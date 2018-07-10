<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>

<h1>Заказы</h1>
<table width="90%" id="agoods2" cellpadding="10" cellspacing="0">
<tr>
<td width="200px">
Дата
</td>
<td>
Имя
</td>
<td>
Телефон
</td>
<td>
Наименование услуги
</td>



<td>
Комментарий
</td>


<td>
Статус
</td>

<td width="10%">
Действие
</td>
</tr>
<?foreach($page as $i=>$p):?>
<tr>
<td>
<?=$p->date?>
</td>
<td>
<?=$p->fio?>
</td>
<td>
<?=$p->tel?>
</td>
<td>
<?=$p->text?>
</td>

<td>
<?=$p->comment?>
</td>

<td width="100px">
<?if ($p->done==1):?>
<a href="<?=URL::site()?>admin/ofeeds/?page=<?=$page1?>&cid=<?=$prod->id?>&undone=1&id=<?=$p->id?>">
<span style="color:green">выполнен</span>
</a>
<?else:?>

<a href="<?=URL::site()?>admin/ofeeds/?page=<?=$page1?>&cid=<?=$prod->id?>&done=1&id=<?=$p->id?>">
<span style="color:red">не выполнен</span></a>

<?endif?>

</td>


</td>

<td>


<?php
/*        echo form::open(URL::site()."admin/feeds?cid=".$prod->id,array('method'=>'POST'));
		print form::hidden("edit","1");
		print form::hidden("prod",1);
		print "Отображать на сайте";
		print form::checkbox('enabled', '1',$p->enabled);
		print form::submit('submit', 'Сохранить изменения');
		echo form::close();
		print "<br/>";*/
?>
	<a href="<?=URL::site()?>admin/ofeeds/?page=<?=$page1?>&cid=<?=$prod->id?>&del=1&id=<?=$p->id?>" onclick="javascript:return confirm('Вы уверены?')"><img src="<?=URL::site()?>img/del.gif"></a>

<?php		
		
		echo form::close();
?>
</td>
</tr>
<?endforeach?>
</table>