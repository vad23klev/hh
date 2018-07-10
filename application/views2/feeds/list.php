<script>	
	function look()
	{
		jQuery.ajax({
			url      : '/answer/look?search=' + $('#theme').val(),
			type     : 'GET',
			data     : '',
			success  : function(data) {
				//document.getElementById('addme').innerHTML = data;
				document.getElementById('getres').innerHTML = data;
			}, 
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				document.getElementById('getres').innerHTML = textStatus;
				//document.getElementById('addme').innerHTML = textStatus;
			}
		});

	}
</script>
<?
function draw_cats1($cats,$current,$dots = 0)
{
$res = "";

	foreach ($cats as $i=>$lm)
	{
		//echo str_repeat("-",$dots);echo $i;echo $lm['name']."<br/>";
		if ($lm['category_id']==0)
		{
			$dots=0;
		}
		$res .= "<option value='".$i."'";
		
		
		if ($i==$current)
		{
			$res .= 'selected';
		}
		
		$res .= ">".str_repeat("-",$dots).$lm['name']."</option>";
		
		if (count($lm['children'])>0)
		{
			$dots++;
			$res .= draw_cats1($lm['children'],$current,$dots);
			$dots--;
		}
				
	}
return $res;
}
//print_r($menu);
?><?//=draw_cats1($menu,0)?>

<h2>Добавление заявки без регистрации</h2>

<?if ($status==1):?>
	<h2>Заявка успешно добавлена</h2>
<?endif?>

<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>

			<form method="POST" class="form-horizontal" id="jq138" id="altForm" action="" enctype="multipart/form-data">

		<div class="cont_form_name">ФИО <span>*</span></div>
	<div class="ti">
	<input type="text" name="fio" value="<?=$data['fio']?>" value="" maxlength="255"  />
	</div>

		<div class="cont_form_name">E-mail <span>*</span></div>
	<div class="ti">
	<input type="text" name="mail" value="<?=$data['mail']?>" value="" maxlength="255"  />
	</div>
	
			
			
		<div class="cont_form_name">Тема <span>*</span></div>
	<div class="ti">
	<input type="text" id="theme" onchange="javascript:look()" name="name" value="<?=$data['name']?>" value="" maxlength="255"  />
	</div>
			<div class="cont_form_name">Категория заявки <span>*</span></div>
	<div class="ti">
	                    <select class="form-control" id="chosen-list1"  name="cat">
							<option value="0">-</option>
							<?if (strlen($good['id'])>0):?>
								<?=draw_cats1($menu,$good['category_id'])?>
							<?else:?>
								<?=draw_cats1($menu,0)?>
							<?endif?>
                        </select>
	</div>
	<div class="cont_form_name">Вопрос <span>*</span></div>
		<div class="txtar"><textarea name='description'><?=trim($data['description'])?></textarea></div>

	<div class="cont_form_name">Файл </div>
	<div class="ti">
	<input type="file" name="file"  />
	</div>


		
	<div class="cont_form_name">Введите код с картинки <span>*</span></div>
		<div class="ti">
			<input type="text" class="fld" name="captcha" value="" size="38" id="field" tabindex="10">
			<?=$captcha?>
</div>
<div style="clear:both;height:40px"></div>		
		
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq138').submit();"><div>Отправить сообщение</div></a>
</form>
<div style="clear:both"></div>
<br/>
<div id="getres">
</div>