<script>
function switchElem(elem)
{
	$("#"+elem).toggle();	
}
</script>
<?
function draw_left_menu($menu,$arr,$tree,$dots,$active_id,$type)
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
			
			//$res2 = "<a href='javascript:void(0);' onclick='javascript:switchElem(\"l1".$lm['id']."\",\"c".$lm['id']."\")' id='c".$lm['id']."'>+</a>";
		} else {$res2="&nbsp;";}
		
		if ($tree[$dots]!=$lm['id']) {
			$style="color:#666";
		} else {$style="color:#666";}
		
		if ($lm['id']==$active_id)
		{
			$class = "class='active'";
		} else {$class = "";}
		$res .= "<ul ";
		if ($dots==0  && $type!='feeds2') {
			$res .= "class='branch'";
			$res .= "><li class='header'>".(str_repeat("&nbsp;",$dots))."&nbsp;";
		} elseif ($dots>0 && $type != 'text' && count($lm['children'])>0) {
			$res .= "class='branch1'><li class='header'>".(str_repeat("&nbsp;",$dots))."&nbsp;";
		} elseif (count($lm['children'])==0) {
			$res .= "><li>".(str_repeat("&nbsp;",$dots))."&nbsp;";
		}
		
		
		
		
		if (count($lm['children'])==0 )
		{
			$res .= "<a href=\"/admin/categories?id=".$lm['id']."\" ".$class.">".$lm['name']."</a>";
		} elseif ($dots==0) {
			//onclick='javascript:switchElem(\"l1".$lm['id']."\"
			//switchElem(\"l1".$lm['id']."
			$res .= "<a href=\"/admin/categories?id=".$lm['id']."\" ".$class.">".$lm['name']."</a>";
		} else {$res .= "<span class='dashed'>".$lm['name']."</span>";/*onclick='javascript:switchElem(\"l1".$lm['id']."\")';*/}
		

		if ($dots==0 ) {
			$res.="<a href='/admin/categories?type=".$type."&c_id=".$lm['id']."' class='add'>+</a>";
		} else {
			$res.="<a href=\"".URL::site()."admin/acategories?del=1&id=".$lm['id']."\" onclick=\"javascript:return confirm('Вы уверены?')\" class='dele'><img src='/img/del1.png' /></a>";
		}

	
		$res .= "</li></ul>";
		
		
		//echo " ".in_array();
		//&& in_array($lm['id'],$arr)
		if (count($lm['children'])>0 )
		{					
			if ($tree[$dots]==$lm['id']) {
				$res .= "<div style='display:block' id='l1".$lm['id']."'>";
			} else {
				$res .= "<div style='display:block' id='l1".$lm['id']."'>";
				//$res .= "<div style='display:none' id='l1".$lm['id']."'>";
			}
			$dots++;
			$res .= draw_left_menu($lm['children'],$arr,$tree,$dots,$active_id,$type);
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
<p><?=$nav_type?></p>
	<?=draw_left_menu($elems[$i],$arr,$tree,0,$active_id,$i)?>	
<?endforeach?>

