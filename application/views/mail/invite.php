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
													<h4>Здравствуйте, <strong><?=$fio?></strong>!</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="panel">											
<p class="last">
	Компания "<?=$referer->shortname?>" Вас пригласили для участия в качетсве эксперта. <br/> <a href="http://<?=$_SERVER['HTTP_HOST']?>/user/register?referer=<?=$referer->user_id?>">http://<?=$_SERVER['HTTP_HOST']?>/user/register?referer=<?=$referer->user_id?></a>.</p>
<p class="m-t-15 last">
	Если перейти по ссылке не получается то скопируйте и вставьте ее в адресную строку браузера.</p>
											</td></tr>
											
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
                            <table class="divider">&nbsp;</table>
                            <!-- end divider -->
                            <!-- begin row -->
                            <!-- end row -->
                        </td>
                    </tr>
                </table>
                <!-- end page container -->
                <?require "footer_.php"?>
            </center>
        </td>
    </tr>
</table>
<p></p>
</body></html>