<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Invoice extends Controller_Template {
	
	public $template = 'invoice';
	
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
 
       
    }	
	
	public function action_invoice()
    {
		if(!$this->auth->instance()->logged_in())
		{
			return $this->request->redirect('user/register');
		} else {
			$content = View::factory('docs/invoice');
			//$this->template = 'oferta';
			$id = $_GET['id'];
			$expert = ORM::factory('expert')->where('id','=',$id)->find();
			$prod = ORM::factory('product')->where('id','=',$expert->product_id)->find();
			$owner = ORM::factory('useratt')->where('id','=',$prod->user_id)->find();
			$author = ORM::factory('useratt')->where('id','=',$expert->expert_id)->find();
			$jobs = ORM::factory('job')->where('product_id','=',$expert->product_id)->where('expert_id','=',$expert->expert_id)->find_all();
			
			$content->expert = $expert;
			$content->prod = $prod;
			$content->owner = $owner;
			$content->author = $author;
			$content->jobs = $jobs;
			
			$this->template->content = $content;
		}
	}

	public function action_oferta()
    {
		if(!$this->auth->instance()->logged_in())
		{
			return $this->request->redirect('user/register');
		} else {
			$content = View::factory('docs/oferta');
			//$this->template = 'oferta';
			$id = $_GET['id'];
			$expert = ORM::factory('expert')->where('id','=',$id)->find();
			$prod = ORM::factory('product')->where('id','=',$expert->product_id)->find();
			$owner = ORM::factory('useratt')->where('id','=',$prod->user_id)->find();
			$author = ORM::factory('useratt')->where('id','=',$expert->expert_id)->find();
			$jobs = ORM::factory('job')->where('product_id','=',$expert->product_id)->where('expert_id','=',$expert->expert_id)->find_all();
			
			$content->expert = $expert;
			$content->prod = $prod;
			$content->owner = $owner;
			$content->author = $author;
			$content->jobs = $jobs;
			
			$this->template->content = $content;
		}
	}	
	
	
	public function action_index()
    {
		if(!$this->auth->instance()->logged_in())
		{
			return $this->request->redirect('user/register');
		} else {
			$id = $_GET['id'];
			$expert = ORM::factory('expert')->where('id','=',$id)->find();
			$prod = ORM::factory('product')->where('id','=',$expert->product_id)->find();
			$owner = ORM::factory('useratt')->where('id','=',$prod->user_id)->find();
			$author = ORM::factory('useratt')->where('id','=',$expert->expert_id)->find();
			$jobs = ORM::factory('job')->where('product_id','=',$expert->product_id)->where('expert_id','=',$expert->expert_id)->find_all();
			
			$this->template->expert = $expert;
			$this->template->prod = $prod;
			$this->template->owner = $owner;
			$this->template->author = $author;
			$this->template->jobs = $jobs;
		}
	}
	
}