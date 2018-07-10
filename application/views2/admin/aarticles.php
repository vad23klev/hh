<table cellpadding="8" width="100%" id="agoods" border="1" cellspacing="0">
<tr>
<th class="left">Отображать</th>
<th class="left">Наименование</th>
<th>Удалить</th>
</tr>
<?foreach ($prods as $i=>$prod) :?>
<tr>
<td width="5%"><?if ($prod->enabled==1) :?><font color="green">активна</font><?else:?><font color="ref">отключена</font><?endif?></td>	
	<td valign="top" class="left"><a href="<?=URL::site()?>admin/articles?page=<?=$page?>&id=<?=$prod->id?>"><?=$prod->name?></a></td>
	
	<td width="50px">
	<a href="<?=URL::site()?>admin/aarticles/?del=1&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
	</td>
	</tr>
<?endforeach?>
</table>
<a href="<?=URL::site()?>admin/articles">Добавить статью</a>
<?=$pagination?>