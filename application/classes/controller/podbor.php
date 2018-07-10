<?
class Controller_Podbor extends Controller_Common {
	public $template = 'companies';	
	
    public function before()
    {
        parent::before();	
	}
 
    public function action_index()
    {
		
		//$this->template->upmenu = $this->upmenu;		
        //$this->template->content = "";
		return $this->request->redirect('companies/list/0');
	}
	
	public function action_list()
	{
		
		$id = $this->request->param('role');
		$page = $this->request->param('page');		
		
		$request = $this->request->param();
		
		$where = '';
		if (intval($_GET['country'])>0)
		{
			$where .= ' and lands like "%'.$_GET['country'].';%" ';
		}


		if (strlen($_GET['search'])>0)
		{
			$where .= ' and (allfio like "%'.$_GET['search'].'%" or company like "%'.$_GET['search'].'%" or opisanie like "%'.$_GET['search'].'%" or opisanie2 like "%'.$_GET['search'].'%")';
		}

		
		if (intval($_GET['step'])>0)
		{
			$steps = ORM::factory('categorie')->where('step_id','=',$_GET['step'])->find_all();
			$stepa = array();
			foreach($steps as $step)
			{
				$stepa[] = $step->id;
			}
			$stepstr = implode(",",$stepa);
			$where .= "and (select count(id) from ss_u2cs where ss_u2cs.user_id = ss_useratts.user_id and category_id in(".$stepstr."))>0";
		}
		
		$items = 10;
		
		if ($id == 0) {
			$this->template->img="/img/1.jpg";				
			$this->template->title="Компании - провайдеры услуг для экспортеров";
			$this->template->stitle="Компании - провайдеры услуг для экспортеров";
			$this->template->sdescr="Раздел «Компании» сайта «Russia Going Global» посвящен российским и зарубежным компаниям, специализирующихся на поддержке ВЭД, экспорта и продвижении продукции на внешних рынках. Вы сможете найти интересующую компанию с помощью фильтров, посмотреть профиль компании, написать отзыв на компанию и связаться с ее представителем.";
			$this->template->h1="Компании";
			$allexperts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM  ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE ss_users.role = 4 and complete = 1 and expert = 1 '.$where.' ')->execute()->as_array();	
			$experts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM  ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE ss_users.role = 4 and complete = 1 and expert = 1 '.$where.' limit '.$items.' offset '.intval($page))->execute()->as_array();	
		} else {
			$this->template->img="/img/experts.jpg";
			$this->template->title="Частные консультанты - провайдеры услуг для экспортеров";
			$this->template->h1="Частные консультанты";	
			
			$this->template->stitle="Частные консультанты - провайдеры услуг для экспортеров";
			$this->template->sdescr="Раздел «Частные консультанты» сайта «Russia Going Global» посвящен российским и зарубежным независимым консультантам, специализирующихся на поддержке экспорта и продвижении продукции на внешних рынках. Вы сможете найти интересующего консультанта с помощью фильтров, посмотреть детальную информацию о консультанте, написать отзыв на консультанта и связаться с ним.";			
			
			$allexperts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM  ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE ss_users.role = 5 and complete = 1 and expert = 1 '.$where.' ')->execute()->as_array();				
			$experts = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM  ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE ss_users.role = 5 and complete = 1 and expert = 1 '.$where.' limit '.$items.' offset '.intval($page))->execute()->as_array();				
			
			//print_r($experts);
		}

		foreach ($experts as $j=>$expert)
		{
			if (strlen($expert['opisanie']) > 250)
			{
				$experts[$j]['opisanie'] = substr($expert['opisanie'],0,250);
				$ta = explode(' ',$experts[$j]['opisanie']);
				//print_r($ta);
				if(count($ta) > 1) {
					unset($ta[count($ta)-1]);
				}
				$ta[] = ' ...';
				$experts[$j]['opisanie'] = implode(' ',$ta);
			}
		}
		
		
		$steps = ORM::factory('step')->find_all();
		$countries = ORM::factory('country')->order_by('name','ASC')->find_all();
		$content = View::factory('companies/list');
		$content->pagination = $this->pagination(count($allexperts),$items,intval($page),5,"",$id);
		$content->experts = $experts;
		$content->steps = $steps;
		$content->step = intval($_GET['step']);
		$content->countries = $countries;
		$content->page = intval($page);
		$content->role = intval($id);
		$content->request = $request;
		$content->login = $this->login;
		
		$this->template->content = $content;
	}

	public function action_one()
	{

		$id = $this->request->param('id');
		$role = $this->request->param('role');
		$page = $this->request->param('page');
	
		if ($_POST) {			
			$recom = ORM::factory('recom');
			$recom->expert_id = $id;
			$recom->owner_id = $this->auth->instance()->get_user()->id;
			$recom->text = $_POST['text'];
			$recom->rating = $_POST['rating'];
			$recom->cts = time();
			$recom->save();
			$_SESSION['success'] = 1;
			return $this->request->redirect($_SERVER['HTTP_REFERER']);
		}
		
		
		if (intval($id) == 0) {
			return $this->request->redirect("/companies/list/".$role."/".$page);
		}

		$expert = DB::query(Database::SELECT, 'SELECT ss_useratts.*,ss_users.role,ss_users.email FROM  ss_useratts LEFT JOIN ss_users ON ss_useratts.user_id = ss_users.id WHERE ss_users.id = '.$id)->execute()->as_array();

		if (count($expert) == 0) {
			return $this->request->redirect("/companies/list/".$role."/".$page);
		}

		/*if (strlen($expert[0]['opisanie']) > 350)
		{
			$expert[0]['opisanie'] = substr($expert[0]['opisanie'],0,350);
			$ta = explode(' ',$expert[0]['opisanie']);
			//print_r($ta);
			if(count($ta) > 1) {
				unset($ta[count($ta)-1]);
			}
			$expert[0]['opisanie'] = implode(' ',$ta);

		}*/

		
		if ($role == 0) {
			$this->template->img="/img/1.jpg";
			$this->template->title="Компании";
			$this->template->h1="Компании";
			$this->template->h2="Компании";

			$this->template->stitle=$expert[0]['shortname'].' (услуги для экспортеров)';
			$this->template->sdescr=$expert[0]['opisanie'];			
			
		} else {
			$this->template->img="/img/experts.jpg";
			$this->template->title="Частные консультанты";
			$this->template->h1="Частные консультанты";	
			$this->template->h2="Частные консультанты";

			$this->template->stitle = $expert[0]['fio'].' '.$expert[0]['lastname'].' '.$expert[0]['surname'].'(консультант по экспорту)';
			$this->template->sdescr = $expert[0]['opisanie'];
		}

		$recoms = ORM::factory('recom')->where('expert_id','=',$id)->order_by('id','desc')->find_all();
		$content = View::factory('companies/one');
		$content->recoms = $recoms;
		$content->success = $_SESSION['success'];
		$_SESSION['success'] = 0;
		$content->page = intval($page);
		$content->role = intval($role);
		$content->expert = $expert[0];
		$content->login = $this->login;
	
		$this->template->content = $content;
//print_r($this->request->param());exit;
		
	}


function pagination ($total,$per_page,$page,$step,$link,$role,$country,$sstep,$search) {
	$pages = array();
	$content = View::factory('pagination');
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
	$content->pages = $pages;
	return $content;
}	
	

	
}
?>