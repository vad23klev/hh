<a href="/admin/goods?<?=$cstr?>&id=<?=$prod->id?>"><?=$prod->name?></a><br/>

<form method="POST" action="<?=URL::site()?>admin/values?<?=$cstr?>&cid=<?=$cid?>">
<table>
<?foreach ($values as $value) :?>
<tr>
<td><?=$value->name?></td>
<td>
<input type="text" name="value[<?=$value->id?>]" value="<?=$value->value?>">
</td>
</tr>
<?endforeach?>
</table>
<input type="submit" >
</form>