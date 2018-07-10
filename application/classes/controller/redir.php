<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Redir extends Controller {
 
    public function action_index()
    {
		//$this->request->redirect('limuzini');
		print_r($_GET);
		$data = $_GET;
		
		$url = '';
		
		if (isset($data['categoryID']))
		{		
			switch ($data['categoryID'])
			{
				case 7:
					$url = "/limuzini";
				break;
				case 75:
					$url = "/limuzini";
				break;
				case 72:
					$url = "/fotogalereya/2006";
				break;				
				case 73:
					$url = "/fotogalereya/2005";
				break;
				case 74:
					$url = "/fotogalereya/2007";
				break;
				case 75:
					$url = "/fotogalereya/2009";
				break;
				case 76:
					$url = "/fotogalereya/2008";
				break;
				case 77:
					$url = "/fotogalereya/2010";
				break;
				case 78:
					$url = "/fotogalereya/2011";
				break;
				case 79:
					$url = "/fotogalereya/2012";
				break;
				case 63:
					$url = "/ukrasheniya/ukrasheniya_iz_iskusstvennih_tsvetov_na_kapot_2315.html";
				break;
				case 64:
					$url = "/ukrasheniya/ukrasheniya_iz_jivih_tsvetov_1314.html";
				break;
				case 65:
					$url = "/ukrasheniya/nakleyki_na_stekla_1313.html";
				break;
				case 71:
					$url = "/limuzini";
				break;			
			}
		}
		
		if (isset($data['productID']))
		{		
			$prod=ORM::factory('product')->where('enabled','=',1)->where('id','=',$data['productID'])->find();
			$url = $prod->parent_chpu."/".$prod->alias.".html";
			if (isset($data['m']))
			{
				$url .= '?m='.$data['m'];
			}
		}
		
		if (isset($data['aux_page']))
		{
			switch ($data['aux_page'])
			{
				case 'aux509':
					$url = 'skidki';
				break;
				case 'aux509_nv':
					$url = 'pravila_konkursa';
				break;
				case 'aux19_1':
					$url = 'kontakti';
				break;
				case 'aux5082':
					$url = 'novosti';
				break;
				case 'aux86':
					$url = 'vakansii';
				break;
				case 'aux21_1':
					$url = 'soveti';
				break;
				case 'aux21_2':
					$url = 'soveti/limuzin_na_romanticheskoe_svidanie_.html';
				break;
				case 'aux21_3':
					$url = 'soveti/limuzin_na_svadbu_.html';
				break;
				case 'aux21_4':
					$url = 'soveti/limuzin_naprokat.html';
				break;
				case 'aux21_5':
					$url = 'soveti/limuzin_dlya_delovih_lyudey.html';
				break;


				case 'aux6001':
					$url = 'ukrasheniya';
				break;
				case 'aux6002':
					$url = 'fotogalereya';
				break;				
			}
		}
		$this->request->redirect($url);
	}

    public function action_register()
    {
	}	

    public function action_cabinet()
    {
	}	
	
	public function action_history()
    {
	}	

	public function action_passlost()
    {
	}	
	
}
