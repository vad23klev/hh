<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Common {
 
    public function action_index()
    {
	}

    public function before()
    {
        parent::before();		
		
		$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
		
		$this->template->title="Личный кабинет";
		$this->template->h1="Личный кабинет";

		if ($this->auth->instance()->get_user()->role == 4 || $this->auth->instance()->get_user()->role == 5) {
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);			
			
			if ($this->auth->instance()->get_user()->role == 4) {
				$saletype = 0;
			} else {
				$saletype = 1;
			}

			
			$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') = 0  and sale_type='.$saletype.' and stock_type in (2) order by cts desc')->execute()->as_array();
			
			$this->template->nm = count($prods);
		} else {
		
		}	
		
	}	

public function action_pays()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			if ($_POST && count($_POST['name']) > 0) {
				foreach ($_POST['name'] as $i=>$v) {
					$job = ORM::factory('job');
					$job->product_id = $_POST['prod'][$i];
					$job->expert_id = $this->auth->instance()->get_user()->id;
					$job->name = $_POST['name'][$i];
					$job->date = strtotime($_POST['date'][$i]);
					$job->cost = $_POST['cost'][$i];
					$job->valuta = $_POST['valuta'][$i];
					$job->save();
				}
			
			}
		
		
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}


public function action_delpaket1()
{

	if($this->auth->instance()->logged_in())
	{
		if ($_POST && count($_POST['del']) > 0) {
			foreach ($_POST['del'] as $i=>$v) {
				$expert = ORM::factory('expert');
				$expert->expert_id = $this->auth->instance()->get_user()->id;
				$expert->product_id = $v;
				$expert->reject = 1;
				$expert->save();
			}
		
		}
	
	
		return $this->request->redirect($_SERVER['HTTP_REFERER']);
	} else {
		return $this->request->redirect("/user/register");
		
	}    
}
	
	
public function action_delpaket()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			if ($_POST && count($_POST['del']) > 0) {
				foreach ($_POST['del'] as $i=>$v) {
					mysql_query('DELETE FROM ss_cat2prods WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_experts WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_feeds WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_products WHERE id='.$v);
					echo mysql_error();					
				}
			
			}
		
		
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}		
	
	
public function action_delete()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			if ($_POST && count($_POST['del']) > 0) {
				foreach ($_POST['del'] as $i=>$v) {
					mysql_query('DELETE FROM ss_cat2prods WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_experts WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_feeds WHERE product_id='.$v);
					echo mysql_error();
					mysql_query('DELETE FROM ss_products WHERE id='.$v);
					echo mysql_error();					
					
				}
			
			}
		
		
			return $this->request->redirect("/user/openlots");
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}	

public function action_delfile()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			if ($_GET && intval($_GET['del']) > 0) {
				$good = ORM::factory('file')->where('id', '=', $_GET['del'])->find();
				
				if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/files/".$good->name) && strlen($good->name)>0)
				{
					unlink($_SERVER['DOCUMENT_ROOT']."/img/files/".$good->name);
				}				
				$good->delete();			
			}				
			$_SESSION['in_wind'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}	

public function action_delimg()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			if ($_GET && intval($_GET['del']) > 0) {

				$good = ORM::factory('img')->where('id', '=', $_GET['del'])->find();
				
				if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/photos/".$good->name) && strlen($good->name)>0)
				{
					unlink($_SERVER['DOCUMENT_ROOT']."/img/photos/".$good->name);
				}				
				$good->delete();
			}				
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}

	

	public function action_accept()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
    	    if ($_GET)
	        {				
				$prod = ORM::factory('expert')->where('product_id','=',$_GET['id'])->where('expert_id','=',$this->auth->instance()->get_user()->id)->find();				
				$prod->product_id = $_GET['id'];
				
				$prod->uts = time();
				$prod->fio = $_POST['fio'];
				$prod->dolz = $_POST['dolz'];
				
				if (isset($_POST['send']))
				{
					$prod->draft = 0;
					$prod1 = ORM::factory('product')->where('id','=',$_GET['id'])->find();
					$prod1->stock_type = 5;
					$prod1->save();
				} else {
					$prod->draft = 1;
				}
				

				$prod->expert_id = $this->auth->instance()->get_user()->id;
				if ($prod->reject == 0) {	
					$prod->reject = $_GET['reject'];
				}	
				$prod->save();												

				if ($_POST['oferta_type'] == 0) {
					$fname = $this->uploadFile0($_FILES['dogovor'],'img/oferta',$prod);
				//echo $fname;exit;
					$prod->dogovor = $fname;
				} else {
					$prod->oferta = $_POST['oferta'];	
					if($prod->dogovor != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$prod->dogovor)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$prod->dogovor);
					}
					
					$prod->dogovor = '';
				}
				$prod->save();

				$prod = ORM::factory('product')->where('id','=',$_GET['id'])->find();
				
				$prod->save();

				foreach ($_POST['descriptions'] as $i=>$v)
				{					
					$file = ORM::factory('file')->where('id','=',$i)->find();
					$file->description = $v;
					$file->save();
				}
				
				//print_r($_FILES); exit;
				foreach ($_FILES['file']['name'] as $i=>$file) {
					
					if (file_exists($_FILES['file']['tmp_name'][$i]))
					{					
						$img = ORM::factory('file');
						$img->product_id = $prod->id;
						$img->file = $_FILES['file']['name'][$i];
						$img->description = $_POST['fdsc'][$i];
						$img->user_id = $this->auth->instance()->get_user()->id;					
						$img->save();
						mb_ereg("\.([^\.]*)$",$file,$t);
						$ext = strtolower($t[1]);
						copy($_FILES['file']['tmp_name'][$i],$_SERVER['DOCUMENT_ROOT'].'/img/files/'.$img->id.'.'.$ext);	
						$img->name = $img->id.'.'.$ext;
						$img->save();
					}
				}				
				
				
				if ($_POST && count($_POST['name']) > 0) {
					mysql_query('delete from ss_jobs where product_id='.$_GET['id'].' and expert_id='.$this->auth->instance()->get_user()->id);
					foreach ($_POST['name'] as $i=>$v) {
						$job = ORM::factory('job');
						$job->product_id = $_POST['prod'][$i];
						$job->expert_id = $this->auth->instance()->get_user()->id;
						$job->name = $_POST['name'][$i];
						$job->date = $_POST['date'][$i];
						$job->cost = str_replace(" ","",$_POST['cost'][$i]);
						$job->valuta = $_POST['valuta'][$i];
						$job->save();
					}
				}				

				
				$mail_url = 'smsg/user/'.$atts->user_id."/1/";
				$mail = Request::factory($mail_url)->execute();

	        }
			$_SESSION['in_wind'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->request->redirect("/");
			
		}
	}		
	

public function action_rejecte()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_GET)
	        {		
				$prod = ORM::factory('expert')->where('expert_id','=',$_GET['expert'])->where('product_id','=',$_GET['uid'])->find();
				//$prod->reject = time();
				$prod->reject_e = time();
				$prod->choosen = 0;
				$prod->save();
			}
			$this->request->redirect($_SERVER['HTTP_REFERER']);
				
		} else {
			$this->request->redirect("/");
			
		}
	
	}	
	
public function action_best()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_GET)
	        {		
				
				$prod = ORM::factory('feed')->where('id','=',$_GET['id'])->find();
				mysql_query('update ss_feeds set best = 0 where product_id ='.$prod->product_id);
				//$prod->reject = time();
				$prod->best = 1;
				$prod->save();
			}
			$this->request->redirect($_SERVER['HTTP_REFERER']);
				
		} else {
			$this->request->redirect("/");
			
		}
	
	}		
	
	
	

public function action_reject()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_GET)
	        {
				//mysql_query('update ss_experts set choosen = 0 where product_id ='.$_GET['uid']);			
			
				$prod = ORM::factory('expert')->where('expert_id','=',$_GET['expert'])->where('product_id','=',$_GET['uid'])->find();
				$prod->reject = time();
				$prod->reason = $_POST['reason'];
				$prod->rating = $_POST['rating'];
				$prod->reject_e = 0;
				$prod->choosen = 0;
				$prod->save();

				//$prod1 = ORM::factory('expert')->where('reject','=',0)->where('choosen','=',$_GET['uid'])->where('expert_id','=',$_GET['expert'])->where('product_id','=',$_GET['uid'])->find();
				
				//$prod = ORM::factory('product')->where('id','=',$_GET['uid'])->find();
				//$prod->stock_type = 2;
				//$prod->save();

				$mail_url = 'smsg/expert/'.$_GET['expert']."/2/".$_GET['uid'];
				$mail = Request::factory($mail_url)->execute();
				//$this->auth->instance()->get_user()->id;
	        // Создаем переменную, отвечающую за связь с моделью данных User
			}
			$this->request->redirect($_SERVER['HTTP_REFERER']);
				
		} else {
			$this->request->redirect("/");
			
		}
	
	}	
	
public function action_choose()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_GET)
	        {
				mysql_query('update ss_experts set choosen = 0,reject=1 where product_id ='.$_GET['uid']);				
			
				$prod = ORM::factory('expert')->where('expert_id','=',$_GET['expert'])->where('product_id','=',$_GET['uid'])->find();
				$prod->choosen = 1;
				$prod->reject = 0;
				$prod->save();

				$prod = ORM::factory('product')->where('id','=',$_GET['uid'])->find();
				$prod->stock_type = 6;
				$prod->save();
				
				$mail_url = 'smsg/expert/'.$_GET['expert']."/1/".$prod->id;
				$mail = Request::factory($mail_url)->execute();

				//$this->auth->instance()->get_user()->id;
	        // Создаем переменную, отвечающую за связь с моделью данных User
			}
			$this->request->redirect($_SERVER['HTTP_REFERER']);
				
		} else {
			$this->request->redirect("/");
			
		}
	
	}	
	

public function action_close()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_GET)
	        {
				$prod = ORM::factory('product')->where('id','=',$_GET['id'])->find();
				$prod->stock_type = 4;
				$prod->save();
				$expert = ORM::factory('expert')->where('product_id','=',$prod->id)->where('choosen','>',0)->find();
				$expert->reason = $_POST['reason'];
				$expert->rating = $_POST['rating'];
				$expert->save();
				//$this->auth->instance()->get_user()->id;
	        // Создаем переменную, отвечающую за связь с моделью данных User
			}
			$this->request->redirect($_SERVER['HTTP_REFERER']);
				
		} else {
			$this->request->redirect("/");
			
		}
	
	}		

	

    public function action_client()
    {
	
		if($this->auth->instance()->logged_in())
	    {
	
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
				
	        // Создаем переменную, отвечающую за связь с моделью данных User
				if (intval($_POST['user_id']) == 0) {
					$model = ORM::factory('user');
				} else {
					$model = ORM::factory('user')->where('id','=',$_POST['user_id'])->find();
				}
				$mail = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email="'.$_POST['email'].'";')->execute()->as_array();
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				//$validation->rule('fio', 'not_empty');
				$validation->rule('email', 'email');
				$validation->rule('phone', 'not_empty');
				$validation->rule('region', 'not_empty');
				$validation->rule('city', 'not_empty');
				
				/*if (intval($_GET['user_id']) == 0) {
					$validation->rule('password', 'not_empty');
					$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
				}*/
				
				$validation->labels(array(
						'password' => 'Пароль',
						'email' => 'E-mail',
						'phone' => 'Телефон',
						'region' => 'Регион',
						'city' => 'Город',
				));
				
				
				$validation->check();
				$errors = $validation->errors('validation');
				if (intval($_POST['user_id']) == 0) {
					if (count($mail)>0)
					{
						$errors['invalid_mail'] = 'Пользователь с таким E-mail уже существует';
					}
				}
				if(count($errors)>0)
				{
					
				} 
				else {
					
					$pass = $this->generate_password(6,8);
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
				if (intval($_POST['user_id']) == 0) {
					$model->values(array(
						'username' => $_POST['email'],
						'email' => $_POST['email'],
						'role' => 5,
						'password' => $pass,
						'password_confirm' => $pass,
						));
				} /*else {
					if (strlen($_POST['password']) > 0) {	
						$model->values(array(
						'password' => $pass,
						'password_confirm' => $pass,
						));
					}
				
				}*/
				
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();

					//echo $model->id;
					// Назначаем ему роли
					if (intval($_POST['user_id']) == 0) {
						$model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
					}
					
					//print_r($_POST);
					if (intval($_POST['user_id']) == 0) {
						$atts = ORM::factory('useratt');
					} else {
						$atts = ORM::factory('useratt')->where('user_id','=',$_POST['user_id'])->find();
					}
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'phone'=>$_POST['phone'],
					'parent_user_id'=>$_POST['parent_user_id'],
					'company'=>$_POST['company'],
					'shortname'=>$_POST['shortname'],
					'complete'=>0,
					'expert'=>0,
					'logo'=>$_POST['logo'],
					'region'=>$_POST['region'],
					'city'=>$_POST['city'],
					'user_id'=>$model->id
					));
					$atts->save();
					//print_r($_POST);

					if (file_exists($_FILES['photo']['tmp_name'])) {
						$l1 = $this->uploadImg($_FILES['photo'],'img/uimgs',$atts);
						$atts->photo = $l1;
						$atts->save();
					}
					
					$u2c1 = ORM::factory('u2c')->where('user_id','=',$this->auth->instance()->get_user()->id)->find_all();
					foreach ($u2c1 as $i=>$v) {
						$u2c = ORM::factory('u2c');
						$u2c->user_id = $model->id;
						$u2c->category_id = $v->category_id;
						$u2c->save();
					} 
					
					
					$mail_url = 'smsg/user/'.$atts->user_id."/1/".$pass;
					$mail = Request::factory($mail_url)->execute();

					
					//if ($this->auth->instance()->login($_POST['username'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						$this->request->redirect('user/client/?user_id='.$atts->user_id);
					//}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;
				}
				}
				$data = $_POST;
	        }

    
		$content = View::factory('user/client');
		$content->data = ORM::factory('useratt')->where('user_id','=',intval($_GET['user_id']))->find();
		$content->parent_id = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
		$content->errors = $errors;
		$this->template->title = "Личный кабинет. Редактирование пользователя";
		$content->info = $this->gen_info;$this->template->content = $content;
		$this->setmain();
		
		} else {
			$this->request->redirect("/");
			
		}
    }	


public function action_client1()
    {
		$s = Session::instance();
		if($this->auth->instance()->logged_in())
	    {
	
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
				$info = ORM::factory('info')->find();
				$data = $_POST;
				
				$mailbody = View::factory('mail/invite');
				$mailbody->fio = $_POST['fio'];
				$mailbody->email = $_POST['email'];
				$referer = ORM::factory('useratt')->where('user_id','=',$_POST['referer'])->find();
				$mailbody->referer = $referer;
							
				$emails = array();
				$emails = explode(';',$info->email);

				$from_user = "НП ПРОВЭД";
				$from_email = 'info@proved-np.org';
				$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
				$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

				$headers = "From: $from_user <$from_email>\r\n".
											"MIME-Version: 1.0" . "\r\n" .
											"Content-type: text/html; charset=UTF-8" . "\r\n";
								
				$res = mail($_POST['email'],"Приглашение от ".$info->name,$mailbody,$headers,'-f'.$from_email);

				
				$_SESSION['success'] = 1;	
				$this->request->redirect($_SERVER['HTTP_REFERER']);
	        } 

		$content = View::factory('user/client_feedback');
		
		$content->data = $this->auth->instance()->get_user()->id;
		$content->parent_id = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
		$content->errors = $errors;
		$content->success = $_SESSION['success'];
		$_SESSION['success'] = 0;
		$this->template->title = "Личный кабинет. Редактирование пользователя";
		$content->info = $this->gen_info;$this->template->content = $content;
		$this->setmain();
		
		} else {
			$this->request->redirect("/");
			
		}
    }
	

    public function action_ausers()
    {
			$errors = array();
			
    	    
		if($this->auth->instance()->logged_in())
	    {
			$data = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE parent_user_id="'.($this->auth->instance()->get_user()->id).'"')->execute()->as_array();
			
			$content = View::factory('user/ausers');
			$this->template->title = "Личный кабинет. Мои пользователи";
			$content->data = $data;
			$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
			$content->cats = $cats;
			$content->errors = $errors;
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();
		} else {
			$this->request->redirect("/");
			
		}
    }
	
	
	public function action_aregister()
    {
			$errors = array();
			$data = array();
			//print_r($_POST);
    	    if ($_POST)
	        {
				//print_r($_REQUEST);
	        // Создаем переменную, отвечающую за связь с моделью данных User
				$model = ORM::factory('user');
				$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.$_POST['username'].'";')->execute()->as_array();
				$mail = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email="'.$_POST['email'].'";')->execute()->as_array();
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				//$validation->rule('fio', 'not_empty');
				//$validation->rule('username', 'not_empty');
				$validation->rule('email', 'email');
				$validation->rule('password', 'not_empty');
				$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
				$validation->labels(array(
						'username' => 'Имя пользователя',
						'password' => 'Пароль',
						'email' => 'E-mail',
						'password_confirm' => 'Пароли должны совпадать',
				));

				$validation->check();
				$errors = $validation->errors('validation');
				if (count($login)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким ИНН уже существует';
				}
				if (count($mail)>0)
				{
					$errors['invalid_mail'] = 'Пользователь с таким E-mail уже существует';
				}				
				if(count($errors)>0)
				{
					foreach ($errors as $error) {
						echo $error.'<br/>';
					}

				} 
				else {
					
					//print_r($_POST);exit;
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
					$model->values(array(
						'username' => $_POST['email'],
						'email' => $_POST['email'],
						'role' => $_POST['expert'],
						'password' => $_POST['password'],
						'password_confirm' => $_POST['password_confirm'],
						));
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();

					//echo $model->id;
					// Назначаем ему роли
					$model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
					
					//print_r($_POST);
					$atts = ORM::factory('useratt');
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'surname'=>$_POST['surname'],
					'lastname'=>$_POST['lastname'],
					'parent_user_id'=>$_POST['referer'],
					'user_id'=>$model->id
					));
					$atts->save();
					//print_r($_POST);
										
					$mail_url = 'smsg/user/'.$atts->user_id."/1/".$_POST['password'];
					$mail = Request::factory($mail_url)->execute();

					
					if ($this->auth->instance()->login($_POST['email'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						echo '/user/cabinet/?success'; exit;
						//$this->request->redirect();
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;exit;
				}
				}
				$data = $_POST;
	        }
			exit;
    }	
	
    public function action_register()
    {
		
			if($this->auth->instance()->logged_in())
			{		
				return $this->request->redirect('user/cabinet');
			} 
		
		
			$errors = array();
			$data = array();
			//print_r($_POST);
    	    if ($_POST && ! isset($_POST['token']))
	        {
				//print_r($_POST);
	        // Создаем переменную, отвечающую за связь с моделью данных User
				$model = ORM::factory('user');
				$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.$_POST['username'].'";')->execute()->as_array();
				$mail = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email="'.$_POST['email'].'";')->execute()->as_array();
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				//$validation->rule('fio', 'not_empty');
				//$validation->rule('username', 'not_empty');
				$validation->rule('email', 'email');
				$validation->rule('password', 'not_empty');
				$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
				$validation->labels(array(
						'username' => 'Имя пользователя',
						'password' => 'Пароль',
						'email' => 'E-mail',
						'password_confirm' => 'Пароли должны совпадать',
				));

				$validation->check();
				$errors = $validation->errors('validation');
				if (count($login)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким ИНН уже существует';
				}
				if (count($mail)>0)
				{
					$errors['invalid_mail'] = 'Пользователь с таким E-mail уже существует';
				}				
				if(count($errors)>0)
				{
					
				} 
				else {
					
					
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
					$model->values(array(
						'username' => $_POST['email'],
						'email' => $_POST['email'],
						'role' => $_POST['expert'],
						'password' => $_POST['password'],
						'password_confirm' => $_POST['password_confirm'],
						));
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();

					//echo $model->id;
					// Назначаем ему роли
					$model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
					
					//print_r($_POST);
					$atts = ORM::factory('useratt');
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'surname'=>$_POST['surname'],
					'lastname'=>$_POST['lastname'],
					'parent_user_id'=>$_GET['referer'],
					'user_id'=>$model->id
					));
					$atts->save();
					//print_r($_POST);
										
					$mail_url = 'smsg/user/'.$atts->user_id."/1/";
					$mail = Request::factory($mail_url)->execute();

					
					if ($this->auth->instance()->login($_POST['email'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						return ;
						$this->request->redirect('user/cabinet/?success');
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;
				}
				}
				$data = $_POST;
				$data ['regnow'] = 0;
	        } elseif ($_POST && isset($_POST['token'])) {
				$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
				$user = json_decode($s, true);
				if (!isset($user['error'])) {
					$data = $user;
					$pass = substr(md5($data['uid']),26);
					$data ['fio'] = $data['last_name'];
					$data ['lastname'] = $data['first_name'];
					$data ['passe'] = $pass;
					$data ['referer'] = $_GET['referer'];
					$data ['regnow'] = 1;
					
					
				}
				//var_dump($user);
			}
			
                    
		$content = View::factory('user/register');
		$content->data = $data;
		$content->user = $user;
		$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
		$content->cats = $cats;
		$content->errors = $errors;
		$content->info = $this->gen_info;$this->template->content = $content;
		$this->setmain();
    }	

public function action_chpass()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
	        // Создаем переменную, отвечающую за связь с моделью данных User
				$model = ORM::factory('user')->where('id','=',$this->auth->instance()->get_user()->id)->find();
				//echo $model->id; exit;
				//$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email<>"'.$_POST['email'].'" AND username="'.$_POST['login'].'";')->execute()->as_array();
						
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				$validation->rule('password', 'not_empty');
				$validation->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
								
				$validation->labels(array(
						'password' => 'Пароль',
						'password_confirm' => 'Пароли',

				));
				
				
				$validation->check();
				$errors = $validation->errors('validation');
				
				if( count($errors)>0)
				{
					
				} 
				else {	
					
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
					$model->values(array(
							'password' => $_POST['password'],
							'password_confirm' => $_POST['password_confirm'],
							));
				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();
					// Назначаем ему роли
			
					//if ($this->auth->instance()->login($_POST['username'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
					$this->request->redirect('user/chpass?success');
					//}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки
					echo $e;
				}
				}
				//$data = $_POST;
	        }
			
			$content = View::factory('user/chpass');

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
			
			$data = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();

			$content->data = $data[0];
			$content->errors = $errors;
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/");
			
		}
	
	}		

	public function action_openanswers()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/currentlots');
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
			if ($this->auth->instance()->get_user()->role == 4) {
				$saletype = 0;
			} else {
				$saletype = 1;
			}
			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();and enabled in (0,1,3,6,5,7)
			$stocktype = array('2' => 'Ожидает ответа');
			foreach ($stocktype as $i=>$type) {			
				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') = 0  and sale_type='.$saletype.' and stock_type in (2) order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
				}
				$data1[$i]['prods'] = $prods;
			}
			
					
			$content->data = $data1;
			$content->noall = 1;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Открытые заявки";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}
	
	
	
    public function action_openanswers1()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$errors = array();
			$data = array();
			
			$content = View::factory('user/openanswers');				
			
    	    if ($_POST)
	        {
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				$validation->rule('user', 'not_empty');				
				$validation->check();
				$content->errors = $validation->errors('validation');
				$content->current = $_POST['uid'];
				if(!$validation->check())
				{
					$content->data = $_POST;
				} 
				else {
					$expert = ORM::factory('expert')->where('expert_id','=',$this->auth->instance()->get_user()->id)->where('product_id','=',$_POST['uid'])->find();
					$expert->expert_id = $this->auth->instance()->get_user()->id;
					$expert->product_id = $_POST['uid'];
					$expert->reject = $_POST['reject'];
					$expert->save();
					
					if ($_POST['reject'] == 0) {
						$prod = ORM::factory('product')->where('id','=',$_POST['uid'])->find();
						$prod->stock_type = 5;
						$prod->save();
					}	
					
					
					//$prod = ORM::factory('product')->where('id','=',$_POST['uid'])->find();
					//$prod->expert_id = $this->auth->instance()->get_user()->id;					
					//$prod->save();
					
					$mail_url = 'smsg/lot/'.$_GET['uid']."/9/";
					$mail = Request::factory($mail_url)->execute();
					if ($_POST['reject'] == 0) {
						return $this->request->redirect("/user/answers/?uid=".$_POST['uid']."&status=1");
					} else {
						return $this->request->redirect("/user/openanswers/");
					}
				}	
	        }
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
						
			$data = DB::query(Database::SELECT, 'SELECT ss_products.*,ss_useratts.shortname FROM ss_products left join ss_useratts on ss_products.user_id = ss_useratts.user_id WHERE category_id in ('.$ustr.') and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') = 0  and (select count(id) from ss_experts where product_id=ss_products.id and choosen=1) = 0  and enabled in (0,1,3,7) order by cts desc')->execute()->as_array();
			//echo 'SELECT * FROM ss_products WHERE category_id in ('.$ustr.') and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') = 0 and enabled in (0,1,3,7) order by cts desc';
			//print_r($data); //echo 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'"';
			foreach ($data as $i=>$d) {
				$data[$i]['cat'] = ORM::factory('categorie')->where('id','=',$d['category_id'])->find();
				$ua = ORM::factory('useratt')->where('user_id','=',$d['user_id'])->find();
				$data[$i]['username'] = $ua->fio;
				$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.user_id,ss_feeds.text,ss_feeds.rating,ss_useratts.shortname FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$d['id']." order by cts asc")->execute()->as_array();	

				foreach ($feeds as $j=>$feed)
				{
					$feeds[$j]['cts'] = $this->dateru($feeds[$j]['cts']);
				}
				
				$cfeeds = ORM::factory('feed')->where('product_id','=',$d['id'])->where('enabled','=',0)->find_all();
				$data[$i]['cfeeds'] = $cfeeds->count();
				$data[$i]['company'] = trim($data[$i]['shortname'],PHP_EOL);
				//$data[$i]['company'] = $data[$i]['shortname'];
				$data[$i]['feeds'] = $feeds;
				$feed = ORM::factory('feed')->where('product_id','=',$d['id'])->order_by('cts','DESC')->find();				
				//$data[$i]['lastfeed'] = $this->dateru($feed->cts);
				$data[$i]['ets'] = $this->dateru($data[$i]['ets']);
				$data[$i]['enabled1'] = $this->lotstates[$d['enabled']];
				if (intval($data[$i]['cts'])>0) {
					//echo  $data[$i]['cts']."<br/>";
					$data[$i]['cts'] = $this->dateru($data[$i]['cts']);					
				}
				if (isset($_GET['na']) && count($feeds)>0)
				{
					unset($data[$i]);
				}								
			}			
						
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			$content->user = $this->auth->instance()->get_user()->id;
			$content->data = $data;
			$content->errors = $errors;
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/");
			
		}
	}	
	

    public function action_answers()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$errors = array();
			$data = array();
			
			$content = View::factory('user/answers');				
			
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
					$prod->user_id = $this->auth->instance()->get_user()->id;					
					$prod->save();
					
					$fname = $this->uploadFile($_FILES['filename'],'img/feeds',$prod);
					$prod->file = $fname;
					$prod->save();
					$mail_url = 'smsg/lot/'.$_GET['uid']."/1/";
					$mail = Request::factory($mail_url)->execute();

					return $this->request->redirect("/user/answers/?uid=".$_POST['uid']."&status=1");
				}	
	        }
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE category_id in ('.$ustr.') and expert_id = '.$this->auth->instance()->get_user()->id.' and enabled in (0,1,3,7) order by cts desc')->execute()->as_array();
			$data = DB::query(Database::SELECT, 'SELECT ss_products.*,ss_useratts.shortname FROM ss_products left join ss_useratts on ss_products.user_id = ss_useratts.user_id WHERE category_id in ('.$ustr.') and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') > 0 and enabled in (0,1,3,6,5,7) order by cts desc')->execute()->as_array();
			
			//print_r($data); //echo 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'"';
			foreach ($data as $i=>$d) {
				$control = array(4,5,6);
				$data[$i]['disabled'] = 0;				
				if (in_array($data[$i]['stock_type'],$control)) {
					$exp = ORM::factory('expert')->where('choosen','=',1)->where('product_id','=',$d['id'])->find();
					if ($exp->expert_id != $this->auth->instance()->get_user()->id) {
						$data[$i]['disabled'] = 1;
					}	
				
				}
				$data[$i]['cat'] = ORM::factory('categorie')->where('id','=',$d['category_id'])->find();
				$ua = ORM::factory('useratt')->where('user_id','=',$d['user_id'])->find();
				$ch = ORM::factory('expert')->where('expert_id','=',$this->auth->instance()->get_user()->id)->where('product_id','=',$d['id'])->find();
				$data[$i]['username'] = $ua->fio;
				$data[$i]['ch'] = $ch->choosen;
				$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.file,ss_feeds.user_id,ss_feeds.text,ss_feeds.rating,ss_useratts.shortname FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$d['id']." and (ss_feeds.user_id in (".$this->auth->instance()->get_user()->id.",".$d['user_id'].") and ss_feeds.preuser_id in (".$this->auth->instance()->get_user()->id.",0)) order by cts asc")->execute()->as_array();	

				
				
				foreach ($feeds as $j=>$feed)
				{
					$feeds[$j]['cts'] = $this->dateru($feeds[$j]['cts']);
				}
				
				$cfeeds = ORM::factory('feed')->where('product_id','=',$d['id'])->where('enabled','=',0)->find_all();
				$data[$i]['cfeeds'] = $cfeeds->count();
				$data[$i]['feeds'] = $feeds;
				$data[$i]['company'] = str_replace(PHP_EOL,'',$data[$i]['shortname']);
				$feed = ORM::factory('feed')->where('product_id','=',$d['id'])->order_by('cts','DESC')->find();				
				$data[$i]['lastfeed'] = $this->dateru($feed->cts);
				$data[$i]['enabled1'] = $this->lotstates[$d['enabled']];
				if (intval($data[$i]['cts'])>0) {
					//echo  $data[$i]['cts']."<br/>";
					$data[$i]['cts'] = $this->dateru($data[$i]['cts']);					
				}
				if (isset($_GET['na']) && count($feeds)>0)
				{
					unset($data[$i]);
				}								
			}			
						
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			$content->user = $this->auth->instance()->get_user()->id;
			$content->data = $data;
			$content->errors = $errors;
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/");
			
		}
	}		

	
	public function action_addfiles()
    {
    
		if($this->auth->instance()->logged_in())
	    {
				foreach ($_FILES['file']['name'] as $i=>$file) {					
					if (file_exists($_FILES['file']['tmp_name'][$i]))
					{					
						$img = ORM::factory('file');
						$img->product_id = $_POST['prod'];
						$img->owner_id = $_POST['expert'];
						$img->file = $_FILES['file']['name'][$i];
						$img->description = $_POST['fdsc'][$i];
						$img->user_id = $this->auth->instance()->get_user()->id;					
						$img->save();
						mb_ereg("\.([^\.]*)$",$file,$t);
						$ext = strtolower($t[1]);
						copy($_FILES['file']['tmp_name'][$i],$_SERVER['DOCUMENT_ROOT'].'/img/files/'.$img->id.'.'.$ext);	
						$img->name = $img->id.'.'.$ext;
						$img->save();
					}
				}
			$_SESSION['success'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->request->redirect("/");
			
		}
	}	
	
	
    public function action_addimgs()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			foreach ($_FILES['file']['name'] as $i=>$file) {
				//print_r($file); echo $i; exit;
				if (file_exists($_FILES['file']['tmp_name'][$i]))
				{					
					$img = ORM::factory('img');
					$img->product_id = $_POST['prod'];
					$img->description = $_FILES['file']['name'][$i];
					$img->save();
					mb_ereg("\.([^\.]*)$",$file,$t);
					$ext = strtolower($t[1]);
					copy($_FILES['file']['tmp_name'][$i],$_SERVER['DOCUMENT_ROOT'].'/img/photos/'.$img->id.'.'.$ext);	

					$img->name = $img->id.'.'.$ext;
					$img->save();
				}
			}
			$_SESSION['success'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->request->redirect("/");
			
		}
	}		
	
	
	
    public function action_cabinet()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$errors = array();
			$data = array();
    	    if ($_POST)
	        {
			//print_r($_POST);
	        // Создаем переменную, отвечающую за связь с моделью данных User
				$model = ORM::factory('user')->where('id','=',$this->auth->instance()->get_user()->id)->find();
				//echo $model->id; exit;
				$mail = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email="'.$_POST['email'].'" AND id<>"'.$this->auth->instance()->get_user()->id.'";')->execute()->as_array();
				$login = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE email<>"'.$_POST['email'].'" AND username="'.$_POST['username'].'";')->execute()->as_array();
						
				//$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				//$validation->rule('fio', 'not_empty');
				//$validation->rule('shortname', 'not_empty');
				//$validation->rule('fullname', 'not_empty');
				//$validation->rule('region', 'not_empty');
				//$validation->rule('city', 'not_empty');
				//$validation->rule('street', 'not_empty');
				//$validation->rule('house', 'not_empty');
				//$validation->rule('web', 'not_empty');
				///$validation->rule('dolz', 'not_empty');
				//$validation->rule('phone', 'not_empty');
				//$validation->rule('phone1', 'not_empty');				

				//$validation->rule('email', 'email');

				/*$validation->labels(array(
						'fio' => 'ФИО',
						'shortname' => 'Краткое имя',
						'fullname' => 'Полное имя',
						'street' => 'Улица',
						'region' => 'Регион',
						'city' => 'Город',
						'house' => 'Дом',
						'phone1' => 'Телефон компании',
						'web' => 'Web-сайт',
						'dolz' => 'Должность',
						'email' => 'E-mail',
						'phone' => 'Телефон'

				));*/


				
				//$validation->check();
				//$errors = $validation->errors('validation');
				if (count($mail)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким e-mail уже существует';
				}


				if (count($login)>0)
				{
					$errors['invalid_login'] = 'Пользователь с таким логином уже существует';
				}

//print_r($_POST); exit;
				
				if( count($errors)>0)
				{
					
				} 
				else {	
					//print_r($_POST);exit;
		//if (strlen($_POST[''])==0) {}
	        // Вносим в эту переменную значения, переданные из POST
				$model->values(array(
					'username' => $_POST['username'],
					'email' => $_POST['email'],
					'role' => $_POST['expert']
					));

				try
				{
					// Пытаемся сохранить пользователя (то есть, добавить в базу)
					$model->save();
					// Назначаем ему роли
					//print_r($_POST);exit;
					$atts = ORM::factory('useratt')->where('user_id','=',$model->id)->find();
					$complete = 0;
					if ($atts->complete == 1 || strlen($_POST['complete']) > 0)
					{
						$complete = 1;
					}
					//echo $complete;exit;
					$lands = array();
					//print_r($_POST['country']);
					foreach ($_POST['country'] as $i=>$v) {
						if ($v > 0) {
							$lands[] = $v;
						}
					}
					//print_r($_POST['lang']);
					foreach ($_POST['lang'] as $i=>$v) {
						if ($v != '') {
							$lang .= $v.";";
						}
					}
					//echo $lang;exit;
					
					
					$landstr = implode(';',$lands);
					$landstr .= ";";
//					echo $landstr; exit;
					$atts->values(array(
					'fio'=>$_POST['fio'],
					'fio_dg'=>$_POST['fio_dg'],
					'dolz_dg'=>$_POST['dolz_dg'],
					'birthday'=>$_POST['birthday'],
					'lands'=>$landstr,
					'company'=>htmlspecialchars($_POST['company']),
					'region'=>str_replace("\r","",$_POST['region']),
					'city'=>str_replace("\r","",$_POST['city']),
					'fullname'=>htmlspecialchars($_POST['fullname']),
					'shortname'=>htmlspecialchars($_POST['shortname']),
					'dolz'=>htmlspecialchars($_POST['dolz']),
					'street'=>str_replace("\r","",$_POST['street']),
					'house'=>str_replace("\r","",$_POST['house']),
					'zip'=>str_replace("\r","",$_POST['zip']),
					'export'=>str_replace("\r","",$_POST['export']),
					'web'=>str_replace("\r","",$_POST['web']),
					'inn'=>$_POST['inn'],
					'kpp'=>$_POST['kpp'],
					'ogrn'=>$_POST['ogrn'],
					'bank'=>$_POST['bank'],
					'rsch'=>$_POST['rsch'],
					'ksch'=>$_POST['ksch'],
					'bik'=>$_POST['bik'],
					'pa'=>$_POST['pa'],
					'fa'=>$_POST['fa'],
					'lastname'=>$_POST['lastname'],
					'surname'=>$_POST['surname'],
					'allfio'=>$_POST['fio'].' '.$_POST['lastname'].' '.$_POST['surname'],
					'phone'=>$_POST['phone'],
					'landcode'=>$_POST['landcode'],
					'citycode'=>$_POST['citycode'],
					'mphone'=>$_POST['mphone'],
					'mlandcode'=>$_POST['mlandcode'],
					'mcitycode'=>$_POST['mcitycode'],
					'landcode1'=>$_POST['landcode1'],
					'citycode1'=>$_POST['citycode1'],
					'phone1'=>$_POST['phone1'],
					'nd'=>$_POST['nd'],
					'experience'=>$_POST['experience'],
					'opisanie'=>$_POST['opisanie'],
					'opisanie2'=>$_POST['opisanie2'],
					'obrazov'=>$_POST['obrazov'],
					'notfound'=>$_POST['notfound'],
					'special'=>$_POST['special'],
					'vk'=>$_POST['vk'],
					'fb'=>$_POST['fb'],
					'tw'=>$_POST['tw'],
					'lang'=>$lang,
					'skype'=>$_POST['skype'],
					'user_id'=>$model->id,
					'complete'=>$complete
					));
										
					$atts->save();
					if (file_exists($_FILES['logo']['tmp_name'])) {
						$l1 = $this->uploadImg($_FILES['logo'],'img/logos',$atts);
						$atts->logo = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['photo']['tmp_name'])) {
						$l1 = $this->uploadImg($_FILES['photo'],'img/uimgs',$atts);
						$atts->photo = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['resume']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['resume'],'img/resume',$atts);
						$atts->resume = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['reg']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['reg'],'img/reg',$atts);
						$atts->reg = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['ust']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['ust'],'img/ust',$atts);
						$atts->ust = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['svid']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['svid'],'img/svid',$atts);
						$atts->svid = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['spr']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['spr'],'img/spr',$atts);
						$atts->spr = $l1;
						$atts->save();
					}					
					if (file_exists($_FILES['resh']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['resh'],'img/resh',$atts);
						$atts->resh = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['egr']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['egr'],'img/egr',$atts);
						$atts->egr = $l1;
						$atts->save();
					}
					if (file_exists($_FILES['dov']['tmp_name'])) {
						$l1 = $this->uploadFile($_FILES['dov'],'img/dov',$atts);
						$atts->dov = $l1;
						$atts->save();
					}
					
					//echo $_POST['c1'];
					//print_r($_POST['c']);exit;
					
					
					mysql_query('delete from ss_u2cs where user_id='.$model->id);
					if ($_POST['expert'] != 3 && $_POST['expert'] != 6) {

						$u2c = ORM::factory('u2c');
						$c1 = ORM::factory('categorie')->where('id','=',$_POST['c1'])->find();
						$u2c->spec = $c1->cat->id;
						$u2c->user_id = $model->id;
						$u2c->category_id = $_POST['c1'];
						$u2c->save();

						foreach ($_POST['c'] as $i=>$v) {
							if ($v > 0) {							
								$u2c = ORM::factory('u2c');
								$c1 = ORM::factory('categorie')->where('id','=',$i)->find();
								$u2c->spec = $c1->cat->id;
								$u2c->user_id = $model->id;
								$u2c->category_id = $i;
								$u2c->save();
							}
						}					
					} else {
						foreach ($_POST['v'] as $i=>$v) {
							if ($v > 0) {							
								$u2c = ORM::factory('u2v');
								$u2c->user_id = $model->id;
								$u2c->ved_id = $v;
								$u2c->save();
							}
						}											
					}	
					
					//if ($this->auth->instance()->login($_POST['username'], $_POST['password'])) {
					// И отправляем его на страницу пользователя
						$_SESSION['success0'] = 1;
						
						$this->request->redirect('user/cabinet/');
					//}
				}
				catch (ORM_Validation_Exception $e)
				{
					// Это если возникли какие-то ошибки1
					echo $e;
				}
				}
				//$data = $_POST;
	        } else{
			}
			
			$content = View::factory('user/cabinet');

		
						
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
			$veds = ORM::factory('ved')->where('ved_id','=',0)->find_all();
			$u2vs = ORM::factory('u2v')->where('user_id','=',$this->auth->instance()->get_user()->id)->find_all();
			if (isset($_SESSION['success0'])) {
				$content->success0 = $_SESSION['success0'];
				unset($_SESSION['success0']);
			}
			$content->cats = $cats;
			$content->veds = $veds;
			$content->u2vs = $u2vs;
			$content->data = $usrdata;
			$content->errors = $errors;
			$content->role = $this->auth->instance()->get_user()->role;
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/");
			
		}
	
			

    
	}	
	
    public function action_orders()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/orders');
			
			$data = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();

			$gds = explode("-",$data[0]['goods']);
			$goods = ORM::factory('product')->where('id','in',$gds)->find_all();
			$ords = explode("-",$data[0]['orders']);
			$orders = ORM::factory('order')->where('id','in',$ords)->order_by('id','DESC')->find_all();
			$odata = array();
			foreach ($orders as $j=>$order) {
				$conts = ORM::factory('container')->where('order_id','=',$order->id)->find_all();
				//$cont = 
				foreach ($conts as $i=>$bsk)
				{
					$prods[$j][$i]['id'] = $bsk->id;
					//$bs_array = explode('-',$bsk['id']);
					//print_r($bs_array);
					$pname = ORM::factory('product')->where('id','=',$bsk->code)->find();
					$mat = ORM::factory('shop')->where('id','=',$bsk->mat)->find();
					$prods[$j][$i]['article'] = $pname->article;
					$prods[$j][$i]['name'] = $pname->name;
					$prods[$j][$i]['chpu'] = $pname->parent_chpu."/".$pname->alias;
					$prods[$j][$i]['picture'] = $pname->picture;
					$prods[$j][$i]['material'] = $mat->name;
					$prods[$j][$i]['id'] = $bsk->id;
					$prods[$j][$i]['price'] = $bsk->price;
					$prods[$j][$i]['n'] = $bsk->q;
				}			
			}

			$content->orders = $orders;
			$content->prods = $prods;
			
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/");
			
		}
	}	
	
	public function action_looklot()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$status = $_GET['status']; 
			$content = View::factory('user/looklot');
			if ($_POST)
	        {			
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				$validation->rule('ticket', 'not_empty');
				
				$validation->check();
				$content->errors = $validation->errors('validation');
				
				if(!$validation->check())
				{
					$content->data = $_POST;
				} 
				else {
					$prod = ORM::factory('feed');
					$prod->text = $_POST['ticket'];	
					$prod->cts = time();
					$prod->product_id = $_GET['uid'];					
					$prod->user_id = $this->auth->instance()->get_user()->id;					
					$prod->save();
					
					$mail_url = 'smsg/lot/'.$_GET['uid']."/1/";
					$mail = Request::factory($mail_url)->execute();

					return $this->request->redirect("/user/looklot/?uid=".$_GET['uid']."&status=1");
				}
				
			}

			$good = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE id='.$_GET['uid'])->execute()->as_array();	
			$cat = ORM::factory('categorie')->where('id','=',$good[0]['category_id'])->find();
			$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.id,ss_feeds.cts,ss_feeds.text,ss_feeds.rating,ss_useratts.fio FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$_GET['uid'])->execute()->as_array();	
			$good = $good[0];

			$lmenu = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();
			$content->useratt = $user_att[0];
			$content->state = array(0=>'на модерации',1=>'открыта',2=>'закрыта'); 
			$content->menu = $this->make_menu2($lmenu);

			$this->template->title .= ' Просмотр заявки '.$good['name'];
			
			$content->cat = $cat->name;
			$content->prod = $good;
			$content->feeds = $feeds;
			$cats = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();
			
			$content->menu = $this->make_menu($cats);
			$content->info = $this->gen_info;$this->template->content = $content;			
			$this->setmain();
			
		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}	
	

    public function action_addlot()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$status = $_GET['status']; 
			$content = View::factory('user/addlot');

			if ($_POST)
	        {			
				$validation = Validation::factory($_POST);
					//$validation->bind(':cr', $_SESSION['captcha_response']);
				//$validation->rule('cat', 'not_empty');
				$validation->rule('title', 'not_empty');
				$validation->rule('description', 'not_empty');
				
				$validation->labels(array(
						'title' => 'Тема',
						'description' => 'Описание задачи',

				));
				
				//
				//print_r($_POST['c']);
				$validation->check();
				$errors = $validation->errors('validation');
				
				if (count($_POST['c'][0]) == 0){
					$errors[] = 'Не выбраны специализации и сферы деятельности';
				}
				
				$cs = array();
				foreach ($_POST['c'] as $i=>$v) {
					if ($v > 0) {
						$cs[] = $v;
					}
				}
				//print_r($cs);exit;
				
				$content->errors = $errors;
				
								
				if(count($errors) > 0)
				{
					$content->data = $_POST;
				} 
				else {
					$cat = ORM::factory('categorie')->where('id','=',$cs[0])->find();
					$prod = ORM::factory('product');
					$prod->category_id = $cs[0];	
					$prod->title = $_POST['title'];	
					$prod->parent_chpu = $cat->parent_chpu.'/'.$cat->alias;
					//$alias = strtolower($this->translit($cat->name.'_'.time()));
					//$prod->alias = $alias;	
					//$prod->description = $_POST['description'];	
					$prod->name = $_POST['description'];	
					$prod->region = $_POST['region'];	
					$prod->cts = time();
					$prod->stock_type = 2;
					$prod->sale_type = $_POST['sale_type'];
					$tm = time();
					$em = $tm + 30*24*60*60;
					$prod->ets = $em;
					$prod->pub = $_POST['pub'];
					$prod->user_id = $this->auth->instance()->get_user()->id;					
					$prod->save();
					$prod->alias = $prod->id.'_'.time();
					
					$prod->save();
					//print_r($_FILES);
					foreach ($_FILES['file']['name'] as $i=>$file) {
						//print_r($file); echo $i; exit;
						if (file_exists($_FILES['file']['tmp_name'][$i]))
						{					
							$img = ORM::factory('img');
							$img->product_id = $prod->id;
							$img->description = $_FILES['file']['name'][$i];
							$img->save();
							mb_ereg("\.([^\.]*)$",$file,$t);
							$ext = strtolower($t[1]);
							copy($_FILES['file']['tmp_name'][$i],$_SERVER['DOCUMENT_ROOT'].'/img/photos/'.$img->id.'.'.$ext);	

							$img->name = $img->id.'.'.$ext;
							$img->save();
						}
					}

					foreach ($_POST['o'] as $i=>$v) {
						if (strlen(trim($v)) == 0 || intval(trim($v)) == 0 ) {
						} else {
							$u2c = ORM::factory('value');
							$u2c->option_id = $i;
							$u2c->product_id = $prod->id;
							$u2c->value = $v;
							$u2c->save();
						}
					}


					
					foreach ($cs as $i=>$v) {
						if ($v > 0) {							
							$u2c = ORM::factory('cat2prod');
							$u2c->product_id = $prod->id;
							$u2c->cat_id = $v;
							$u2c->save();
						}
					}
					
					
					$mail_url = 'smsg/lot/'.$prod->id."/0/";
					$mail = Request::factory($mail_url)->execute();

					
					
					
					return $this->request->redirect("/user/addlot/?status=1&sale_type=".$_POST['sale_type']);
				}
				
			}
			//$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
			$cats = ORM::factory('categorie')->where('category_id','=',355)->where('type','=','catalog')->find_all();
			$steps = ORM::factory('step')->find_all();
			$content->cats = $cats;
			$content->steps = $steps;
			$content->status = $status;
			//print_r($cats);
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->setmain();

		} else {
			$this->request->redirect("/user/register");
			
		}
	}	
	
	private function make_menu2($src,$type='admin/categories') {
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
                $menu_arr[$elem->id]['children'] = array();                
                $children = ORM::factory('categorie')->where('category_id','=',$elem->id)->find_all();
				//echo $menu_arr[$elem->id]['name']."!!!".count($children)."!!!<br/>";
                if (count($children)>0)
                {
                    $menu_arr[$elem->id]['children'] = $this->make_menu2($children);
                }
            }
            
        }    
        return $menu_arr;
    }  
	
	
	
	
	public function action_history()
    {
	}	

	public function action_forgot()
    {
		if($this->auth->instance()->logged_in())
		{		
			return $this->request->redirect('user/cabinet');
		} 

		
		$complete = 0;
		if ($_POST) {
			$validation = Validation::factory($_POST);
						//$validation->bind(':cr', $_SESSION['captcha_response']);
			$validation->rule('email', 'not_empty');
			$validation->rule('email', 'email');

			$model = ORM::factory('user')->where('email','=',$_POST['email'])->find();
			$uat = ORM::factory('useratt')->where('user_id','=',$model->id)->find();
			$errors = array();
			$validation->check();
			$errors = $validation->errors('validation');
			if ($model->id==0)
			{
				$errors['invalid_login'] = 'Пользователя с таким e-mail не существует';
			}
			
			
			if (count($errors)==0) {
				$pass = $this->generate_password(5, 8);
				
				$mail_url = 'smsg/user/'.$uat->user_id."/4/".$pass;
				$mail = Request::factory($mail_url)->execute();

				
				$model->values(array(
								'email' => $_POST['email'],
								'password' => $pass,
								'password_confirm' => $pass,
				));
				$model->save();
				$complete = 1;
			}
		}
		$content = View::factory('user/forget');
		$content->errors = $errors;
		$content->complete = $complete;
		$content->info = $this->gen_info;$this->template->content = $content;
		$this->setmain();
	}


    public function action_login()
    {
		if($this->auth->instance()->logged_in())
	    {
			return $this->request->redirect('/user/cabinet');
		}
	
			if ($_POST && strlen($_POST['username'])>0 && strlen($_POST['password'])>0)
	        {
			
	            // Создаем переменную, отвечающую за связь с моделью данных User
	            $user = ORM::factory('user');
	            // в $status помещаем результат функции login
	            $status = $this->auth->instance()->login($_POST['username'], $_POST['password']);
	            // Если логин успешен, то				
	            if ($status)
	            {
			//$this->login['name'] = $this->auth->instance()->get_user()->username;
					$att = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
	                // Отправляем пользователя на его страницу
					if ($this->auth->instance()->get_user()->role != 4 && $this->auth->instance()->get_user()->role != 5) {
						if ($att->complete==1) {
							$this->request->redirect($_SERVER['HTTP_REFERER']);
							//$this->request->redirect('/user/openlots');
						} else {
							$this->request->redirect('/user/cabinet');
						}
					} else {
						if ($att->complete==1) {
							$this->request->redirect($_SERVER['HTTP_REFERER']);
							/*if ($this->auth->instance()->get_user()->role == 4) {
								$this->request->redirect('/user/providerlots');
							} else {
								$this->request->redirect('/user/providerq');
							}*/
						} else {
							$this->request->redirect('/user/cabinet');
						}
					}
	            }
	            else
	            {
                // Иначе ничего не получилось, пишем failed
					$_SESSION['loginfail'] = 1;
	                $this->request->redirect('/user/login');
				}
            } else {
				$content = View::factory('user/login');
				$content->info = $this->gen_info;$this->template->content = $content;
				$content->fail = $_SESSION['loginfail'];
				$_SESSION['loginfail'] = 0;
				$this->setmain();
			}
    
	//$this->request->redirect($_SERVER['HTTP_REFERER']);
    }




    public function action_logout()
    {
        if ($this->auth->instance()->logout(FALSE, FALSE))
        {
		
			$this->login['name']=-1;		
            // Если получается, то предлагаем снова залогиниться
            return $this->request->redirect($_SERVER['HTTP_REFERER']);
        }
    }	

	public function setmain() {
		$this->template->login = $this->login;
		$this->template->root = $this->root;
		$this->template->main = $this->main;
		$this->template->tops = $this->tops;
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
	
	}

	public function generate_password($min, $max) {
		mt_srand((double)microtime()*1000000);
		// Длина пароля от 8 до 12 символов
		$randval = mt_rand($min, $max);
		$passwd = "";
		//http://www.asciitable.com/  (48-57): 0-9, (65-90): A-Z, (97-122): a-z
		//							  48: 0, 49: 1, 73: I, 79: O, 103: g, 108: l, 113: q
		for ($i = 1; $i <= $randval; $i++) {
			$val = mt_rand(50, 122);
			if (($val > 57) && ($val < 65) ||
				($val == 73) ||
				($val == 79) ||
				($val > 90) && ($val < 97) ||
				($val == 103) ||
				($val == 108) ||
				($val == 113)) {
				$i--;
				continue;
			} else
				$passwd .= chr($val);
		};
		return stripslashes($passwd);
	}

	public function action_activity()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/activity');
	

			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			$stocktype = array('1' => 'Последние сообщения');
			
			foreach ($stocktype as $i=>$type) {			
				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5) order by cts desc')->execute()->as_array();

				foreach ($prods as $j=>$prod) {
					//where('user_id','<>',$this->auth->instance()->get_user()->id)->
					$prods[$j]['feed'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->where('user_id','<>',$this->auth->instance()->get_user()->id)->order_by('cts','desc')->find();
					if ($prods[$j]['feed']->id == 0) {
						unset($prods[$j]);
					}
				}				
				
				foreach ($prods as $j=>$prod) {
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					
					if (strlen($prod['title']) > 120) {
						$prods[$j]['title1'] = substr($prod['title'],0,120);
						$ta = explode(' ',$prods[$j]['title1']);
						//print_r($ta);
						if(count($ta) > 1) {
							unset($ta[count($ta)-1]);
						}
						$prods[$j]['title1'] = implode(' ',$ta);
					} else {
						$prods[$j]['title1'] = $prods[$j]['title'];
					}
					
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					//$prods[$j]['feed'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->where('user_id','<>',$this->auth->instance()->get_user()->id)->order_by('cts','desc')->find();
					$prods[$j]['userdata'] = ORM::factory('useratt')->where('user_id','=',$prods[$j]['feed']->user_id)->find();
				}
				
				$data1[$i]['prods'] = $prods;
			}

			
			$content->data = $data1;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Ответы";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}
	
	
	public function action_provideractivity()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/activity');
	

			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			$stocktype = array('1' => 'Последние сообщения');
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
			foreach ($stocktype as $i=>$type) {			
//				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();
				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE category_id in ('.$ustr.') and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') > 0 and stock_type in (2,5) order by cts desc')->execute()->as_array();


				foreach ($prods as $j=>$prod) {					
					$prods[$j]['feed'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->where('user_id','<>',$this->auth->instance()->get_user()->id)->order_by('cts','desc')->find();
					if ($prods[$j]['feed']->id == 0) {
						unset($prods[$j]);
					}
				}				
				//->where('user_id','<>',$this->auth->instance()->get_user()->id)
				
				foreach ($prods as $j=>$prod) {
					if (strlen($prod['title']) > 120) {
						$prods[$j]['title1'] = substr($prod['title'],0,120);
						$ta = explode(' ',$prods[$j]['title1']);
						//print_r($ta);
						if(count($ta) > 1) {
							unset($ta[count($ta)-1]);
						}
						$prods[$j]['title1'] = implode(' ',$ta);
					} else {
						$prods[$j]['title1'] = $prods[$j]['title'];
					}
				
				
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					//$prods[$j]['feed'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->where('user_id','<>',$this->auth->instance()->get_user()->id)->order_by('cts','desc')->find();
					$prods[$j]['userdata'] = ORM::factory('useratt')->where('user_id','=',$prods[$j]['feed']->user_id)->find();
				}
				
				$data1[$i]['prods'] = $prods;
			}

			
			$content->data = $data1;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Ответы";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}

	public function action_providerq()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/curq');
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
			if ($this->auth->instance()->get_user()->role == 4) {
				$saletype = 0;
			} else {
				$saletype = 1;
			}
			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();and enabled in (0,1,3,6,5,7)
			$stocktype = array('-1' => 'Все заявки');
			$rounds = array('-1' => '<i class="fa fa-fw m-r-5 fa-circle text-default"></i>','2' => '<i class="fa fa-fw m-r-5 fa-circle text-danger"></i>','5' => '<i class="fa fa-fw m-r-5 fa-circle text-primary"></i>','6' => '<i class="fa fa-fw m-r-5 fa-circle text-success"></i>','4' => '<i class="fa fa-fw m-r-5 fa-circle text-warning"></i>');
			$groups = array();
			foreach ($stocktype as $i=>$type) {
				$i1 = '2,5,6';
				//and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' and reject=0) > 0
				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE  (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' and reject=1) = 0 and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=1 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					if (!array_key_exists($prods[$j]['cat']->id,$groups)) {
						$groups[$prods[$j]['cat']->id] = $prods[$j]['cat']->name;
					}					
					$f = array();
					$f[] = $prod['user_id'];
					$f[] = $this->auth->instance()->get_user()->id;
					
					$prods[$j]['feeds'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->where('user_id','in',$f)->order_by('cts','desc')->find_all();
				}
				$data1[$i]['prods'] = $prods;
			}
			
							
			$data1[1]['prods'] = $prods;

			ksort($stocktype);
			
			//print_r($data1);		
			$content->data = $data1;
			$content->groups = $groups;
			$content->nochat = 0;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Вопросы";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}	
	
	
	public function action_openq()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/curq');
		
			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();
			$stocktype = array('2' => 'Ожидает ответа', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Завершенные');
			$rounds = array('-1' => '<i class="fa fa-fw m-r-5 fa-circle text-default"></i>','2' => '<i class="fa fa-fw m-r-5 fa-circle text-danger"></i>','5' => '<i class="fa fa-fw m-r-5 fa-circle text-primary"></i>','6' => '<i class="fa fa-fw m-r-5 fa-circle text-success"></i>','4' => '<i class="fa fa-fw m-r-5 fa-circle text-warning"></i>');

			$groups = array();
			
			foreach ($stocktype as $i=>$type) {
				//if ($i == -1) {
					$i1 = '2,5,6,4';
				/*} else {
					$i1 = $i;
				}*/
				if (strlen($_GET['search'])>0) {
					//echo 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and stock_type in ('.$i.') order by cts desc';
					$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=1 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				} else {
					$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and sale_type=1 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				}
				
				foreach ($prods as $j=>$prod) {

					if ($i == -1) {
						$prods[$j]['status'] = $rounds[$prods[$j]['stock_type']];
					} else {
						$prods[$j]['status'] = $rounds[$i];
					}
					$prods[$j]['feeds'] = ORM::factory('feed')->where('product_id','=',$prod['id'])->order_by('cts','desc')->find_all();
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					if (!array_key_exists($prods[$j]['cat']->id,$groups)) {
						$groups[$prods[$j]['cat']->id] = $prods[$j]['cat']->name;
					}				
					
				}
				
				if (intval($_GET['gr']) > 0) {
					foreach ($prods as $j=>$prod) {
						if ($prod['category_id'] != $_GET['gr']) {
							unset($prods[$j]);
						}
					}
				}	
				
				
				$data1[$i]['prods'] = $prods;
			}
			

			
			
			$content->groups = $groups;		
			$content->data = $data1;
			$content->rounds = $rounds;
			$content->stocktype = $stocktype;
			$content->nochat = 1;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Вопросы";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}


	
	
	
	public function action_providerlots()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			//print_r($_GET);exit;
			$content = View::factory('user/currentlots');
			$usrdata = ORM::factory('useratt')->where('user_id','=',$this->auth->instance()->get_user()->id)->find();
			
			$u2c = $usrdata->u2cs->find_all();
			$uar = array();
			$uar[] = 0;
			foreach ($u2c as $i=>$v) {
				$uar[] = $v->category_id;
			}
			$ustr = implode(',',$uar);
			if ($this->auth->instance()->get_user()->role == 4) {
				$saletype = 0;
			} else {
				$saletype = 1;
			}
			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();and enabled in (0,1,3,6,5,7)
			$stocktype = array('2' => 'Черновик','5' => 'Ведутся переговоры', '6' => 'В работе');
			$rounds = array('1' => '<i class="fa fa-fw m-r-5 fa-circle text-default"></i>','7' => '<i class="fa fa-fw m-r-5 fa-circle text-danger"></i>','5' => '<i class="fa fa-fw m-r-5 fa-circle text-primary"></i>','6' => '<i class="fa fa-fw m-r-5 fa-circle text-success"></i>','8' => '<i class="fa fa-fw m-r-5 fa-circle text-warning"></i>','2' => '<i class="fa fa-fw m-r-5 fa-circle text-inverse"></i>');

			//$rounds = array('-1' => '<i class="fa fa-fw m-r-5 fa-circle text-default"></i>','2' => '<i class="fa fa-fw m-r-5 fa-circle text-danger"></i>','5' => '<i class="fa fa-fw m-r-5 fa-circle text-primary"></i>','6' => '<i class="fa fa-fw m-r-5 fa-circle text-success"></i>','8' => '<i class="fa fa-fw m-r-5 fa-circle text-warning"></i>');
			/*SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in (0,375,374,373,372,356)) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id=166 and reject=0) > 0  and (title like "%%" or name like "%%") and sale_type=0 and stock_type in (2) order by cts desc*/
			foreach ($stocktype as $i=>$type) {
				if ($i == -1) {
					$i1 = '2,5,6,4';
					$add ='';
				} else {
					$i1 = $i;
					$add = '';
				}
				//echo 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' and reject=0) > 0  and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type in ('.$i1.') order by cts desc<br/><br/>';
				$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' and reject=0) > 0  and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					
					if (strlen($prod['title']) > 80) {
						$prods[$j]['title'] = substr($prod['title'],0,80);
						$ta = explode(' ',$prods[$j]['title']);
						//print_r($ta);
						if(count($ta) > 1) {
							unset($ta[count($ta)-1]);
						}
						$prods[$j]['title'] = implode(' ',$ta);
					}
					if ($i == -1) {
						$prods[$j]['status'] = $rounds[$prods[$j]['stock_type']];
					} else {
						$prods[$j]['status'] = $rounds[$i];
					}								
					
					
				}
				
				$data1[$i]['prods'] = $prods;
				if (!array_key_exists($prods[$j]['cat']->id,$groups)) {
					$groups[$prods[$j]['cat']->id] = $prods[$j]['cat']->name;
				}
			}
			
			
			$stocktype[7] = 'Отказанные';
			$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' and reject > 0) > 0  and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type <> 4 order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['stock_type'] = 7;
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
				}
			$data1[7]['prods'] = $prods;

			$stocktype[8] = 'Выполненные';
			$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.' ) > 0  and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type = 4 order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['stock_type'] = 4;
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
				}
			$data1[8]['prods'] = $prods;
			
			
			
			$stocktype[1] = 'Ожидают ответа';
			$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE (select count(id) from ss_cat2prods where product_id=ss_products.id and cat_id in ('.$ustr.')) > 0 and (select count(id) from ss_experts where product_id=ss_products.id and expert_id='.$this->auth->instance()->get_user()->id.') = 0  and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type in (2,5) order by cts desc')->execute()->as_array();
				foreach ($prods as $j=>$prod) {
					$prods[$j]['stock_type'] = 1;
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
				}
							
			$data1[1]['prods'] = $prods;

			ksort($stocktype);
			
			//print_r($data1);exit;
			$content->groups = $groups;	
			$content->data = $data1;
			$content->rounds = $rounds;
			$content->noall = 0;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Открытые заявки";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
		}    
	}	
	
	
	public function action_openlots()
    {
    
		if($this->auth->instance()->logged_in())
	    {
			$coeff = 1;
			$content = View::factory('user/openlots');
		
			$user = DB::query(Database::SELECT, 'SELECT * FROM ss_users WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();						
			//$data = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and stock_type in (2,5,6) order by cts desc')->execute()->as_array();'2' => 'Ожидает ответа',
			$stocktype = array('-1' => 'Все заявки', '2' => 'Ожидают ответа','5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Завершенные');
			$rounds = array('-1' => '<i class="fa fa-fw m-r-5 fa-circle text-default"></i>','2' => '<i class="fa fa-fw m-r-5 fa-circle text-danger"></i>','5' => '<i class="fa fa-fw m-r-5 fa-circle text-primary"></i>','6' => '<i class="fa fa-fw m-r-5 fa-circle text-success"></i>','4' => '<i class="fa fa-fw m-r-5 fa-circle text-warning"></i>');

			$groups = array();
			
			foreach ($stocktype as $i=>$type) {
				if ($i == -1) {
					$i1 = '2,5,6,4';
				} else {
					$i1 = $i;
				}
				if (strlen($_GET['search'])>0) {
					//echo 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and stock_type in ('.$i.') order by cts desc';
					$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and (title like "%'.$_GET['search'].'%" or name like "%'.$_GET['search'].'%") and sale_type=0 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				} else {
					$prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE user_id="'.$user[0]['id'].'" and sale_type=0 and stock_type in ('.$i1.') order by cts desc')->execute()->as_array();
				}
				
				foreach ($prods as $j=>$prod) {
					if (strlen($prod['title']) > 80) {
						$prods[$j]['title'] = substr($prod['title'],0,80);
						$ta = explode(' ',$prods[$j]['title']);
						//print_r($ta);
						if(count($ta) > 1) {
							unset($ta[count($ta)-1]);
						}
						$prods[$j]['title'] = implode(' ',$ta);
					}
					if ($i == -1) {
						$prods[$j]['status'] = $rounds[$prods[$j]['stock_type']];
					} else {
						$prods[$j]['status'] = $rounds[$i];
					}
					
					$prods[$j]['exp'] = $prods[$j]['cts'] + 31*24*60*60;
					$prods[$j]['cat'] = ORM::factory('categorie')->where('id','=',$prod['category_id'])->find();
					if (!array_key_exists($prods[$j]['cat']->id,$groups)) {
						$groups[$prods[$j]['cat']->id] = $prods[$j]['cat']->name;
					}
				}
				
				if (intval($_GET['gr']) > 0) {
					foreach ($prods as $j=>$prod) {
						if ($prod['category_id'] != $_GET['gr']) {
							unset($prods[$j]);
						}
					}
				}	
				
				
				$data1[$i]['prods'] = $prods;
			}
			

			
			
			$content->groups = $groups;		
			$content->data = $data1;
			$content->rounds = $rounds;
			$content->stocktype = $stocktype;
			$content->user = $this->auth->instance()->get_user()->id;
			$this->template->title .= "| Открытые заявки";
			$content->info = $this->gen_info;$this->template->content = $content;
			$this->root = 1;
			$this->curr = 0;
			$this->setmain();

		} else {
			return $this->request->redirect("/user/register");
			
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


private function uploadFile0($file,$folder,$good){
	//print_r($file);
	if (file_exists($file['tmp_name'][0])) {
		
		
		mb_ereg("\.([^\.]*)$",$file["name"][0],$t);
		$ext = strtolower($t[1]);		
//		if ($image->width>1000 || $image->height>1000) {
//			$image->resize(1000,1000,Image::AUTO);
//		}
		//echo Kohana::debug($this->image);		1
		copy($file['tmp_name'][0],$_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
		
}


private function uploadFile($file,$folder,$good){
	print_r($file);
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





private function uploadImg($file,$folder,$good){
	if (file_exists($file['tmp_name'])) {
		$image = Image::factory($file['tmp_name']);
		
		mb_ereg("\.([^\.]*)$",$file["name"],$t);
		$ext = strtolower($t[1]);
		/*if ($image->width>250 || $image->height>250) {
			$image->resize(250,250,Image::AUTO);
		}*/
		$image->resize(180,180, Image::WIDTH);
		//echo Kohana::debug($this->image);		
		$image->save($_SERVER['DOCUMENT_ROOT']."/".$folder."/".$good->id.".".$ext);
		return $good->id.".".$ext;
	} else {return "";}
}
}

