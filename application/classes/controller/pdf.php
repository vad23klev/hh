<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Pdf extends Controller {
	
	public $template = 'pdf';
	
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
			require $_SERVER['DOCUMENT_ROOT']."/mpdf/mpdf.php";
			$mpdf = new mPDF();
			$mpdf->debug = true;
			$content = View::factory('pdf/invoice');
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
			
			//var_dump($content);
			
			$html1 = '<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head><style>';
			$mpdf->WriteHTML($html1);
			//echo $html;
			
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/bootstrap/css/bootstrap.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/font-awesome/css/font-awesome.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/animate.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/style.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/style-responsive.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/theme/default.css");			
			$mpdf->WriteHTML($stylesheet,1);

			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/invoice-print.min.css");
			$mpdf->WriteHTML($stylesheet,1);			

			$html1 = '</style>';
			$mpdf->WriteHTML($html1);
			
			$html = $content->render();				
			$mpdf->WriteHTML($html);
			$mpdf->Output( 'invoice'.$id.'.pdf' , 'D' );
			exit;
		}
	}

	public function action_oferta()
    {
		if(!$this->auth->instance()->logged_in())
		{
			return $this->request->redirect('user/register');
		} else {

			require $_SERVER['DOCUMENT_ROOT']."/mpdf/mpdf.php";
			$mpdf = new mPDF();
			$mpdf->debug = true;
			$content = View::factory('pdf/oferta');
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
			
			//var_dump($content);
			
			$html1 = '<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head><style>';
			$mpdf->WriteHTML($html1);
			//echo $html;
			
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/bootstrap/css/bootstrap.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/plugins/font-awesome/css/font-awesome.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/animate.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/style.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/style-responsive.min.css");
			$mpdf->WriteHTML($stylesheet,1);
			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/theme/default.css");			
			$mpdf->WriteHTML($stylesheet,1);

			$stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/css/invoice-print.min.css");
			$mpdf->WriteHTML($stylesheet,1);			

			$html1 = '</style>';
			$mpdf->WriteHTML($html1);
			
			$html = $content->render();				
			$mpdf->WriteHTML($html);
			$mpdf->Output( 'oferta'.$id.'.pdf' , 'D' );
			exit;
			//$this->template->content = $content;
		}
	}	
	
	
	public function action_index()
    {

	}
	
}