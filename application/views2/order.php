
<?if (count($prods)>0):?>
<div id="item_price">
<div style="margin:10px;">
<?$sum = 0?>
<?$q = 0?>
<?foreach ($prods as $i=>$v):?>
<?$q += $v['n']?>
<?$sum += $v['n']*$v['price']?>
<?endforeach?>

<h3>Общая сумма:</h3>
<br/>
<span class="price"><big><?=$sum?> Р</big></span>
<br/>
<small>(сумма товаров указана без учета доставки)</small>
<br/><br/>
<strong class="h33">Товаров в корзине:</strong> <span class="price"><big><?=$q?></big></span>
<br/>

<a href="<?=URL::site()?>order/form"  id="basket_button">Оформить заказ</a><br/>
<a href="<?=URL::site()?>" class="border" style="width:162px;margin-bottom:10px;text-align:center;">Продолжить шопинг</a>
</div>
</div>

<div id="cart">
<form method="post" action="<?=URL::site()?>basket/upd" id="bform" name="bform">
<?$j=0?>
<?foreach ($prods as $i=>$v):?>
<div class="white otstup">
<?$j++?>

<table class="order" border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="30px">
<?if (count($prods)>1):?>
<span class="bignumber"><?=$j?></span>
<?endif?>
</td>
<td width="150px">

<?if (strlen($v['picture'])>0):?>
<a href="/<?=$v['chpu']?>.html" title="<?=$v['name']?>">
	<img src="/imnew.php?type=catalog&small&image=<?=$v['picture']?>" border="0"/>
</a>

<?endif?>
</td>
<td align="left" style="text-align:left">
<h3 style="float:left"><a href="/<?=$v['chpu']?>.html"><?=$v['name']?> <?=$v['brand']?></a></h3>
<?if (strlen($v['article'])>0):?>

<?endif?>
<?if ($v['stock_type']==2):?>
<p style="clear:both"></p>
<small>(для уточнения сроков поступления заказа и доставки с вами свяжется администратор)</small>
<?endif?>
</td>
<td style="text-align:center">
<table align="right"><tr>
<td align="center">
<h3>Цена</h3>
</td>

<td align="center">
<h3>Кол-во</h3>
</td>
<td style="text-align:right">
<h3>Сумма</h3>
</td>
</tr><tr>
<td align="center"  width="90px">
<?=$v['price']?> Р
</td>

<td  align="center" >
<input type="hidden" name="id[<?=$v['id']?>]" value="<?=$v['id']?>">
<div class="border"  style="float:none;margin:0px;width:22px;margin-left:5px;">
<input type="text" name="q[<?=$v['id']?>]" value="<?=$v['n']?>" class="n" style="width:20px;"/>
</div>
</td>
<td  style="text-align:right"  width="90px">
<span class="price"><?=$v['n']*$v['price']?> Р</span>
</td>
<!--td>
<input type="checkbox" name="delete[<?=$v['id']?>]" value="<?=$v['id']?>"/>
</td--></tr></table>

</td><td>

<a href="/basket/upd?del&id=<?=$i?>" onclick="return confirm('Вы уверены?')" class="dele">
Удалить 
</a><br/>

<a href="javascript:void(0);" onclick="javascript:document.forms['bform'].submit();">
Пересчитать
</a>



</td>
</tr>
</table>
</div>
<?endforeach?>

</form>
</div>

<?else:?>
<div class="row">
<h1>Ваша корзина пуста</h1>
</div>
<?endif?>

