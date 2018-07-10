<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Basket extends Controller {
	public function action_index()
    {
		$s = Session::instance();
		if (!isset($_SESSION["basket"])) {$_SESSION["basket"]=array();}
		if (count($_GET)>0) {		
			if ($_GET['act']=='add')
			{
				$this->add($_GET['id']."-".$_GET['color'].'-'.$_GET['size'].'-'.$_GET['mat'].'-'.$_GET['brand'],$_GET['price'],$_GET['n']);
				return $this->request->redirect('basket/show');
			}
		}
		return $this->request->redirect('basket/show');
	}

	public function action_upd()
    {
				
		$s = Session::instance();

		if(isset($_POST["delete"])&&is_array($_POST["delete"])) {
			foreach($_POST["delete"] as $k=>$v) {
				if(isset($_SESSION["basket"][$v])) {

					Unset($_SESSION["basket"][$v]);
				}
			}
		}

		if(isset($_GET["del"])&&isset($_GET["id"])) {
			Unset($_SESSION["basket"][$_GET["id"]]);
		}
		
		
		if(isset($_POST["q"])&&is_array($_POST["q"])) {
			foreach($_POST["q"] as $k=>$v) {
				if(isset($_SESSION["basket"][$k])) {
					$_SESSION["basket"][$k]['n'] = $v;
					//Unset($_SESSION["basket"][$v]);
				}
			}
		}
		
		return $this->request->redirect('order/cart');	
	}
	
	public function add($id,$price,$n)
    {
		$s = Session::instance();
		if ($n>0) {
			if(isset($_SESSION["basket"][$id]))
				  $_SESSION["basket"][$id]["n"]+= $n;
			else{
				  $_SESSION["basket"][$id]=array("id"=>$id,"n"=>$n,"price"=>$price);
			}
		}
	}
	
	public function upd()
    {
	}

	public function show() {
		$s = Session::instance();
		$q = 0;
		$sum = 0;
		if (count($_SESSION['basket']) >0 ) {
			foreach ($_SESSION['basket'] as $i=>$v)
			{
				$q += $v['n'];
				$sum += $v['n']*$v['price'];
			}
			return "<a href='".URL::site()."order/cart'>Ваш заказ: <br/>".$sum." руб.</a><br/>";
		} else {return "Ваш заказ: <br/>0 руб.";}
	}

	public function show_all() {
		$s = Session::instance();
		$q = 0;
		$sum = 0;
		$body = "";
		
		//print_r($_GET);
		if (count($_SESSION['basket']) >0 ) {
			foreach ($_SESSION['basket'] as $i=>$v)
			{
				$q += $v['n'];
				$sum += $v['n']*$v['price'];
			}
			
			$a = $this->good_list_no_groups($_GET," ss_products.id=".$_GET['id']);
			
			$colors = ORM::factory('color')->where('id','=',$_GET['color'])->find_all();
			$sizes = ORM::factory('size')->where('id','=',$_GET['size'])->find_all();
			$mats = ORM::factory('material')->where('id','=',$_GET['mat'])->find_all();
			
			$content = View::factory('basket');
			$content->prod = $a['prods'][0];
			$content->getdata = $_GET;
			$content->colors = $colors;
			$content->sizes = $sizes;
			$content->mats = $mats;
			$content->q = $q;
			$content->sum = $sum;
			//$body .= "В КОРЗИНЕ:<a href='".URL::site()."order/cart'><br/> ".$q." ТОВАРОВ на сумму <br/>".$sum." руб.</a><br/>";
			$body = $content;
			
		} else {$body .= "";}
		
		return $body;
	}

	public function action_showa()
    {
		//echo ;
		return $this->request->redirect('basket/showa2?'.$_SERVER['QUERY_STRING']);
	}

	public function action_showa2()
    {
		$this->response->body($this->show_all());
	}	
	
	
	public function action_show()
    {
		$this->response->body($this->show());
	}


	public function good_list_no_groups($data,$where=" true ") {
		$a = array();
		$pre_filter = $where;
		/*if ($data['color']==0) {$where .= '';} else {$where .= ' and colors like "%'.$data['color'].'%"';}
		if ($data['size']==0) {$where .= '';} else {$where .= ' and sizes like "%'.$data['size'].'%"';}
		if ($data['mat']==0) {$where .= '';} else {$where .= ' and materials like "%'.$data['mat'].'%"';}
		if ($data['brand']==0) {$where .= '';} else {$where .= ' and brand_id ='.$data['brand'];}*/
//		$where .= " and Price>".$data['min']." and Price<".$data['max'];
		$where .= " and enabled=1";
		$a['colors'] = array();
		$a['sizes'] = array();
		$a['materials'] = array();
		$a['brands'] = array();
		$a['prods'] = array();
		$a['brands'] = array();
		$items_page = 6;
		
		$col_array = array();
		$size_array = array();
		$mat_array = array();
		$brand_array = array();

		$col_string = "";
		$size_string = "";
		$mat_string = "";
		

		if ($data['page']>0)
		{
			$data['page']--;
		}
		
		
		$all_prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE enabled=1 and '.$pre_filter)->execute()->as_array();
		
		
				
		$brand_array[] = 0;
		foreach ($all_prods as $prod)
		{
			$col_string .= $prod['colors'];
			$size_string .= $prod['sizes'];
			$mat_string .= $prod['materials'];
			$brand_array[] = $prod['brand_id'];			
		}
		
		$col_array = explode("-",$col_string);
		$size_array = explode("-",$size_string);
		$mat_array = explode("-",$mat_string);
		
		$a['colors'] = ORM::factory('color')->where('id','in',$col_array)->find_all();
		$a['sizes'] = ORM::factory('size')->where('id','in',$size_array)->order_by('pos')->find_all();
		$a['materials'] = ORM::factory('material')->where('id','in',$mat_array)->order_by('name')->find_all();
		$a['brands'] = ORM::factory('brand')->where('id','in',$brand_array)->order_by('name')->find_all();
		$a['data'] = $data;
		
		
		$a['prods'] = DB::query(Database::SELECT, 'SELECT ss_products.*,ss_brands.name as bname FROM ss_products LEFT JOIN ss_brands ON ss_products.brand_id=ss_brands.id  WHERE '.$where)->execute()->as_array();
		//$a['counts'] = count($page_prods);
		//$a['pagination'] = Pagination::factory(array('total_items' => $a['counts'],'items_per_page'=>$items_page));

		
	
		return $a;
	}	
}