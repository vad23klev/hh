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
													<h4>Уважаемый (ая), <strong><?=trim($user['lastname'])?><?=trim($user['surname'])?></strong>!</h4>
                                                    <p class="m-b-5">Ваша заявка на регистрацию принята. Внимательно ознакомьтесь с содержанием этого письма.</p>
													<p >Ваша заявка на регистрацию будет рассмотрена только если Вы заполните все обязательные поля на странице Профиля в Вашем Личном кабинете и предоставите актуальные и достоверные сведения о Вашей компании.</p>
													
													<p >Если Вы не можете заполнить всю форму регистрации за одну сессию, Вы можете сохранить уже введенную информацию, нажав на кнопку &ldquo;Сохранить&rdquo; на соответствующем этапе регистрации, и вернуться к завершению регистрации в любое время позже.</p>
													
													<p>Просим учесть, что переход на следующий этап регистрации не возможен без заполненения всех полей предшествующего этапа.</p>
<p>
	После заполнения всех полей формы регистрации нажмите кнопку &laquo;Отправить на модерацию&raquo;.</p>	
<p>
	Письмо о предоставлении полного доступа к Платформе Вы получите на указанный при регистрации адрес электронной почты (e-mail) после проверки всех данных модератором в течение 5-ти рабочих дней.</p>
<p>
	<strong>Внимание:</strong> При проверке данных модератор может уточнить полученную информацию, связавшись с контактным лицом напрямую, а также имеет право запросить дополнительную информацию.</p>	
													
                                                </td>
                                            </tr>
											</table>
									</td></tr></table>		
											<!--table class="divider">&nbsp;</table-->
                            <table class="row">
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
											
											<table class="twelve columns">
                                            <tr>
                                                <td>
                                                    Ваши авторизационные данные (для входа в Ваш Личный кабинет):   <br/>
												</td></tr><tr><td  class="panel">	
<b>Логин:</b> <?=$user['username']?><br/>
<b>Пароль:</b> <?=$pass?>

<p class="m-t-15 last">
	Чтобы начать работать на платформе, перейдите в личный кабинет по ссылке <a href="http://<?=$_SERVER['HTTP_HOST']?>/user/login">http://<?=$_SERVER['HTTP_HOST']?>/user/login</a>.</p>
<p class="m-t-15 last">
	Если перейти по ссылке не получается то скопируйте и вставьте ее в адресную строку браузера.</p>
</p>
</td></tr>
                                            <!--tr>
                                                <td>
                                                    
                                                </td>
                                            </tr-->
											</table>
									</td></tr><!--/table>		
									                            <table class="row"-->
                                <tr>
                                    <!-- begin wrapper -->
                                    <td class="wrapper">
									
											<table class="twelve columns">
		                                            <tr>
                                                <td>
                                                                                                        <p class="last">									
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
                            <!--table class="divider">&nbsp;</table-->
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