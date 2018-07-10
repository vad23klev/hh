<h1>Настройки</h1>

<?php

        echo form::open(URL::site()."admin/info",array('method'=>'post'));
		
		print form::hidden("edit","1");
       print "<table class='inpform' width='100%' border='0' cellpadding='4'>";

		print "<tr><td width='200'>";
        print "<b>Название организации: </b>";
        print "</td><td>";
        print form::input('name', $page->name);
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Телефон: </b>";
        print "</td><td>";
        print form::input('phone', $page->phone);
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Телефон 2: </b>";
        print "</td><td>";
        print form::input('phone2', $page->phone2);
        print "</td></tr>";


		print "<tr><td width='200'>";
        print "<b>E-mail: </b>";
        print "</td><td>";
        print form::input('email', $page->email);
        print "</td></tr>";
		print "<tr><td width='200'>";
        print "<b>Ящик для заказов: </b>";
        print "</td><td>";
        print form::input('poll_head', $page->poll_head);
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Адрес: </b>";
        print "</td><td>";
        print form::input('address', $page->address);		
        print "</td></tr>";
		
		print "<tr><td width='200'>";
        print "<b>Рабочее время: </b>";
        print "</td><td>";
		print form::input('worktime', $page->worktime);
        print "</td></tr>";
		
		print "<tr><td width='200'>";
        print "<b>Курс доллара: </b>";
        print "</td><td>";
		print form::input('dollar', $page->dollar);
        print "</td></tr>";
		print "<tr><td width='200'>";
        print "<b>Курс евро: </b>";
        print "</td><td>";
		print form::input('euro', $page->euro);		
        print "</td></tr>";
		print "<tr><td width='200'>";
        print "<b>Текст: </b>";
        print "</td><td>";
		print form::textarea("text1",$page->text1);
        print "</td></tr>";		

		print "<tr><td width='200'>";
        print "<b>Текст 1: </b>";
        print "</td><td>";
		print form::textarea("text2",$page->text2);
        print "</td></tr>";		

		
		?>
	<tr><td>Использовать Captcha</td>
<td>
<?print form::hidden('use_captcha', 0);?>
<input type="checkbox" name="use_captcha" value="1" <?if($page->use_captcha==1):?>checked<?endif?>/>
	</td></tr>
<?		
		print "</table>";
		print form::submit('submit', 'Сохранить изменения');
        print "<br><br>";
        echo form::close();



?>

        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('text1');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

var ckeditor2 = CKEDITOR.replace('text2');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor2, path: '/AjexFileManager/'});

/*var ckeditor3 = CKEDITOR.replace('text3');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor3, path: '/AjexFileManager/'});*/


</script>


