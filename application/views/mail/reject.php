<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<head>

<?require "css.php"?>

</head>
<body>

<p>&nbsp;</p>
<!-- begin page body -->
<table class="body">    
	<tr>
        <td class="center" align="center" valign="top">
            <center>
			
			<table class="row">
                    <tr>
                        <td class="center" align="center">
                            <center>
                                <!-- begin container -->
                                <table class="container content"  style="width:610px">
                                    <tr>
                                        <td class="wrapper"  style="background:white;padding-top:15px;">
                                            <table class="twelwe columns" style="width:100%">
                                                <tr>
                                                    <td style="text-align:left;">
                                                        <img src="http://board.proved-np.org/img/logo.png" style="width:150px;float:left;margin:0 auto" />
 
                                                    </td>
                                                </tr>
                                            </table>											
                                        </td>
                                    </tr>									
									
									
                                </table>
								
                                <!-- end container -->
                            </center>
                        </td>
                    </tr>
                </table>
			
			
                <!-- begin page header -->
                <table class="container content dark-theme">
                    <tr>
                        <td>
                            <!-- begin row -->
                            <table class="row">
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
                                        <table class="twelve columns">
                                            <tr>
                                                <td class="last">
													<h4>Здравствуйте, <strong><?=$user['fio']?> <?=$user['lastname']?> <?=$user['surname']?></strong>!</h4>                                                   
													<p class="m-b-5">
													К сожалению, Ваше предложение отклонено. <br />
<?if($expert->reason != ''):?>
<br /><br />
Причина отказа от услуг: <?=$expert->reason?>
<br /><br />
<?endif?>
													
													
													</p>												
												
                                                </td>
                                            </tr>
											</table>
									</td></tr></table>		
											<table class="divider">&nbsp;</table>
                            <table class="row">
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
											
											<table class="twelve columns">
<tr><td  class="panel">	
<br />
<b>Дата:</b> ( <?=date('d.m.Y H:i',$prod->cts)?>)<br /> 
<b><?=$saletypes1[$prod->sale_type]?></b>: <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?>
<?=$cat->name?><br/>
<b>Тема:</b> <?=$prod->title?><br/>
<b><?=$saletypes[$prod->sale_type]?>:</b> <?=$prod->name?>
<br />

</td></tr>
                                            <tr>
                                                <td>
                                                    <p class="m-t-15 last">Если перейти по ссылке не получается то скопируйте и вставьте ее в адресную строку браузера</p>
                                                </td>
                                            </tr>
											</table>
									</td></tr></table>		
									<table class="divider">&nbsp;</table>
									                            <table class="row">
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
									
											<table class="twelve columns">
		                                            <tr>
                                                <td>
                                                    <p class="last">									
<p>
Данное уведомление сформировано автоматически и не предполагает ответа.
</p>
<p>
Задать интересующие вопросы, сообщить о возникшей проблеме, а также направить Ваши предложения можно написав в службу поддержки Платформы ПРОВЭД по электронной почте info@proved-np.org или отправив сообщение через нашу группу в facebook. </p>
											
											</td>
                                            </tr>
											
                                        </table>
                                    </td>
                                    <!-- end wrapper -->
                                </tr>
                            </table>
                            <!-- end row -->
                            <!-- begin divider -->
                            <table class="divider">&nbsp;</table>
                            <!-- end divider -->
                            <!-- begin row -->
                            <!-- end row -->
                        </td>
                    </tr>
                </table>
                <!-- end page container -->
                
                <!-- begin page footer -->
                <table class="row">
                    <tr>
                        <td class="center" align="center">
                            <center>
                                <!-- begin container -->
                                <table class="container content dark-theme"  style="width:610px">
                                    <tr>
                                        <td class="wrapper"  style="padding-top:15px;">
                                            <table class="twelwe columns">
                                                <tr>
                                                    <td style="text-align:center">
                                                        <img src="http://board.proved-np.org/main/pwhite.png" style="float:none;margin:0 auto" /><br/>
                                                        
												<a href="https://www.facebook.com/provednp">Официальная страница НП ПРОВЭД на Facebook. - 
Присоединяйтесь!</a><br/>
 <br/>
<a href="http://www.linkedin.com/company/non-commercial-partnership-for-foreign-trade-proved-?trk=top_nav_home">Follow us! PROVED Partnership Group Page on LinkedIn.<br/>
Learn more about us - PROVED Partnership Official Page on LinkedIn.</a><br/>
 
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="wrapper"  style="background:white;padding-top:15px;">
                                            <table class="twelwe columns" style="width:100%">
                                                <tr>
                                                    <td style="text-align:left;width:50%">
                                                        
 © 2015. Платформа «ПРОВЭД»
                                                    </td>
 
                                                    <td style="text-align:right;width:50%">
                                                        <a href="">О СЕРВИСЕ</a> &nbsp; <a href="">ПРАВИЛА ПОЛЬЗОВАНИЯ</a> &nbsp; <a href="">ВОЙТИ</a>
 
                                                    </td>
                                                </tr>
                                            </table>											
                                        </td>
                                    </tr>									
									
									
                                </table>
								
                                <!-- end container -->
                            </center>
                        </td>
                    </tr>
                </table>
                <!-- end page footer -->
            </center>
        </td>
    </tr>
</table>
<p></p>
</body></html>