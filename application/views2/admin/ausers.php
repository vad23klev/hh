<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#dt').dataTable({"aaSorting": [[0, "desc" ]]});
			} );
		</script>



<table cellpadding="4" width="100%">
<tr><td valign="top">

<h1><?=$h1?></h1>
<br/>
<a href="/admin/adduser">Добавить пользователя</a>
<br/>
<br/>

<form method="post" action="/admin/ausers?filter=1">
<table border="0" cellspacing="0" cellpadding="4">
<tr>
<td>
Логин <input type="text" name="username" value="<?=$sess['username']?>" style="width:200px;"/>
</td>
<td>
ФИО <input type="text" name="fio" value="<?=$sess['fio']?>" style="width:200px;"/>
</td>
<td>


</td>

<td>


</td>
<td>





</td>
<td>
<input type="submit" value="искать">

</td>

</tr>
</table>
</form>
<br/>



<div id="demo">
<table border="1" cellspacing="0" width="100%" cellpadding="4"  id="dt">
<thead>
<th>ID</th>
<th>Логин</th>
<th>ФИО</th>
<th>Телефон</th>
<th>E-mail</th>
<th>Статус</th>
<th>Редактировать</th>
</thead>
<tbody>
<?foreach ($users as $user):?>
<tr>
<td align="center"><?=$user['id']?></td><td> <?=$user['username']?></td>
<td align="left" style="padding:5px"><?=$user['fio']?>
<br/>
Компания: <?=$user['company']?>
</td><td>
<?=$user['phone']?>
</td><td>
<?=$user['email']?>
</td>
<td align="center">


<form method="POST" action="/admin/ausers?role">
<input type="hidden" name="id" value="<?=$user['id']?>"/>
<select name="roles">
<?$roles = array(4=>'провайдер услуги',5=>'эксперт-консультант',3=>'экспортер/импортер',2=>'администратор')?>
<?=$roles[$user['role']]?> <?=$user['role']?>
<?foreach ($roles as $i=>$stat):?>
<option <?if ($i==$user['role']):?>selected<?endif?> value="<?=$i?>"><?=$stat?></option>
<?endforeach?>
</select><br/>

<input type="hidden" name="expert" value="0">
<input type="checkbox" name="expert" value="1" <?if ($user['expert']==1):?>checked<?endif?>> Подтвержден<br/>

<input type="submit" value="Поменять">
</form>


</td>
<td align="center">
<a href="/admin/cabinet?user=<?=$user['id']?>">
<img src="/img/imgedit.gif" /></a>

<a href="/admin/ausers/?del=1&id=<?=$user['id']?>" onclick="javascript:return confirm('Вы уверены?')"><img alt="Удалить" src="/img/del.gif" border="0"></a>


</td>
</tr>
<?endforeach?>
</tbody>
</table>
</div>

</td></tr></table>

<?=str_replace("admin","admin/ausers",$pagination)?>