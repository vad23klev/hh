<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Авторизация для доступа в панель управления</title>
</head>
<body>
<center>
<div style="background:red;"><font color="white"><b>
<?php 
$s=Session::instance(); 
echo $_SESSION['err_str'];
$_SESSION['err_str']="";
?>
</font></b></div><br>
<table>
<tr>
<td align="left">
<?php 

print form::open('http://petersburg4you.com/index.php/admin/checklogin/');
print " Логин: ";
print form::input('login', '');
print "<br>Пароль: ";
print form::password('pass', '');
?>

<br/>Язык:
<select name="lang">
<option value="ru">Русский</option>
<option value="en">Английский</option>
<option value="de">Немецкий</option>
<option value="fr">Французский</option>
<option value="sp">Испанский</option>
</select>

<?php

print "<br>".form::submit('submit', 'Login');

print form::close();

?>
</tr></td></table>
</center>
</body>
</html>
