<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller {
 
    public function action_index()
    {
	
		if (!isset($_GET['q'])) {$sval='';} else {$sval = $_GET['q'];}
				
		if (strlen($sval)>0){
			$prods = ORM::factory('product')->where('enabled','=','1')->where('name','like',''.$sval.'%')->or_where('name','like','% '.$sval.'%')->or_where('id','like','%'.$sval.'%')->find_all();
			
			foreach ($prods as $prod)
			{
				echo $prod->name."\n";
			}		
		}
		
	}	
	
    public function action_co_goods()
    {
		if (!isset($_GET['val'])) {$sval='';} else {$sval = $_GET['val'];}
				
		if (strlen($sval)>5){
			$prods = ORM::factory('product')->where('name','like','%'.$sval.'%')->or_where('name','like','% '.$sval.'%')->find_all();
			if (count($prods)>0) {
				foreach ($prods as $prod)
				{
					echo "<input type='checkbox' value='".$prod->id."' name='cg[".$prod->id."]'> ".$prod->name."<br/>";
				}
			}
		} else {echo "Длина строки должна быть от 5 символов";}
	}	
	
	public function action_find()
    {
	
		if (!isset($_GET['q'])) {$sval='';} else {$sval = $_GET['q'];}
				
		if (strlen($sval)>0){
			$prods = ORM::factory('product')->where('enabled','=','1')->where('name','like',''.$sval.'%')->or_where('name','like','% '.$sval.'%')->find_all();
			
			foreach ($prods as $prod)
			{
				echo $prod->name."\n";
			}		
		}
		
	}	
	
	
}
