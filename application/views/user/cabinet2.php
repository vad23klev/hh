<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>



<table align="center" cellpadding="6">
<tr>
<td valign="top" style="padding:5px"><h1>Регистрация </h1></td>
</tr><tr>
<td style="padding:15px" align="left">
	<form method="POST">
	<table >
	<tr><td style="padding:3px;vertical-align:middle">ФИО* </td><td style="padding:3px"><input type="text" style="width:180px" class="fld" name="fio" value="<?=$_POST['fio']?>"></td><td></td></tr>
	<tr>
	<td style="padding:3px;vertical-align:middle">E-mail* </td><td style="padding:3px"><input type="text" style="width:180px" class="fld" name="email"  value="<?=$_POST['email']?>"></td>
	</tr><tr>
	<td style="padding:3px;vertical-align:middle">Телефон </td><td style="padding:3px"><input type="text" style="width:180px" class="fld" name="phone"  value="<?=$_POST['phone']?>"></td>
	</tr>
	<tr>
	<td style="padding:3px;vertical-align:middle">День рождения </td>
	<td style="padding:3px">
	
	<input type='text' value='<?=$_POST['birthday']?>' readonly id='birth' class="fld" name='birthday'/>
<img id="f_trigger_a"
			onmouseout="this.style.background=''"
			onmouseover="this.style.background='red';"
			title="Выбрать дату" style="border: 1px solid red; cursor: pointer;"
			src="<?=URL::site()?>public/js/calendar/img.gif"/>

		<script type="text/javascript">
			Calendar.setup({
			inputField : "birth", // id of the input field
			ifFormat : "%Y-%m-%d", // format of the input field
			button : "f_trigger_a", // trigger for the calendar (button ID)
			//align : "Tl", // alignment (defaults to "Bl")
			singleClick : true
		});
		</script>
	
	
	</td>
	<td></td>
	
	
	
	</tr>
	<tr><td style="padding:3px;vertical-align:middle">Логин* </td><td style="padding:3px"><input style="width:180px" type="text" class="fld" name="username"  value="<?=$_POST['username']?>"></td><td></td></tr>
	<tr><td style="padding:3px;vertical-align:middle">Пароль* </td><td style="padding:3px"><input style="width:180px" type="password" class="fld" name="password" ></td>
	</tr><tr>
	<td style="padding:3px;vertical-align:middle">Повторите пароль* </td><td style="padding:3px"><input style="width:180px" type="password" class="fld" name="password_confirm" ></td></tr>
	<tr>
	<td colspan="4" align="center" style="padding:5px">
	<input type="submit" value="Зарегистрироваться" class="redb">
	</td>
	</tr>
	</table>
	
	
	</form>
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</td>
</tr>
</table>

