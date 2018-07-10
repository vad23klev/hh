<?//if ($cats->enabled!=0):?>

<?
function draw_menu($menu)
{
$res = "<table cellpadding=\"8\" width=\"100%\" id=\"agoods\" style='border:1px solid #666;border-bottom:none' cellspacing=\"0\" style=\"margin-top:10px;\">";
	foreach ($menu as $lm)
	{
		if ($lm['nav_type']==0) {$type = "виртуальная";} elseif($lm['nav_type']==1) {$type = "верхнее меню";} else {$type = "нижнее меню";}
		if ($lm['enabled']==0) {$show = "<font color='red'>не отображать</font>";} else {$show = "<font color='green'>отображать</font>";}

		$res .= "<tr class='grey'><td style='border-bottom:1px solid #666'><a href=\"".URL::site()."admin/categories?id=".$lm['id']."\">".$lm['name']."</a></td><td class='brdr'>".$type."</td><td class='brdr'>".$show."</td><td class='brdr'><a href=\"".URL::site()."admin/categories?id=".$lm['id']."\"><img src='/img/imgedit.gif'></a></td><td width='16px'  class='brdr'>";
		
		if ($lm['sld_pid']==0) {
			$res.="<a href=\"".URL::site()."admin/acategories?del=1&id=".$lm['id']."\" onclick=\"javascript:return confirm('Вы уверены?')\"> <img src='/img/del.gif' /></a>";
		}
		$res .= "</td></tr>";
		
		/*if (count($lm['children'])>0)
		{
			$res .= draw_menu($lm['children']);
		}*/
				
	}
$res .= "</table>";

return $res;
}

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
<h1>Страницы</h1>
<?//exit?>
<table>

<tr><td>
<?=draw_menu($lmenu)?>
<br/>
<br/>
<a style="color:#aeee00;font-size:19px" href="/admin/categories">Добавить страницу</a>


</td></tr></table>