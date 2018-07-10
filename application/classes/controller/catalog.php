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
			if (count($a_array)>=2) {
				$parent = $a_array[count($a_array)-3];
			} else {
				$parent = $catalog;
			}
			//echo $sid;
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
			$this->template->h1 = $cat->name;
		} else {
			if (strlen($parent)>0) {
				$parent = ORM::factory('categorie')->where('alias',"=",$parent)->find();
				$pid = $parent->id;
			} else {
				$pid=0;
			}
			$cat = ORM::factory('categorie')->where('alias',"=",$alias)->where('category_id','=',$pid)->find();
			$this->main = $cat->main;
			$this->template->crumbs = $this->make_crumbs($cat);
			$this->template->h1 = $cat->name;
		}
						

		if ($this->main != 1)
		{			
			$this->get_root($cat);
			ksort($this->upmenu);
		} else {
			$this->template->beste = $this->getbest(5);
			//$this->template->bestp = $this->getbest(4);
			
		}		
		
		
		
		//unset($arr[count($arr)-1]);

		
		//$navi = new Controller_Navigation;

	//echo $cat->type;
		switch ($cat->type)
		{
			case 'text':
				$content = View::factory('page');
				//$content->h1 = $cat->title;
				$this->template->h1 = 'Горячая линия';
				$content->h1 = $cat->title;
				$content->html = $cat->html;
				$content->login = $this->login;
				$content->crumbs = $this->make_crumbs($cat);
				$content->addwords = $cat->addwords;
				$content->uplinks = ORM::factory('categorie')->where('category_id','=',$cat->id)->order_by('sort')->find_all();
				$this->template->uid = $cat->id;
//				$comments_url = 'comments/' . $id;
//				$comments = Request::factory($comments_url)->execute();	
			break;
			case 'companies':
				$content = View::factory('companies1');
				
				$content->img="/img/experts.jpg";
				$content->title="Частные консультанты - провайдеры услуг для экспортеров";
				$content->h1="Частные консультанты";	
			
				$content->stitle="Частные консультанты - провайдеры услуг для экспортеров";
				$content->sdescr="Раздел «Частные консультанты» сайта «Russia Going Global» посвящен российским и зарубежным независимым консультантам, специализирующихся на поддержке экспорта и продвижении продукции на внешних рынках. Вы сможете найти интересующего консультанта с помощью фильтров, посмотреть детальную информацию о консультанте, написать отзыв на консультанта и связаться с ним.";

				$content->h1 = $cat->title;
				$content->html = $cat->html;
				$content->login = $this->login;
				$content->crumbs = $this->make_crumbs($cat);
				$content->addwords = $cat->addwords;
				$content->uplinks = ORM::factory('categorie')->where('category_id','=',$cat->id)->order_by('sort')->find_all();
				$this->template->uid = $cat->id;
//				$comments_url = 'comments/' . $id;
//				$comments = Request::factory($comments_url)->execute();	
			break;			
			case 'news':
				if (strlen($sid)==0) {
					/*if (intval($_GET['page']) == 0) {
						$page = 0;
					} else {
						$page = intval($_GET['page']) - 1;
					}*/
					$page = intval($_GET['page']);
					$ids = $this->ids($cat,$_GET['search'],$_GET['tags']);
					//print_r($ids);
					if (count($ids) > 1) {
						$allnews = ORM::factory('new')->where('category_id','=',$cat->id)->where('enabled','=',1)->where('id','in',$ids)->find_all();
						$news = ORM::factory('new')->where('category_id','=',$cat->id)->where('enabled','=',1)->where('id','in',$ids)->order_by('date','desc')->limit(10)->offset($page*10)->find_all();						
					} else {
						$allnews = ORM::factory('new')->where('category_id','=',$cat->id)->where('enabled','=',1)->find_all();					
						$news = ORM::factory('new')->where('category_id','=',$cat->id)->where('enabled','=',1)->order_by('date','desc')->limit(10)->offset($page*10)->find_all();
					}
					
					
					$lastnews = ORM::factory('new')->where('enabled','=',1)->order_by('date','desc')->limit(5)->find_all();
					$leftmenu = ORM::factory('categorie')->where('type','=','news')->where('enabled','=',1)->find_all();
					$pages = $this->pages($allnews->count(),10,$page,5,$cat->parent_chpu.'/'.$cat->alias);
					
					$content = View::factory('news/list');
					$content->stitle = "Новости Russia Going Global";
					$content->sdescr ="Хотите быть в курсе новостей в сфере экспорта, получать информацию о существующих инструментах государственной поддержки экспорта и продвижения на внешних рынка, получать экспертную информацию по тем или иным аспектам развития экспорта, знать истории успеха российских компаний, которые уже успешно осуществляют географическую экспансию – подписываетесь на новости Russia Going Global.";
					$content->leftmenu = $leftmenu;
					$content->login = $this->login;
					$content->cat = $cat;
					$content->pages = $pages;
					$content->page = $page;
					$content->news = $news;
					$content->lastnews = $lastnews;
					$this->template->uid = -1;
				} else {
					$content = View::factory('/detailed')->bind('details', $details);
					$content->login = $this->login;
					$content->page = $_GET['page'];
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
					$content->login = $this->login;
					$content->errors = array();
					$content->data = array();
					$content->cat = $cat;
					$content->captcha = $captcha;
					$cats = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();			
					$content->menu = $this->make_menu($cats);

					
				} else {

					
					
					//print_r($_POST);
					$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
					$validation->rule('fio', 'not_empty');
					$validation->rule('description', 'not_empty');
					$validation->rule('name', 'not_empty');
					$validation->rule('cat', 'not_empty');
					$validation->rule('mail', 'not_empty');
					$validation->rule('mail', 'email');
					$validation->rule('captcha', 'not_empty');
					//echo $_POST['captcha']."==".$_SESSION['captcha_response'];
					$validation->labels(array(
						'fio' => 'ФИО',
						'mail' => 'E-mail',
						'description' => 'Сообщение',
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
						$cps = ORM::factory('product')->where('user_id','=',0)->where('sizes','=',$_POST['mail'])->find();
						if ($cps->id>0) 
						{
							$errors[]="Вы уже отправляли заявку без регистрации. Для отправления заявок вам необходимо зарегистрироваться";
						}					
					}
					//print_r($errors);
					if (count($errors)>0)
					{
						$news = ORM::factory('feed')->where('enabled','=',1)->order_by('id','DESC')->find_all();
						$content = View::factory('feeds/list');
						$content->login = $this->login;
						$content->errors = $errors;
						$content->data = $_POST;
						$content->cat = $cat;
						$content->captcha = $captcha;
						$cats = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();			
						$content->menu = $this->make_menu($cats);
					} else {

						$cat = ORM::factory('categorie')->where('id','=',$_POST['cat'])->find();
						$prod = ORM::factory('product');
						$prod->category_id = $_POST['cat'];	
						$prod->parent_chpu = $cat->parent_chpu.'/'.$cat->alias;
						$alias = strtolower($this->translit($_POST['name']));
						$prod->alias = $alias;	
						$prod->description = $_POST['description'];	
						$prod->name = $_POST['name'];	
						$prod->colors = $_POST['fio'];	
						$prod->sizes = $_POST['mail'];	
						$prod->cts = time();
						$prod->user_id = $this->auth->instance()->get_user()->id;					
						$prod->save();
						
						$mail_url = 'smsg/lot/'.$prod->id."/0/";
						$mail = Request::factory($mail_url)->execute();

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
				$news = $this->vertmenu;
				$content = View::factory('articles/list');
				$content->news = $news;
				$content->cat = $cat;
				$this->template->h1 = 'Горячая линия';
				$this->template->uid = -2;

			break;			
			case 'catalog':
				//echo $sid;
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
						
						/*if ($this->root == 0) {
							$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->where('enabled','=',1)->order_by('sort')->find_all();
							$back = $cat->background;
						} else {
							$subcats = ORM::factory('categorie')->where('category_id','=',$this->root)->where('enabled','=',1)->order_by('sort')->find_all();
							$bm = ORM::factory('categorie')->where('id','=',$this->root)->where('enabled','=',1)->find();
							$back = $bm->background;
						}*/
						
						$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->where('enabled','=',1)->order_by('sort')->find_all();
						foreach ($subcats as $sc)
						{
							$cats[] = $sc->id;
						}
						
						$sub_items = ORM::factory('categorie')->where('category_id','=',$cat->id)->order_by('sort')->find_all();
						
						/*foreach ($subcats as $sc)
						{
							$cats[] = $sc->id;
						}*/
						
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
							$a = $this->good_list_no_groups($data," category_id =".$cat->id);
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
						$this->template->saletype = 1;
					} else {
						$content = View::factory('/detailed')->bind('details', $details);
						$prod = ORM::factory('product')->where('alias','=',str_replace(".html","",$sid))->find();
						$st = $prod->sale_type;
						//echo $prod->sale_type;
						if ($prod->sale_type == 0) {
							$this->template->saletype = 1;
						} else {
							$this->template->saletype = 2;
						}
						if ($prod->id == 0) {
							return $this->request->redirect("/");
						}
						$details_url = 'details/'.$alias."/".$sid;
						$details = Request::factory($details_url)->execute();
						if (strlen($prod->title)==0) {
							$cat->title .= "::".$prod->title;
						} else {
							$cat->title = $prod->title;
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

		$content->info = $this->gen_info;
		
		//var_dump($this->request);
		//if ($this->root == $cat->id) {$this->root = 0;}
		//echo $this->template->saletype; exit;
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
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
		$this->template->banners2 = $this->banners2;
		$this->template->banners3 = $this->banners3;

		
		//$this->template->upmenu = $this->upmenu;		
        $this->template->content = $content;
    }

public function translit($urlstr){

	$urlstr = str_replace(" ","_",$urlstr);
	$urlstr = str_replace("(","",$urlstr);
	$urlstr = str_replace(")","",$urlstr);
	$urlstr = str_replace(",","",$urlstr);
	$urlstr = str_replace(".","",$urlstr);
	$urlstr = str_replace("+","",$urlstr);
	$urlstr = str_replace('"',"",$urlstr);
	$urlstr = str_replace("'","",$urlstr);
	$urlstr = str_replace("#","",$urlstr);
	$urlstr = str_replace("/","_",$urlstr);
	$urlstr = str_replace("-","_",$urlstr);

	if (preg_match('/[^A-Za-z0-9_]/', $urlstr)) {
    		$urlstr = $this->translitChars($urlstr);
    		$urlstr = preg_replace('/[^A-Za-z0-9_]/', '', $urlstr);
	}
	return $urlstr;
}

public function translitChars($str){
    $tr = array(
		"[red]"=> "", "[/red]"=> "",
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ж"=>"zh","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"i","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"i","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
        " "=> "-", "."=> "", "/"=> "_"
    );
    return strtr($str,$tr);
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
