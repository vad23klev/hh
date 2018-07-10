<?if (strlen($login['name'])>0 && $login['name']!='-1'):?>

<h4>Добро пожаловать, <br/><?=$login['name']?></h4>
<a href="/user/orders">Мои заказы</a><br/>
<a href="/user/cabinet">Личные данные</a><br/>
<a href="/user/logout">Выйти</a><br/>

<?else:?>

<h4>Личный кабинет</h4>
<form method="post" action="/user/login">
<div>
<input type="text" style="width:140px" name="username" class="fld"/><br/>
<table><tr><td>
<input type="password" style="width:105px"  name="password" value="логин" class="fld"/></td>
<td><input type="image" src="/img/login.png" style="margin-top:5px;"/></td>
</tr>
</table>
</div>
</form>
<div style="margin-top:-15px;"><br/>
<a href="/user/forgot">Забыли пароль</a><br/>
<a href="/user/register">Регистрация</a><br/>
</div>

<?endif?>