<h1>Новости</h1>

<table cellpadding="8" width="100%" id="agoods2" cellspacing="0">
<tr>
<th class="left">Дата</th>
<th class="left">Активность</th>
<th class="left">Наименование</th>
<th colspan="2">Действия</th>
</tr>
<?foreach ($prods as $i=>$prod) :?>
<tr>
	<td width="100px"><?=$prod->date?></td>
	<td width="100px"><?if ($prod->enabled==1) :?><font color="green">активна</font><?else:?><font color="ref">отключена</font><?endif?></td>
	<td valign="top" class="left"><a href="<?=URL::site()?>admin/news?page=<?=$page?>&id=<?=$prod->id?>"><?=$prod->name?></a></td>

	<td width="20px">
	<a href="<?=URL::site()?>admin/news?page=<?=$page?>&id=<?=$prod->id?>" ><img src="/img/imgedit.gif" border="0" /></a>
	</td>
	
	<td width="20px">
	<a href="<?=URL::site()?>admin/anews/?del=1&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><img src="/img/del.gif" border="0" /></a>
	</td>
	</tr>
<?endforeach?>
</table>
<br/>
<br/>
<a style="color:#aeee00;font-size:19px" href="<?=URL::site()?>admin/news">Добавить новость</a>
<?$pagination = str_replace("/admin","/admin/anews",$pagination)?>
<?=$pagination?>