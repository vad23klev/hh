<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Details extends Controller {
	public $upmenu = array();
	public $title= '';
	public $root = 0;
	
	
	public function before()
    {
        parent::before();	
		$this->auth = new Auth_ORM(
		array(
			'hash_method'  => 'md5',
			'hash_key'     => 5856739,
			'lifetime'     => 1209600,
			'session_key'  => 'adm_auth_user',
		));
		
	}
	
	
    public function action_index()
    {
		$id = $this->request->param("id");
		$a_array = explode("/",$id);

		$sid = $a_array[count($a_array)-1];
		//$alias = str_replace("/".$sid,"",$id);
		$alias = $a_array[count($a_array)-2];
		$sid = str_replace(".html","",$sid);
		$cat = ORM::factory('categorie')->where('alias','=',$alias)->find();
		
		switch ($cat->type)
		{
			case 'news':
				$content = View::factory('news/item');
				
				if(!$this->auth->instance()->logged_in())
				{
					$login['name']=-1;
				} else {
					//print_r($this->auth->instance());
					$name = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_users.role,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();			
					//print_r($name[0]);
					
					$login = $name[0];
					$login['name'] = $name[0]['fio'];	
					if ($name[0]['expert'] == 1) {
						$login['role'] = $this->auth->instance()->get_user()->role;
					} else {
						$login['role'] = 1;
					}
				}
				
				$content->login = $login;
				$lastnews = ORM::factory('new')->where('enabled','=',1)->order_by('date','desc')->limit(5)->find_all();
				$leftmenu = ORM::factory('categorie')->where('type','=','news')->where('enabled','=',1)->find_all();
				$content->leftmenu = $leftmenu;
				$prod = ORM::factory('new')->where('alias','=',$sid)->find();
				$content->stitle = $prod->name;
				$content->sdescr = htmlspecialchars(strip_tags($prod->announce));
				$content->title = $prod->name;
				$content->description = htmlspecialchars(strip_tags($prod->announce));
				$content->lastnews = $lastnews;
				$content->prod = $prod;
				$content->name = $cat->name;
				$content->info = ORM::factory('info')->find();
				$content->idd = $cat->id;
				$content->link = $cat->parent_chpu."/".$cat->alias;
				$this->title = $prod->name;
			break;
			case 'feeds':
			break;
			case 'articles':
				$content = View::factory('articles/item');
				$prod = ORM::factory('article')->where('alias','=',$sid)->find();
				$content->prod = $prod;
				$content->link = $cat->parent_chpu."/".$cat->alias;
				$this->title = $prod->name;
			break;			
			case 'catalog':
			if($this->auth->instance()->logged_in())
			{
				$s = Session::instance();
				$_SESSION['num'] = intval($_GET['num']);
			
				$prod = ORM::factory('product')->where('alias','=',$sid)->find();
				$catt = ORM::factory('categorie')->where('id','=',$prod->category_id)->find();
				$this->get_root($catt);

				if ($prod->sale_type == 0) {
					if ($prod->user_id == $this->auth->instance()->get_user()->id) {
						$content = View::factory('catalog/item');
					} else {
						$content = View::factory('catalog/itemp');						
					}
				} else {
					$content = View::factory('catalog/q');
				}	
				if ($_POST)
				{
					$validation = Validation::factory($_POST);
						//$validation->bind(':cr', $_SESSION['captcha_response']);
					$validation->rule('ticket', 'not_empty');
					
					$validation->check();
					$content->errors = $validation->errors('validation');
					$content->current = $_POST['uid'];
					if(!$validation->check())
					{
						$content->data = $_POST;
					} 
					else {
						
						$prod = ORM::factory('feed');
						$prod->text = $_POST['ticket'];	
						$prod->cts = time();
						$prod->product_id = $_POST['uid'];
						$prod->preuser_id = $_POST['preuser'];						
						$prod->user_id = $this->auth->instance()->get_user()->id;					
						$prod->save();
						
						$fname = $this->uploadFile($_FILES['filename'],'img/feeds',$prod);
						$prod->file = $fname;
						$prod->save();
						$mail_url = 'smsg/lot/'.$_GET['uid']."/1/";
						$mail = Request::factory($mail_url)->execute();

						return $this->request->redirect($_SERVER['HTTP_REFERER']);
					}	
				}
	
				//print_r($this->upmenu);
				$expert = ORM::factory('expert')->where('product_id','=',$prod->id)->where('expert_id','=',$this->auth->instance()->get_user()->id)->find();
				$usr = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
				
				$specs = ORM::factory('cat2prod')->where('product_id','=',$prod->id)->find_all();
				$prs = '';
				foreach ($specs as $spec)
				{
					$c1 = ORM::factory('categorie')->where('id','=',$spec->cat_id)->find();
					if ($c1->category_id > 0)
					{
						$prs = $c1->name;
					}
				}
				
				
				if ($prod->user_id == $this->auth->instance()->get_user()->id) {
					//if ($prod->stock_type == 6) {
						//$experts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_experts.choosen,ss_experts.reject FROM ss_experts LEFT JOIN ss_useratts ON ss_experts.expert_id = ss_useratts.user_id WHERE product_id='.$prod->id)->execute()->as_array();	
					//} else {
					$experts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email,ss_experts.id as eid,ss_experts.choosen,ss_experts.reject,ss_experts.price,ss_experts.valuta,ss_experts.reason,ss_experts.oferta,ss_experts.uts,
					ss_experts.dogovor,ss_experts.fio as fio1,ss_experts.dolz as dolz1,ss_experts.draft as draft FROM ss_experts LEFT JOIN ss_useratts ON ss_experts.expert_id = ss_useratts.user_id LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE product_id='.$prod->id.' and ss_useratts.user_id>0 and ss_experts.draft = 0 order by ss_experts.choosen desc')->execute()->as_array();						
					
					//}
				} else {
					$experts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE user_id='.$prod->user_id)->execute()->as_array();	
					
					$exp = ORM::factory('expert')->where('product_id','=',$prod->id)->where('choosen','=',1)->find();
					$experts[0]['choosen'] = $exp->choosen;
					$experts[0]['oferta'] = $expert->oferta;
					//print_r($experts);
				}
				
				$view = 0; 
				$showform  = 1;
				$choosen = 0;
				if ($prod->sale_type == 0) {
					
					foreach ($experts as $k=>$exp) {
						if ($exp['choosen'] == 1) {
							$choosen = 1;
						}
						//print_r($exp);
						if ($prod->user_id == $this->auth->instance()->get_user()->id && intval($exp['user_id'])>0) {
							$eu = $exp['user_id'];
							$e1 = 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.user_id,ss_feeds.text,ss_feeds.file,ss_feeds.rating,ss_useratts.shortname,ss_useratts.photo FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id.' and (ss_feeds.user_id = '.$eu.' or ss_feeds.preuser_id='.$eu.') order by cts asc';
							$feeds = DB::query(Database::SELECT, $e1)->execute()->as_array();							
							$jobs = ORM::factory('job')->where('product_id','=',$prod->id)->where('expert_id','=',intval($exp['user_id']))->find_all();
							$total = 0;
							foreach ($jobs as $job) {
								$total += $job->cost; 
							}
							$experts[$k]['jobs'] = $jobs;
							$experts[$k]['total'] = $total;

							$files = ORM::factory('file')->where('product_id','=',$prod->id)->where('user_id','=',intval($exp['user_id']))->find_all();
							$outfiles = ORM::factory('file')->where('product_id','=',$prod->id)->where('user_id','=',intval($this->auth->instance()->get_user()->id))->where('owner_id','=',intval($exp['id']))->find_all();
							$experts[$k]['files'] = $files;
							$experts[$k]['outfiles'] = $outfiles;
							
						} else {
							$view = 1;
							$feeds = DB::query(Database::SELECT, "SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.file,ss_feeds.user_id,ss_feeds.text,ss_feeds.best,ss_feeds.rating,ss_useratts.shortname,ss_useratts.photo FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id=".$prod->id." and (ss_feeds.user_id in (".$this->auth->instance()->get_user()->id.",".$prod->user_id.") and ss_feeds.preuser_id in (".$this->auth->instance()->get_user()->id.",".$prod->user_id.")) order by cts asc")->execute()->as_array();
							$jobs = ORM::factory('job')->where('product_id','=',$prod->id)->where('expert_id','=',$this->auth->instance()->get_user()->id)->find_all();
							
							$files = ORM::factory('file')->where('product_id','=',$prod->id)->where('user_id','=',$this->auth->instance()->get_user()->id)->find_all();
							$experts[$k]['files'] = $files;
							$experts[$k]['jobs'] = $jobs;
							$diff = time() - $expert->reject; // || (($expert->reject != 0 && $expert->reject_e != 0) || $diff > 3*24*60*60)							
							if ($expert->id == 0) {
								$showform = 0;
							}
							
							if ($choosen == 1 && $expert->choosen==0) {
								$showform = 0;
							}

							
						}
					

					
						foreach ($feeds as $j=>$feed)
						{
							$feeds[$j]['cts'] = $this->dateru($feeds[$j]['cts']);
						}
						$experts[$k]['feeds'] = $feeds;
						$experts[$k]['rate'] = $this->get_rate($exp['id']);
						//$experts[$k]['fullname'] = htmlspecialchars($experts[$k]['fullname']);
					}
					
					
					/*if (strlen($prod->title) > 250) {
						$title1 = substr($prod->title,0,250);
						$ta = explode(' ',$title1);
						//print_r($ta);
						if(count($ta) > 1) {
							unset($ta[count($ta)-1]);
						}
						$title1 = implode(' ',$ta);
					}*/
					$content->title1 = $prod->title;
					
					
				} else {
					foreach ($feeds as $j=>$feed)
					{
						$feeds[$j]['cts'] = $this->dateru($feeds[$j]['cts']);
					}

					if ($prod->user_id == $this->auth->instance()->get_user()->id) {
						$showform = 0;
						
						$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.file,ss_feeds.user_id,ss_feeds.text,ss_feeds.best,ss_feeds.rating,ss_useratts.fio,ss_useratts.lastname,ss_useratts.surname,ss_useratts.photo FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id." order by cts asc")->execute()->as_array();						
					} else {
						$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.file,ss_feeds.user_id,ss_feeds.text,ss_feeds.best,ss_feeds.rating,ss_useratts.fio,ss_useratts.lastname,ss_useratts.surname,ss_useratts.photo FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id." and ss_feeds.user_id in (".$prod->user_id.",".$this->auth->instance()->get_user()->id.") order by cts asc")->execute()->as_array();										
					}
					
					foreach ($feeds as $j=>$feed)
					{
						$feeds[$j]['cts'] = $this->dateru($feeds[$j]['cts']);
					}					
					
					$content->feeds = $feeds;	
				}
				
				$this->get_root_id($catt);		
				//$this->get_root($catt);		
				$arr = $this->get_parents($catt);
				
				//krsort($arr);
				$menu = $this->draw_menu($arr);
				//print_r($menu);
				$catalog = ORM::factory('categorie')->where('id','=',$this->root)->find_all();
				$options = ORM::factory('value')->where('product_id','=',$prod->id)->find_all();
				$menu = $this->make_recursive_menu($catalog,"0",$arr);
				
				//$menu = $this->make_menu($catalog,"0",$arr);
				//print_r($menu);
						//print_r($menu[$this->root]['children']);
				$s = $this->draw_vert_menu($menu[$this->root]['children'],0,$catt->id);
				
				$imgs = ORM::factory('img')->where('product_id','=',$prod->id)->find_all();

				
					/*} else {
						$content = View::factory('catalog/item2');
					}*/

				$this->title = $prod->name;
				$content->cid = $catt->id;
				$content->prs = $prs;
				$content->in_wind = $_SESSION['in_wind'];
				$_SESSION['in_wind'] = 0;
				$content->imgs = $imgs;
				$content->options = $options;
				$content->num = $_SESSION['num'];
				$content->user = $this->auth->instance()->get_user()->id;
				$content->udata = $usr;
				$content->view = $view;
				$content->cat = $catt;
				$content->showform = $showform;
				$content->expert = $expert;
				$content->reject = $expert->reject;
				$content->choosen = $choosen;
				$content->experts = $experts;
				$content->na = $expert->id;
				$content->user_id = $this->auth->instance()->get_user()->id;
				$content->view = $view;
				$content->prod = $prod;

				} else {
					return $this->request->redirect("/user/register");
			
				} 
				//$content->upmenu = $this->upmenu;
			break;
		}
		
		
		$this->response->body($content);
    }


	public function get_rate($id)
    {
		$rateout = array();
        $e1 = 'SELECT avg(`rating`) as rate FROM `ss_experts` WHERE `expert_id`='.$id.' and `rating`>0';
		$rate = DB::query(Database::SELECT, $e1)->execute()->as_array();
		$rateout['rate'] = intval($rate[0]['rate']);
		$e1 = 'SELECT count(`reason`) as rate FROM `ss_experts` WHERE `expert_id`='.$id.' and `reason`<>""';
		$feeds = DB::query(Database::SELECT, $e1)->execute()->as_array();
		$rateout['feeds'] = intval($feeds[0]['rate']);
		return $rateout	;
    }



	
	public function get_root($cat)
    {
        if (strlen($cat->parent_chpu)>0)
        {
            $this->upmenu[$cat->id]['link'] = $cat->parent_chpu."/".$cat->alias;
        } else {
            $this->upmenu[$cat->id]['link'] = $cat->alias;
        }
        $this->upmenu[$cat->id]['name'] = $cat->name;
        
        if ($cat->category_id>0)
        {
            $pc = ORM::factory('categorie')->where('id',"=",$cat->category_id)->find();
            $this->get_root($pc);
        }
    }
	
	
	    public function get_root_id($cat)
    {	
        if ($cat->category_id>0)
        {
            $pc = ORM::factory('categorie')->where('id',"=",$cat->category_id)->find();
            $this->root = $pc->id;
			$this->get_root_id($pc);
        } else {$this->root = $cat->id;}
    }
	

public function draw_vert_menu($menu,$level=0,$current)
{
	$res = "";
//$res = "<ul class='vmenu'>";
	foreach ($menu as $lm)
	{
		$level ++;
		
		if ($current != $lm['id'])
		{		
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" >".$lm['name']."</a> >> ";
		} else {
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" style=\"font-weight:bold;\">".$lm['name']."</a>  >> ";		
		}
		
		if (count($lm['children'])>0)
		{
			$res .= $this->draw_vert_menu($lm['children'],$level,$current);
		}
		$level--;
						
	}
//$res .= "</ul>";

return $res;
}

public function get_parents($cat,$pos=0)
{
	$arr[$pos] = $cat->id;
	
	if ($cat->category_id>0){
		$parent = ORM::factory('categorie')->where('id','=',$cat->category_id)->find();
		$pos ++;
		$arr += $this->get_parents($parent,$pos);
	}
	
	return $arr;
}

private function draw_menu($menu) {
	$menuelems = array();
	foreach ($menu as $i=>$elem)
	{		
		$menuelem = ORM::factory('categorie')->where('id','=',$elem)->find();
		$menuelems[$i]['link'] = $menuelem->parent_chpu."/".$menuelem->alias;
		$menuelems[$i]['name'] = $menuelem->name;
		
	}
	return $menuelems;
}


	protected function make_recursive_menu($src,$type,$arr) {
        $menu_arr = array();
        if (count($src)>0)
        {
            foreach($src as $i=>$elem)
            {
                $alias = $elem->alias;
                if (strlen($elem->parent_chpu)>0) {
                    $menu_arr[$elem->id]['link'] = $elem->parent_chpu."/".$alias;
                } else {$menu_arr[$elem->id]['link'] = $alias;}
                $menu_arr[$elem->id]['active'] = 0;
                $menu_arr[$elem->id]['name'] = $elem->name;
				$menu_arr[$elem->id]['id'] = $elem->id;
                $menu_arr[$elem->id]['children'] = array();
                
                $children = ORM::factory('categorie')->where('category_id','=',$elem->id)->where('enabled','=',1)->find_all();
                if (count($children)>0 && in_array($elem->id,$arr))
                {
                    $menu_arr[$elem->id]['children'] = $this->make_recursive_menu($children,$type,$arr);
                }
            }
            
        }    
        return $menu_arr;
    }	

public function dateru($intime) {
	if(strlen($intime)>0) {
		$time = date('Y.m.d',$intime);
		//echo $time.' ';
		$t_arr = explode(".",$time);
		//		print_r($t_arr);
		$day = $t_arr[2];
		$month = $t_arr[1];
		$year = $t_arr[0];
		
		$time1 = date('H.i',$intime);
		//echo $time.' ';
		$t_arr = explode(".",$time1);
		//		print_r($t_arr);
		$hour = $t_arr[0];
		$minute = $t_arr[1];
		
		//		echo $day.' '.$month.' ',$year;
		// Проверка существования месяца

		$months_ru = array(1=>'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
		$date_ru = $day . '&nbsp;'. $months_ru[intval($month)] . '&nbsp;' . $year . ' г. '.$hour.':'.$minute;
		return $date_ru;  
	} else {
		return '';
	}
}

private function uploadFile($file,$folder,$good){
	if (file_exists($file['tmp_name'])) {
		
		
		mb_ereg("\.([^\.]*)$",$file["name"],$t);
		$ext = strtolower($t[1]);
//		if ($image->width>1000 || $image->height>1000) {
//			$image->resize(1000,1000,Image::AUTO);
//		}
		//echo Kohana::debug($this->image);		1
		copy($file['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
		
}


	
} // Articles
