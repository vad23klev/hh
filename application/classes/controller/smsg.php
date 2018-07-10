<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Smsg extends Controller {
	public $upmenu = array();
	public $title= '';
	public $root = 0;
	
	public $headers;
	public $emails;
	
	public $lot_msgs = array('0'=>array('subject'=>'Создана новая заявка','view'=>'mail/newlot','access'=>2),
	'1'=>array('subject'=>'Добавлен тикет','view'=>'mail/new','access'=>2),
	'2'=>array('subject'=>'Достигнута резервная цена','view'=>'mail/reserved','access'=>0),
	'3'=>array('subject'=>'Торги окончены - резервная цена не достигнута','view'=>'mail/nowinner','access'=>0),
	'4'=>array('subject'=>'Торги успешно окончены','view'=>'mail/win','access'=>0),
	'6'=>array('subject'=>'Лот успешно выставлен на торги','view'=>'mail/lotout','access'=>0),
	'7'=>array('subject'=>'Данные лота успешно изменены','view'=>'mail/lotchanged','access'=>0),
	'8'=>array('subject'=>'Добавлен лот','view'=>'mail/lotadded','access'=>0),
	'9'=>array('subject'=>'Заявка выбрана экспертом','view'=>'mail/choose','access'=>0),
	'5'=>array('subject'=>'Лот выкуплен','view'=>'mail/win','access'=>1));
	
	public $user_msgs = array('1'=>array('subject'=>'Вы зарегистрированы на портале RussiaGoingGlobal ','view'=>'mail/confirm'),'2'=>array('subject'=>'Ваш профиль авторизован ','view'=>'mail/blitz'),'3'=>array('subject'=>'Ваш профиль блокирован ','view'=>'mail/unblitz'),'4'=>array('subject'=>'Восстановление пароля ','view'=>'mail/forgot'));
	public $expert_msgs = array('1'=>array('subject'=>'Ваша компания принята ','view'=>'mail/accept'),'2'=>array('subject'=>'Отказ от Вашего предложения','view'=>'mail/reject'));
	
	public $lotstates = array(0=>'Новая',1=>'Подтверждена',2=>'Отменена'); 
	
    public function before()
    {
        parent::before();
 		$info = ORM::factory('info')->find();
		$this->emails = explode(';',$info->email);
		$this->headers  = "Content-type: text/html; charset=utf-8 \r\n";
		$this->headers .= "From: ".$info->name." <".$emails[0].">\r\n"; 
	}	
	
	public function sending($email,$subject,$message)
	{
	
	
	}
	
    public function action_index()
    {

    }
	
	public function action_admin() {
	
		$user = DB::query(Database::SELECT, 'SELECT ss_useratts.user_id as uid,ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE ss_users.id='.$this->request->param('lot'))->execute()->as_array();		

		if ($user[0]['subscribe']==1 && $this->request->param('event')!=1)
		{
			$info = ORM::factory('info')->find();
			$emails = array();
			$emails = explode(';',$info->email);

			$headers  = "Content-type: text/html; charset=utf-8 \r\n";
			$headers .= "From: ".$info->name." <".$emails[0].">\r\n"; 
						
			$message = ORM::factory('message')->where('id','=',$this->request->param('event'))->find();
			mail($user[0]['email'],'Сообщение от администрации сайта '.$info->name,$message->text,$headers,'-f'.$from_email);
		}
	
	}

	public function action_expert() {
	
		$user = DB::query(Database::SELECT, 'SELECT ss_useratts.user_id as uid,ss_users.email,ss_users.role,ss_users.username,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE ss_users.id='.$this->request->param('lot'))->execute()->as_array();		
		$prod = ORM::factory('product')->where('id','=',$this->request->param('param1'))->find();
		$expert = ORM::factory('expert')->where('product_id','=',$prod->id)->where('expert_id','=',$user->user_id)->find();
		$info = ORM::factory('info')->find();
					
		$mailbody = View::factory($this->expert_msgs[$this->request->param('event')]['view']);
		$mailbody->sitename = $info->name;
		$mailbody->user = $user[0];
		$mailbody->prod = $prod;
		$mailbody->expert = $expert;
		$mailbody->state = 2;
		$roles = array(3=>'импортер / экспортер',4=>'провайдер услуг',5=>'эксперт-консультант');
		$saletype = array(1=>'вопрос',0=>'заявка');
		$mailbody->saletype = $saletype[$prod->sale_type];			
					
		$emails = array();
		$emails = explode(';',$info->email);

		$from_user = $info->name;
		$from_email = 'info@'.$_SERVER['HTTP_HOST'];
		$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

		$headers = "From: $from_user <$from_email>\r\n".
									"MIME-Version: 1.0" . "\r\n" .
									"Content-type: text/html; charset=UTF-8" . "\r\n";
		
		
		//$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		//$headers .= "From: ".$info->name." <".$emails[0].">\r\n"; 			
		//print_r($this->expert_msgs[$this->request->param('event')]);
		$res = mail($user[0]['email'],$this->expert_msgs[$this->request->param('event')]['subject'],$mailbody,$headers,'-f'.$from_email);
		//echo $res."<br/>";
		$mailbody->state = 0;
		foreach ($emails as $email) {
			$res = mail($email,$this->expert_msgs[$this->request->param('event')]['subject'].' '.$prod->id,$mailbody,$headers,'-f'.$from_email,'-f'.$from_email);
			//echo $res."<br/>";
		/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
		}				
	}
	
	
	public function action_user() {
	
		$user = DB::query(Database::SELECT, 'SELECT ss_useratts.user_id as uid,ss_users.email,ss_users.role,ss_users.username,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE ss_users.id='.$this->request->param('lot'))->execute()->as_array();		

		$info = ORM::factory('info')->find();

		$emails = array();
		$emails = explode(';',$info->email);
		$params = $this->request->param();
		//print_r($params);exit;
		
		$mailbody = View::factory($this->user_msgs[$this->request->param('event')]['view']);
		$mailbody->pass = $this->request->param('param1');
		$mailbody->sitename = $info->name;
		$mailbody->user = $user[0];
		$mailbody->mail = $emails[0];
		$roles = array(3=>'импортер / экспортер',4=>'провайдер услуг',5=>'эксперт-консультант');
		$mailbody->role = $roles[$user[0]['role']];		

		$from_user = $info->name;
		$from_email = 'info@'.$_SERVER['HTTP_HOST'];
		$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

		$headers = "From: $from_user <$from_email>\r\n".
									"MIME-Version: 1.0" . "\r\n" .
									"Content-type: text/html; charset=UTF-8" . "\r\n";
		
		
		//$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		//$headers .= "From: ".$info->name." <".$emails[0].">\r\n"; 			
		
		if ($this->request->param('event') == 1) {
			$subject = $this->user_msgs[$this->request->param('event')]['subject'].$roles[$user[0]['role']];
		} else {
			$subject = $this->user_msgs[$this->request->param('event')]['subject'];
		}
		
		$res = mail($user[0]['email'],$subject,$mailbody,$headers,'-f'.$from_email);
		//echo $res."<br/>";
		foreach ($emails as $email) {
			$res = mail($email,$subject,$mailbody,$headers,'-f'.$from_email,'-f'.$from_email);
			//echo $res."<br/>";
		/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
		}				
	}
	
	public function action_lot()
	{
	
		//print_r($this->request->param());
		//exit;
	
		$prod = ORM::factory('product')->where('id','=',$this->request->param('lot'))->find();
		$info = ORM::factory('info')->find();
				
		$emails = array();
		$emails = explode(';',$info->email);				
		
		$from_user = $info->name;
		$from_email = 'info@'.$_SERVER['HTTP_HOST'];
		$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

		$headers = "From: $from_user <$from_email>\r\n".
									"MIME-Version: 1.0" . "\r\n" .
									"Content-type: text/html; charset=UTF-8" . "\r\n";


		$user = DB::query(Database::SELECT, 'SELECT ss_useratts.user_id as uid,ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE ss_users.id='.$prod->user_id)->execute()->as_array();		
		
		//echo $this->lot_msgs[$_GET['event']]['view'];
		$mailbody = View::factory($this->lot_msgs[$this->request->param('event')]['view']);
		$mailbody->prod = $prod;
		$mailbody->user = $user[0];
		if ($prod->sale_type == 1) {
			$subject = 'Создан новый вопрос эксперту';
		} else {
			$subject = 'Создана новая заявка';
		}
		
		//print_r($emails);
		$mailbody->state = 0;
		
		
		foreach ($emails as $email) {
			$res = mail($email,$subject,$mailbody,$headers,'-f'.$from_email);
		/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
		}
//echo $res;exit;
		$mailbody->state = 2;
		mail($user[0]['email'],$subject,$mailbody,$headers,'-f'.$from_email);		
		
		
		$user = ORM::factory('user')->where('role','>',1)->find();
		foreach ($user as $u)
		{
			mail($u->email,$subject,$mailbody,$headers,'-f'.$from_email);		
		}
		
		$mailbody->state = 1;		
		mail($winner[0]['email'],$subject,$mailbody,$headers,'-f'.$from_email);		
	}

	
	public function action_status() {
		//print_r($this->request->param()); exit;
		$prod = ORM::factory('product')->where('id','=',$this->request->param('lot'))->find();
		$info = ORM::factory('info')->find();

		//print_r($_GET); print_r($_POST); exit;
		
		$user = DB::query(Database::SELECT, 'SELECT ss_useratts.user_id as uid,ss_users.email,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE ss_users.id='.$prod->user_id)->execute()->as_array();		

		
		$emails = array();
		$emails = explode(';',$info->email);				
		
		$from_user = $info->name;
		$from_email = $emails[0];
		$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

		$headers = "From: $from_user <$from_email>\r\n".
									"MIME-Version: 1.0" . "\r\n" .
									"Content-type: text/html; charset=UTF-8" . "\r\n";

		$mailbody = View::factory('mail/status');
		$mailbody->prod = $prod;
		$mailbody->user = $user[0];
		$mailbody->status=$this->lotstates[$this->request->param('event')];
		$state = $_POST['enabled'];
		if ($state == 2)
		{
			$mailbody->message = 'Причина отказа: <br/>'.$_POST['materials'];
		} else {
			$mailbody->message = '';
		}
		//echo $mailbody; $mailbody->message ;echo $state;print_r($_POST);exit;
		
		
		$message = ORM::factory('message');
		$message->user_id = $user[0]['id'];
		$message->winner_id = $winner[0]['user_id'];
		$message->text = $mailbody;		
		$message->product_id = $product_id;
		$message->cts = time();
		$message->save();
	
	
		$mailbody->state = 0;
		foreach ($emails as $email) {
			$res = mail($email,'Смена статуса заявки '.$prod->id,$mailbody,$headers,'-f'.$from_email);
		/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
		}

		$mailbody->state = 2;
		mail($user[0]['email'],"Смена статуса заявки ".$prod->id,$mailbody,$headers,'-f'.$from_email);		

	}	
	
	
	
	public function convdate($curdate) {
		$months = array(1=>"января",2=>"февраля",3=>"марта",4=>"апреля",5=>"мая",6=>"июня",7=>"июля",8=>"августа",9=>"сентября",10=>"октября",11=>"ноября",12=>"декабря");
		$r .= date("d",$curdate)." ";
		$r .= $months[date("n",$curdate)]." msk ";
		$r .= date("Y",$curdate)." ";
		$r .= date("h",$curdate).":";
		$r .= date("i",$curdate)." ";
		
		return $r;
	}	
	
	
} // Articles


