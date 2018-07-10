<div class="white">
<?if (count($prods)>0):?>
<h1>Данные для заказа:</h1>
<div class="order_data">
<form method="post" action="<?=URL::site()?>order/confirm" id="bform" name="bform">


<?foreach ($data as $i=>$v):?>
<input type="hidden" name="<?=$i?>" value="<?=$v?>">
<?endforeach?>

<?$j=0?>
ФИО: <?=$data['fio']?> <br/>
Телефон: <?=$data['phone']?> <br/>
<?if (strlen($data['email'])>1):?>
E-mail: <?=$data['email']?> <br/>
<?endif?>
<?if (strlen($data['city'])>0):?>
Город: <?=$data['city']?> <br/>
<?endif?>
<?if (strlen($data['zip'])>1):?>
Индекс: <?=$data['zip']?> <br/>
<?endif?>
<?if (strlen($data['address'])>1):?>
Адрес: <?=$data['address']?> <br/>
<?endif?>
Способ оплаты: <?=$pay->pay?><br/>
Способ доставки: <?=$del->name?>

<table width="90%" cellspacing="0"><tr>
<td style="text-align:left">
<strong>Наименование</strong>
</td>
<td align="center">
<strong>Цена</strong>
</td>

<td align="center">
<strong>Кол-во</strong>
</td>
<td style="text-align:right">
<strong>Сумма</strong>
</td>
</tr>

<?foreach ($prods as $i=>$v):?>

<tr>
<td  align="left">
<table width="100%" ><tr><td style="border:none">
<strong style="float:left"><a href="/<?=$v['chpu']?>"><?=$v['name']?> <?=$v['brand']?></a>
</strong>
</td><td style="border:none;text-align:right">
<?if (strlen($v['picture'])>0):?>
<a href="/<?=$v['chpu']?>.html" title="<?=$v['name']?>">
	<img src="/imnew.php?type=catalog&small&image=<?=$v['picture']?>" border="0" height="70px"/>
</a>
<?endif?>
</td></tr></table>

</td><td align="center">
<?=$v['article']?>
</td>



<td align="center"  width="50px">
<?=$v['price']?> Р
</td>

<td  align="center" width="40px">

<?=$v['n']?>
</td>
<td  style="text-align:right"  width="50px">
<span class="price"><?=$v['n']*$v['price']?> Р</span>
</td>
<!--td>
<input type="checkbox" name="delete[<?=$v['id']?>]" value="<?=$v['id']?>"/>
</td--></tr>



<?endforeach?>
</table>


<div style="margin:10px;">
<?$sum = 0?>
<?$q = 0?>
<?foreach ($prods as $i=>$v):?>
<?$q += $v['n']?>
<?$sum += $v['n']*$v['price']?>
<?endforeach?>

<strong>Общая сумма товаров:</strong>
<span class="price"><?=$sum?> Р</span>
<br/>

<strong>Стоимость доставки:</strong>
<?if ($del->cost>0):?>
	<?if ($sum<3000):?><?$d=$del->cost?><?else:?><?$d=0?><?endif?>
	<span class="price"><?=$d?> Р</span>
<?else:?>
	Стоимость доставки уточняйте у наших менеджеров
<?endif?>
<br/>

<strong>Итого:</strong>

<?if ($sum<3000):?><?$d=$del->cost?><?else:?><?$d=0?><?endif?>
<span class="price"><?=$sum + $d?> Р</span>
<br/>


								<input type="submit" class="borderaa" value="Подтвердить заказ" style="width:250px">
<a href="<?=URL::site()?>order/form" class="border" style="width:124px;height:20px;margin-bottom:10px;text-align:center;">Изменить данные</a>
<a href="<?=URL::site()?>" class="border" style="width:124px;height:20px;margin-bottom:10px;text-align:center;">Продолжить шопинг</a>
<br/><br/>

</div>



</form>
</div>



<?else:?>
<div class="white">
<h1>Ваша корзина пуста</h1>
</div>
<?endif?>
</div>
