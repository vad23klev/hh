<?
class Controller_Forum extends Controller_Common {
	public $template = 'forum';	
	
    public function before()
    {
        parent::before();	
	}
 
 	public function action_index()
	{
		if (intval($_GET['step']) > 0) {
			$cat = ORM::factory('categorie')->where('id','=',$_GET['step'])->find();
			return $this->request->redirect("/forum/list/0/".$cat->step_id."/".$_GET['step']."?search=".$_GET['search']);
		}
		$this->template->title="Вопросы/ответы";
		$content = View::factory('forum/main');
		$steps = ORM::factory('step')->find_all();
		$content->steps = $steps;
		//return $this->request->redirect('/forum/list/0');
		$this->template->content = $content;
	}

	public function ids($step,$category,$search)
	{
		$where = "";
		if (intval($category) > 0)
		{
			$where = "category_id = ".$category;
		} else {
			$cats = DB::query(Database::SELECT, 'SELECT ss_categories.* FROM ss_categories WHERE step_id="'.intval($step).'"')->execute()->as_array();
			$ca = array();
			foreach ($cats as $cat) {
				$ca[] = $cat['id'];
			}
			$ca[] = -1;
			$cstr = implode(",",$ca);
			$where = "category_id in (".$cstr.")";
		}
		//echo $where;
		if (strlen($search) > 0) {
			$where1 = "and (title like '%".$search."%' or name like '".$search."')";			
		}
		
		$prods = DB::query(Database::SELECT, 'SELECT ss_products.id FROM ss_products WHERE pub=1 '.$where1.' and sale_type=1 and '.$where)->execute()->as_array();
		$pa = array();
		foreach ($prods as $prod)
		{
			$pa[] = $prod['id'];
		}
		$pa[] = -1;
		
		return $pa;
	}
	
	public function action_list()
	{
		
		if (isset($_GET['step']) > 0) {
			return $this->request->redirect("/forum/list/0/".$_GET['step']."?search=".$_GET['search']);
		} /*else {
			return $this->request->redirect("/forum/");
		}*/
		
		$page = $this->request->param('page');
		$step = $this->request->param('step');
		$category = $this->request->param('category');
		$step = $this->request->param('step');
		
		$prods = $this->ids($step,$category,$_GET['search']);
		
		
		$request = $this->request->param();
		$items = 10;
		$allquestions = ORM::factory('product')->where('sale_type','=',1)->where('pub','=',1)->where('id','in',$prods)->find_all();
		$questions = ORM::factory('product')->where('sale_type','=',1)->where('pub','=',1)->where('id','in',$prods)->order_by('id','desc')->limit($items)->offset(intval($page))->find_all();
		
		$lastposts = ORM::factory('product')->where('sale_type','=',1)->where('pub','=',1)->where('id','in',$prods)->order_by('id','desc')->limit(10)->find_all();
		
		$this->template->title="Список вопросов";
		$content = View::factory('forum/list');
		$steps = ORM::factory('step')->find_all();
		$cat = ORM::factory('categorie')->where('id','=',$category)->find();
		$content->lastposts = $lastposts;
		$content->cat = $cat;
		$content->search = $_GET['search'];
		$content->steps = $steps;
		$content->pagination = $this->pagination(count($allquestions),$items,intval($page),5,"forum/pagelist",0,0,$step,$category);
		$content->questions = $questions;
		$content->page = intval($page);
		$content->category = intval($category);
		$content->stepname = ORM::factory('step')->where('id','=',intval($step))->find();
		$content->step = intval($step);
	
		$this->template->content = $content;
	}

	public function action_like() {
		if($this->auth->instance()->logged_in())
	    {
			if (intval($_GET['id']) > 0) {
				$like = ORM::factory('like');
				$like->feed_id = $_GET['id'];
				$like->user_id = $this->auth->instance()->get_user()->id;
				$like->save();
			}	
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $this->request->redirect("/user/register");
		}
	}
	
	
	public function action_one()
	{

		$id = $this->request->param('id');
		$page = $this->request->param('page');
		$postpage = $this->request->param('pastpage');
		$step = $this->request->param('step');
		$category = $this->request->param('category');
		
	
		if ($_POST) {
			//$param = $this->request->param();
			//print_r($param);
			//echo $id;exit;
			$recom = ORM::factory('feed');
			$recom->product_id = $id;
			$recom->user_id = $this->auth->instance()->get_user()->id;
			$recom->text = $_POST['text'];
			$recom->cts = time();
			$recom->save();
			$_SESSION['success'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		}
		
		
		if (intval($id) == 0) {
			return $this->request->redirect("/forum/");
		}
		$items = 10;
		$prod = ORM::factory('product')->where('id','=',$id)->find();
		
		$this->template->stitle = "Вопрос экспертам в области экспорта";
		$this->template->sdescr = $prod->title;
				
		$allfeeds = ORM::factory('feed')->where('product_id','=',$id)->find_all();
		$feeds = ORM::factory('feed')->where('product_id','=',$id)->order_by('id','desc')->limit($items)->offset(intval($page))->find_all();
		$owner = ORM::factory('useratt')->where('user_id','=',$prod->user_id)->find();
//echo count($allfeeds);
		$content = View::factory('forum/one');
		$content->pagination = $this->pagination(count($allfeeds),$items,intval($page),5,"forum/pagecomments",$id,intval($postpage),$step,$category);
		$content->allfeeds = $feeds;
		$content->user_id = $this->auth->instance()->get_user()->id;
		$cat = ORM::factory('categorie')->where('id','=',$category)->find();
		$content->feeds = $feeds;
		$content->prod = $prod;
		$content->cat = $cat;
		$content->owner = $owner;
		$content->postpage = $postpage;
		$content->success = $_SESSION['success'];
		$content->login = $this->login;
		$_SESSION['success'] = 0;
		$content->page = intval($page);
		$content->category = intval($category);
		$content->stepname = ORM::factory('step')->where('id','=',intval($step))->find();
		$content->step = intval($step);		
	
		$this->template->content = $content;
//print_r($this->request->param());exit;
		
	}


function pagination ($total,$per_page,$page,$step,$view,$id,$pastpage,$step,$category) {
	$pages = array();
	$content = View::factory($view);

	//print_r($_GET);
		//	/page=[0-9]+/	
	//echo $_SERVER['QUERY_STRING'];
	$req = explode("?",$_SERVER['REQUEST_URI']);
	
	$_qs = str_replace("kohana_uri=".$_GET['kohana_uri'],"",$_SERVER['QUERY_STRING']);
	$_qs = str_replace("kohana_uri=".$_GET['kohana_uri']."&","",$_qs);
	$_qs = str_replace("&page","page",$_qs);
	
	for($j=0;$j<ceil($total/$per_page);$j++){
		if ($j>=$page-$step && $j<=$page+$step)
		{						
			if (strlen($_qs)>0) {
				if (preg_match("/page=[0-9]+/",$_qs)) {
					$link = preg_replace("/page=[0-9]+/","page=".$j,$_qs);
				} else {$link = $_qs."page=1".$j;}
			} else {
				$link = "page=".$j;
			}
			
			$link = $link;
			$pages[$j] = array("link"=>$link);
		}
	}

	$content->current = $page;

	if (strlen($_qs)>0) {
		if (preg_match("/page=[0-9]+/",$_qs)) {
			$link = preg_replace("/page=[0-9]+/","page=0",$_qs);
		} else {$link = $_qs."page=1".$j;}
	} else {
		$link = "page=".$j;
	}			

	$content->min = array("link"=>$link,"number"=>0);

	if (strlen($_qs)>0) {
		if (preg_match("/page=[0-9]+/",$_qs)) {
			$link = preg_replace("/page=[0-9]+/","page=".($j-1),$_qs);
		} else {$link = $_qs."page=1".$j-1;}
	} else {
		$link = "page=".$j-1;
	}			

	//print_r($pages);
	
	$content->max = array("link"=>$link,"number"=>$j-1);
	$content->url = $req[0];
	$content->role = $role;
	$content->country = $country;
	$content->sstep = $sstep;
	$content->search = $search;
	$content->id = $id;
	$content->pages = $pages;
	$content->pastpage = $pastpage;
	$content->step = intval($step);
	$content->category = intval($category);
	return $content;
}		
	
	
	
}
?>