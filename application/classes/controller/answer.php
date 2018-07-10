<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Answer extends Controller {
	public function action_index()
    {
		$fio = $_GET['fio'];
		$tel = $_GET['tel'];
		$service = $_GET['message'];
		//print_r($_GET);
		$feed = ORM::factory('feed');
		
		$feed->date = date("Y-d-m H:i");
		$feed->fio = $fio;
		$feed->when = $tel;
		$feed->text = $service;
		$feed->subj = 1;
		$feed->save();

		$info = ORM::factory('info')->find();
		$body .= "ФИО: ".$fio."<br>";
	    $body .= "Телефон: ".$tel."<br>";
		$body .= "Услуга: ".$service."<br>";
	    $body .= "Когда перезвонить: ".$when;
		//print_r($_SESSION['basket']);

		
		/*if (strlen($payname->suffix)>0) {
			$body .= "<br><br>Ссылка для оплаты заказа: <a href='http://agavaspb.ru/index.php/order/pay/?id=".$add->id."'>http://agavaspb.ru/index.php/order/pay?id=".$add->id."</a><br>";
		}*/
		$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		$headers .= "From: SiteProject <info@".$_SERVER['HTTP_HOST'].">\r\n"; 

		if (strlen($info->email)>0) {
			$emails = explode('<br/>',$info->email);
			mail($emails[0],"Новая заявка",$body,$headers);
		}
		
		
		
		echo "<div class='buttone'>Ваша заявка отправлена</span>";
	}

	public function action_looklot()
    {
		if ($_GET['uid']) {
			//$status = $_GET['status']; 
			//$content = View::factory('user/looklot1');
			//mysql_query('update ss_feeds set enabled=1 where product_id='.$_GET['uid']);
			$feeds = ORM::factory('feed')->where('product_id','=',$_GET['uid'])->find_all();
			foreach ($feeds as $feed)
			{
				$feed->enabled = 1;
				$feed->save();
			}
			
			//echo mysql_error();
			/*if ($_POST)
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
			//$content->menu = $this->make_menu2($lmenu);
			
			$content->cat = $cat->name;
			$content->prod = $good;
			$content->feeds = $feeds;
			$cats = ORM::factory('categorie')->where('category_id','=',0)->where('type','=','catalog')->find_all();
			
			echo $content;*/
		}
 
	}		
	
	
	
	
	
	public function action_rate()
    {
		if (isset($_GET['uid']) && isset($_GET['val']))
		{
			$v = ORM::factory('feed')->where('id','=',$_GET['uid'])->find();
			$v->rating = $_GET['val'];
			$v->save();
			echo $_GET['val'];
		}				
	}
	
	
	
	public function action_look()
    {
		$view = View::factory('results');
		
		$sval = $_GET['search'];

		$message = $_GET['search'];
		if ((strlen($sval)==0 || $sval=='Поиск по сайту') && !isset($_GET['brend']))
		{	
			$message="Пустая строка поиска";
			$cats = array();
			$prods = array();
		}else {

			//$brands = ORM::factory('brand')->where('name','like',''.$sval.'%')->or_where('name','like','% '.$sval.'%')->find_all();
			$cats = ORM::factory('categorie')->where('name','like',''.$sval.'%')->or_where('name','like','% '.$sval.'%')->or_where('addwords','like','%'.$sval.'%')->find_all();
			//$prods = ORM::factory('product')->where('enabled','=',1)->where('name','like',''.$sval.'%')->or_where('name','like','% '.$sval.'%')->find_all();

			if (!isset($data['min']))
			{
				$data['min'] = 0;
			}

			if (!isset($data['max']))
			{
				$data['max'] = 99999999;
			}		
			$prods = DB::query(Database::SELECT, "SELECT * FROM ss_products WHERE (ss_products.name like '".$sval."%' or ss_products.name like '% ".$sval."%'  or ss_products.addwords like '%".$sval."%')")->execute()->as_array();	
			//$prods = $this->good_list_no_groups($data," (ss_products.name like '".$sval."%' or ss_products.name like '% ".$sval."%'  or ss_products.addwords like '%".$sval."%')");			
		}

		$view->sval = $sval;
		$view->message = $message;
		$view->cats = $cats;
		$view->prods = $prods;

		echo $view;
		
	}
	
	
	public function action_prod()
    {
		$article = $_GET['article'];
		$main = $_GET['main'];
		
		$prod = ORM::factory('product')->where('article','=',$article)->find();
		
		$a = array();
				$turnir = ORM::factory('turnir')->where('id','=',$prod->turnir_id)->find();
				$a['turnir_id'] = $turnir->id;
				$a['turnir'] = $turnir->name;
				$seazon = ORM::factory('seazon')->where('id','=',$prod->seazon_id)->find();
				$a['sezon_id'] = $seazon->id;
				$a['sezon'] = $seazon->name;
				$league = ORM::factory('league')->where('id','=',$prod->league_id)->find();
				$a['league_id'] = $league->id;
				$a['league'] = $league->name;
				$team1 = ORM::factory('team')->where('id','=',$prod->team1_id)->find();
				$a['team1_id'] = $team1->id;
				$a['team1'] = $team1->name;
				$team2 = ORM::factory('team')->where('id','=',$prod->team2_id)->find();
				$a['team2_id'] = $team2->id;
				$a['team2'] = $team2->name;
		
		
		
		$content = View::factory('catalog/item');
		$content->product = $prod; 
		$content->chars = $a; 
		$content->main = $main; 
		
		echo $content;

	}

	
function send_mime_mail($name_from, $email_from, $name_to, $email_to, $data_charset, $send_charset, $subject, $body)
{
	$to = $this->mime_header_encode($name_to, $data_charset, $send_charset) . ' <' . $email_to . '>';
	$subject = $this->mime_header_encode($subject, $data_charset, $send_charset);
	$from =  $this->mime_header_encode($name_from, $data_charset, $send_charset) .' <' . $email_from . '>';
	if ($data_charset != $send_charset)
	{
		$body = iconv($data_charset, $send_charset, $body);
	}
	$headers = "From: $from\r\n";
	$headers .= "Reply-To: $from\r\n";
	$headers .= "Content-type: text/html; charset=$send_charset\r\n";
	$res = mail($to, $subject, $body, $headers);
	//echo $res; exit;
	return $res;
}

function mime_header_encode($str, $data_charset, $send_charset)
{
	if($data_charset != $send_charset)
	{
		$str = iconv($data_charset, $send_charset, $str);
	}
	return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}	
	
	
	public function action_mail()
    {
		$info = ORM::factory('info')->find();
		
		$mess = "ФИО: ".$_POST['fio']."<br/><br/>";
		$mess .= "E-mail: ".$_POST['email']."<br/><br/>";
		$mess .= "Сообщение: <br/>".$_POST['mess']."<br/><br/>";
		
		$emails = explode(";",$info->email);
		
		foreach ($emails as $email) {
			$res = $this->send_mime_mail('Администратор', // имя отправителя
					   'info@'.$_SERVER['HTTP_HOST'], // email отправителя
					   'Быченков Денис', // имя получателя
					   $email, // email получателя
					   'UTF-8',  // кодировка, в которой находятся передаваемые строки
					   'UTF-8', // кодировка, в которой будет отправлено письмо
					   $_POST['title'], // тема письма
					   $mess // текст письма
					   );
		}
		
		if ($res == 1) {
			$content = '<p class="text-center">Спасибо, Ваше сообщение успешно отправлено. Мы ответим Вам в ближайшее время.</p>';
		} else {
			$content = 'Ошибка ';
		}
		
		echo $content;

	}


	
	public function action_form()
    {
		$article = $_GET['article'];
		$main = $_GET['main'];
		
		$prod = ORM::factory('product')->where('article','=',$article)->find();
		
		$a = array();
		$turnir = ORM::factory('turnir')->where('id','=',$prod->turnir_id)->find();
		$a['turnir'] = $turnir->name;
		$seazon = ORM::factory('seazon')->where('id','=',$prod->seazon_id)->find();
		$a['seazon'] = $seazon->name;
		$league = ORM::factory('league')->where('id','=',$prod->league_id)->find();
		$a['league'] = $league->name;
		$team1 = ORM::factory('team')->where('id','=',$prod->team1_id)->find();
		$a['team1'] = $team1->name;
		$team2 = ORM::factory('team')->where('id','=',$prod->team2_id)->find();
		$a['team2'] = $team2->name;
		
		
		
		$content = View::factory('catalog/item');
		$content->product = $prod; 
		$content->chars = $a; 
		$content->main = $main; 
		
		echo $content;

	}
	
public function action_mail1()
    {
		$info = ORM::factory('info')->find();
		
		$mess = "ФИО: ".$_POST['fio']."<br/><br/>";
		$mess .= "E-mail: ".$_POST['email']."<br/><br/>";
		$mess .= "Код ТН ВЭД: ".$_POST['ved']."<br/><br/>";
		
		$emails = explode(";",$info->email);
		
		foreach ($emails as $email) {
			$res = $this->send_mime_mail('Администратор', // имя отправителя
					   'info@'.$_SERVER['HTTP_HOST'], // email отправителя
					   'Быченков Денис', // имя получателя
					   $email, // email получателя
					   'UTF-8',  // кодировка, в которой находятся передаваемые строки
					   'UTF-8', // кодировка, в которой будет отправлено письмо
					   $_POST['title'], // тема письма
					   $mess // текст письма
					   );
		}
		
		if ($res == 1) {
			$content = '<p class="text-center">Спасибо, Ваше сообщение успешно отправлено. Мы ответим Вам в ближайшее время.</p>';
		} else {
			$content = 'Ошибка ';
		}
		
		echo $content;

	}	
	public function action_mail2()
    {
		$info = ORM::factory('info')->find();
		
		$mess = "ФИО: ".$_POST['fio']."<br/><br/>";
		$mess .= "E-mail: ".$_POST['email']."<br/><br/>";
		$mess .= "Вопрос: ".$_POST['quest']."<br/><br/>";
		$mess .= "Текст вопроса: ".$_POST['qtext']."<br/><br/>";
		
		$emails = explode(";",$info->email);
		
		foreach ($emails as $email) {
			$res = $this->send_mime_mail('Администратор', // имя отправителя
					   'info@'.$_SERVER['HTTP_HOST'], // email отправителя
					   'Быченков Денис', // имя получателя
					   $email, // email получателя
					   'UTF-8',  // кодировка, в которой находятся передаваемые строки
					   'UTF-8', // кодировка, в которой будет отправлено письмо
					   $_POST['title'], // тема письма
					   $mess // текст письма
					   );
		}
		
		if ($res == 1) {
			$content = '<p class="text-center">Спасибо, Ваше сообщение успешно отправлено. Мы ответим Вам в ближайшее время.</p>';
		} else {
			$content = 'Ошибка ';
		}
		
		echo $content;

	}	
	
}