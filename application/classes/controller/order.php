<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Order extends Controller_Common {
 
    public function action_index()
    {
	}
	 
	public function action_search()
    {
		$view = View::factory('results');
		
		$sval = $_POST['search'];

		$message = $_POST['search'];
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
			
			$prods = $this->good_list_no_groups($data," (ss_products.name like '".$sval."%' or ss_products.name like '% ".$sval."%'  or ss_products.addwords like '%".$sval."%')");
			if (count($cats)==0 && count($prods)==0){$message="Ничего не найдено";}
		}
		$brends = DB::query(Database::SELECT,"SELECT ss_brands.id,ss_brands.name from ss_brands")->execute()->as_array();

		$this->template->back = "back-home.jpg";
		$view->sval = $sval;
		$view->message = $message;
		$view->cats = $cats;
		$view->prods = $prods['prods'];
		$view->brends = $brends;
		$this->template->h1 = 'Результаты поиска';
		$this->template->uid = 0;	
		$this->template->main = 0;
		$this->template->root = 0;
		$this->template->upmenu = array();
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
		$this->template->top10 = $this->top10;
		$this->template->content = $view;
	}	
	
	
    public function action_form()
    {
	
		$s = Session::instance();
		
		if (!isset($_SESSION["order_data"])) {
			$_SESSION["order_data"]=array();		
		}
	
		$view = View::factory('order_form');
		$view->paymodes = ORM::factory('pay')->find_all();
		$view->deliver = ORM::factory('delivery')->find_all();
		$view->data = $_SESSION["order_data"];
		
		$this->template->uid = 0;	
		$this->template->main = 0;
		$this->template->root = 0;
		$this->template->upmenu = array();
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
		$this->template->top10 = $this->top10;
		$this->template->content = $view;
	}	

	public function action_cart()
    {
	
		$this->setvertmenu(0);
		$this->sethormenu(0);
		
		$s = Session::instance();
				
		$view = View::factory('order');
		if (!isset($_SESSION['basket']) || count($_SESSION['basket'])==0){
			$view->prods = array();
		} else {
			$prods = array();
			$bs_array = array();
			foreach ($_SESSION['basket'] as $i=>$bsk)
			{
				$prods[$i]['id'] = $bsk['id'];
				$bs_array = explode('-',$bsk['id']);
				//print_r($bs_array);
				$pname = ORM::factory('product')->where('id','=',$bs_array[0])->find();
				$color = ORM::factory('color')->where('id','=',$bs_array[1])->find();
				$size = ORM::factory('size')->where('id','=',$bs_array[2])->find();
				$mat = ORM::factory('material')->where('id','=',$bs_array[3])->find();
				$brand = ORM::factory('brand')->where('id','=',$bs_array[4])->find();
				$prods[$i]['article'] = $pname->article;
				$prods[$i]['name'] = $pname->name;
				$prods[$i]['stock_type'] = $pname->stock_type;
				$prods[$i]['chpu'] = $pname->parent_chpu."/".$pname->alias;
				$prods[$i]['color'] = $color->name;
				$prods[$i]['picture'] = $pname->picture;
				$prods[$i]['rgb'] = $color->rgb;
				$prods[$i]['size'] = $size->name;
				$prods[$i]['material'] = $mat->name;
				$prods[$i]['brand'] = $brand->name;
				$prods[$i]['id'] = $bsk['id'];
				$prods[$i]['price'] = $bsk['price'];
				$prods[$i]['n'] = $bsk['n'];
			}
			$view->prods = $prods;
		}
		
		$this->template->uid = 0;	
		$this->template->title = "Корзина";
		$this->template->main = 0;
		$this->template->root = 0;
		$this->template->upmenu = array();
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
		$this->template->top10 = $this->top10;
		$this->template->content = $view;	
	}		

	public function action_lookdata()
    {
	
		$this->setvertmenu(0);
		$this->sethormenu(0);
		
		$s = Session::instance();
		//print_r($_POST);
		$_SESSION["order_data"] = $_POST;
		$view = View::factory('look');
		if (!isset($_SESSION['basket']) || count($_SESSION['basket'])==0){
			return $this->request->redirect('order/cart');
		} else {
			$prods = array();
			$bs_array = array();
			foreach ($_SESSION['basket'] as $i=>$bsk)
			{
				$prods[$i]['id'] = $bsk['id'];
				$bs_array = explode('-',$bsk['id']);
				//print_r($bs_array);
				$pname = ORM::factory('product')->where('id','=',$bs_array[0])->find();
				$color = ORM::factory('color')->where('id','=',$bs_array[1])->find();
				$size = ORM::factory('size')->where('id','=',$bs_array[2])->find();
				$mat = ORM::factory('material')->where('id','=',$bs_array[3])->find();
				$brand = ORM::factory('brand')->where('id','=',$bs_array[4])->find();
				$prods[$i]['article'] = $pname->article;
				$prods[$i]['name'] = $pname->name;
				$prods[$i]['chpu'] = $pname->parent_chpu."/".$pname->alias;
				$prods[$i]['color'] = $color->name;
				$prods[$i]['picture'] = $pname->picture;
				$prods[$i]['rgb'] = $color->rgb;
				$prods[$i]['size'] = $size->name;
				$prods[$i]['material'] = $mat->name;
				$prods[$i]['brand'] = $brand->name;				
				$prods[$i]['id'] = $bsk['id'];
				$prods[$i]['price'] = $bsk['price'];
				$prods[$i]['n'] = $bsk['n'];
			}
			
			$pay = ORM::factory('pay')->where('id','=',$_POST['paymode'])->find();
			$del = ORM::factory('delivery')->where('id','=',$_POST['deliver'])->find();
			$view->prods = $prods;
			$view->pay = $pay;
			$view->del = $del;
			$view->data = $_POST;
		}
		
		$this->template->uid = 0;	
		$this->template->title = "Просмотрите данные заказа";
		$this->template->main = 0;
		$this->template->root = 0;
		$this->template->upmenu = array();
		$this->template->vertmenu = $this->vertmenu;
		$this->template->hormenu = $this->hormenu;
		$this->template->top10 = $this->top10;
		$this->template->content = $view;	
	}	


	
	
    public function action_confirm()
    {
		$s = Session::instance();
		$body = "";
		if ($_POST && isset($_SESSION['basket'])) {
			//print_r($_POST);

			$order = ORM::factory('order')->values($_POST, array('ddate', 'fio','zip','address', 'city', 'phone', 'email', 'paymode', 'deliver', 'type','nav_type','enabled','comment'));
			$order->save();
			$id = $order->id; 
			foreach ($_SESSION['basket'] as $i=>$v)
			{
				//echo $i."<br/>";
				$_SESSION['basket'][$i]['order_id'] = $id;
				$_SESSION['basket'][$i]['code'] = $i;
				$_SESSION['basket'][$i]['q'] = $_SESSION['basket'][$i]['n'];
			}
			
			$payname = ORM::factory('pay')->where('id','=',$_POST['paymode'])->find();
			$dprice = ORM::factory('delivery')->where('id','=',$_POST['deliver'])->find();
			
            $body .= "<h4>Заказ № ".$id."</h4>";
                   $body .= "ФИО: ".$_POST['fio']."<br>";
                   $body .= "Телефон: ".$_POST['phone']."<br>";
                $body .= "E-mail: ".$_POST['email']."<br>";
                   $body .= "Дата доставки: ".$_POST['ddate']."<br>";
                   $body .= "Город: ".$_POST['city']."<br>";
                   $body .= "Адрес: ".$_POST['address']."<br>";
                   $body .= "Способ оплаты: ".$payname->pay."<br>";
                   $body .= "Способ доставки: ".$dprice->name."<br><br>";
                   $body .= "<h4>Состав заказа:</h4>";
                $body .= "<table cellpadding='2' cellspacing='0' align='left' border='0'>\r\n";
				$body .= "<tr><td>";
                $body .= "<table cellpadding='4' cellspacing='0' align='left' border='1'>\r\n";
                $body .= "<tr>\r\n";
                $body .= "<td style='padding:4px'>ID</td>\r\n";
                $body .= "<td style='padding:4px'>Наименование</td>\r\n";
				$body .= "<td style='padding:4px'>Цвет</td>\r\n";                
				$body .= "<td style='padding:4px'>Размер</td>\r\n";                
				$body .= "<td style='padding:4px'>Материал</td>\r\n";                
                $body .= "<td style='padding:4px'>Количество</td>\r\n";
                $body .= "<td style='padding:4px'>Цена</td>\r\n";
                $body .= "</tr>\r\n";

			//print_r($_SESSION['basket']);
			$quant = 0;
			$sum = 0;
			foreach ($_SESSION['basket'] as $i=>$v)
			{
			
				$bs_array = explode('-',$v['id']);
				//print_r($bs_array);
				$pname = ORM::factory('product')->where('id','=',$bs_array[0])->find();
				$color = ORM::factory('color')->where('id','=',$bs_array[1])->find();
				$size = ORM::factory('size')->where('id','=',$bs_array[2])->find();
				$mat = ORM::factory('material')->where('id','=',$bs_array[3])->find();
				$brand = ORM::factory('brand')->where('id','=',$bs_array[4])->find();

				$v['color'] = $bs_array[1];
				$v['size'] = $bs_array[2];
				$v['mat'] = $bs_array[3];

			
				$container = ORM::factory('container')->values($v,array('order_id','code','q','price','color','size','mat'));
				$container->save();
				
				$prod = ORM::factory('product')->where('id','=',$v['id'])->find();
				
				
				$body .= "<tr>\r\n";
				$body .= "<td>".$bs_array[0]."</td>\r\n";
				
				
				$body .= "<td style='padding:4px'>".$prod->name."&nbsp;".$brand->name."</td>\r\n";
				$body .= "<td style='padding:4px'>".$color->name."&nbsp;</td>\r\n";
				$body .= "<td style='padding:4px'>".$size->name."&nbsp;</td>\r\n";
				$body .= "<td style='padding:4px'>".$mat->name."&nbsp;</td>\r\n";
				$body .= "<td style='padding:4px'>".$v['q']."</td>\r\n";

				//$body .= "<td>".$good['type']."</td>\r\n";
				$body .= "<td style='padding:4px'>".$v['price']." руб.</td>\r\n";
				$body .= "</tr>\r\n";
				
				$quant += $v['q'];
				$sum += $v['q']*$v['price'];
			}

			$body .= "</table><br><br/<br/><br/><br/<br/><br/>\r\n";
			$body .= "</td></tr><tr><td>";
            $body .= "<strong>Заказ: ".$quant." шт. на сумму ".$sum." руб. </strong><br/>";
			
			if ($dprice->cost==0) {
				$body .= "<strong>Стоимость доставки уточняйте у наших менеджеров </strong><br/>";
				$body .= "<strong>Итого: ".($dprice->cost+$sum)." руб. </strong><br/>";
				
			} else {
				if ($sum<3000) {
					$body .= "<strong>Доставка: ".$dprice->cost." руб. </strong><br/>";
					$body .= "<strong>Итого: ".($dprice->cost+$sum)." руб. </strong><br/>";
					
					
					$order->dprice = $dprice->cost;
					$order->save();
					
				} else {
					$body .= "<strong>Доставка: 0 руб. </strong><br/>";
					$body .= "<strong>Итого: ".$sum." руб. </strong><br/>";				
				}
			}
			/*if (strlen($payname->suffix)>0) {
				$body .= "<br><br>Ссылка для оплаты заказа: <a href='http://agavaspb.ru/index.php/order/pay/?id=".$add->id."'>http://agavaspb.ru/index.php/order/pay?id=".$add->id."</a><br>";
			}*/
            $body .= "<br><br><span style='font-size:14px;font-weight:bold'>Спасибо за ваш заказ. Наш менеджер скоро свяжется с Вами.</span>";
			$body .= "</td></tr></table>";
            $headers  = "Content-type: text/html; charset=utf-8 \r\n";
            $headers .= "From: Магазин Lotus Store <info@lotusstore.ru>\r\n"; 

			if (strlen($_POST['email'])>0) {
				mail($_POST['email'],"Новый заказ",$body,$headers);
			}

			$emails = array();
			$emails = explode(';',$this->gen_info->email);				
			//print_r($emails);
			foreach ($emails as $email) {
				$res = mail($email,"Новое сообщение",$body,$headers);
				echo $res;
			/*		<a href="mailto:<?=$email?>"><?=$email?></a><br/>*/
			}
			
			unset ($_SESSION['basket']);
			
			$view = "<div class='white'>".$body."</div>";
			
		} else {
			$view = "<div class='white'><h1>Корзина пуста</h1></div>";
		}
		
		$this->template->uid = 0;	
		$this->template->title = "Подтверждение заказа";
		$this->template->main = 0;
		$this->template->root = 0;
		$this->template->upmenu = array();
		$this->template->vertmenu = $this->vertmenu;
		$this->template->top10 = $this->top10;
		$this->template->hormenu = $this->hormenu;
		$this->template->content = $view;
	
	}	
	
	public function action_pay()
    {
	}	
	
	public function action_success()
    {
	}		
	public function action_fail()
    {
	}		

}
