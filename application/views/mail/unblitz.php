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
			<?require "header_.php"?>
			
			
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
                                                    <p >Авторизация Вашего профиля на сайте Russia Going Global приостановлена.
<br/>
Просим Вас связаться с администрацией Russia Going Global.<br/><a href="mailto:<?=$mail?>">СВЯЗАТЬСЯ</a></p>												
                                                </td>
                                            </tr>
											</table>
									</td></tr></table>		
	                            <table class="row">
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
									
											<table class="twelve columns">
		                                            <tr>
                                                <td>                                                    <p class="last">									
<p>Данное уведомление сформировано автоматически и не предполагает ответа.</p>
<p>Задать интересующие вопросы, сообщить о возникшей проблеме, а также направить Ваши предложения можно написав в службу поддержки Russia Going Global по электронной почте info@<?=$_SERVER['HTTP_HOST']?>.</p></p>
											
											</td>
                                            </tr>
											
                                        </table>
                                    </td>
                                    <!-- end wrapper -->
                                </tr>
                            </table>
                            <!-- end row -->
                            <!-- begin divider -->
                            <!-- end divider -->
                            <!-- begin row -->
                            <!-- end row -->
                        </td>
                    </tr>
                </table>
                <!-- end page container -->
                
                <!-- begin page footer -->
                <?require "footer_.php"?>
                <!-- end page footer -->
            </center>
        </td>
    </tr>
</table>
<p></p>
</body></html>