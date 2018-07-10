<?
function draw_cats($cats,$current,$dots = 0)
{
$res = "";
	foreach ($cats as $lm)
	{
		if ($lm['category_id']==0)
		{
			$dots=0;
		}
		$res .= "<option value='".$lm['id']."'";
		
		
		if ($lm['id']==$current)
		{
			$res .= 'selected';
		}
		
		$res .=">".str_repeat("&nbsp;&nbsp;&nbsp;",$dots).$lm['name']."</option>";
		
		if (count($lm['children'])>0)
		{
			$dots++;
			$res .= draw_cats($lm['children'],$current,$dots);
			$dots--;
		}
				
	}
return $res;
}
?>



<?php
/*						$ct->name = $_POST['name'];
						$ct->sort = $_POST['sort'];
						$ct->category_id = $_POST['cat'];
						$ct->type = $_POST['type'];*/
?>
<table>
<tr><td width="250px" valign="top" style="padding-left:30px">
<ul>
<li><a href="<?=URL::site()?>admin/options">Добавить опцию</a></li>
<?foreach ($lmenu as $lmen) :?>
<?$opts = ORM::factory('option')->where('category_id','=',$lmen['id'])->order_by('sort','ASC')->find_all()?>
<li><?=$lmen['name']?>
<ul style="margin-left:40px">
<?foreach ($opts as $opt) :?>
<li><a href="<?=URL::site()?>admin/options?id=<?=$opt->id?>"><?=$opt->name?></a> <a href="<?=URL::site()?>admin/options?del&id=<?=$opt->id?>"><img src="/img/del.gif"></a></li>
<?endforeach?>
</ul>
</li>
	<?$scats = ORM::factory('categorie')->where('category_id','=',$lmen['id'])->order_by('sort','ASC')->find_all()?>
	<ul>
	<?foreach ($scats as $scat) :?>
	<?$opts = ORM::factory('option')->where('category_id','=',$scat->id)->order_by('sort','ASC')->find_all()?>
<li><?=$scat->name?>
<ul style="margin-left:40px">
<?foreach ($opts as $opt) :?>

<li><a href="<?=URL::site()?>admin/options?id=<?=$opt->id?>"><?=$opt->name?></a> <?if ($role == 2):?><a href="<?=URL::site()?>admin/options?del&id=<?=$opt->id?>"><img src="/img/del.gif"></a><?endif?></li>
<?endforeach?>
</ul>
</li>

	<?endforeach?>	
	</ul>
<?endforeach?>
</ul>
</td><td valign="top">
<form method="POST" action="<?=URL::site()?>admin/options">
<?php
        if ($option->id !=0){
			print form::hidden("opt",$option->id);
            print form::hidden("edit","1");
        } else {			
            print form::hidden("add","1");
        }
?>
<table>
<tr>
<td>Наименование</td>
<td>
<textarea style="width:400px;height:200px" name="name"><?=$option->name?></textarea>
</td>
</tr>
<tr>
<td>Порядок</td>
<td>

<input type="text" name="sort" value="<?=$option->sort?>">
</td>
</tr>
<tr>
<td>Категория</td>
<td>
<select name="cat">

	<?if (strlen($option->id)>0):?>
		<?=draw_cats($lmenu,$option->category_id)?>
	<?else:?>
		<?=draw_cats($lmenu,0)?>
	<?endif?>

</select>
</td>
</tr>
<tr>
<td>Тип</td>
<td>
<?$types=array("1"=>"текст","2"=>"дата","3"=>"телефон")?>
<select name="type">
<?foreach ($types as $i=>$type) :?>
	<option value="<?=$i?>"<?if ($option->type==$i):?>selected<?endif?>><?=$type?></option>
<?endforeach?>
</select>

</td>
</tr>
<tr>
<td>Тип ввода</td>
<td>
<?$types2=array("1"=>"текст","2"=>"селектор (ввод значений через ,)","3"=>"радио (ввод значений через ,)","4"=>"чекбокс (ввод значений через ,)")?>
<select name="type2">
<?foreach ($types2 as $i=>$type) :?>
	<option value="<?=$i?>"<?if ($option->type2==$i):?>selected<?endif?>><?=$type?></option>
<?endforeach?>
</select>

</td>
</tr>

<tr>
<td>Список значений</td>
<td>
<textarea name="values" style="width:600px;height:300px"><?=$option->values?></textarea>
</td>
</tr>

<tr>
<td>Учитывать при заказе</td>
<td>
		<input type="hidden" name="sale" value="0"/>
		<input type="checkbox" name="sale" value="1" <?if($option->sale==1):?>checked<?endif?>/>

</td>
</tr>


</table>
<?if ($role == 2):?>
<input type="submit">
<?endif?>
</form>
</td></tr></table>

