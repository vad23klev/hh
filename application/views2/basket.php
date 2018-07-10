<center>
Товар <span class="blaued"><?=$prod['name']?> <?=$prod['bname']?></span> добавлен в корзину
<table id="basket_table">
<tr>
<?if (strlen($prod['picture'])>0):?>
<td style="text-align:center" valign="middle">

<img src="/imnew.php?type=catalog&small&image=<?=$prod['picture']?>" class="item" alt="<?=$prod['photo_description']?>" title="<?=$prod['photo_description']?>" style="margin-left:-5px;">

</td>

<?endif?>
<?if (count($colors)>0):?>
<tr>
<td valign="middle" class="padded">
<div class="param">
	<div class="basket_heads">Цвет:</div>
	
	<?foreach ($colors as $i=>$color):?>	
	<a href="javascript:void(0);" class='color <?if ($getdata['color']==$color->id):?>ac<?endif?>' id='c<?=$color->id?>' title='<?=$color->name?>' style="background:#<?=$color->rgb?>">
	</a>
	<?endforeach?>
	<div class="clearing"></div>
</div>
</td>
<?endif?>
<?if (count($mats)>0):?>

<td  valign="middle" class="padded">

<div class="param">
	<div class="basket_heads">Материал:</div>
	
	<?foreach ($mats as $i=>$mat):?>	
	<a href="javascript:void(0);" class='border<?if ($getdata['mat']==$mat->id):?>aa<?endif?> mat' title='<?=$mat->name?>' ><?=$mat->name?>
	</a>
	<?endforeach?>
	<div class="clearing"></div>
</div>	
</td>

<?endif?>
</tr><tr>
<?if (count($mats)>0):?>
<td valign="middle" class="padded">
<div class="param">
	<div class="basket_heads">Размер:</div>
	
	<?foreach ($sizes as $i=>$size):?>	
	<a href="javascript:void(0);"  class='border<?if ($getdata['size']==$size->id):?>aa<?endif?> size' title='<?=$size->name?>' > <?=$size->name?>
	</a>&nbsp;
	<?endforeach?>
	
</div>	

</td>
<?endif?>
<td valign="middle" class="padded">
	<?if($prod['in_stock']>0 && $prod['stock_type']==0):?>
		<div class="param">
		<div class="basket_heads">Количество:</div> <a href="javascript:void(0);"  class='borderaa'><?=$getdata['n']?> шт.</a>
		<div class="clearing"></div>
		</div>
		<!--url: "/basket/?flag=" + flag + "&act=" + act + "&id=" + id + "&price=" + price + "&n=" + n,-->
	<?endif?>


</td>
</tr>
</table>
<hr color="#2a8fa5"/>
<br/>
Всего в корзине <span class="blaued"><?=$q?></span> товара на общую сумму <span class="blaued"><?=$sum?></span> руб.
<br/><br/>
<hr color="#2a8fa5"/>
<div >
<a class="borderaa" href="/order/cart" style="width:150px;">Оформить заказ</a>
<a class="borderaa righted" href="javascript:void(0);" onclick="javascript:CloseAll()"  style="width:150px;">Продолжить покупки</a>
</div>
</center>
