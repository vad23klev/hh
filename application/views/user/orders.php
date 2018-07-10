<h1>Ваши заказы:</h1>
<?foreach ($orders as $j=>$order) :?>
<strong>Номер:</strong> <?=$order->id?><br/>
<strong>Дата заказа:</strong> <?=$order->order_time?><br/>
<strong>ФИО:</strong> <?=$order->fio?><br/>
<strong>Телефон:</strong> <?=$order->phone?><br/>
<strong>E-mail:</strong> <?=$order->email?><br/>
<strong>Статус:</strong> <?if ($order->used==0):?>Новый<?endif?><?if ($order->used==1):?>Оплачен<?endif?><?if ($order->used==2):?>Выполнен<?endif?><br/>
<h4>Состав заказа:</h4>
<table cellpadding='4' cellspacing='0' align='left' border='1' width="100%">
<tr>
<td style='padding:4px' width="50px">Артикул</td>
<td style='padding:4px'>Наименование</td>
<td style='padding:4px' width="75px">Магазин</td>                
<td style='padding:4px' width="70px">Количество</td>
<td style='padding:4px' width="70px">Цена</td>
</tr>
<?$q=0;?>
<?$v=0;?>
<?foreach ($prods[$j] as $i=>$prod):?>
	<tr>
<td style='padding:4px'><?=$prod['article']?></td>
<td style='padding:4px'><?=$prod['name']?></td>
<td style='padding:4px'><?=$prod['material']?></td>                
<td style='padding:4px'><?=$prod['n']?></td>
<?$q += $prod['n']?>
<td style='padding:4px'><?=$prod['price']?> руб.</td>
<?$v += $prod['n']*$prod['price']?>
</tr>
<?endforeach?>

</table>
<br/>
<strong>Всего товаров: <span class="price1"><?=$q?> шт.</span> на сумму: <span class="price1"><?=$v?> руб.</span> </strong>
<p>&nbsp;</p>
<?endforeach?>