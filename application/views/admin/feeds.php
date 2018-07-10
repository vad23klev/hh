<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>
<h1>Тикеты заявки <?=$prod->name?></h1>

<table width="90%" id="agoods2" cellpadding="10" cellspacing="0">
<tr>
<td width="200px">
Дата
</td>
<td>
Имя
</td>
<td>
Текст
</td>
<td>
Выполнено
</td>

<td width="10%">
Действие
</td>
</tr>
<?foreach($page as $i=>$p):?>
<tr>
<td>
<?=date('d.M.Y H:i:s',$p->cts)?>
</td>
<td>
<?$user = ORM::factory('useratt')->where('user_id','=',$p->user_id)->find()?>
<?=$user->fio?>
</td>

<td>
<?=$p->text?>
</td>

<td>
<?if ($p->enabled==1):?>
<a href="<?=URL::site()?>admin/feeds/?page=<?=$page1?>&cid=<?=$prod->id?>&undone=1&id=<?=$p->id?>&uid=<?=$uid?>">
<span style="color:green">просмотрен</span>
</a>
<?else:?>

<a href="<?=URL::site()?>admin/feeds/?page=<?=$page1?>&cid=<?=$prod->id?>&done=1&id=<?=$p->id?>&uid=<?=$uid?>">
<span style="color:red">не просмотрен</span></a>

<?endif?>

</td>

<td>
	<a href="<?=URL::site()?>admin/feeds/?page=<?=$page1?>&cid=<?=$prod->id?>&del=1&id=<?=$p->id?>&uid=<?=$uid?>" onclick="javascript:return confirm('Вы уверены?')"><img src="<?=URL::site()?>img/del.gif"></a>

<?php		
		
		echo form::close();
?>
</td>
</tr>
<?endforeach?>
</table>
<?php
        echo form::open(URL::site()."admin/feeds?uid=".$prod->id,array('method'=>'POST'));
		print form::hidden("add","1");
		print form::hidden("prod",1);
		print "Добавить тикет";
?><br/>
<textarea name="text" style="width:400px"></textarea><br/>
<?
		print form::submit('submit', 'Сохранить изменения');
		echo form::close();
		print "<br/>";
?>



