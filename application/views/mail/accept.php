<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<head>

<?require "css.php"?>
<?$saletypes1 = array(0=>'Заявка в сфере',1=>'Вопрос в сфере')?>
<?$saletypes2 = array(0=>'Описание задачи',1=>'Вопрос')?>
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
                                                    <p class="m-b-5">Вы успешно зарегистрировались на сайте Russia Going Global в категории «<?=$role?>».</p>
													<p class="m-b-5">Для получения полного доступа к функционалу Платформы Вам необходимо пройти авторизацию, для чего на странице Профиля в Вашем личном кабинете  необходимо заполнить все поля, отмеченные как обязательные для заполнения и предоставить соответствующие актуальные и достоверные сведения о компании.</p>												
												
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
												
Ваша компания была выбрана для работы с данной задачей.<br />
<br />
<br />
<b>Дата:</b> ( <?=date('d.m.Y H:i',$prod->cts)?>)<br /> 
<b><?=$saletypes1[$prod->sale_type]?></b>: <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?>
<?=$cat->name?><br/>
<b>Тема:</b> <?=$prod->title?><br/>
<b><?=$saletypes2[$prod->sale_type]?>:</b> <?=$prod->name?>
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
