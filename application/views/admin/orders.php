<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>

<?
		$deliver = ORM::factory('delivery')->find_all();

		$pay = ORM::factory('pay')->find_all();
		$selection = array('-1' =>'-','0' =>'Новый', '1' => 'Принят','2' => 'Оплачен', '3' => 'Выполнен');

		//print_r($sess);exit;
if (!is_array($sess) || count($sess)==0)
{
	$sess['ddate2']='';
	$sess['name2']='';
	$sess['phone2']='';
	$sess['email2']='';
	$sess['used2']=-1;
	$sess['paymode2']=0;
	$sess['deliver2']=0;
}

?>
<h1>Заказы</h1>

<a href="<?=URL::Site()?>admin/container?<?=$cstr?>&cid=0">Добавить заказ</a><br/><br/>

<table width="90%" border="1" cellpadding="4" cellspacing="0" id="ordtable">
<tr>
<td>
<b>ID</b>
</td>
<td>
<b>Дата</b>
</td>
<td>
<b>ФИО</b>
</td>
<td>
<b>Телефон</b>
</td>
<td>
<b>E-mail</b></td>
<td>
<b>Статус</b>
</td>
<td>
<b>Товары</b>
</td>
<td>
<b>Доставка</b>
</td>
<!--td>
<b>Отправить</b>
</td-->
<td width="70px">
<b>Итого</b>
</td>

<td colspan="2">&nbsp;
</td>
</tr>
<form method="POST" action="/admin/orders?filter=1">
<tr>
<td>

</td>
<td>
<input type="hidden" name="search" value="1">
<input type="text" name="ddate2" value="" id="ddt" style="width:70px;">


<img id="f_trigger_a"
			onmouseout="this.style.background=''"
			onmouseover="this.style.background='red';"
			title="Выбрать дату" style="border: 1px solid red; cursor: pointer;"
			src="<?=URL::site()?>public/js/calendar/img.gif"/>

		<script type="text/javascript">
			Calendar.setup({
			inputField : "ddt", // id of the input field
			ifFormat : "%d.%m.%Y", // format of the input field
			button : "f_trigger_a", // trigger for the calendar (button ID)
			//align : "Tl", // alignment (defaults to "Bl")
			singleClick : true
		});
		</script>
</td>
<td>
<input type="text" value="" name="name2">
</td>
<td>
<input type="text" value="" name="phone2">
</td>
<td>
<input type="text" value="" name="email2">
</td>
<td>
<?        print form::select('used2',$selection,$sess['used2']);		?>
</td>
	<td>

</td>
<td>

</td>
<td></td>
<td width="70px" colspan="2">
<input type="submit" value="Искать">
</td>

</tr>
</form>

<?foreach($page as $i=>$p):?>
<tr>
<td>
<?=$p['id']?>
</td>
<td width="100px">
<span id=<?=$p['id']?>>
<?=$p['order_time']?>
</span>
</td>
<td>
<?=$p['fio']?>
</td>
<td>
<?=$p['phone']?></td><td>
<?=$p['email']?>
</td>
<td>
<?php

foreach ($selection as $i=>$sel)
{
	if ($i == $p['used'])
	{
		echo $sel;
	}
}
        //print form::select('used',$selection,$p['used']);		
?>
</td>
	
	<td>
	<?$sum=0?>
	<?$q=0?>
<?$container = ORM::factory('container')->where('order_id','=',$p['id'])->find_all()?>
<?foreach ($container as $i=>$pp):?>
<?$q += $pp->q?>
<?$sum += $pp->q*$pp->price?>
<?endforeach?>


	<?=$sum?> руб.
	

	</td>
<td>
<?//$del = ORM::factory('delivery')->where('id','=',$p['deliver'])->find();?>
<?//if ($sum<3000):?>
<?=$p['dprice']?> руб.<br/>
<?//else:?>
<?//endif?>

</td>	
<!--td>
<a href='javascript:void(0)'>ссылку</a>
</td--><td nowrap>
<?//if ($sum<3000):?>
<b><?=$p['dprice']+$sum?> руб.</b>
<?//else:?>

<?//endif?>
<br/>
<?		

		print "</td><td>";
		?>
		<a href='/admin/container?<?=$cstr?>&cid=<?=$p['id']?>'><img src='/img/imgedit.gif' border='0'></a></td><td>
<?		
		//print form::submit('submit', 'Сохранить изменения');
		print "&nbsp;";
		echo form::open(URL::site()."admin/orders?".$cstr,array('method'=>'POST'));
		print form::hidden("del","1");
		print form::hidden("prod",$p['id']);			
		//print form::submit('submit', 'Удалить заказ');
		print "<input type='image' src='/img/del.gif' />";
		
		echo form::close();
?>
</td>
</tr>
<tr>
</tr>

<tr>
</tr>
<?endforeach?>
</table>

Выводить
<a href="<?=URL::site()?>admin/orders?filter=<?=$filter?>&page=<?=$page1?>&q=5" <?if ($items==5):?>style="font-weight:bold"<?endif?>>5</a> 
<a href="<?=URL::site()?>admin/orders?filter=<?=$filter?>&page=<?=$page1?>&q=10" <?if ($items==10):?>style="font-weight:bold"<?endif?>>10</a> 
<a href="<?=URL::site()?>admin/orders?filter=<?=$filter?>&page=<?=$page1?>&q=20" <?if ($items==20):?>style="font-weight:bold"<?endif?>>20</a> 
<a href="<?=URL::site()?>admin/orders?filter=<?=$filter?>&page=<?=$page1?>&q=50" <?if ($items==50):?>style="font-weight:bold"<?endif?>>50</a>

<?=str_replace("admin","admin/orders",$pagination)?>
