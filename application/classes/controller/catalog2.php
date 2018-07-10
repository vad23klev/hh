<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Catalog extends Controller_Common {
 
    public function action_index()
    {
		$id = $this->request->param('id');
		$catalog = $this->request->param('catalog');
		
//
		$sid = "";		
//echo $id;
		if (strlen($id)==0) {
			$alias = $this->request->param('catalog');
		} elseif (strpos($this->request->param('id'),".html")>0) {
			$id = $catalog."/".$id;
			$a_array = explode("/",$id);
			$sid = $a_array[count($a_array)-1];
			//$alias = str_replace("/".$sid,"",$id);
			$alias = $a_array[count($a_array)-2];
			//print_r($a_array);
			if (count($a_array)>=2) {
				$parent = $a_array[count($a_array)-3];
			} else {
				$parent = $catalog;
			}

		} else {
			$a_array = explode("/",$id);
//			print_r($a_array);
			$alias = $a_array[count($a_array)-1];
			if (count($a_array)>=2) {
				$parent = $a_array[count($a_array)-2];
			} else {
				$parent = $catalog;
			}
		}
		
		if (count($this->request->param())==0)
		{
			$cat = ORM::factory('categorie')->where('main','=',1)->find();
			$alias = $cat->alias;
			$this->main = 1;
		} else {
			if (strlen($parent)>0) {
				$parent = ORM::factory('categorie')->where('alias',"=",$parent)->find();
				$pid = $parent->id;
			} else {
				$pid=0;
			}
			$cat = ORM::factory('categorie')->where('alias',"=",$alias)->where('category_id','=',$pid)->find();
			$this->main = $cat->main;
		}
						
		if ($this->main != 1)
		{			
			$this->get_root($cat);
			ksort($this->upmenu);
		} else {
			
			$hits = $this->good_list_no_groups($data," sale_type = 3");
			//print_r($hits);exit;
			$this->template->hits = $hits['prods'];
			$pgoods = $this->good_list_no_groups($data," sale_type = 2");
			$this->template->pgoods = $pgoods['prods'];
		}

		//unset($arr[count($arr)-1]);
		$this->template->crumbs = $this->make_crumbs($cat);
		
		
		//$navi = new Controller_Navigation;
		$bcat = ORM::factory('categorie')->where('main','=',1)->find();
		$back = $bcat->background;
	
		switch ($cat->type)
		{
			case 'text':
				$content = View::factory('page');
				$content->h1 = $cat->title;
				$content->html = $cat->html;
				$content->uplinks = ORM::factory('categorie')->where('category_id','=',$cat->id)->order_by('sort')->find_all();
				$this->template->uid = $cat->id;
//				$comments_url = 'comments/' . $id;
//				$comments = Request::factory($comments_url)->execute();	
			break;
			case 'news':
				if (strlen($sid)==0) {
					$news = ORM::factory('new')->where('enabled','=',1)->order_by('date','desc')->find_all();
					$content = View::factory('news/list');
					$content->news = $news;
					$this->template->uid = -1;
				} else {
					$content = View::factory('/detailed')->bind('details', $details);
					$prod = ORM::factory('new')->where('alias','=',str_replace(".html","",$sid))->find();
					$details_url = 'details/'.$alias."/".$sid;
					$details = Request::factory($details_url)->execute();
					$cat->title .= "::".$prod->name;
					$this->template->uid = -1;
				}
			break;
			case 'feeds':
				$captcha = Captcha::instance();
				$errors = array();
				if (count($_POST)==0) {
					$news = ORM::factory('feed')->where('enabled','=',1)->order_by('id','DESC')->find_all();
					$content = View::factory('feeds/list');
					$content->errors = array();
					$content->data = array();
					$content->cat = $cat;
					$content->captcha = $captcha;
					
				} else {

					
					
					//print_r($_POST);
					$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
					$validation->rule('fio', 'not_empty');
					$validation->rule('text', 'not_empty');
					$validation->rule('mail', 'not_empty');
					$validation->rule('mail', 'email');
					$validation->rule('captcha', 'not_empty');
					//echo $_POST['captcha']."==".$_SESSION['captcha_response'];
					$validation->labels(array(
						'fio' => 'ФИО',
						'mail' => 'E-mail',
						'text' => 'Сообщение',
						'captcha' => 'Код картинки',
					));
					
					if( !$validation->check())
					{
						$errors = $validation->errors('validation');
					} else {
						if (!Captcha::valid($_POST['captcha']))
						{
							$errors[]="Неправильно введен код с картинки";
						}
						
					}
					//print_r($errors);
					if (count($errors)>0)
					{
						$news = ORM::factory('feed')->where('enabled','=',1)->order_by('id','DESC')->find_all();
						$content = View::factory('feeds/list');
						$content->errors = $errors;
						$content->data = $_POST;
						$content->cat = $cat;
						$content->captcha = $captcha;
						
					} else {
						$feed = ORM::factory('feed');
						$feed->date = $_POST['date'];
						$feed->fio = $_POST['fio'];
						$feed->mail = $_POST['mail'];
						$feed->text = $_POST['text'];
						$feed->enabled = 0;
						$feed->save();
						
						
						
						$headers  = "Content-type: text/html; charset=utf-8 \r\n";
						$headers .= "From: Магазин Agava <info@agavaspb.ru>\r\n"; 					
						
						$body = $_POST['date']."<br/>";
						$body = $_POST['fio']."<br/>";
						$body = $_POST['text']."<br/>";
						$emails = array();
						$emails = explode(';',$this->gen_info->email);				
						//print_r($emails);
						foreach ($emails as $email) {
							$res = mail($email,"Новое сообщение",$body,$headers);
							echo $res;
						/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
						}
						//exit();
						
						
						return $this->request->redirect('podtverjdenie_otziva');
						//podtverjdenie_otziva
						
					}
					
					
				}
				
				$this->template->uid = -1;
				$this->template->view = 0;
			break;
			case 'gallery':
				$news = ORM::factory('shopimg')->where('shop_id','=',$cat->id)->find_all();
				$content = View::factory('gallery/list');
				$content->photos = $news;
				$content->cat = $cat;
				$this->template->uid = -2;
			break;
			case 'articles':
				if (strlen($sid)==0) {
					$news = ORM::factory('article')->where('enabled','=',1)->find_all();
					$content = View::factory('articles/list');
					$content->news = $news;
					$content->cat = $cat;
					$this->template->uid = -2;
				} else {
					$content = View::factory('/detailed')->bind('details', $details);
					$prod = ORM::factory('article')->where('alias','=',str_replace(".html","",$sid))->find();
					$details_url = 'details/'.$alias."/".$sid;
					$details = Request::factory($details_url)->execute();
					$cat->title .= "::".$prod->name;
					$this->template->uid = -2;
				}
			break;			
			case 'catalog':
					if (strlen($sid)==0) {
						$data = $_GET;
					
						if (!isset($data['page']))
						{
							$data['page'] = 0;
						}
						
						if (!isset($data['sort']))
						{
							$data['sort'] = "price";
						}				
						
						if (!isset($data['view']))
						{
							$data['view'] = 0;
						}				

						if (!isset($data['min']))
						{
							$data['min'] = 0;
						}

						if (!isset($data['max']))
						{
							$data['max'] = 999999;
						}
						
						if (!isset($data['color']))
						{
							$data['color'] = 0;
						}

						if (!isset($data['size']))
						{
							$data['size'] = 0;
						}
						if (!isset($data['mat']))
						{
							$data['mat'] = 0;
						}

						if (!isset($data['brend']))
						{
							$data['brend'] = 0;
						}						

						$catalog = ORM::factory('categorie')->where('id','=',$this->root)->find_all();
						
						if ($cat->category_id == 0) {
							$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->where('enabled','=',1)->order_by('sort')->find_all();
						} else {
							$subcats = ORM::factory('categorie')->where('category_id','=',$cat->category_id)->where('enabled','=',1)->order_by('sort')->find_all();
						}
						
						$sub_items = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();
						
						$sca = "(";
						foreach ($sub_items as $sc)
						{
							$sca .= $sc->id.",";
						}
						$sca .= $cat->id.")";
						
						$menu = $this->make_recursive_menu($catalog,"0",$arr);
						//print_r($menu[$this->root]['children']);
						$s = $this->draw_vert_menu($menu[$this->root]['children'],0,$cat->id);
						//echo $s;
						//$cat->('category_id', $tag););
						$count = 0;

						
						//print_r($grp);		
						//if (count($subcats)==0) {		
							//$a = $this->good_list($cat,$data);
							$podbor = $this->podbor($cat->id);
							$a = $this->good_list_no_groups($data," category_id in ".$sca);
							$content = View::factory('catalog/list');
							$content->cat = $cat;
							$content->podbor = $podbor;
							
							$brends = DB::query(Database::SELECT,"SELECT ss_brands.id,ss_brands.name from ss_products left join ss_brands on ss_products.brand_id=ss_brands.id where ss_brands.category_id=".$this->root." GROUP BY ss_brands.id,ss_brands.name")->execute()->as_array();

							//echo $this->root;print_r($brends);exit;
							
							$content->brends = $brends;
							//$cats = ORM::factory('categorie')->where('category_id','=',$cat->category_id)->find_all();
							$content->subcats = $subcats;
							$content->sub_items = $sub_items;
							$content->root = $this->root;
							//$content->upmenu = $this->upmenu;
							$content->vertmenu = $s;
							//echo count($a['prods']);
							if (count($a['prods'])>0) {
								$content->prods = $a['prods'];
							} else {
								
								$grp = $this->form_groups($cat);						
								$groups = "(0,";
								foreach ($grp as $i=>$gr)
								{
									$groups .= $gr.",";
								}
								$groups .= ")";
								$groups = str_replace(",)",")",$groups);
								
								$a = $this->good_list_no_groups($data," category_id in".$groups);
								if ($a['data']['view']==1) {
									$content->prods = $a['prods'];
								} else {
									$content->prods = array();
								}
								//print_r($a['data']);	
							
							}
							//echo $a['pagination'];
							$content->pagination = $a['pagination'];
/*						} else {
							$content = View::factory('catalog/list');
							$content->cat = $cat;
							$content->vertmenu = $s;
							$content->subcats = $subcats;
						}*/

					} else {

								$content = View::factory('/detailed')->bind('details', $details);
								$prod = ORM::factory('product')->where('alias','=',str_replace(".html","",$sid))->find();
								$details_url = 'details/'.$alias."/".$sid;
								$details = Request::factory($details_url)->execute();
								if (strlen($prod->title)==0) {
									$cat->title .= "::".$prod->name;
								} else {
									$cat->title = $prod->name;
								}
					}
					$this->template->uid = 0;
					
					if ($this->root == 0) {
						$back = $cat->background;
					} else {
						$bm = ORM::factory('categorie')->where('id','=',$this->root)->where('enabled','=',1)->find();
						$back = $bm->background;
					}					
			break;
		}

		
		//var_dump($this->request);
		//if ($this->root == $cat->id) {$this->root = 0;}
		$this->template->back = $back;
		$this->template->cat_id = $cat->id;
		$this->template->root = $this->root;
		$this->template->main = $this->main;
		$this->template->brands = $this->brands;
		$this->template->brandpics = $this->brandpics;
		$this->template->title = $cat->title." | ".$this->title;
		//$this->template->gen_info = $this->gen_info;
		$this->template->keywords = $cat->keywords;
		$this->template->description = $cat->description;
		//$this->template->vertmenu = $this->vertmenu;
		//$this->template->hormenu = $this->hormenu;
		$this->template->banners2 = $this->banners2;
		$this->template->banners3 = $this->banners3;

		
		//$this->template->upmenu = $this->upmenu;		
        $this->template->content = $content;
    }
	
	
	
	
	public function form_groups($cat) {
		$r = array();
		
		//$r[] = $cat->id;
		//echo $cat->id;
		
		$sgr = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();
		//print_r($sgr);
		//echo $cat->id."==".count($sgr)."<br/>";
		if (count($sgr)>0)
		{
			foreach ($sgr as $v)
			{
				$r[] = $v->id;
				$s_r = array();
				$s_r = $this->form_groups($v);
				foreach ($s_r as $v2)
				{
					$r[] = $v2;
				}
			}		
		}
		return $r;
	}
	
} // Articles
