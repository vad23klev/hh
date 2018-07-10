<?php defined('SYSPATH') or die('No direct script access.');
 
abstract class Controller_Common extends Controller_Template {
 
    public $template = 'main';
    public $vertmenu = array();
    public $hormenu = array();
    public $upmenu = array();
	public $title;
	public $gen_info;
	public $banners2;
	public $banners;
	public $auth;
    public $main = 0;
	public $root = 0;
	public $top10 = array();
	

	
    public function before()
    {
        parent::before();
        
	//'session_type' => Session::$default,
	$this->auth = new Auth_ORM(
	array(
		'hash_method'  => 'md5',
		'hash_key'     => 5856739,
		'lifetime'     => 1209600,
		'session_key'  => 'adm_auth_user',
	));
 
        $catalog = ORM::factory('categorie')->where('enabled','=','1')->where('category_id','=','0')->where('nav_type','=','1')->order_by('category_id','ASC')->order_by('sort','ASC')->find_all();
 
       $brends = ORM::factory('categorie')->where('enabled','=','1')->where('category_id','=','0')->where('alias','<>','main')->where('nav_type','=','2')->order_by('category_id','ASC')->order_by('sort','ASC')->find_all();
 
		//$this->brandpics = ORM::factory('brand')->where('picture','<>',"")->order_by('name')->find_all();

		//$this->brands = ORM::factory('brand')->order_by('name')->find_all();
		
		$nm = 0;
		if(!$this->auth->instance()->logged_in())
		{			
			$this->login['name']=-1;
		} else {
			//print_r($this->auth->instance());
			$name = DB::query(Database::SELECT, 'SELECT ss_users.email,ss_users.role,ss_useratts.* FROM ss_users LEFT JOIN ss_useratts ON ss_users.id=ss_useratts.user_id WHERE username="'.($this->auth->instance()->get_user()->username).'"')->execute()->as_array();			
			//print_r($name[0]);
			
			$this->login = $name[0];
			$this->login['name'] = $name[0]['fio'];	
			if ($name[0]['expert'] == 1) {
				$this->login['role'] = $this->auth->instance()->get_user()->role;
			} else {
				$this->login['role'] = 1;
			}
		}
 
		//print_r($this->login);
 
		$this->gen_info = ORM::factory('info')->find();
        
		$this->top10 = DB::query(Database::SELECT, 'SELECT ss_products.* FROM ss_products WHERE enabled=1 ORDER BY rand() LIMIT 10')->execute()->as_array();;

//		print_r($this->banners2);
		$this->banners = ORM::factory('banner')->where('enabled','=',1)->order_by('sort')->find_all();

		$portfolio = ORM::factory('categorie')->where('category_id','=',84)->where('enabled','=',1)->order_by('sort')->find_all();
		$contacts = ORM::factory('categorie')->where('category_id','=',85)->where('enabled','=',1)->order_by('sort')->find_all();
		
		
        View::set_global('title', $this->gen_info->name);				
        View::set_global('description', $this->gen_info->name);
		//$this->template->cabinet = $this->cabinet();    
        $this->hormenu = $this->make_menu($catalog,"0");
		$this->vertmenu = $this->make_menu($brends,"0");    

		$this->template->portfolio = $this->make_menu($portfolio,"0");
		$this->template->contacts = $this->make_menu($contacts,"0");
		$this->template->nm = $nm;
		
		$this->template->saletype = 0;
		$this->template->banners = $this->banners;
		$this->template->news = ORM::factory('new')->where('enabled','=','1')->order_by('date','DESC')->limit(3)->find_all();
		$this->title = $this->gen_info->name;
        $this->template->info = $this->gen_info;
		$this->template->login = $this->login;
		$this->template->content = '';
        $this->template->styles = array('main');
        $this->template->scripts = '';
    }
    
    protected function make_menu($src,$type) {
        $menu_arr = array();
        if (count($src)>0)
        {
            foreach($src as $i=>$elem)
            {
                $alias = $elem->alias;
                if (strlen($elem->parent_chpu)>0) {
                    $menu_arr[$elem->id]['link'] = $elem->parent_chpu."/".$alias;
                } else if ($elem->main==0){$menu_arr[$elem->id]['link'] = $alias;}
				else {$menu_arr[$elem->id]['link'] = '';}
                $menu_arr[$elem->id]['active'] = 0;
				$menu_arr[$elem->id]['id'] = $elem->id;
                $menu_arr[$elem->id]['name'] = $elem->name;
				$menu_arr[$elem->id]['photo'] = $elem->picture;
                $menu_arr[$elem->id]['children'] = array();
                $menu_arr[$elem->id]['sizetable'] = $elem->sizetable;
                $children = ORM::factory('categorie')->where('category_id','=',$elem->id)->where('enabled','=',1)->order_by('sort','ASC')->find_all();
                if (count($children)>0)
                {
                    $menu_arr[$elem->id]['children'] = $this->make_menu($children,$type);
                }
            }
            
        }    
        return $menu_arr;
    }   
    
	protected function make_recursive_menu($src,$type,$arr) {
        $menu_arr = array();
        if (count($src)>0)
        {
            foreach($src as $i=>$elem)
            {
				//if ($elem->category_id>0) {
					$alias = $elem->alias;
					if (strlen($elem->parent_chpu)>0) {
						$menu_arr[$elem->id]['link'] = $elem->parent_chpu."/".$alias;
					} else {$menu_arr[$elem->id]['link'] = $alias;}
					$menu_arr[$elem->id]['active'] = 0;
					$menu_arr[$elem->id]['name'] = $elem->name;
					$menu_arr[$elem->id]['id'] = $elem->id;
					$menu_arr[$elem->id]['sizetable'] = $elem->sizetable;
					$menu_arr[$elem->id]['children'] = array();
					
					$children = ORM::factory('categorie')->where('category_id','=',$elem->id)->where('enabled','=',1)->order_by('sort','ASC')->find_all();
					if (count($children)>0 && in_array($elem->id,$arr))
					{
						$menu_arr[$elem->id]['children'] = $this->make_recursive_menu($children,$type,$arr);
					}
				//}
            }
            
        }    
        return $menu_arr;
    }  
	
	
    public function setvertmenu ($id){
        foreach ($this->vertmenu as $i=>$v)
        {
            if ($i == $id)
            {
                $this->vertmenu[$i]['active'] = 1;
                break;
            }
        }
        
        //print_r($this->menu);
    }
    
    public function sethormenu ($id){
        foreach ($this->hormenu as $i=>$v)
        {
            if ($i == $id)
            {
                $this->hormenu[$i]['active'] = 1;
                break;
            }
        }
        
        //print_r($this->menu);
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
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" style=\"\">".$lm['name']."</a>";
		} else {
			$res .= "<a href=\"".URL::site().$lm['link']."\" class=\"va\" style=\"font-weight:bold;\">".$lm['name']."</a>";		
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
	$arr[$pos]['id'] = $cat->id;
	$arr[$pos]['name'] = $cat->name;
	if (strlen($cat->parent_chpu)>0) {
		$arr[$pos]['chpu'] = $cat->parent_chpu."/".$cat->alias;
	} else {$arr[$pos]['chpu'] = $cat->alias;}
	
	if ($cat->category_id>0){
		$parent = ORM::factory('categorie')->where('id','=',$cat->category_id)->find();
		$pos ++;
		$arr += $this->get_parents($parent,$pos);
	}
	
	return $arr;
}


	
	public function good_list_no_groups($data,$where=" true ") {
		$a = array();
		//if (trim($where) == "true") {$where = " enabled=1 ";}
		$pre_filter = $where;
				
		if ($data['color']==0) {$where .= '';} else {$where .= ' and colors like "%'.$data['color'].'%"';}
		if ($data['size']==0) {$where .= '';} else {$where .= ' and sizes like "%'.$data['size'].'%"';}
		if ($data['mat']==0) {$where .= '';} else {$where .= ' and materials like "%'.$data['mat'].'%"';}
		if ($data['brend']==0) {$where .= '';} else {$where .= ' and brand_id ='.$data['brend'];}
		
		if ($data['typ']==1) {
			$add_where = "";
			if (trim($where) != "true"){$where.=" or ";} else {$where = "";} $where .= ' description like "%мужск%"';	
		} 
		
		if ($data['typ2']==1) {
			$add_where = "";
			if (trim($where) != "true"){$where.=" or ";} else {$where = "";} $where .= ' description like "%женск%"';
		}
		
		
		if (isset($data['mech']) || isset($data['mech2'])) {
			$add_where .= " and (";
		}
		
		if (isset($data['mech'])) {
			$add_where .= ' description like "%кварц%"';
		}
		if (isset($data['mech2'])) {
			if (isset($data['mech'])) {
				$add_where .= ' or ';
			}
			$add_where .= ' description like "%механич%"';
		}
	
		if (isset($data['mech']) || isset($data['mech2'])) {
			$add_where .= ")";
		}
		$where .= $add_where;
		
//		if ($data['mech']==1) {if (trim($where) != "true"){$where.=" or ";} else {$where = "";} $where .= ' description like "%кварц%"';} 
//		if ($data['mech2']==1) { if (trim($where) != "true"){$where.=" or ";} else {$where = "";}  $where .= ' description like "%механич%"';}
		
//		$where .= " and (Price>".$data['min']." and Price<".$data['max'].") ";		
		$a['colors'] = array();
		$a['sizes'] = array();
		$a['materials'] = array();
		$a['brands'] = array();
		$a['prods'] = array();
		$a['brands'] = array();
		$items_page = 9999;
		
		$col_array = array();
		$size_array = array();
		$mat_array = array();
		$brand_array = array();

		$col_string = "";
		$size_string = "";
		$mat_string = "";
		//echo $where;
//print_r($data);
/*		if ($data['page']>0)
		{
			$data['page']--;
		}*/
		//print_r($data);
		$all_prods = DB::query(Database::SELECT, 'SELECT * FROM ss_products WHERE ('.$where.') and enabled=1 and stock_type=2')->execute()->as_array();
		
		//print_r($all_prods);
				
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

		//echo $where;
		//print_r($data);
		$a['prods'] = DB::query(Database::SELECT, "SELECT ss_products.* FROM ss_products WHERE (".$where.") and enabled=1 and stock_type=2 ORDER BY sort LIMIT ".$items_page." OFFSET ".($data['page']*$items_page))->execute()->as_array();
//		echo count($a['prods']);
		//print_r($a['prods']);
		$a['counts'] = count($all_prods);
		$a['pagination2'] = Pagination::factory(array('total_items' => $a['counts'],'items_per_page'=>$items_page));
//		$a['pagination'] = $this->pagination($a['counts'],$items_page,$data['page'],5,"");
		
	
		return $a;
	}	
	
public function prepare() {
			$data = $_GET;
			if (!isset($data['page']) || strlen($data['page'])==0)
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
			if (!isset($data['brand']))
			{
				$data['brand'] = 0;
			}		
	return $data;
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
		$date_ru = $day . '&nbsp;'. $months_ru[intval($month)] . '&nbsp;' . $year . ' г.';// '.$hour.':'.$minute;
		return $date_ru;  
	} else {
		return '';
	}
}	



function convdate($dta) {
	$darray = explode("-",$dta);
	$str = $darray[2].".".$darray[1].".".$darray[0];
	return $str;
}

function podbor($c_id) {

	$options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id WHERE single=0 and (category_id=".$c_id.")")->execute()->as_array();

	$list_options = DB::query(Database::SELECT,"SELECT ss_options.id,ss_options.name,ss_options.table_ref,ss_tables.table_name,ss_tables.name as tname,ss_values.value FROM ss_options LEFT JOIN ss_values ON ss_options.id=ss_values.option_id LEFT JOIN ss_tables ON ss_tables.id=ss_options.table_ref WHERE single=1 and (category_id=".$c_id.")")->execute()->as_array();
	
	foreach ($list_options as $jj=>$opts) {
		$v_a = explode("-",$opts['value']);
		$vals = ORM::factory($opts['table_name'])->where('id','in',$v_a)->find_all();
		$list_options[$jj]['vals'] = $vals;
	}
	
	$view = View::factory('podbor');
	$view->options = $options;
	$view->list_options = $list_options;
	return $view;
	
	
}


function cabinet($cat) {

		$view = View::factory('userdata');
		$view->login = $this->login;
		return $view;
}


function make_crumbs($cat) {

		$this->get_root_id($cat);		
		$this->get_root($cat);		
		$arr = $this->get_parents($cat);
		krsort($arr);

		$view = View::factory('crumbs');
		$view->crumbs = $arr;
		
		return $view;
}


function pages ($total,$per_page,$page,$step,$link) {
	$pages = array();
	$content = View::factory('plain');
	$data = $_GET;
	unset($data['kohana_uri']);
	unset($data['page']);
	
	foreach($data as $i=>$dt)
	{
		$data[$i] = $i.'='.$dt;
	}
	
	$datastr = implode("&",$data);
		//	/page=[0-9]+/
	
	for($j=0;$j<ceil($total/$per_page);$j++){
		if ($j>=$page-$step && $j<=$page+$step)
		{
			if ($datastr != '')
			{
				$link = $datastr.'&page='.$j;
			} else {
				$link = 'page='.$j;
			}
			$pages[$j] = array("link"=>$link);
		}
	}

	$content->current = $page;

	if ($datastr != '')
	{
		$link = $datastr.'&page=0';
	} else {
		$link = 'page=0';
	}

	$content->min = array("link"=>$link,"number"=>0);


	//print_r($pages);
	
	$content->max = array("link"=>$link,"number"=>$j-1);
	$content->url = $req[0];
	$content->pages = $pages;
	return $content;
}	

public function ids($cat,$search,$tags)
	{
		$where1[] =" 1";
		
		if (strlen($search) > 0)
		{
			$where1[] = " (text like '%".$search."%' or announce like '%".$search."%' or name like '%".$search."%')";			
		}
		
		if (strlen($tags) > 0)
		{
			$where1[] = " (tags like '%".$tags."%')";			
		}

		$wherestr = implode(" and ",$where1);		
		
		$prods = DB::query(Database::SELECT, 'SELECT ss_news.id FROM ss_news WHERE category_id = '.$cat.' and enabled=1 and '.$wherestr)->execute()->as_array();
		$pa = array();
		foreach ($prods as $prod)
		{
			$pa[] = $prod['id'];
		}
		$pa[] = -1;
		
		return $pa;
	}



public function getbest($role) {
	$experts = DB::query(Database::SELECT,"SELECT ss_users.id FROM ss_users WHERE role=".$role)->execute()->as_array();
	$elist[] = 0;
	foreach ($experts as $i=>$v) {
		$elist[] = $v['id'];
	}
	$instr = implode(',',$elist);	
	//echo $instr.'<br/>';
	if ($role == 4) {
		$ratings = DB::query(Database::SELECT,"SELECT `expert_id` , avg( `rating` ) as rate 
												FROM `ss_experts`
												WHERE `rating` >0 and `expert_id` in (".$instr.") 
												GROUP BY `expert_id`
												ORDER BY avg( `rating` ) DESC
												LIMIT 0 , 3 ")->execute()->as_array();
	} else {
		$ratings = DB::query(Database::SELECT,"SELECT `user_id` as expert_id , count( `best` ) as rate
												FROM `ss_feeds`
												WHERE `best` > 0 and `user_id` in (".$instr.") 
												GROUP BY `user_id`
												ORDER BY count( `best` ) DESC
												LIMIT 0 , 3 ")->execute()->as_array();	
													
		//print_r($ratings);											
	}
												
	foreach ($ratings as $i=>$rating)
	{
		$usr = ORM::factory('useratt')->where('user_id','=',$rating['expert_id'])->find();
		$ratings[$i]['udata'] = $usr;
	}	
	
	return $ratings;
}

} // End Common
