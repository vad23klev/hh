<center>
<?php
print form::open_multipart($url."index.php/".$type,array('method'=>'POST'));
?>
<table align="left">
<?if ($id==1):?>
<?php
	print "<tr><td><b>Новая опция</b>\n</td><td>";
		print form::hidden('add', "1");
		print form::hidden('type2', $stype);
		print form::input('name', '','size="70"')."<br/></td>";
		print "</tr><tr><td><b>позиция</b></td><td>";
        
		print form::input('pos', '','size="20"');
		echo "</td></tr>";
?>
<?else:?>
<?php
	    print "<tr><td><b>Редактировать опцию</b>\n</td><td>";
		print form::hidden('edit', "1");
		print form::hidden('id', $page->id);
		print form::hidden('type2', $page->type);
        print form::input('name', $page->name,'size="70"')."<br/></td>";
		print "</tr><tr><td><b>позиция</b></td><td>";	
		print form::input('pos', $page->pos,'size="20"');
		echo "</td></tr>";
?>
<?endif?>
<tr>
<td colspan="2">
<?print form::submit('submit', 'Сохранить изменения');?>
</td>
</tr>
</table>
<br/><br/><br/><br/><br/>
<?php 

echo form::close();?>
</center>

<p style="padding:3px">
<a href="/index.php/admin/subcats?type2=<?=$type2?>&id=1">Добавить опцию</a><br/>
</p>
<ul>
<?foreach ($spages as $page):?>
<li>
<a href="/index.php/admin/subcats?type2=<?=$type2?>&id=<?=$page->id?>"> <?=$page->name?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/index.php/admin/subcats/?del=1&type2=<?=$type2?>&id=<?=$page->id?>"><font color="">x</font></a>
</li>
<?endforeach?>
</ul>