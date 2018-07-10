
<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#dt').dataTable({"aaSorting": [[0, "desc" ]]});
			} );
		</script>

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
function draw_menu($menu,$arr,$dots = 0)
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
			$res2 = "<a href='javascript:void(0);' onclick='javascript:switchElem(\"l".$lm['id']."\",\"c".$lm['id']."\")' id='c".$lm['id']."'>+</a>";
		} else {$res2="";}
		
		$res .= "<table><tr class='grey'><td style='border:none;width:20px;'>&nbsp;".$res2."</td><td width='300px' style='border:none'>".(str_repeat("&nbsp;&nbsp;&nbsp;",$dots))."<a style='color:#008ED7 ' title='редактировать товары группы' href=\"".URL::site()."admin/agoods?c_id=".$lm['id']."\">".$lm['name']."</a></td><td  style='border:none'><a title='редактировать описание группы' href=\"".URL::site()."admin/categories?type=1&id=".$lm['id']."\" ><img  src='/img/imgedit.gif' border='0' /></a> <a href=\"".URL::site()."admin/agoods?cdel=1&id=".$lm['id']."\" onclick=\"javascript:return confirm('Вы уверены?')\"><font color=\"#bd0016\"><img src='/img/del.gif' border='0' /></font></a></td></tr></table>";
		
		//echo " ".in_array();
		//&& in_array($lm['id'],$arr)
		if (count($lm['children'])>0 )
		{
			$dots++;
			$res .= "<div style='display:none' id='l".$lm['id']."'>";
			$res .= draw_menu($lm['children'],$arr,$dots);
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

if (!is_array($sess) || count($sess)==0)
{
	$sess['article']='';
	$sess['price']='';
	$sess['name']='';
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

<table cellpadding="4" width="100%">
<tr><td valign="top">

<h1><?=$h1?></h1>

<?=draw_menu($lmenu,$arr)?>

<a href="/admin/categories?type=1&c_id=<?=$c_id?>">Добавить подгруппу</a> &nbsp; <a href="<?=URL::site()?>admin/goods?page=<?=$page?>&q=<?=$q?>&c_id=<?=$c_id?>">Добавить заявку</a> &nbsp; <a href="/admin/agoods?c_id=0">заявки без группы</a>
<br/><br/>
Путь: <a class="way" href="<?=URL::site()?>admin/agoods?filter=<?=$filter?>&page=0&c_id=-1&q=<?=$q?>">Начало</a> / 
<?foreach ($way as $i=>$w):?>
<a <?if ($i<count($way)-1):?>class="way"<?endif?> href="<?=URL::site()?>admin/agoods?filter=<?=$filter?>&page=0&c_id=<?=$w->id?>&q=<?=$q?>"><?=$w->name?></a> 

<a title='редактировать описание группы' href='/admin/categories?type=1&id=<?=$w->id?>' ><img  src='/img/imgedit.gif' border='0' /></a>
/ 
<?endforeach?>

<!--form method="post" action="/admin/agoods?filter=1">
<tr>
<td width="10px">
</td>
<td>
<input type="text" name="name" value="<?=$sess['name']?>" style="width:100%;"/>
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
</form-->
<div id="demo">

	<table cellpadding="8" width="100%" id="dt" class="display" cellspacing="0">
	<thead>
	<th>ID</th>
	<th>Наименование</th>
	<th>Тикеты</th>
	<th>Статус</th>
	<th>Тип</th>
	<th>Пользователь</th>
	<th>Действия</th>
	</thead>


	<tbody>
	<?foreach ($prods as $i=>$prod) :?>
	<tr>
		<td><?=sprintf("%06d",$prod['id'])?></td>
		<td ><a href="<?=URL::site()?>admin/goods?q=<?=$q?>&c_id=<?=$c_id?>&page=<?=$page?>&id=<?=$prod['id']?>"><?=$prod['title']?></a>
		
		</td>

		<td >
			<?$feeds = ORM::factory('feed')->where('product_id','=',$prod['id'])->find_all()?>
			<a href="/admin/feeds?uid=<?=$prod['id']?>"><?=$feeds->count()?></a>
		</td>
		<td >
		
		<?$stocktype = array('0' =>'На модерации', '2' => 'Открыта', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');?>
		<?=$stocktype[$prod['stock_type']]?>

		</td>
		<td>		<?$saletype = array('0' =>'Заявка', '1' => 'Вопрос');?>
		<?=$saletype[$prod['sale_type']]?></td>
		<td >
			<div style="display:none">
		<?if ($prod['sale_type']==2):?>
	<a href="<?=URL::site()?>admin/agoods?q=<?=$q?>&main=1&c_id=<?=$c_id?>&page=<?=$page?>&id=<?=$prod['id']?>">
	<span style="color:green">Как предмет коллекции</span>
	</a>
	<?else:?>

	<a href="<?=URL::site()?>admin/agoods?q=<?=$q?>&main=2&c_id=<?=$c_id?>&page=<?=$page?>&id=<?=$prod['id']?>">
	<span style="color:red">В каталоге</span></a>

	<?endif?>
		</div>
			<?if ($prod['user_id']==0 && $prod['colors']!='') :?>
				Заявка без регистрации<br/>
				ФИО: <?=$prod['colors']?><br/>
				E-mail: <?=$prod['sizes']?>
			<?elseif ($prod['user_id']>0):?>	
				<?$user=ORM::factory('useratt')->where('user_id','=',$prod['user_id'])->find()?>
				ФИО: <?=$user->fio?><br/>
				Компания: <?=$user->company?>
			<?endif?>
		<!--a href="<?=URL::site()?>admin/values?page=<?=$page?>&q=<?=$q?>&c_id=<?=$c_id?>&cid=<?=$prod['id']?>">Опции</a-->	
		</td>
		
		<td >
		<a href="<?=URL::site()?>admin/goods?filter=<?=$filter?>&page=<?=$page?>&c_id=<?=$c_id?>q=<?=$q?>&c_id=<?=$c_id?>&page=<?=$page?>&id=<?=$prod['id']?>"><img alt="Редактировать" src="/img/imgedit.gif" border="0"></a>
		<a href="<?=URL::site()?>admin/agoods/?filter=<?=$filter?>&page=<?=$page?>&c_id=<?=$c_id?>&del=1&id=<?=$prod['id']?>" onclick="javascript:return confirm('Вы уверены?')"><img alt="Удалить" src="/img/del.gif" border="0"></a>
		</td>
		</tr>
	<?endforeach?>
	</tbody>

	</table>
</div>
</td></tr></table>

