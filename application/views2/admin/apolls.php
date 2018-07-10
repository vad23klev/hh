<table cellpadding="8" width="100%" id="agoods" border="1" cellspacing="0">
<tr>
<th class="left">Активность</th>
<th class="left">Наименование</th>
<th colspan="2">Действия</th>
</tr>
<?foreach ($prods as $i=>$prod) :?>
<tr>
	<td width="5%"><?=$prod->date?></td>
	<td width="5%"><?if ($prod->enabled==1) :?><font color="green">активен</font><?else:?><font color="ref">неактивен</font><?endif?></td>
	<td valign="top" class="left"><a href="<?=URL::site()?>admin/apolls?page=<?=$page?>&id=<?=$prod->id?>"><?=$prod->name?></a></td>

	<td width="20px">
	<a href="<?=URL::site()?>admin/news?page=<?=$page?>&id=<?=$prod->id?>" ><img src="/img/imgedit.gif" border="0" /></a>
	</td>
	
	<td width="20px">
	<a href="<?=URL::site()?>admin/apolls/?del=1&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><img src="/img/del.gif" border="0" /></a>
	</td>
	</tr>
<?endforeach?>
</table>
<a href="<?=URL::site()?>admin/polls">Добавить новость</a>
<?=$pagination?>