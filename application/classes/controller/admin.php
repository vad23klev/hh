<?php defined('SYSPATH') or die('No direct access allowed.');
	 // Описание класса
	class Controller_Admin extends Controller_Template {
	public $template = "admin";
	public $role = 0;
	public $root = 0;
	private $auth;	
    private $content_types = array('text' =>'Текст', 'catalog' => 'Заявки', 'news' => 'Новости','feeds'=>'обратная связь','articles'=>'Статьи');
	private $nav_types = array(1=>"Верхняя навигация",2=>"Боковая навигация",0=>"Страницы без меню");
	
	public $wmenu = array("<b>Содержание</b>"=>"","Страницы"=>"admin/acategories","Заявки"=>"admin/agoods","Новости"=>"admin/anews","Блоки для главной"=>"admin/aarticles","Пользователи"=>"admin/ausers","Доп. поля"=>"admin/options","<b>Настройки</b>"=>"","Контакты"=>"admin/info","Выход"=>"admin/logout");

	
public function before()
   {		   
        parent::before();
		
		// Save the config in the object
//	'session_type' => Session::$default,		
		$info = ORM::factory('info')->find();
		
		$this->template->title = $info->name;
		
		$this->auth = new Auth_ORM(
		array(
			'hash_method'  => 'md5',
			'hash_key'     => 5856739,
			'lifetime'     => 1209600,
			'session_key'  => 'adm_auth_user',
		));
				
		
		
		if($this->auth->logged_in())
	    {
			
			if (isset($_GET['c_id'])) {
				$curr = ORM::factory('categorie')->where('id','=',$_GET['c_id'])->find();
				$tree = $this->get_parents($curr);
			} else {
				if (!isset($_GET['id'])) {$_GET['id']=0;}
				$curr = ORM::factory('categorie')->where('id','=',$_GET['id'])->find();
				$tree = $this->get_parents($curr);			
			}
			krsort ($tree);
			foreach ($tree as $tr) {
				$tree2[] = $tr;			
			}
			
			$active_id = 0;
			if (strpos($_SERVER['REQUEST_URI'],"/categories")!==false)
			{
				$active_id = $_GET['id'];
			} 
			
			$this->template->navi = $this->show_navi($tree2,$active_id);
			$this->template->bans = $this->show_bans();
			$this->template->login=1;
			$this->template->role = $this->auth->get_user()->role;
			$this->role = $this->auth->get_user()->role;
		} else {$this->template->navi = '';$this->template->login=0;}
	}	

	public function action_upload()
    {
			if($this->auth->logged_in())
            {
				$content = View::factory('admin/upload');
			
				$this->template->wmenu = $this->wmenu;
				$files = glob($_SERVER['DOCUMENT_ROOT']."/exch/*.*");
				$content->files = $files;
				$this->template->content = $content;			
			
			} else {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	}
	
		public function action_import()
    {
			if($this->auth->logged_in())
            {
				$content = View::factory('admin/import');
			
				$this->template->wmenu = $this->wmenu;
				$files = glob($_SERVER['DOCUMENT_ROOT']."/exch/*.*");
				$content->files = $files;
				$this->template->content = $content;			
			
			} else {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	}
	
	
	public function action_pcsv()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				if (file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/out1.csv'))
				{
					$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/exch/out1.csv','r');
					$buffer = "";
					while (!feof($fp)) {
						$buffer = fgets($fp, 4096);
						$data = explode(";",$buffer);
						$prod = ORM::factory('product')->where('id','=',$data[0])->find();
						
						if (strlen(trim($data[2]))>0 && file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[2]))) {
							$ct = ORM::factory('img');
							$ct->product_id = $prod->id;				
							$ct->description = iconv("windows-1251", "utf-8" ,$data[1]);
							$ct->save();
														
							$filename=$this->uploadImg4Csv($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[2]),'img/photos',$ct);
							$ct->name = $filename;
							$ct->save();
						}
						$content .= $prod->id." Фото ".$data[0]." добавлен<br/>";
						
					}
					
					fclose($fp);
				}
				$this->template->wmenu = $this->wmenu;
				$this->template->content = $content;

			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	}	

	
	
	public function action_csv()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				if (file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/out.csv'))
				{
					$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/exch/out.csv','r');
					$buffer = "";					
					
					$i = 0;
					while (!feof($fp)) {
						$buffer = fgets($fp, 4096);
						//print_r($buffer);
						$data = explode(";",$buffer);
							if (count($data)>1 && $i>0) {
								$cat = ORM::factory('categorie')->where('name','=',iconv("windows-1251", "utf-8" ,$data[0]))->find();
								$brand = ORM::factory('brand')->where('name','=',iconv("windows-1251", "utf-8" ,$data[2]))->find();
								$prod = ORM::factory('product')->where('name','=',iconv("windows-1251", "utf-8" ,$data[1]))->find();
								$add = "обновлен";
								if ($prod->id==0) {
									$add = "добавлен";
									$prod = ORM::factory('product');
								}
								
								$prod->name = iconv("windows-1251", "utf-8" ,$data[1]);
								$prod->category_id = $cat->id;
								$prod->brand_id = $brand->id;
								$prod->parent_chpu = $cat->parent_chpu.'/'.$cat->alias;
								$prod->description = iconv("windows-1251", "utf-8" ,$data[2].' '.$data[3])."<br/>".iconv("windows-1251", "utf-8" ,$data[4]);
								$prod->enabled = 1;
								$prod->sale_type = 1;
								$prod->save();
								
								mysql_query('delete from ss_imgs where product_id='.$prod->id);
												
								//echo '/exch/'.trim($data[5]).'<br/>';
								if (strlen(trim($data[5]))>0 && file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[5]))) {
									
									$prod->picture = $this->uploadImg4Csv($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[5]),'img/catalog',$prod);
								}
								
								$prod->alias = $this->translit($prod->name)."_".$prod->id;
								$prod->save();
								
								//if ($add=="добавлен") {
									if (strlen(trim($data[6]))>0 && file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[6]))) {
										$ct = ORM::factory('img');
										$ct->product_id = $prod->id;							
										$ct->save();
										
										
										$filename=$this->uploadImg4Csv($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[6]),'img/photos',$ct);
										$ct->name = $filename;
										$ct->save();
									}
								//echo '/exch/'.trim($data[5]).'<br/>';	
									if (strlen(trim($data[7]))>0 && file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[7]))) {
										$ct = ORM::factory('img');
										$ct->product_id = $prod->id;							
										$ct->save();
										
										
										$filename=$this->uploadImg4Csv($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[7]),'img/photos',$ct);
										$ct->name = $filename;
										$ct->save();
									}					
									
									if (strlen(trim($data[8]))>0 && file_exists($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[8]))) {
										$ct = ORM::factory('img');
										$ct->product_id = $prod->id;							
										$ct->save();
										
										
										$filename=$this->uploadImg4Csv($_SERVER['DOCUMENT_ROOT'].'/exch/'.trim($data[8]),'img/photos',$ct);
										$ct->name = $filename;
										$ct->save();
									}
								//}
								$content .= $prod->id." Товар ".iconv("windows-1251", "utf-8" ,$data[1])." в категорию ".$cat->name." ".$add."<br/>";
							}
							$i++;			
							//echo $i;
						}
						
					
					fclose($fp);
					
				} else {
					$content = "Файл не найден";
				}
				//exit;
				$this->template->wmenu = $this->wmenu;
				$this->template->content = $content;

			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	}	
	


	public function action_repair2()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
	            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				$prods = ORM::factory('categorie')->find_all();
				
				foreach ($prods as $prod)
				{
					if (strlen($prod->parent_chpu)==0) {
						$parent = ORM::factory('categorie')->where('id','=',$prod->category_id)->find();
						echo $prod->name."<br/>";
						$prod->parent_chpu = $parent->alias;
						$prod->save();
					}
				}
				
			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	}
	
	public function action_repair()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
	            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				$prods = ORM::factory('product')->find_all();
				
				foreach ($prods as $prod)
				{
					//if (strlen($prod->parent_chpu)==0) {
						$parent = ORM::factory('categorie')->where('id','=',$prod->category_id)->find();
						echo $prod->name." ".$parent->alias."<br/>";
						$alias = $this->translit($prod->name)."_".$prod->id;
						$prod->alias = $alias;
						$prod->parent_chpu = $parent->alias;
						$prod->save();
					//}
				}
				
			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	    }
	
	public function action_index()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
	            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				return $this->request->redirect('admin/acategories');
			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	    }

	public function action_ausers()
	    {
		// Тут можно сделать ссылки на вход и регистрацию
			if($this->auth->logged_in())
	            {
				$a = $this->set_up();
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
				$cv = View::factory('admin/ausers');
				
				$filter =" username<>'admin' ";
					
					if (isset($_GET['del'])) {
						echo $_GET['id'];
						$user1 = ORM::factory('useratt')->where('user_id','=',$_GET['id'])->find();						
						echo $user1->id;
						$user1->delete();
						$user = ORM::factory('user')->where('id','=',$_GET['id'])->find();
						$user->delete();
						mysql_query('delete from ss_products where user_id='.$_GET['id']);
						return $this->request->redirect($_SERVER['HTTP_REFERER']);
					}
					
					
					if (isset($_GET['act'])) {
						if ($_POST) {
							$user = ORM::factory('useratt')->where('id','=',$_POST['id'])->find();

							$user->status = $_POST['stats'];
							
							$user->save();
							unset ($_POST);
							return $this->request->redirect($_SERVER['HTTP_REFERER']);
						//print_r($_POST); echo $user->id; exit;
						}
					}

					if (isset($_GET['role'])) {
						if ($_POST) {
							$user = ORM::factory('useratt')->where('id','=',$_POST['id'])->find();							
							//echo $user->expert.' '.$_POST['expert'];
							if ($user->expert == 0 && $_POST['expert']==1) {
								$mail_url = 'smsg/user/'.$user->user_id."/2/";
								$mail = Request::factory($mail_url)->execute();
							}
							if ($user->expert == 1 && $_POST['expert'] == 0) {
								
								$mail_url = 'smsg/user/'.$user->user_id."/3/";
								$mail = Request::factory($mail_url)->execute();
							}
							//exit;
							$user->expert = $_POST['expert'];
							$user->complete = $_POST['complete'];
							$user->save();
							$us = ORM::factory('user')->where('id','=',$user->user_id)->find();
							$us->role = $_POST['roles'];
							$us->save();
							unset ($_POST);
							return $this->request->redirect($_SERVER['HTTP_REFERER']);
						//print_r($_POST); echo $user->id; exit;
						}
					}					
				
					if ($_POST)
					{
						$_SESSION['filter'] = $_POST;
						$a['filter'] = 1;
					} 
					
					if (!isset($_SESSION['filter'])) {
						$_SESSION['filter']['name'] = "";
						$_SESSION['filter']['article'] = "";
						$_SESSION['filter']['price'] = "";
						$a['filter'] = 0;
					}				
				
				
				if ($a['filter']==1) {						
//						print_r($_SESSION["filter"]);
					if (strlen($_SESSION["filter"]["username"])>0)
					{
						$filter .= " and username='".$_SESSION["filter"]["username"]."' ";
					}
					if (strlen($_SESSION["filter"]["name"])>0)
					{
						$filter .= " and fio like '%".$_SESSION["filter"]["fio"]."%' ";
					}
					
				}
				
				
				$allusers = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_users.username,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_useratts.user_id = ss_users.id WHERE '.$filter)->execute()->as_array();
				$users = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_users.username,ss_users.role,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_useratts.user_id = ss_users.id WHERE '.$filter." ORDER BY fio ASC LIMIT ".$a['q']." OFFSET ".$a['page']*$a['q'])->execute()->as_array();
				$counts = count($allusers);
				$cv->stats = array(0=>'Новый',1=>'Подтвержден',2=>'Блокирован');
				$cv->h1 = "Управление пользователями";
				$cv->users = $users;
				$cv->role = $this->role;				
				$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>$a['q']));
				$this->template->wmenu = $this->wmenu;
				$this->template->content=$cv;
			}
			else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	    }
		
		public function action_afaqs()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('faq')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('faq');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('faq')->where('id','=',$cat)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/afaqs?page='.$page);
					}
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('faq');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('faq')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('category_id','question','answer'));
							$ct->save();
													
							
							return $this->request->redirect('admin/afaqs');
							//return $this->request->redirect('admin/sizes?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href='".URL::site()."admin/sizes'>Добавить вопрос</a>";
					$lmenu = ORM::factory('faq')->find_all();
					$cv = View::factory('admin/faqs');
					//$cv->prods = ORM::factory('size')->limit(20)->offset($page*20)->find_all();
					$cv->cats = ORM::factory('categorie')->where('type','=','faq')->where('enabled','=',1)->order_by('id')->find_all();
					$cv->prods = ORM::factory('faq')->order_by('id')->find_all();
					$counts = ORM::factory('faq')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}						
		}
		

		
		
		public function action_acategories()
		{
				if($this->auth->logged_in())
				{
					$a = $this->set_up();
					if (isset($_GET['del']))
					{
						$cat = ORM::factory('categorie')->where('id', '=', $_GET['id'])->find();
						
						mysql_query("UPDATE ss_categories set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();

						mysql_query("UPDATE ss_products set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_news set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_feeds set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();


						$cat->delete();
						return $this->request->redirect('admin/acategories');
					}

					$cv = View::factory('admin/acategories');
					if ($type1==0) {
						$lmenu = ORM::factory('categorie')->where('category_id','=','0')->order_by('nav_type','DESC')->find_all();
					} elseif($type1==1)  {
						$lmenu = ORM::factory('categorie')->where('category_id','=','0')->where('type','=','catalog')->find_all();
					}
					$pages = ORM::factory('categorie')->where('category_id','=','0')->where('enabled','=','1')->find_all();					
					$cv->type1=$type1;
					$cv->c_id=$a['c_id'];
					$cv->pages = $pages;
					$cv->role = $this->role;
					$this->template->wmenu = $this->wmenu;
					$cv->addlink = "<a href=".URL::site()."admin/categories>Добавить страницу</a>";
					$cv->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		
		
		public function action_categories()
		{
				if($this->auth->logged_in())
				{
					$a = $this->set_up();
					if (isset($_GET['del']))
					{
						$cat = ORM::factory('categorie')->where('id', '=', $_GET['id'])->find();
						
						mysql_query("UPDATE ss_categories set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();

						mysql_query("UPDATE ss_products set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_news set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_feeds set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();


						$cat->delete();
						return $this->request->redirect('admin/categories');
					}
					
					if (isset($_GET['di']))
					{
						$cat = ORM::factory('categorie')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/pages/".$cat->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/pages/".$cat->picture);
						}
						
						$cat->set('picture','');
						$cat->save();
						
						return $this->request->redirect('admin/categories?&id='.$cat->id);
					}

					if (isset($_GET['db']))
					{
						$cat = ORM::factory('categorie')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/backs/".$cat->background))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/backs/".$cat->background);
						}
						
						$cat->set('background','');
						$cat->save();
						
						return $this->request->redirect('admin/categories?&id='.$cat->id);
					}

					
					
					if (!isset($_GET['type'])) {$type1=0;} else {$type1=$_GET['type'];}
					
					if ($_POST)
					{
						$data = $_POST;
						
						if (isset($_POST['add'])) {
							$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							//$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = $this->translit($data['name']);
							}
							
							if ($data['page_id']>0 )
							{
								$data['category_id']=$data['page_id'];
								$parent = ORM::factory('categorie')->where('id','=',$data['page_id'])->find();
								echo $parent->id."<br/>";
								$data['parent_chpu'] = $this->get_path($parent);

								
							} else if (strlen($data['page_id'])>0) {$data['category_id'] = 0;$data['parent_chpu'] = '';}
							
							//echo $data['parent_chpu'];
							//exit;
							
							if (strlen ($data['title'])>0)
							{
								$data['title'] = $data['title'];
							} else {$data['title'] = $data['name'];}
							
							if (strlen ($data['keywords'])>0)
							{
								$data['keywords'] = $data['keywords'];
							} else {$data['keywords'] = $data['name'];}
							
							if (strlen ($data['description'])>0)
							{
								$data['description'] = $data['description'];
							} else {$data['description'] = $data['name'];}
							
							if ($data['main']>0 && isset($data['main'])) {
								mysql_query("UPDATE ss_categories set main=0");
							}
							
							$cat = ORM::factory('categorie')->values($data, array('name', 'alias','parent_chpu','title', 'keywords', 'description', 'sort', 'category_id', 'html', 'type','nav_type','enabled','sizetable','online','main','has_acc','sitemap','addwords','step_id')); // достаем из $_POST поля username, email, password
							
							
							try
							{
								$cat->save($extra_validation); 
								
								if (file_exists($_FILES['picture']['tmp_name'])) {
									$data['picture']=$this->uploadImg($_FILES['picture'],'img/pages',$cat);
								} else {
									$data['picture'] = $cat->picture;
								}

								if (file_exists($_FILES['background']['tmp_name'])) {
									$data['picture']=$this->uploadImg4Csv1($_FILES['background'],'img/backs',$cat);
	//								copy();
									$data['picture'] = $_FILES['background']['name'];
								} else {
									$data['background'] = $cat->background;
								}


								$cat->picture=$data['picture'];
								$cat->background=$data['background'];
								$cat->save();
								
								
								//echo 'Модель успешно сохранена';
								//$id = ORM::factory('categorie')->order_by('id','desc')->limit(1)->find();
								return $this->request->redirect('admin/categories?&id='.$cat->id);
								/*if ($type1==0) {								
									return $this->request->redirect('admin/categories?id='.$id->id);
								} elseif ($type1==1) {
									return $this->request->redirect('admin/agoods?c_id='.$id->id);
								} elseif ($type1==2) {
									return $this->request->redirect('admin/anews?c_id='.$id->id);
								} elseif ($type1==3) {
									return $this->request->redirect('admin/aarticles?c_id='.$id->id);
								}*/
							}
							catch(ORM_Validation_Exception $e)
							{
								//echo 'Не заполено поле Наименование';
								$cv = View::factory('admin/categories');
							}
							
							
							
						} else {
						
							if ($data['page_id']>0)
							{
								$data['category_id']=$data['page_id'];
								$parent = ORM::factory('categorie')->where('id','=',$data['page_id'])->find();
								
								$data['parent_chpu'] = $this->get_path($parent);

								
							}  else if (strlen($data['page_id'])>0) {$data['category_id'] = 0;$data['parent_chpu'] = '';}
							
							if (strlen ($data['title'])>0)
							{
								$data['title'] = $data['title'];
							} else {$data['title'] = $data['name'];}
							
							if (strlen ($data['keywords'])>0)
							{
								$data['keywords'] = $data['keywords'];
							} else {$data['keywords'] = $data['name'];}
							
							if (strlen ($data['description'])>0)
							{
								$data['description'] = $data['description'];
							} else {$data['description'] = $data['name'];}
							
							if ($data['main']>0 && isset($data['main'])) {
								mysql_query("UPDATE ss_categories set main=0");
							}
							
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = $this->translit($data['name']);
							}
							
						
							$cats = ORM::factory('categorie')->where('id','=',$_GET['id'])->find();
							$cats->values($data, array('name', 'alias','parent_chpu','title', 'keywords', 'description', 'sort', 'category_id', 'html', 'type','nav_type','enabled','sizetable','online','main','sitemap','has_acc','addwords','step_id'));
							
							if (file_exists($_FILES['picture']['tmp_name'])) {
								$data['picture']=$this->uploadImg($_FILES['picture'],'img/pages',$cats);
							} else {
								$data['picture'] = $cats->picture;
							}

							if (file_exists($_FILES['background']['tmp_name'])) {
								$data['background']=$this->uploadImg4Csv1($_FILES['background'],'img/backs',$cats);
//								copy();
								$data['background'] = $_FILES['background']['name'];
							} else {
								$data['background'] = $cats->background;
							}

							
							
							mysql_query("update ss_products set parent_chpu='".$data['parent_chpu']."/".$data['alias']."' where category_id=".$cats->id);
							
							$cats->picture=$data['picture'];
							$cats->background=$data['background'];
							$cats->save();
							
							return $this->request->redirect('admin/categories?&id='.$cats->id);
							
						}
						
					} else {
						if (isset($_GET['id'])) {
							$cats = ORM::factory('categorie')->where('id','=',$_GET['id'])->find();
							$cv = View::factory('admin/categories');
							$cv->cats = $cats;
							
							switch ($cats->type) {
								case 'text':
									$cv->prefix = "";
									$cv->addmess = "";
									$goods = array();
								break;
								case 'catalog':
									$cv->addmess = "Добавить товар";
									$cv->prefix = "admin/goods";
									$goods = ORM::factory('product')->where('category_id','=',$_GET['id'])->find_all();
								break;
								case 'news':
									$cv->addmess = "Добавить новость";
									$cv->prefix = "admin/news";
									$goods = ORM::factory('new')->where('category_id','=',$_GET['id'])->find_all();
								break;								
								case 'articles':
									$cv->addmess = "Добавить статью";
									$cv->prefix = "admin/articles";
									$goods = ORM::factory('article')->where('category_id','=',$_GET['id'])->find_all();
								break;								
								case 'feed':
									$cv->addmess = "Добавить отзыв";
									$cv->prefix = "admin/feeds";
									$goods = ORM::factory('feed')->where('category_id','=',$_GET['id'])->find_all();
								break;																
								
							}
							
							$cv->goods = $goods;
						} else {						
							$cv = View::factory('admin/categories');
						}
					}
				
					if ($type1==0) {
						$lmenu = ORM::factory('categorie')->where('category_id','=','0')->where('type','<>','catalog')->find_all();
					} elseif($type1==1)  {
						$lmenu = ORM::factory('categorie')->where('category_id','=','0')->where('type','=','catalog')->find_all();
					}
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$pages = ORM::factory('categorie')->where('category_id','=','0')->where('enabled','=','1')->find_all();					
					$steps = ORM::factory('step')->find_all();					
					$cv->type1=$type1;
					$cv->c_id=$a['c_id'];
					$cv->pages = $pages;
					$cv->steps = $steps;
					$cv->role = $this->role;
					$this->template->wmenu = $this->wmenu;
					$cv->addlink = "<a href=".URL::site()."admin/categories>Добавить страницу</a>";
					$cv->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}


		public function action_imgs()
		{
				if($this->auth->logged_in())
				{
					
					$a = $this->set_up();
				
					$cstr = "a1";
					foreach ($a as $i=>$vv)
					{
						$cstr .= "&".$i."=".$vv;
					}				
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
						
						
					$cid = $_GET['cid'];
					$cat = ORM::factory('product')->where('id','=',$cid)->find();


					if (isset($_GET['del']))
					{
						$good = ORM::factory('img')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/photos/".$good->name) && strlen($good->name)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/photos/".$good->name);
						}
						
						$good->delete();
						return $this->request->redirect('admin/imgs?'.$cstr.'&cid='.$cid);
					}
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('img');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('img')->where('id','=',$cat)->find();
						}
						
						if (file_exists($_FILES['foto']['tmp_name']))
						{
							if (strlen($_POST['pos'])==0) {
								$ct->pos = $_POST['pos'];
							} else{
								$pos = ORM::factory('img')->where('product_id','=',$cid)->order_by('pos','DESC')->find();
								$ct->pos = $pos->pos+1;
							}
							$ct->description = $_POST['description'];
							$ct->width = $_POST['width'];
							$ct->height = $_POST['height'];
							$ct->product_id = $cid;							
							$ct->save();
														
							$filename=$this->uploadImg($_FILES['foto'],'img/photos',$ct);
							$ct->name = $filename;
							$ct->save();
							
						} elseif (isset($_POST['prod']))
						{
							$ct->description = $_POST['description'];
							$ct->width = $_POST['width'];
							$ct->pos = $_POST['pos'];
							$ct->height = $_POST['height'];							
							$ct->save();						
							
						}
						//return $this->request->redirect($_SERVER['HTTP_REFERRER']);	
						return $this->request->redirect('admin/imgs?'.$cstr.'&cid='.$cid);		
					
					}
					
					$cv = View::factory('admin/photos');
					$cv->cid = $cat;
					
					$photos = ORM::factory('img')->where('product_id','=',$cid)->order_by('pos','desc')->find_all();
					$cv->goods = $photos;
					$cv->cstr = $cstr;
					$this->template->addlink = "<a href=".URL::site()."admin/imgs?".$cstr."cid=".$cid.">Добавить фото</a>";				
					$lmenu = ORM::factory('img')->where('product_id','=',$cid)->find_all();
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}


		public function action_deliver()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['id']))
					{
						$id=0;
					} else {$id = $_GET['id'];}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('delivery')->where('id','=',$cat)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/deliver');
					}
					
					
					if ($_POST)
					{
						$data = $_POST;
						if (isset($data['add']))
						{
							$info = ORM::factory('delivery');
						} elseif ($data['edit']) {
							$info = ORM::factory('delivery')->where('id','=',$data['id'])->find();
						}
						
						$info->values($_POST, array('name', 'cost'));
						$info->save();
						if (isset($data['add']))
						{
							return $this->request->redirect('admin/deliver');
						} else {return $this->request->redirect('admin/deliver?id='.$data['id']);}
					}
				
					
					$lmenu = ORM::factory('delivery')->find_all();
					if (isset($_POST['add']))
					{
						$page = ORM::factory('delivery');
					} else {
						$page = ORM::factory('delivery')->where('id','=',$id)->find();
					}

					$cv = View::factory('admin/deliver');
					$cv->lmenu = $lmenu;
					$cv->page = $page;
					//$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$this->template->addlink = '';
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}	

		
		public function action_container()
		{
				if($this->auth->logged_in())
				{
				
					$a = $this->set_up();
					$cstr = "a1";
					foreach ($a as $i=>$vv)
					{
						$cstr .= "&".$i."=".$vv;
					}				
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}

				
					if (isset($_GET['cid'])) { 
						$cat = $_GET['cid'];
					} else {
						$cat = 0;
					}
										
					
					if (isset($_GET['del']))
					{
						$id = $_GET['id'];
						$ct = ORM::factory('container')->where('id','=',$id)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/container?'.$cstr."&cid=".$cat);
					}
					
					if ($_POST)
					{
					
						if (isset($_POST['order']))  {
							if (!isset($_POST['add'])) {
								$order = ORM::factory('order')->where('id','=',$_POST['order'])->find();
							} else {
								$order = ORM::factory('order');
							}
							$order->values($_POST, array('ddate','fio', 'zip','address','city','phone','email','paymode','deliver','used','comment','comment1','dprice'));
							$order->save();
							
							$cat = $order->id;
						} else {
					
					
							if (isset($_POST['add']))
							{
								foreach ($_POST['cg'] as $i=>$v) {
									$ct = ORM::factory('container');
									$product = ORM::factory('product')->where('id','=',$v)->find();
									//print_r($product);
									
									$ct->order_id = $cat;
									$ct->code = $product->id;
									$ct->q = 1;
									$ct->price = $product->Price;
									
									$ct->save();
								}
								
								
							} else {
								//$data = $_POST;
								$ct = ORM::factory('container')->where('id','=',$_POST['id'])->find();
								
								$ct->values($_POST,array('price','q','color','size','mat'));
								$ct->save();


							}
						}
																					
							return $this->request->redirect('admin/container?'.$cstr."&cid=".$cat);
												
					}
				
					//$lmenu = ORM::factory('size')->find_all();
					$cv = View::factory('admin/container');
					$cv->order_id = $cat;
					$cv->cstr = $cstr;
					$cv->order = ORM::factory('order')->where('id','=',$cat)->find();
					$cv->prods = ORM::factory('container')->where('order_id','=',$cat)->find_all();
					$counts = ORM::factory('size')->count_all();
					
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}						
		}
		
		
		
		
		public function action_sizes()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('size')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('size');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('size')->where('id','=',$cat)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/sizes?page='.$page);
					}
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('size');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('size')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('name','descr','pos'));
							$ct->save();
														
							$ct->save();
							
							return $this->request->redirect('admin/sizes');
							//return $this->request->redirect('admin/sizes?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href='".URL::site()."admin/sizes'>Добавить размер</a>";
					$lmenu = ORM::factory('size')->find_all();
					$cv = View::factory('admin/sizes');
					//$cv->prods = ORM::factory('size')->limit(20)->offset($page*20)->find_all();
					$cv->prods = ORM::factory('size')->order_by('pos')->find_all();
					$counts = ORM::factory('size')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}						
		}

		public function action_colors()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('color')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('color');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('color')->where('id','=',$cat)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/colors');
					}
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('color');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('color')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('name','rgb'));
							$ct->save();
														
							$ct->save();
							
							return $this->request->redirect('admin/colors');
							//return $this->request->redirect('admin/colors?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href='".URL::site()."admin/colors'>Добавить цвет</a>";
					$lmenu = ORM::factory('color')->order_by('name')->find_all();
					$cv = View::factory('admin/colors');
					$cv->prods = ORM::factory('color')->order_by('name')->find_all();
					$counts = ORM::factory('color')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/colors');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
		}

		public function action_materials()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('material')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('material');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('material')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/material/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/material/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/material');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('material')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/material/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/material/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/materials?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('material');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('material')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('name','descr'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/material',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							
							return $this->request->redirect('admin/materials?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/materials>Добавить материал</a>";
					$lmenu = ORM::factory('material')->find_all();
					$cv = View::factory('admin/materials');
					$cv->prods = ORM::factory('material')->order_by('name')->find_all();
					$counts = ORM::factory('material')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts-10));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}		

		public function action_brends()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('brand')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('brand');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('brand')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/brand/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/brand/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/brends');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('brand')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/brand/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/brand/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/brends?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('brand');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('brand')->where('id','=',$cat)->find();
						}
						
							$data = $_POST;
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = $this->translit(strtolower($data['name']));
							}
							
							if ($data['page_id']>0)
							{
								//$data['category_id']=$data['page_id'];
								$parent = ORM::factory('categorie')->where('id','=',$data['page_id'])->find();
								$data['parent_chpu'] = $this->get_path($parent);								
							} else {/*$data['category_id'] = 0;*/$data['parent_chpu'] = '';}


							$data['name'] = trim($_POST['name']);
							
							$ct->values($data,array('name','descr','alias','category_id','parent_chpu','title','keywords','description'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/brand',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							return $this->request->redirect('admin/brends');
							//return $this->request->redirect('admin/brends?id='.$ct->id);
												
					}
				
					$cv = View::factory('admin/brands');
					$ct1 = ORM::factory('categorie')->where('type','=','catalog')->where('enabled','=','1')->where('category_id','=',0)->find_all();						
					$cv->cats1 = $ct1;//$this->make_menu($ct1);
					$this->template->addlink = "<a href=".URL::site()."admin/brends>Добавить баннер</a>";
					$lmenu = ORM::factory('brand')->find_all();					
					$cv->prods = ORM::factory('brand')->order_by('name')->find_all();
					$cv->prod = $prod;
					$counts = ORM::factory('brand')->count_all();
					//$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/brends');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}				
		

		public function action_leagues()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('league')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('league');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('league')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/league/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/league/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/leagues');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('brand')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/league/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/league/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/leagues?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('league');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('league')->where('id','=',$cat)->find();
						}
							
							$_POST['name'] = trim($_POST['name']);
							
							$ct->values($_POST,array('name','descr','turnir_id'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/league',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							return $this->request->redirect('admin/leagues');
							//return $this->request->redirect('admin/brends?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/leagues>Добавить лигу</a>";
					$lmenu = ORM::factory('league')->find_all();
					$cv = View::factory('admin/leagues');
					$cv->prods = ORM::factory('league')->order_by('name')->find_all();
					$counts = ORM::factory('league')->count_all();
					//$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/brends');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}				
		
		
		public function action_seazons()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('seazon')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('seazon');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('seazon')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/seazons/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/seazons/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/seazons');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('seazon')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/seazons/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/seazons/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/seazons?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('seazon');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('seazon')->where('id','=',$cat)->find();
						}
							
							$_POST['name'] = trim($_POST['name']);
							
							$ct->values($_POST,array('name','descr','league_id'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/seazons',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							return $this->request->redirect('admin/seazons');
							//return $this->request->redirect('admin/brends?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/seazons>Добавить баннер</a>";
					$lmenu = ORM::factory('seazon')->find_all();
					$cv = View::factory('admin/seazon');
					$cv->prods = ORM::factory('seazon')->order_by('name')->find_all();
					$counts = ORM::factory('seazon')->count_all();
					//$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/brends');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}				

		public function action_teams()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('team')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('team');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('team')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/teams/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/teams/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/teams');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('team')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/teams/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/teams/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/teams?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('team');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('team')->where('id','=',$cat)->find();
						}
							
							$_POST['name'] = trim($_POST['name']);
							
							$ct->values($_POST,array('name','descr','league_id'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/teams',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							return $this->request->redirect('admin/teams');
							//return $this->request->redirect('admin/brends?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/teams>Добавить баннер</a>";
					$lmenu = ORM::factory('team')->find_all();
					$cv = View::factory('admin/teams');
					$cv->prods = ORM::factory('team')->order_by('name')->find_all();
					$counts = ORM::factory('team')->count_all();
					//$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/brends');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}				
		
		
		public function action_turnirs()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('turnir')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('turnir');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('turnir')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/turnir/".$ct->picture) && strlen($ct->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/turnir/".$ct->picture);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/turnirs');
					}
					if (isset($_GET['di']))
					{
						$good = ORM::factory('team')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/turnir/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/turnir/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/turnirs?id='.$good->id);
					}

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('turnir');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('turnir')->where('id','=',$cat)->find();
						}
							
							$_POST['name'] = trim($_POST['name']);
							
							$ct->values($_POST,array('name','descr'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/turnirs',$ct);
								$ct->picture = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							return $this->request->redirect('admin/turnirs');
							//return $this->request->redirect('admin/brends?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/teams>Добавить баннер</a>";
					$lmenu = ORM::factory('turnir')->find_all();
					$cv = View::factory('admin/turnirs');
					$cv->prods = ORM::factory('turnir')->order_by('name')->find_all();
					$counts = ORM::factory('turnir')->count_all();
					//$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/brends');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}			
			
		}				


		
		public function action_info()
		{
				if($this->auth->logged_in())
				{
					//print_r($_POST);exit;
					if ($_POST)
					{						
						$info = ORM::factory('info')->find();
						$info->values($_POST, array('name', 'address','phone','phone2', 'phone3', 'email', 'worktime', 'text1', 'text2', 'text3','use_captcha','vk','fb','tw','yt','gg','skype','poll_head','poll','dollar','euro'));
						$info->save();
						
						//print_r($_POST);
						return $this->request->redirect('admin/info');
					}
				
					$page = ORM::factory('info')->find();
					$cv = View::factory('admin/info');
					$cv->page = $page;
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$this->template->addlink = '';
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}		
		
		public function action_agoods()
	    {
	    		if($this->auth->logged_in())
				{
//					$user = Auth::instance()->get_user();

					$s = Session::instance();
					$prods = ORM::factory('product')->count_all();
						
					$a = $this->set_up();	



					
					if (isset($_GET['cdel']))
					{
						$cat = ORM::factory('categorie')->where('id', '=', $_GET['id'])->find();
						
						mysql_query("UPDATE ss_categories set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();

						mysql_query("UPDATE ss_products set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_news set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();

						mysql_query("UPDATE ss_feeds set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();
						mysql_query("UPDATE ss_articles set category_id=0,enabled=0 where category_id=".$_GET['id']);
						echo mysql_error();

						$cat->delete();

						
						return $this->request->redirect('admin/agoods?q='.$a['q'].'&page='.$page);
					}

					if (isset($_GET['main']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						$good->sale_type = $_GET['main'];
						$good->save();
						
						return $this->request->redirect('admin/agoods?q='.$a['q'].'&c_id='.$a['c_id'].'&page='.$a['page'].'&filter='.$a['filter']);
					}

					if (isset($_GET['enabled']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						$good->stock_type = $_GET['enabled'];
						$good->save();
						
						return $this->request->redirect('admin/agoods?q='.$a['q'].'&c_id='.$a['c_id'].'&page='.$a['page'].'&filter='.$a['filter']);
					}					
					
					
					if (isset($_GET['del']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						mysql_query("DELETE FROM ss_values WHERE product_id=".$_GET['id']);
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}
						
						$good->delete();
						
						return $this->request->redirect('admin/agoods?q='.$a['q'].'&c_id='.$a['c_id'].'&page='.$a['page'].'&filter='.$a['filter']);
					}
					
					if (!isset($a['page']) || $a['page']==0)
					{
						$a['page'] = 0;
					} else {
						$a['page']--;}
					
					if ($_POST)
					{
						$_SESSION['filter'] = $_POST;
						$a['filter'] = 1;
					} 
					
					if (!isset($_SESSION['filter'])) {
						$_SESSION['filter']['name'] = "";
						$_SESSION['filter']['article'] = "";
						$_SESSION['filter']['price'] = "";
						$a['filter'] = 0;
					}

					$filter =" true ";
					if ($a['filter']==1) {						
//						print_r($_SESSION["filter"]);
						if (strlen($_SESSION["filter"]["article"])>0)
						{
							$filter .= " and article='".$_SESSION["filter"]["article"]."' ";
						}
						if (strlen($_SESSION["filter"]["name"])>0)
						{
							$filter .= " and name like '%".$_SESSION["filter"]["name"]."%' ";
						}
						if (strlen($_SESSION["filter"]["price"])>0)
						{
							$filter .= " and price='".$_SESSION["filter"]["price"]."' ";
						}						
					}
										
					$cv = View::factory('admin/agoods');
					if ($a['c_id']==-1) {
						$allprods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE '.$filter)->execute()->as_array();
						$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE '.$filter." ORDER BY sort ASC ")->execute()->as_array();
						$counts = count($allprods);
						$cv->prods = $prods;
					} else {
						$filter .= " and category_id=".$a['c_id'];
						$allprods = DB::query(Database::SELECT, 'SELECT ss_products.* FROM ss_products WHERE '.$filter)->execute()->as_array();
						$prods = DB::query(Database::SELECT, 'SELECT ss_products.* FROM ss_products WHERE '.$filter." ORDER BY sort ASC ")->execute()->as_array();
						$counts = count($allprods);
						$cv->prods = $prods;
						//$counts = ORM::factory('product')->where('category_id','=',$a['c_id'])->count_all();						
						//$cv->prods = ORM::factory('product')->where('category_id','=',$a['c_id'])->limit($a['q'])->offset($a['page']*$a['q'])->find_all();					
					}
					
					if ($a['c_id']==-1)
					{
						$cv->h1 = "Все заявки";
						$this->root = 0;
						$cat = 0;
						$narr = array();
						$cv->arr = array();
						$cv->way = array();
					} else {						
						$name = ORM::factory('categorie')->where('id','=',$a['c_id'])->find();

						$this->get_root_id($name);
						$cat = $name->id;
						$narr = $this->get_parents($name);
						krsort($narr);
						$cv->arr = $narr;
						$cv->way = $this->draw_parents($narr);
						$cv->h1 = $name->name;
					}
					
					//echo $this->root;
					//print_r($arr);
					$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>$a['q']));
					$cv->c_id = $a['c_id'];
					if ($a['page']>0){$a['page']++;}
					$cv->root = $this->root;
					$cv->page = $a['page'];
					$cv->q = $a['q'];
					$cv->filter = $a['filter'];					

					$this->template->wmenu = $this->wmenu;
					$lmenu = ORM::factory('categorie')->where('category_id','=',$cat)->where('type','=','catalog')->order_by('sort','DESC')->find_all();
					$cv->sess = $_SESSION['filter'];
					$cv->lmenu = $this->make_menu($lmenu);
					$cv->role = $this->role;
					$this->template->content = $cv;					
				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
	    
	    }
		
		
		public function action_goods()
		{
				if($this->auth->logged_in())
				{
				
					$a = $this->set_up();
				
					$cstr = "a1";
					foreach ($a as $i=>$vv)
					{
						$cstr .= "&".$i."=".$vv;
					}				
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
					
					if (isset($_GET['del']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}
						
						$good->delete();
						return $this->request->redirect('admin/agoods?'.$cstr);
					}

					if (isset($_GET['options']))
					{
						
						foreach ($_POST['option'] as $j=>$option) {						
							$val = ORM::factory('value')->where('option_id', '=', $j)->where('product_id','=',$_POST['good'])->find();
							$val->product_id=$_POST['good'];
							$val->option_id=$j;
							$val->value = $option;
							$val->save();
							//echo $value->id;
						}

						foreach ($_POST['opt_list'] as $j=>$option) {						
							$val = ORM::factory('value')->where('option_id', '=', $j)->where('product_id','=',$_POST['good'])->find();
							$val->product_id=$_POST['good'];
							$val->option_id=$j;
							$res = '';
							foreach ($option as $opt)
							{
								$res .= $opt."-";
							}
							$val->value = $res;
							$val->save();
							//echo $value->id;
						}
						
						//print_r($_POST); exit;	
						
						return $this->request->redirect('admin/goods?'.$cstr.'&id='.$_POST['good']);
					}

					if (isset($_GET['do']))
					{
						$val = ORM::factory('value')->where('option_id', '=', $_GET['opt'])->where('product_id', '=', $_GET['id'])->find();
											
						$val->value=str_replace($_GET['val']."-","",$val->value);
						$val->save();
						
						return $this->request->redirect('admin/goods?'.$cstr.'&id='.$_GET['id']);
					}
					


					
					if (isset($_GET['di']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/goods?'.$cstr.'&id='.$good->id);
					}
					if (isset($_GET['di2']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog2/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog2/".$good->picture);
						}
						
						$good->set('picture2','');
						$good->save();
						
						return $this->request->redirect('admin/goods?'.$cstr.'&id='.$good->id);
					}
					if (isset($_GET['di3']))
					{
						$good = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog3/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog3/".$good->picture);
						}
						
						$good->set('picture3','');
						$good->save();
						
						return $this->request->redirect('admin/goods?'.$cstr.'&id='.$good->id);
					}					

					if (isset($_GET['cgm']))
					{
						$s = ORM::factory('product')->where('id', '=', $_GET['id'])->find();
						
						$s->co_goods = str_replace($_GET['cid'].'-','',$s->co_goods);
						
						$s->save();
						
						return $this->request->redirect('admin/goods?'.$cstr."&id=".$_GET['id']);
					}
					
									
					if ($_POST)
					{					
						$data = $_POST;
						//print_r($_POST);exit;
						if (isset($_POST['add']))
						{
							$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							//$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = strtolower($this->translit($data['title']));
							}
							
							if ($data['cat']>0)
							{
								$data['category_id']=$data['cat'];
								$parent = ORM::factory('categorie')->where('id','=',$data['cat'])->find();
								$data['parent_chpu'] = $this->get_path($parent);
								
							} else if (strlen($data['cat'])>0) {$data['category_id'] = 0;$data['parent_chpu'] = '';}
							
							$pos = DB::query(Database::SELECT, 'SELECT max(sort) as pos FROM ss_products WHERE category_id='.$data['category_id'])->execute()->as_array();
							
							//print_r($pos);
							
							
							$data['sort'] = $pos[0]['pos'] + 1;
							
							//echo $data['pos'];
							//exit;
							$cat = ORM::factory('product')->values($data, array('article','category_id', 'title','name','parent_chpu','alias', 'description', 'short_html','sort', 'price_type','Price', 'price2', 'price3','enabled','sale_type','in_stock','stock_type','brand_id','addwords')); // достаем из $_POST поля username, email, password
							
							
							try
							{
								$cat->save($extra_validation); 
								//echo 'Модель успешно сохранена';
								$id = $cat->id;
								
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/catalog',$cat);
								$cat->values($data,array('picture'));
								$cat->alias = $data['alias']."_".$id;
								$cat->save();
								
								
								foreach ($data['cats'] as $v)
								{
									if ($v>0) {
										$ct = ORM::factory('cat2prod')->where('cat_id','=',$v)->where('product_id','=',$uid)->count_all();
										if ($ct==0){
											$c2p = ORM::factory('cat2prod');
											$c2p->cat_id = $v;
											$c2p->product_id = $id;
											$c2p->save();
										}
									}
								}	
								$data = array();
								
								return $this->request->redirect('admin/goods?'.$cstr.'&id='.$cat->id);
							}
							catch(ORM_Validation_Exception $e)
							{
								//echo 'Не заполено поле Наименование';
								return $this->request->redirect('admin/goods?'.$cstr);							}


						} else {
							/*print_r($_POST);
							exit;*/
							
							if ($data['cat']>0)
							{
								$data['category_id']=$data['cat'];
								$parent = ORM::factory('categorie')->where('id','=',$data['cat'])->find();
								$data['parent_chpu'] = $this->get_path($parent);
								
							}  else if (strlen($data['cat'])>0) {$data['category_id'] = 0;$data['parent_chpu'] = '';}

							if (strlen ($data['name'])>0)
							{
								$data['alias'] = strtolower($this->translit($data['title']));
							}							
							
						
							$good = ORM::factory('product')->where('id','=',$_GET['id'])->find();
							if (file_exists($_FILES['foto']['tmp_name'])) {
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/catalog',$good);
							} else {
								$data['picture'] = $good->picture;
							}
							
							if (file_exists($_FILES['foto2']['tmp_name'])) {
								$data['picture2']=$this->uploadImg($_FILES['foto2'],'img/catalog2',$good);
							} else {
								$data['picture2'] = $good->picture;
							}
							
							if (file_exists($_FILES['foto3']['tmp_name'])) {
								$data['picture3']=$this->uploadImg($_FILES['foto3'],'img/catalog3',$good);
							} else {
								$data['picture3'] = $good->picture;
							}							
							
							$good->values($data, array('article','picture','picture2','picture3','category_id','title', 'name','parent_chpu','alias','photo_description', 'description', 'short_html','sort', 'price_type','Price', 'price2', 'price3','enabled','sale_type','in_stock','stock_type','brand_id','addwords'));
							
							$good->alias = $data['alias']."_".$good->id;
							$color = "";

							if (isset($data['cg'])) {
								foreach ($data['cg'] as $i=>$v)
								{
									if ($v>0) {							
										$color .= $color .= $v."-";
									}
								}
								$good->co_goods .= $color;
							}
							
							
							
							
							$good->save();
							
							$uid = $good->id;
							
							foreach ($data['cats'] as $v)
							{
								if ($v>0) {
									$ct = ORM::factory('cat2prod')->where('cat_id','=',$v)->where('product_id','=',$uid)->count_all();
									if ($ct==0){
										$c2p = ORM::factory('cat2prod');
										$c2p->cat_id = $v;
										$c2p->product_id = $uid;
										$c2p->save();
									}
								}
							}							
							//print_r($data);exit;
							
							return $this->request->redirect('admin/goods?'.$cstr.'&id='.$id);							
						}
					
					} else {
						$ct = ORM::factory('categorie')->where('type','=','catalog')->where('category_id','=',0)->find_all();						
						$cv = View::factory('admin/goods');
												
						$cv->cstr = $cstr;
						$cv->q = $a['q'];
						
						$cv->c_id = $a['c_id'];
						$cv->page = $a['page'];
						if (!isset($id)) {$cv->pid =1;$good = ORM::factory('product');} else {$cv->pid = $id;$good = ORM::factory('product')->where('id','=',$id)->find();}
						//$cv->cat = $ct;						
						$cv->type = "admin/goods";
						$cv->good = $good;
					}
					
					if (isset($good->id)) {
					
						
						$name = ORM::factory('categorie')->where('id','=',$good->category_id)->find();
						$this->get_root_id($name);
						$cat = $name->id;
						$narr = $this->get_parents($name);
						krsort($narr);
						$ct2 = ORM::factory('categorie')->where('category_id','=',$good->category_id)->find_all();
						$lmenu = ORM::factory('categorie')->where('category_id','=',$good->category_id)->where('type','=','catalog')->find_all();
						$options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id WHERE single=0 and (category_id=".$a['c_id']." OR product_id=".$good->id.")")->execute()->as_array();

						$list_options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_options.table_ref,ss_tables.table_name,ss_tables.name as tname,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id LEFT JOIN ss_tables ON ss_tables.id=ss_options.table_ref WHERE single=1 and (category_id=".$a['c_id']." OR product_id=".$good->id.")")->execute()->as_array();
						
						$co_good = explode("-",$good->co_goods);					
						$co_goods = ORM::factory('product')->where('id','in',$co_good)->find_all();

						
						foreach ($list_options as $jj=>$opts) {
							$v_a = explode("-",$opts['value']);
							$vals = ORM::factory($opts['table_name'])->where('id','in',$v_a)->find_all();
							$list_options[$jj]['vals'] = $vals;
						}
						

						
						//$options = ORM::factory('option')->where('category_id','=',$good->category_id)->find_all();
						$cv->arr = $narr;
						$cv->way = $this->draw_parents($narr);
						$cv->h1 = $good->name;
						
					} else {
					
						if ($a['c_id']==0) {
							$this->root = 0;
							$cat = 0;
							$narr = array();
							$options = array();
							$list_options = array();
							$cv->arr = array();
							$cv->way = array();
							$cv->h1 = "Добавить товар";
							$lmenu = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();							
						} else {
							$name = ORM::factory('categorie')->where('id','=',$a['c_id'])->find();
							$this->get_root_id($name);
							$cat = $name->id;
							$narr = $this->get_parents($name);
							krsort($narr);
							$cv->arr = $narr;
							$lmenu = ORM::factory('categorie')->where('category_id','=',$good->category_id)->where('type','=','catalog')->find_all();		
							$options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id WHERE  single=0 and category_id=".$a['c_id'])->execute()->as_array();
							
							$list_options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_options.table_ref,ss_tables.name as tname,ss_tables.table_name,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id LEFT JOIN ss_tables ON ss_tables.id=ss_options.table_ref WHERE single=1 and (category_id=".$a['c_id'].")")->execute()->as_array();
							
							$cv->way = $this->draw_parents($narr);		
							$cv->h1 = "Добавить товар";							
						}
					
						$colors = array();
						$sizes = array();
						$materials = array();
						$co_goods = array();
					}
					
					//print_r($ct);
					
					$cv->cats1 = $this->make_menu($ct);					
					$cv->colors = $colors;
					$cv->sizes = $sizes;
					$cv->materials = $materials;
					$cv->co_goods = $co_goods;
					$cv->options = $options;
					$cv->list_options = $list_options;
					$cv->role = $this->role;
					
					/*if ($good->id>0) {
						$cv->c2p = DB::query(Database::SELECT, 'SELECT ss_cat2prods.id,ss_cat2prods.cat_id,ss_categories.name,p.name as name2  FROM ss_cat2prods LEFT JOIN ss_categories ON ss_cat2prods.cat_id=ss_categories.id LEFT JOIN ss_categories p ON ss_categories.category_id=p.id WHERE product_id='.$good->id)->execute()->as_array();;
					} else {$cv->c2p = array();}*/
					
					
					$this->template->wmenu = $this->wmenu;					
					$cv->lmenu = $this->make_menu($lmenu);

					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		
		
		
		public function action_news()
		{
				if($this->auth->logged_in())
				{
				//	$cat = $_GET['cid'];
				//	$ct = ORM::factory('new')->where('id','=',$cat)->find();
					if (!isset($_GET['page']))
					{
						$page1 = 0;
					} else {
						$page1 = $_GET['page'];
					}

					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
					if (isset($_GET['del']))
					{
						$good = ORM::factory('new')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture);
						}
						
						$good->delete();
						return $this->request->redirect('admin/news?page='.$page1);
					}
									
					if (isset($_GET['di']))
					{
						$good = ORM::factory('new')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/news?page='.$page1."&id=".$good->id);
					}
									
									
					if ($_POST)
					{
						$data = $_POST;
						if (isset($_POST['add']))
						{
							$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							//$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = strtolower($this->translit($data['name']));
							}
							
							if ($data['cat']>0)
							{
								$data['category_id']=$data['cat'];
								$parent = ORM::factory('categorie')->where('id','=',$data['cat'])->find();
								$data['parent_chpu'] = $this->get_path($parent) ;
							} else {$data['category_id'] = 0;$data['parent_chpu'] = '';}
							
							$cat = ORM::factory('new')->values($data, array('date','category_id', 'name','announce','text','alias','parent_chpu', 'sort','enabled','sname','slink','tags')); // достаем из $_POST поля username, email, password
							
							
							try
							{
								$cat->save($extra_validation); 
								//echo 'Модель успешно сохранена';
								//$id = $cat->id;
								$data = array();
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/news',$cat);
								$cat->values($data,array('picture'));
								$cat->save();
								
								return $this->request->redirect('admin/news?page='.$page1.'&id='.$cat->id);
							}
							catch(ORM_Validation_Exception $e)
							{
								//echo 'Не заполено поле Наименование';
								return $this->request->redirect('admin/news?page='.$page1.'&id='.$_POST['id']);							}


						} else {
						
							if ($data['cat']>0)
							{
								$data['category_id']=$data['cat'];
								$parent = ORM::factory('categorie')->where('id','=',$data['cat'])->find();
								$data['parent_chpu'] = $this->get_path($parent) ;
								//echo $data['parent_chpu']; exit;
							} else {$data['category_id'] = 0;$data['parent_chpu'] = '';}
						
						
							$good = ORM::factory('new')->where('id','=',$_POST['id'])->find();
							if (file_exists($_FILES['foto']['tmp_name'])) {
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/news',$good);
							} else {
								$data['picture']= $good->picture;
							}
							$good->values($data, array('date','category_id', 'name','announce','text','parent_chpu','sort','enabled','picture','sname','slink','tags'));
							$good->save();

							return $this->request->redirect('admin/news?page='.$page1.'&id='.$_POST['id']);							
						}
					
					} else {
											
						$cv = View::factory('admin/news');
						if (!isset($id)) {$cv->pid =0;} else {$cv->pid = $id;$good = ORM::factory('new')->where('id','=',$id)->find();$cv->page = $good;}
						$ct = ORM::factory('categorie')->where('type','=','catalog')->find_all();						
						$cv->cats = $ct;		
						$cv->page = $page1;									
						
					}
				
				
					$this->template->addlink = "<a href=".URL::site()."admin/news>Добавить новость</a>";
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$cv = View::factory('admin/news');
					$ct = ORM::factory('categorie')->where('type','=','news')->find_all();						
					$cv->cats = $ct;			
					$cv->page1 = $page1;			

					if (!isset($id)) {$cv->pid =0; $cv->page = ORM::factory('new');} else {$cv->pid = $id;$good = ORM::factory('new')->where('id','=',$id)->find();$cv->page = $good;}
					//$cv->cat = $ct;

				
					$cv->role = $this->role;
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content =$cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}


		public function action_aarticles()
		{
	    		if($this->auth->logged_in())
				{
					$prods = ORM::factory('article')->count_all();
					
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}
					
					if (isset($_GET['del']))
					{
						$good = ORM::factory('article')->where('id', '=', $_GET['id'])->find();
						/*if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}*/
						
						$good->delete();
						
						return $this->request->redirect('admin/aarticles?page='.$page);
					}
					$counts = ORM::factory('article')->count_all();										
					$cv = View::factory('admin/aarticles');
					$cv->prods = ORM::factory('article')->limit(20)->offset($page*20)->find_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts-10));
					$cv->page = $page;
					$cv->role = $this->role;
					$this->template->addlink = "<a href=".URL::site()."admin/article?all=1>Добавить статью</a>";
					$lmenu = ORM::factory('article')->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = array();
					$this->template->content = $cv;
				
					
				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}

		
		public function action_apolls()
		{
	    		if($this->auth->logged_in())
				{
					$prods = ORM::factory('poll')->count_all();
					
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}
					
					if (isset($_GET['del']))
					{
						$good = ORM::factory('poll')->where('id', '=', $_GET['id'])->find();
						/*if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}*/
						
						$good->delete();
						
						return $this->request->redirect('admin/apolls?page='.$page);
					}
					$counts = ORM::factory('poll')->count_all();										
					$cv = View::factory('admin/apolls');
					$cv->prods = ORM::factory('poll')->limit(20)->offset($page*20)->find_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts-10));
					$cv->page = $page;
					$this->template->addlink = "<a href=".URL::site()."admin/polls?all=1>Добавить новость</a>";
					$lmenu = ORM::factory('poll')->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = array();
					$this->template->content = $cv;
				
					
				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}				
		
		
		
		public function action_anews()
		{
	    		if($this->auth->logged_in())
				{
					$prods = ORM::factory('new')->count_all();
					
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}
					
					if (isset($_GET['del']))
					{
						$good = ORM::factory('new')->where('id', '=', $_GET['id'])->find();
						/*if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$good->picture);
						}*/
						
						$good->delete();
						
						return $this->request->redirect('admin/anews?page='.$page);
					}
					$counts = ORM::factory('new')->count_all();										
					$cv = View::factory('admin/anews');
					$cv->prods = ORM::factory('new')->limit(10)->offset($page*10)->order_by('id','desc')->find_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts));
					$cv->role = $this->role;
					$cv->page = $page;
					$this->template->addlink = "<a href=".URL::site()."admin/news?all=1>Добавить новость</a>";
					$lmenu = ORM::factory('new')->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = array();
					$this->template->content = $cv;
				
					
				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}		
		
		
		
		public function action_articles()
		{
				if($this->auth->logged_in())
				{
				//	$cat = $_GET['cid'];
				//	$ct = ORM::factory('new')->where('id','=',$cat)->find();
					if (!isset($_GET['page']))
					{
						$page1 = 0;
					} else {
						$page1 = $_GET['page'];
					}

					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
					if (isset($_GET['del']))
					{
						$good = ORM::factory('article')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture) && strlen($good->picture)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/news/".$good->picture);
						}
						
						$good->delete();
						return $this->request->redirect('admin/aarticles?page='.$page1);
					}
									
					if (isset($_GET['di']))
					{
						$good = ORM::factory('new')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/articles/".$good->picture))
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/articles/".$good->picture);
						}
						
						$good->set('picture','');
						$good->save();
						
						return $this->request->redirect('admin/article?page='.$page1."&id=".$good->id);
					}
									
									
					if ($_POST)
					{
						$data = $_POST;
						if (isset($_POST['add']))
						{
							$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							//$extra_validation = Validation::factory($_POST)->rule('name', 'not_empty');
							if (strlen ($data['name'])>0)
							{
								$data['alias'] = strtolower($this->translit($data['name']));
							}
							
							if ($data['cat']>0)
							{
								$data['category_id']=$data['cat'];
								$parent = ORM::factory('categorie')->where('id','=',$data['cat'])->find();
								$data['parent_chpu'] = $this->get_path($parent) ;
							} else {$data['category_id'] = 0;$data['parent_chpu'] = '';}
							
							$cat = ORM::factory('article')->values($data, array('date','category_id', 'name','text','alias','parent_chpu', 'sort','enabled','ratings')); // достаем из $_POST поля username, email, password
							
							
							try
							{
								$cat->save($extra_validation); 
								//echo 'Модель успешно сохранена';
								//$id = $cat->id;
								$data = array();
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/news',$cat);
								$cat->values($data,array('picture'));
								$cat->save();
								
								return $this->request->redirect('admin/articles?page='.$page1.'&id='.$cat->id);
							}
							catch(ORM_Validation_Exception $e)
							{
								//echo 'Не заполено поле Наименование';
								return $this->request->redirect('admin/articles?page='.$page1.'&id='.$_POST['id']);							}


						} else {
						
						
							$good = ORM::factory('article')->where('id','=',$_POST['id'])->find();
							if (file_exists($_FILES['foto']['tmp_name'])) {
								$data['picture']=$this->uploadImg($_FILES['foto'],'img/news',$good);
							} else {
								$data['picture']= $good->picture;
							}
							$data['category_id']=$data['cat'];
							$good->values($data, array('date','category_id', 'name','text','sort','enabled','picture','ratings'));
							$good->save();

							return $this->request->redirect('admin/articles?page='.$page1.'&id='.$_POST['id']);							
						}
					
					} else {
											
						$cv = View::factory('admin/articles');
						if (!isset($id)) {$cv->pid =0;} else {$cv->pid = $id;$good = ORM::factory('article')->where('id','=',$id)->find();$cv->page = $good;}
						$ct = ORM::factory('categorie')->where('type','=','article')->find_all();						
						$cv->cats = $ct;		
						$cv->page = $page1;									
						
					}
				
				
					$this->template->addlink = "<a href='".URL::site()."admin/articles'>Добавить статью</a>";
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$cv = View::factory('admin/articles');
					$ct = ORM::factory('categorie')->where('type','=','articles')->find_all();						
					$cv->cats = $ct;			
					$cv->page1 = $page1;			
					$cv->role = $this->role;
					if (!isset($id)) {$cv->pid =0; $cv->page = ORM::factory('article');} else {$cv->pid = $id;$good = ORM::factory('article')->where('id','=',$id)->find();$cv->page = $good;}
					//$cv->cat = $ct;

				
					
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content =$cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}

		}
				
		
		public function action_orders()
		{
				if($this->auth->logged_in())
				{
					$s=Session::instance();
					$a = $this->set_up();
					$cstr = "a1";
					foreach ($a as $i=>$vv)
					{
						$cstr .= "&".$i."=".$vv;
					}				
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
				
					if (!isset($a['page']) || $a['page']==0)
					{
						$a['page'] = 0;
					} else {
						$a['page']--;}
				
								
					if ($_POST)
					{
						$data =$_POST;
						if (isset($data['del'])) {
							$order = ORM::factory('order')->where('id','=',$data['prod'])->find();
							mysql_query("DELETE FROM ss_containers WHERE order_id=".$order->id);
							$order->delete();
							return $this->request->redirect('admin/orders?q='.$a['q'].'&page=0');
						} elseif (isset($data['edit'])) {
							$order = ORM::factory('order')->where('id','=',$data['prod'])->find();
							$order->values($data, array('ddate','fio', 'zip','address','city','phone','email','paymode','deliver','used'));
							$order->save();
						}

						if (isset($_POST['search']))
						{
							$_SESSION['ofilter'] = $_POST;
							$a['filter'] = 1;
						} 						
					}
					
					if (!isset($_SESSION['ofilter'])) {												
						$_SESSION['ofilter']['ddate2'] = "";
						$_SESSION['ofilter']['name2'] = "";
						$_SESSION['ofilter']['phone2'] = "";
						$_SESSION['ofilter']['email2']='';
						$_SESSION['ofilter']['used2']=-1;
						$_SESSION['ofilter']['paymode2']=0;
						$_SESSION['ofilter']['deliver2']=0;

						$a['filter'] = 0;
					}

					$filter =" true ";
					if ($a['filter']==1) {						
						if (strlen($_SESSION["ofilter"]["ddate2"])>0)
						{
							$filter .= " and ddate='".$_SESSION["ofilter"]["ddate2"]."' ";
						}
						if (strlen($_SESSION["ofilter"]["name2"])>0)
						{
							$filter .= " and fio like '%".$_SESSION["ofilter"]["name2"]."%' ";
						}
						if (strlen($_SESSION["ofilter"]["phone2"])>0)
						{
							$filter .= " and phone='".$_SESSION["ofilter"]["phone2"]."' ";
						}						
						if (strlen($_SESSION["ofilter"]["email2"])>0)
						{
							$filter .= " and email='".$_SESSION["ofilter"]["email2"]."' ";
						}						
						if ($_SESSION["ofilter"]["used2"]>-1)
						{
							$filter .= " and used='".$_SESSION["ofilter"]["used2"]."' ";
						}						
					}

					
					$allprods = DB::query(Database::SELECT, 'SELECT * FROM ss_orders WHERE '.$filter)->execute()->as_array();
					$page = DB::query(Database::SELECT, 'SELECT * FROM ss_orders WHERE '.$filter." ORDER BY id DESC LIMIT ".$a['q']." OFFSET ".$a['page']*$a['q'])->execute()->as_array();

					
					
					//$page = ORM::factory('order')->order_by('id','DESC')->limit($a['q'])->offset($a['page']*$a['q'])->find_all();
					$cv = View::factory('admin/orders');

					$counts = count($allprods);
					$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'    => $a['q']));										
					$cv->page = $page;
					$cv->page1 = $a['page'];
					$cv->items = $a['q'];
					$cv->filter = $a['filter'];
					$cv->sess = $_SESSION['ofilter'];
					$cv->cstr = $cstr;
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		
		public function action_options()
		{
				if($this->auth->logged_in())
				{
				
					if (isset($_GET['del']))
					{
						$good = ORM::factory('option')->where('id', '=', $_GET['id'])->find();
												
						$good->delete();
						return $this->request->redirect('admin/options');
					}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('option')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('option');
					}

					
				
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('option');
						} else {
							$cat = $_POST['opt'];
							$ct = ORM::factory('option')->where('id','=',$cat)->find();
						}
						
						$ct->name = $_POST['name'];
						$ct->sort = $_POST['sort'];
						$ct->category_id = $_POST['cat'];
						$ct->type = $_POST['type'];
						$ct->values = $_POST['values'];
						$ct->type2 = $_POST['type2'];
						$ct->single = $_POST['single'];
						$ct->sale = $_POST['sale'];
						$ct->table_ref = $_POST['table_ref'];
						$ct->save();
						mysql_query("UPDATE ss_values SET name=".$ct->name." WHERE option_id=".$ct->id);
						return $this->request->redirect('admin/options?id='.$ct->id);
					}
					
					$lmenu = ORM::factory('categorie')->where('category_id','=','355')->find_all();
					
					$cv = View::factory('admin/options');
					$cv->option = $ct;
					$cv->role = $this->role;
					$cv->table = ORM::factory('table')->find_all();
					$cv->lmenu = $this->make_menu($lmenu);
					$this->template->wmenu = $this->wmenu;

					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		

		
		public function action_values()
		{
				if($this->auth->logged_in())
				{
				
					$a = $this->set_up();
				
					$cstr = "a1";
					foreach ($a as $i=>$vv)
					{
						$cstr .= "&".$i."=".$vv;
					}				
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
					}
				
					$cid = $_GET['cid'];
					$prod = ORM::factory('product')->where('id','=',$cid)->find();
					$opts = ORM::factory('option')->where('category_id','=',$prod->category_id)->find_all();
					
					if ($_POST)
					{
							$data = $_POST;
						
							foreach ($data['value'] as $i=>$val)
							{
								$ct = ORM::factory('value')->where('id','=',$i)->find();
								$ct->value = $val;
								$ct->save();
								echo $i."--".$val."<br/>";
							}
							return $this->request->redirect('admin/values?page='.$_GET['page'].'&cid='.$cid);
					
					}
					
					$cv = View::factory('admin/values');
					
					$values = ORM::factory('value')->where('product_id','=',$cid)->find_all();
					$cv->prod = $prod;
					$cv->cstr = $cstr;
					$cv->cid = $cid;
					$cv->values = $values;
					$cv->role = $this->role;

					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;


				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}		
		
		

		public function action_feeds()
		{
				if($this->auth->logged_in())
				{
					$uid = $_GET['uid'];
					$prod = ORM::factory('product')->where('id','=',$uid)->find();
					if (isset($_GET['del']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						
						$good->delete();
						return $this->request->redirect('admin/feeds?page='.$_GET['page'].'&cid='.$cid);
					}
					
					if (isset($_GET['done']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						$good->enabled=1;
						$good->save();
						return $this->request->redirect($_SERVER['HTTP_REFERER']);
					}
					if (isset($_GET['undone']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						$good->enabled=0;
						$good->save();
						return $this->request->redirect($_SERVER['HTTP_REFERER']);
					}					
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('feed');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('feed')->where('id','=',$cat)->find();
						}
						
							if (isset($_POST['pos']) && strlen($_POST['pos'])==0) {
								$ct->pos = $_POST['pos'];
							} else{
								//where('product_id','=',$cid)->
								$pos = ORM::factory('feed')->order_by('pos','DESC')->find();
								$ct->pos = $pos->pos+1;
							}
							//$ct->product_id = $cid;							
							$ct->fio = $_POST['fio'];
							$ct->date = $_POST['date'];
							$ct->text = $_POST['text'];
							$ct->cts = time();
							$ct->user_id = $this->auth->get_user()->id;
							$ct->product_id = $uid;
							$ct->save();
							
							$mail_url = 'smsg/lot/'.$uid."/1/";
							$mail = Request::factory($mail_url)->execute();

							return $this->request->redirect('admin/feeds?uid='.$_GET['uid'].'&page='.$_GET['page'].'&cid='.$cid);
								
								
					
					}
					
					$cv = View::factory('admin/feeds');
					//where('product_id','=',$cid)
					$photos = ORM::factory('feed')->where('subj','=','0')->where('product_id','=',$uid)->order_by('done','ASC')->order_by('id','DESC')->find_all();
					$cv->page1 = $_GET['page'];
					$cv->prod = $prod;
					$cv->page = $photos;
					$cv->role = $this->role;
					$this->template->addlink = "<a href=".URL::site()."admin/feed?cid=".$cid.">Добавить отзыв</a>";				
					$lmenu = ORM::factory('img')->where('product_id','=',$cid)->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu,'admin/feeds');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}

		
		public function action_ofeeds()
		{
				if($this->auth->logged_in())
				{
					//$cid = $_GET['cid'];
					//$prod = ORM::factory('product')->where('id','=',$cid)->find();
					if (isset($_GET['del']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						
						$good->delete();
						return $this->request->redirect('admin/ofeeds?page='.$_GET['page'].'&cid='.$cid);
					}

					if (isset($_GET['done']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						$good->done=1;
						$good->save();
						return $this->request->redirect('admin/ofeeds?page='.$_GET['page'].'&cid='.$cid);
					}
					if (isset($_GET['undone']))
					{
						$good = ORM::factory('feed')->where('id', '=', $_GET['id'])->find();
						
						$good->done=0;
						$good->save();
						return $this->request->redirect('admin/ofeeds?page='.$_GET['page'].'&cid='.$cid);
					}	

					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('feed');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('feed')->where('id','=',$cat)->find();
						}
						
							if (isset($_POST['pos']) && strlen($_POST['pos'])==0) {
								$ct->pos = $_POST['pos'];
							} else{
								//where('product_id','=',$cid)->
								$pos = ORM::factory('feed')->order_by('pos','DESC')->find();
								$ct->pos = $pos->pos+1;
							}
							//$ct->product_id = $cid;							
							$ct->fio = $_POST['fio'];
							$ct->date = $_POST['date'];
							$ct->text = $_POST['text'];
							$ct->save();
							
							

							return $this->request->redirect('admin/feeds?page='.$_GET['page'].'&cid='.$cid);
								
								
					
					}
					
					$cv = View::factory('admin/ofeeds');
					//where('product_id','=',$cid)
					$photos = ORM::factory('feed')->where('subj','=','1')->order_by('done','ASC')->order_by('id','DESC')->find_all();
					$cv->page1 = $_GET['page'];
					$cv->prod = $prod;
					$cv->page = $photos;
					$cv->role = $this->role;
					$this->template->addlink = "<a href=".URL::site()."admin/feed?cid=".$cid.">Добавить отзыв</a>";				
					$lmenu = ORM::factory('img')->where('product_id','=',$cid)->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu,'admin/ofeeds');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		
		
		
		public function action_services()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('service')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('service');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('service')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/services/".$ct->filename) && strlen($ct->filename)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/services/".$ct->filename);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/services');
					}
					
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('service');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('service')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('name','type','link','description','long_description','enabled','sort'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/service',$ct);
								$ct->filename = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							
							return $this->request->redirect('admin/services?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/service>Добавить баннер</a>";
					$lmenu = ORM::factory('service')->find_all();
					$cv = View::factory('admin/service');
					$cv->prods = ORM::factory('service')->find_all();
					$cv->type = $_GET['type'];
					$counts = ORM::factory('service')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts-10));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$cv->role = $this->role;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/service');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}		
		
		public function action_banners()
		{
				if($this->auth->logged_in())
				{
					//echo 12345;
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('banner')->where('id','=',$cat)->find();
					} else {
						$ct = ORM::factory('banner');
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('banner')->where('id','=',$cat)->find();

						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/banners/".$ct->filename) && strlen($ct->filename)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/banners/".$ct->filename);
						}
						$ct->delete();
					
						return $this->request->redirect('admin/banners');
					}
					
					if ($_POST)
					{
						//print_r($_POST);exit;
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('banner');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('banner')->where('id','=',$cat)->find();
						}
							
							$ct->values($_POST,array('name','type','link','description','sort','enabled'));
							$ct->save();
							
							
							if (file_exists($_FILES['banner']['tmp_name'])) {
								$filename=$this->uploadImg($_FILES['banner'],'img/banners',$ct);
								$ct->filename = $filename;
							
								if (strlen($ct->name)==0)
								{
									$ct->name = $filename;
								}
							}
								
							$ct->save();
							
							
							return $this->request->redirect('admin/banners?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/banners>Добавить баннер</a>";
					$lmenu = ORM::factory('banner')->find_all();
					$cv = View::factory('admin/banners');
					$cv->prods = ORM::factory('banner')->find_all();
					$counts = ORM::factory('banner')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts-10));	
					$cv->type = $_GET['type'];
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu,'admin/banners');
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		

		public function action_stat()
		{
				if($this->auth->logged_in())
				{

					if ($stream = fopen('http://api-metrika.yandex.ru/stat/traffic/summary?id=14110534&oauth_token=eb0c4a504a7c4ae3a9c4734d0d7febb2', 'r')) {
						// print all the page starting at the offset 10
						$xmlstring = stream_get_contents($stream, -1, -1);
						$xml = simplexml_load_string($xmlstring);
						fclose($stream);
					}				
					//var_dump($xml);
					//var_dump($xml->data);
					$stat = array();
					$j = 0;
					foreach ($xml->data->row as $i=>$item)
					{						
						$stat[$j]['date'] = (string)$item->date;
						$stat[$j]['new'] = (string)$item->new_visitors;
						$stat[$j]['visits'] = (string)$item->visits;
						$stat[$j]['page_views'] = (string)$item->page_views;
						$stat[$j]['visitors'] = (string)$item->visitors;
						$j++;
					}
					
					
					$cv = View::factory('admin/stat');
					$cv->stat = $stat;
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu);
					
					$this->template->content = $cv;
				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}

		
		
		
		public function action_users()
		{
				if($this->auth->logged_in())
				{
					if ($_POST)
					{
					
					
					}
				
					$this->template->addlink = "<a href=".URL::site()."admin/users>Добавить пользователя</a>";
					$lmenu = ORM::factory('categorie')->where('category_id','=','0')->find_all();
					$this->template->wmenu = $this->wmenu;
					$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content = "В разработке";
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}
		

		public function action_shopimgs()
		{
				if($this->auth->logged_in())
				{
				
					//$a = $this->set_up();
				
						
					$cid = $_GET['cid'];
					$cat = ORM::factory('shop')->where('id','=',$cid)->find();


					if (isset($_GET['del']))
					{
						$good = ORM::factory('shopimg')->where('id', '=', $_GET['id'])->find();
						
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/shopphotos/".$good->name) && strlen($good->name)>0)
						{
							unlink($_SERVER['DOCUMENT_ROOT']."/img/shopphotos/".$good->name);
						}
						
						$good->delete();
						return $this->request->redirect('admin/shopimgs?'.$cstr.'&cid='.$cid);
					}
					
					if ($_POST)
					{
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('shopimg');
						} else {
							$cat_id = $_POST['prod'];
							$ct = ORM::factory('shopimg')->where('id','=',$cat_id)->find();
						}
						

						if (strlen($_POST['pos'])!=0) {
							$ct->pos = $_POST['pos'];
						} else{
							$pos = ORM::factory('shopimg')->where('shop_id','=',$cid)->order_by('pos','DESC')->find();
							$ct->pos = $pos->pos+1;
						}
						$ct->shop_id = $cid;							
						$ct->save();
							
						if (file_exists($_FILES['foto']['tmp_name']))
						{							
							$filename=$this->uploadImg($_FILES['foto'],'img/shopphotos',$ct);
							$ct->name = $filename;
							$ct->save();
							return $this->request->redirect('admin/shopimgs?cid='.$cid."'");
						}
								
								
					
					}
					
					$cv = View::factory('admin/shopphotos');
					$cv->cid = $cat;
					
					$photos = ORM::factory('shopimg')->where('shop_id','=',$cid)->order_by('pos')->find_all();
					$cv->goods = $photos;
					$cv->cstr = $cstr;
					$this->template->addlink = "<a href=".URL::site()."admin/shopimgs?".$cstr."cid=".$cid.">Добавить фото</a>";				
					$lmenu = ORM::factory('shopimg')->where('shop_id','=',$cid)->find_all();
					$this->template->wmenu = $this->wmenu;
					//$this->template->lmenu = $this->make_menu($lmenu);
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
			
			
			
		}		
		
		
		public function action_shops()
		{
				if($this->auth->logged_in())
				{
					if (!isset($_GET['page']))
					{
						$page = 0;
					} else {
						$page = $_GET['page'];}

					if (isset($_GET['id'])) { 
						$cat = $_GET['id'];
						$ct = ORM::factory('shop')->where('id','=',$cat)->find();
						$brand = explode("-",$ct->brands);
						$brands = ORM::factory('categorie')->where('id','in',$brand)->find_all();
					} else {
						$ct = ORM::factory('shop');
						$brands = array();
					}
					
					if (isset($_GET['del']))
					{
						$cat = $_GET['id'];
						$ct = ORM::factory('shop')->where('id','=',$cat)->find();

						$ct->delete();
					
						return $this->request->redirect('admin/shops?page='.$page);
					}
					if (isset($_GET['dm']))
					{
						$s = ORM::factory('shop')->where('id', '=', $_GET['id'])->find();
						$s->brands = str_replace($_GET['mid'].'-','',$s->brands);
						$s->save();
											
						return $this->request->redirect('admin/shops?id='.$_GET['id']);
					}
					if ($_POST)
					{
						//print_r($_POST); exit;
						if (isset($_POST['add']))
						{
							$ct = ORM::factory('shop');
						} else {
							$cat = $_POST['prod'];
							$ct = ORM::factory('shop')->where('id','=',$cat)->find();
						}
							$_POST['link']=$this->translit($_POST['name']);
						
							$ct->values($_POST,array('name','phone','addr','link','pos','map'));
							$ct->save();
							
							
							foreach ($_POST['brandlist'] as $v)
							{
								if ($v>0) {							
									$_brands .=  $v."-";;
								}
							}
							$ct->brands .= $_brands;
							
							
							$ct->save();
							
							return $this->request->redirect('admin/shops?id='.$_POST['prod']);
							//return $this->request->redirect('admin/sizes?id='.$ct->id);
												
					}
				
					$this->template->addlink = "<a href='".URL::site()."admin/shops'>Добавить магазин</a>";
					$lmenu = ORM::factory('shop')->find_all();
					
					$cv = View::factory('admin/shops');
					$cv->brands = $brands;
					//$cv->prods = ORM::factory('size')->limit(20)->offset($page*20)->find_all();
					$cv->prods = ORM::factory('shop')->order_by('pos')->find_all();
					$cv->brandlist = ORM::factory('categorie')->where('enabled','=',1)->where('type','=','catalog')->where('category_id','=','0')->order_by('sort')->find_all();
					$counts = ORM::factory('shop')->count_all();
					$cv->pagination = Pagination::factory(array('total_items' => $counts,'items_per_page'=>20));					
					$cv->page = $page;
					$cv->page1 = $ct;
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				
					
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}						
		}

		
	
    public function action_adduser()
    {
		if($this->auth->logged_in())
		{
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
				
	        // Создаем переменную, отвечающую за связь с моделью данных User
				$model = ORM::factory('user');
				$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.$_POST['username'].'" OR email="'.$_POST['email'].'";')->execute()->as_array();
			
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				$validation->rule('fio', 'not_empty');
				$validation->rule('username', 'not_empty');
				$validation->rule('email', 'email');
				$validation->rule('password', 'not_empty');
				$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
				
				$validation->check();
				$errors = $validation->errors('validation');
				if (count($login)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким логином уже существует';
				}
				
				if(count($errors)>0)
				{
					
				} 
				else {	
					
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
					$model->values(array(
						'username' => $_POST['username'],
						'email' => $_POST['email'],
						'password' => $_POST['password'],
						'password_confirm' => $_POST['password_confirm'],
						));
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();

					echo $model->id;
					// Назначаем ему роли
					$model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
					
					//print_r($_POST);
					$atts = ORM::factory('useratt');
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'phone'=>$_POST['phone'],
					'company'=>$_POST['company'],
					'user_id'=>$model->id
					));
					$atts->save();
					
					$mail_url = 'smsg/user/'.$atts->user_id."/1/";
					$mail = Request::factory($mail_url)->execute();

					
					if ($this->auth->instance()->login($_POST['username'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						$this->request->redirect('admin/cabinet/?user='.$model->id);
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;
				}
				}
				$data = $_POST;
	        }
    
			$content = View::factory('admin/register1');
			$content->data = $data;
			$content->errors = $errors;
			$this->template->wmenu = $this->wmenu;
			$this->template->content = $content;
		} else
		{
			// А если он не залогинен, отправляем логиниться
			return $this->request->redirect('admin/login');
		}	
    }	

    public function action_cabinet()
    {
    
		if($this->auth->logged_in())
		{
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
	        // Создаем переменную, отвечающую за связь с моделью данных User
				
				$model = ORM::factory('user')->where('id','=',$_GET['user'])->find();
				//echo $model->id; exit;
				$mail = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email="'.$_POST['email'].'" AND id<>"'.$_GET['user'].'";')->execute()->as_array();
				$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.$_POST['login'].'" AND id<>"'.$_GET['user'].'";')->execute()->as_array();
						
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				$validation->rule('fio', 'not_empty');
				$validation->rule('email', 'email');
				$validation->rule('username', 'not_empty');
				//$validation->rule('password', 'not_empty');
				//$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
				
				$validation->check();
				$errors = $validation->errors('validation');
				if (count($mail)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким e-mail уже существует';
				}


				if (count($login)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким ИНН уже существует';
				}
				
				if( count($errors)>0)
				{
					
				} 
				else {	
					
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
				if (strlen($_POST['password'])>0) {
						$model->values(array(
							'username' => $_POST['username'],
							'email' => $_POST['email'],
							'role' => $_POST['role'],
							'password' => $_POST['password'],
							'password_confirm' => $_POST['password_confirm'],
							));
					} else {
						$model->values(array(
							'username' => $_POST['username'],
							'email' => $_POST['email'],
							'role' => $_POST['role']
							));
					}
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();
					// Назначаем ему роли
			
					$atts = ORM::factory('useratt')->where('user_id','=',$model->id)->find();
					
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'birthday'=>$_POST['birthday'],
					'company'=>htmlspecialchars($_POST['company']),
					'region'=>str_replace("\r","",$_POST['region']),
					'city'=>str_replace("\r","",$_POST['city']),
					'fullname'=>htmlspecialchars($_POST['fullname']),
					'shortname'=>htmlspecialchars($_POST['shortname']),
					'street'=>str_replace("\r","",$_POST['street']),
					'web'=>str_replace("\r","",$_POST['web']),
					'house'=>$_POST['house'],					
					'phone'=>$_POST['phone'],
					'phone1'=>$_POST['phone1'],
					'nd'=>$_POST['nd'],
					'dolz'=>$_POST['dolz'],
					'user_id'=>$model->id,
					'expert'=>$_POST['expert']
					));
					
					
					/*$atts->values(array(
					'fio'=>$_POST['fio'],
					'birthday'=>$_POST['birthday'],
					'company'=>$_POST['company'],
					'phone'=>$_POST['phone'],
					'expert'=>$_POST['expert'],
					'nd'=>$_POST['nd'],
					'user_id'=>$model->id
					));*/
					$atts->save();
					
					mysql_query('DELETE FROM ss_u2cs WHERE user_id='.$model->id);
					foreach ($_POST['c'] as $i=>$v) {
						if ($v > 0) {							
							$u2c = ORM::factory('u2c');
							$u2c->user_id = $atts->id;
							$u2c->category_id = $v;
							$u2c->save();
						}
					}					
					
					if ($this->auth->instance()->login($_POST['username'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						$this->request->redirect('admin/cabinet/?user='.$_GET['user']);
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;
				}
				}
				//$data = $_POST;
	        }
			
			$content = View::factory('admin/cabinet');

			if (isset($_SESSION['basket']) && is_array($_SESSION['basket'])) {
				foreach($_SESSION["basket"] as $k=>$v) {
					if(isset($_SESSION["basket"][$k])) {
	//					echo $k.'=='.$_GET['id'];
						//if ($k==$_GET['id']) {
						$prod_a = explode("-",$k);
						//print_r($prod_a);
						$prod = ORM::factory('product')->where('id','=',$prod_a[0])->find();
						$_SESSION["basket"][$k]['price'] = intval($prod->Price*0.85);
						$_SESSION["basket"][$k]['price2'] = intval($prod->Price);
						//}
						//Unset($_SESSION["basket"][$v]);
					}
				}
			}
			
			$usrdata = ORM::factory('useratt')->where('user_id','=',$_GET['user'])->find();
			
			$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
			
			$cs = DB::query(Database::SELECT, 'SELECT * FROM ss_u2cs WHERE user_id="'.$_GET['user'].'";')->execute()->as_array();
			$content->cats = $cats;
			$content->cs = $cs;
			$content->data = $usrdata;
			$content->errors = $errors;
			$content->role = $this->role;
			$this->template->content = $content;
			$this->template->wmenu = $this->wmenu;			

		} else {
			return $this->request->redirect('admin/login');
			
		}    
	}


		
		
	    // Регистрация пользователей
	    public function action_register()
	    {
	    // Если есть данные, присланные методом POST
	    if ($_POST)
	        {
	        // Создаем переменную, отвечающую за связь с моделью данных User
	        $model = ORM::factory('user');
	        // Вносим в эту переменную значения, переданные из POST
	        $model->values(array(
	           'username' => $_POST['username'],
	           'email' => $_POST['email'],
	           'password' => $_POST['password'],
	           'password_confirm' => $_POST['password_confirm'],
	        ));
	        try
			{
	            // Пытаемся сохранить пользователя (то есть, добавить в базу)
	            $model->save();
	            // Назначаем ему роли
	            $model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
	            // И отправляем его на страницу пользователя
	                $this->request->redirect('admin/view/');
	        }
	        catch (ORM_Validation_Exception $e)
	        {
	            // Это если возникли какие-то ошибки
	            echo $e;
			}
	        }
	        // Загрузка формы логина
	        $this->response->body(View::factory('register'));
	    }
	 
	    // Просмотр пользовательских данных
	    public function action_view()
	    {
	    // Проверям, залогинен ли пользователь
	    if($this->auth->logged_in())
	            {
	            // Если да, то здороваемся и предлагаем выйти. Это можно было и в виде view реализовать
	            echo 'Добро пожаловать, '.Auth::instance()->get_user()->username.'!';
	            echo "<br /><a href='".URL::site()."admin/logout'>logout</a>";
	            }
	    else
	        {
	            // А если он не залогинен, отправляем логиниться
	            return $this->request->redirect('admin/login');
	        }
	 
	    }
	 
		// Метод разлогивания
	    public function action_logout()
	    {
	    // Пытаемся разлогиниться
	    if ($this->auth->logout())
	        {
	            // Если получается, то предлагаем снова залогиниться
	            return $this->request->redirect('admin/login');
	        }
	    else
	        {
	            // А иначе - пишем что не удалось
	            echo 'fail logout';
	        }
	    }
	 
	 
	private function make_menu($src,$type='admin/categories') {
        $menu_arr = array();
        if (count($src)>0)
        {
            foreach($src as $i=>$elem)
            {
                $menu_arr[$elem->id]['active'] = 0;
                $menu_arr[$elem->id]['id'] = $elem->id;
				$menu_arr[$elem->id]['category_id'] = $elem->category_id;
				$menu_arr[$elem->id]['name'] = $elem->name;
				$menu_arr[$elem->id]['type'] = $type;
				$menu_arr[$elem->id]['enabled'] = $elem->enabled;
				$menu_arr[$elem->id]['nav_type'] = $elem->nav_type;
				//$menu_arr[$elem->id]['sld_pid'] = $elem->sld_pid;
                $menu_arr[$elem->id]['children'] = array();                
                $children = ORM::factory('categorie')->where('category_id','=',$elem->id)->find_all();
				//echo $menu_arr[$elem->id]['name']."!!!".count($children)."!!!<br/>";
                if (count($children)>0)
                {
                    $menu_arr[$elem->id]['children'] = $this->make_menu($children);
                }
            }
            
        }    
        return $menu_arr;
    }   
	 
	    // Метод логина
	    public function action_login()
	    {
	        // Проверям, вдруг пользователь уже зашел

	         if($this->auth->logged_in())
	            {
				//echo 72107;
	            // И если это так, то отправляем его сразу на страницу пользователей
	            return $this->request->redirect('admin/agoods');
	            }

			
	        // Если же пользователь не зашел, но данные на страницу пришли, то:
	        if ($_POST)
	        {
				
				
	            // Создаем переменную, отвечающую за связь с моделью данных User
	            $user = ORM::factory('user')->where('username','=',$_POST['username'])->find();
	            // в $status помещаем результат функции login
				//echo $user->role;
				if ($user->id > 0 && ($user->role == 2 || $user->role == 99)) {
					$status = $this->auth->login($_POST['username'], $_POST['password']);
				}
				echo $status;
	            // Если логин успешен, то
	            if ($status)
	            {
	                // Отправляем пользователя на его страницу
	                $this->request->redirect('admin/agoods');
	            }
	            else
	            {
                // Иначе ничего не получилось, пишем failed
	                echo 'failed';
            }
	        }
			
			$this->template->lmenu = array();
			$this->template->wmenu = array();
			$this->template->navi = "";			
			$this->template->addlink = "";
			$this->template->content = View::factory('admin/login');
			
	        // Грузим view логина
	            //$this->response->body(View::factory('login'));
	    }
 
		
public function translitChar($char){
	switch($char){
		case 'А': return 'a';
		case 'а': return 'a';
		case 'Б': return 'b';
		case 'б': return 'b';
		case 'В': return 'v';
		case 'в': return 'v';
		case 'Г': return 'g';
		case 'г': return 'g';
		case 'Д': return 'd';
		case 'д': return 'd';
		case 'Е': return 'e';
		case 'е': return 'e';
		case 'Ё': return 'yo';
		case 'ё': return 'yo';
		case 'Ж': return 'zh';
		case 'ж': return 'zh';
		case 'З': return 'z';
		case 'з': return 'z';
		case 'И': return 'i';
		case 'и': return 'i';
		case 'Й': return 'y';
		case 'й': return 'y';
		case 'К': return 'k';
		case 'к': return 'k';
		case 'Л': return 'l';
		case 'л': return 'l';
		case 'М': return 'm';
		case 'м': return 'm';
		case 'Н': return 'n';
		case 'н': return 'n';
		case 'О': return 'o';
		case 'о': return 'o';
		case 'П': return 'p';
		case 'п': return 'p';
		case 'Р': return 'r';
		case 'р': return 'r';
		case 'С': return 's';
		case 'с': return 's';
		case 'Т': return 't';
		case 'т': return 't';
		case 'У': return 'u';
		case 'у': return 'u';
		case 'Ф': return 'f';
		case 'ф': return 'f';
		case 'Х': return 'h';
		case 'х': return 'h';
		case 'Ц': return 'ts';
		case 'ц': return 'ts';
		case 'Ч': return 'ch';
		case 'ч': return 'ch';
		case 'Ш': return 'sh';
		case 'ш': return 'sh';
		case 'Щ': return 'chsh';
		case 'щ': return 'chsh';
		case 'Ъ': return '';
		case 'ъ': return '';
		case 'Ы': return 'i';
		case 'ы': return 'i';
		case 'Ь': return '';
		case 'ь': return '';
		case 'Э': return 'e';
		case 'э': return 'e';
		case 'ю': return 'yu';
		case 'Я': return 'ya';
		case 'я': return 'ya';
		default: return $char;
	}
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

private function uploadImg($file,$folder,$good){
	if (file_exists($file['tmp_name'])) {
		$image = Image::factory($file['tmp_name']);
		
		mb_ereg("\.([^\.]*)$",$file["name"],$t);
		$ext = strtolower($t[1]);
//		if ($image->width>1000 || $image->height>1000) {
//			$image->resize(1000,1000,Image::AUTO);
//		}
		//echo Kohana::debug($this->image);		
		$image->save($_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
		
}

private function uploadImg4Csv($file,$folder,$good){
	//echo $file;
	if (file_exists($file)) {		
		$image = Image::factory($file);
		//print_r($image);
		mb_ereg("\.([^\.]*)$",$file,$t);
		$ext = strtolower($t[1]);
		//exit;
		/*if ($image->width>1000 || $image->height>1000) {
			$image->resize(1000,1000,Image::AUTO);
		}*/
//echo $_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext."<br/>";
		copy($file,$_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		//$image->save($_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
		
}

private function uploadImg4Csv1($file,$folder,$good){
	//echo $file;
	print_r($file);
	if (file_exists($file['tmp_name'])) {		
		$image = Image::factory($file['tmp_name']);
		//print_r($image);
		mb_ereg("\.([^\.]*)$",$file['tmp_name'],$t);
		$ext = strtolower($t[1]);
		//exit;
		/*if ($image->width>1000 || $image->height>1000) {
			$image->resize(1000,1000,Image::AUTO);
		}*/
//echo $_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext."<br/>";
		copy($file['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/".$folder."/".$file['name']);
		//$image->save($_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
		
}



    public function get_path($cat)
    {
		$path = "";
        $path = $cat->alias.$path;
 
        if ($cat->category_id>0)
        {
	//		echo $cat->category_id."==";
            $pc = ORM::factory('categorie')->where('id',"=",$cat->category_id)->find();
            $path = $this->get_path($pc)."/".$path;
        }
//echo $path." ";
		return $path;
    }

	public function set_up ()
	{
		$a = array();
		if (!isset($_GET['c_id']))
		{
			$a['c_id'] = -1;
		} else {
			$a['c_id'] = $_GET['c_id'];}

		if (!isset($_GET['q']))
		{
			$a['q'] = 20;
		} else {
			$a['q'] = $_GET['q'];
		}

		if (!isset($_GET['filter']))
		{
			$a['filter'] = 0;
		} else {
			$a['filter'] = $_GET['filter'];
		}

		
		if (!isset($_GET['page']) || $_GET['page']==0)
		{
			$a['page'] = 0;
		} else {
			$a['page'] = $_GET['page'];}
	
		return $a;
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
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" style=\"margin-left:".($level*5)."px\">".$lm['name']."</a>";
		} else {
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" style=\"font-weight:bold;margin-left:".($level*5)."px\">".$lm['name']."</a>";		
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
		//echo $pos."==".$cat->category_id."==<br/>";
		$parent = ORM::factory('categorie')->where('id','=',$cat->category_id)->find();
		$pos ++;
		$arr += $this->get_parents($parent,$pos);
	}
	
	return $arr;
}

public function draw_parents($arr,$pos=0)
{
	$cats = array();
	foreach ($arr as $i=>$v)
	{
		$cats1 = ORM::factory('categorie')->where('id','=',$v)->find();
		$cats[]=$cats1;
	}	
	return $cats;
}

	public function make_recursive_menu($src,$type,$arr) {
        $menu_arr = array();
        if (count($src)>0)
        {
            foreach($src as $i=>$elem)
            {
                $alias = $elem->alias;
                if (strlen($elem->parent_chpu)>0) {
                    $menu_arr[$elem->id]['link'] = $type."?";
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

	public function form_groups($cat) {
		$r = array();
		
		//$r[] = $cat->id;
		
		$sgr = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();
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

	public function show_navi($tree = array(),$active_id=0)
	{
		$elems = array();

		foreach ($this->nav_types as $i=>$nav_type) {

			$menu = ORM::factory('categorie')->where('category_id','=',0)->where('nav_type','=',$i)->order_by('sort')->find_all();
			
			$elems[$i] = $this->make_menu($menu);
		}
		
		$view = View::factory('admin/lmenu');
		$view->active_id = $active_id;		
		$view->nav_types = $this->nav_types;
		$view->tree = $tree;
		$view->elems = $elems;
		return $view;
	}	
	
	public function show_bans()
	{
		$elems = array();

		foreach ($this->ban_types as $i=>$ban_type) {

			$menu = ORM::factory('banner')->where('type','=',$i)->find_all();
			
			$elems[$i]['name'] = $ban_type;
			$elems[$i]['banners'] = $menu;
		}
		
		$view = View::factory('admin/lbans');
		$view->elems = $elems;
		return $view;
	}
	
	
	
	
		public function action_chpass()
	    {
				if($this->auth->logged_in())
				{
					if ($_POST)
					{
					
						$model = ORM::factory('user')->where('username','=','admin')->find();
	        // Вносим в эту переменную значения, переданные из POST
						$model->values(array(
						   'password' => $_POST['pass1'],
						   'password_confirm' => $_POST['pass2'],
						));
						$model->save();
						
					
					}
				
					$cv = View::factory('admin/chpass');
					$this->template->wmenu = $this->wmenu;
					$this->template->content = $cv;
				

				}
				else
				{
					// А если он не залогинен, отправляем логиниться
					return $this->request->redirect('admin/login');
				}
	    } 	
	
	
	
}
