<script>
function switchElem(elem,link)
{
	$("#"+elem).toggle();
	
	if( $("#"+elem).is(':visible') ) {
    // код для visible
		document.getElementById(link).innerHTML="-";
	}
	else {
		document.getElementById(link).innerHTML="+";
    // код для hidden
	}
}
</script>
<?
function draw_left_menu($menu,$arr,$dots = 0)
{
	$res = "";
//print_r($arr);
	foreach ($menu as $lm)
	{
		if ($lm['category_id']==0 || $lm['category_id']==20)
		{
			$dots=0;
			//$res .= "<table>";
		}		

		if (count($lm['children'])>0 )
		{
			$res2 = "<a href='javascript:void(0);' onclick='javascript:switchElem(\"l1".$lm['id']."\",\"c".$lm['id']."\")' id='c".$lm['id']."'>+</a>";
		} else {$res2="&nbsp;";}
		
		$res .= "<table><tr class='grey'>".(str_repeat("<td width='15px'>&nbsp;</td>",$dots))."<td style='border:none;width:10px;'>".$res2."</td><td width='300px' style='border:none'><a style='color:#008ED7 ' href=\"/admin/categories?id=".$lm['id']."\">".$lm['name']."</a></td></tr></table>";
		
		//echo " ".in_array();
		//&& in_array($lm['id'],$arr)
		if (count($lm['children'])>0 )
		{
			$dots++;
			$res .= "<div style='display:none' id='l1".$lm['id']."'>";
			$res .= draw_left_menu($lm['children'],$arr,$dots);
			$res .= "</div>";
			$dots--;
		}

		if ($lm['category_id']==0 || $lm['category_id']==20)
		{
			//$res .= "</table>";
		}		
		//$res .= "</tr>";
	}

return $res;
}
?>

<?foreach ($nav_types as $i=>$nav_type):?>
<strong><?=$nav_type?></strong><br/>
	<?=draw_left_menu($elems[$i],$arr)?>
<?endforeach?>

