<?
		$deliver = ORM::factory('delivery')->find_all();
		$pay = ORM::factory('pay')->find_all();
		$selection = array('-1' =>'-','0' =>'Новый', '1' => 'Принят','2' => 'Оплачен', '3' => 'Выполнен');
?>

<script type="text/javascript">
	function getcity() {
		//alert(document.getElementById("country").value);

		 $.ajax({
			type: "GET",
			url: '/search/co_goods?val=' + document.getElementById("searchname").value,
			dataType: "html",
			timeout: 10000,
			success: modalAJAXsuccess,
			error: modalAJAXerror
		});
	}
	
	function modalAJAXsuccess (data,textStatus)
	{

		$("#cg").html(data);
	}

	function modalAJAXerror (XMLHttpRequest, textStatus, errorThrown)
	{
		//alert(textStatus);
	}
</script>
<?if (strlen($order->id)>0):?>
<h1>Заказ № <?=$order->id?></h1>
<?else:?>
<h1>Новый заказ</h1>
<?endif?>

<a href="<?=URL::Site()?>admin/container?<?=$cstr?>&cid=0">Добавить заказ</a> &nbsp; 
<a href='/index.php/admin/orders?<?=$cstr?>#<?=$order_id?>'>К заказам</a><br/><br/>

<form method='post' action='/admin/container?<?=$cstr?>&cid=<?=$order_id?>'>
<?
		if (strlen($order->id)>0) {
			print form::hidden("order",$order->id);		
			print form::hidden("edit","1");
		} else {
			print form::hidden("order",1);		
			print form::hidden("add","1");		
		}
?>

<table border="1" cellpadding="4" cellspacing="0">
<tr>
<td width="200px">
ФИО:
</td>
<td>
<input type="text" name="fio" value='<?=$order->fio?>' style='width:350px'><br/>
</td>
</tr><tr>
<td>Телефон</td>
<td>
<input type="text" name="phone" value='<?=$order->phone?>' style='width:150px'><br/>
</td>
</tr><tr>
<td>
E-mail
</td>
<td><input type="text" name="email" value='<?=$order->email?>' style='width:150px'></td>
</tr><tr>
<td>Город</td>
<td><input type="text" name="city" value='<?=$order->city?>' style='width:150px'></td>
</tr><tr>
</tr><tr>
<td>Индекс</td>
<td><input type="text" name="zip" value='<?=$order->zip?>' style='width:150px'></td>
</tr><tr>
<td>Адрес</td>
<td>
<textarea name="address" style="width:500px;height:70px;" ><?=$order->address?></textarea></td>
</tr><tr>
<td>Статус</td>
<td><?
        print form::select('used',$selection,$order->used);?></td></tr><tr>
<td>Доставка</td>
<td>	<select name="deliver">
		<option value="0">-</option>
		<?foreach ($deliver as $d) :?>
			<option value="<?=$d->id?>" <?if ($d->id==$order->deliver):?>selected<?endif?>><?=$d->name?> - <?=$d->cost?></option>
		<?endforeach?>
	</select>
	</td></tr><tr>
<td>Стоимость доставки</td>
<td>
<input type="text" name="dprice" value='<?=$order->dprice?>' style='width:150px'><br/>

	</td></tr><tr>

	
<td>Способ оплаты</td>
<td>	<select name="paymode">
		<option value="0">-</option>
		<?foreach ($pay as $d) :?>
			<option value="<?=$d->id?>" <?if ($d->id==$order->paymode):?>selected<?endif?>><?=$d->pay?></option>
		<?endforeach?>
	</select></td></tr><tr>
<td>Комментарий пользователя</td>
<td><textarea name="comment" style="width:500px;height:70px;"><?=$order->comment?></textarea></td></tr><tr>
<td>Комментарий менеджера</td>
<td><textarea name="comment2" style="width:500px;height:70px;" ><?=$order->comment2?></textarea></td>
</tr>
</table>
<input type="submit" value="Сохранить">	
</form>
<br/><br/>
<?if (strlen($order->id)>0):?>
Список товаров к заказу № <?=$order_id?><br/>

<form method='post' action='/admin/container?<?=$cstr?>&cid=<?=$order_id?>'>
<input type='hidden' value='1' name='add'>
<br/>Для добавления товара в заказ введите часть наименования товара<br/>
<input type='text' name='cgname' id='searchname' onkeyup="javascript:getcity();" style="margin-top:10px;"/>
<div id='cg' style="margin-bottom:10px;">
</div>
<?//=$good->co_goods?>
<input type="submit" value="Добавить товары в заказ"/>
</form>
<table width='700px' border='1' cellpadding="4" cellspacing="0" style="margin-top:10px;">
<tr>
<td>
Артикул
</td>
<td>
Наименование
</td>
<td>
Цвет
</td>
<td>
Размер
</td>
<td>
Материал
</td>
<td width="10%">
Цена
</td>
<td width="10%">
Количество
</td>
<td>
Действие
</td>
</tr>
<?foreach ($prods as $p) :?>
<form method='post' action='/admin/container?<?=$cstr?>&cid=<?=$p->order_id?>'>
<tr>
<td>
<?$name = ORM::factory('product')->where('id','=',$p->code)->find()?>
<?=$name->article?></td>
<td>
<input type="hidden" name="id" value="<?=$p->id?>"/>
<input type="hidden" name="edit" value="1"/>

<?$brand = ORM::factory('brand')->where('id','=',$name->brand_id)->find()?>
<?=$name->name?> <?=$brand->name?> 
<?
	$c_array = explode("-",$name->colors);
	$colors = ORM::factory('color')->where('id','in',$c_array)->find_all();
	$s_array = explode("-",$name->sizes);
	$sizes = ORM::factory('size')->where('id','in',$s_array)->find_all();
	$m_array = explode("-",$name->materials);
	$mats = ORM::factory('material')->where('id','in',$m_array)->find_all();
?>

</td>

<td>
<select name="color">
	<option value="0">-</option>
	<?foreach($colors as $color):?>
		<option value="<?=$color->id?>" <?if ($color->id==$p->color):?>selected<?endif?>><?=$color->name?></option>
	<?endforeach?>
</select>
</td>
<td>
<select name="size">
	<option value="0">-</option>
	<?foreach($sizes as $size):?>
		<option value="<?=$size->id?>" <?if ($size->id==$p->size):?>selected<?endif?>><?=$size->name?></option>
	<?endforeach?>
</select>

</td>
<td>
<select name="mat">
	<option value="0">-</option>
	<?foreach($mats as $mat):?>
		<option value="<?=$mat->id?>" <?if ($mat->id==$p->mat):?>selected<?endif?>><?=$mat->name?></option>
	<?endforeach?>	
</select>

</td>


<td>
<input type="text" name="price" value="<?=$p->price?>" style="width:50px;"/>
</td>
<td>
<input type="text" name="q" value="<?=$p->q?>" style="width:20px;"/>
</td>
<td>
<input type="image" src="/img/imgedit.gif" value="submit"/>
<a href='/index.php/admin/container?<?=$cstr?>cid=<?=$order_id?>&id=<?=$p->id?>&del=1&cid=<?=$p->order_id?>'><img src="/img/del.gif" border="0"></a>
</td>


</tr>
</form>
<?endforeach?>
</table>
<?endif?>
        <script type="text/javascript">
/*var ckeditor1 = CKEDITOR.replace('comment');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

var ckeditor2 = CKEDITOR.replace('comment2');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor2, path: '/AjexFileManager/'});

var ckeditor3 = CKEDITOR.replace('address');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor3, path: '/AjexFileManager/'});*/

</script>

<br/><br/>
<a href='/index.php/admin/orders?<?=$cstr?>#<?=$order_id?>'>К заказам</a><br/>