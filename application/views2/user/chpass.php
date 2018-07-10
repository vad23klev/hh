<?if (!isset($_GET['success'])):?>
<h2>Смена пароля </h2>

<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>



	<form method="POST" id="jq137">
	
	<div class="row">
		<div class="cont_form_name">Введите<br/> текущий пароль <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld w200" name="password1" >
		</div>
	</div>	
	
	
	<div class="row">
		<div class="cont_form_name">Введите<br/> новый пароль <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld w200" name="password" >
		</div>
	</div>	
	
	<div class="row">	
		<div class="cont_form_name">Повторите ввод нового пароля <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld w200" name="password_confirm" >
		</div>
	</div>	
	<div class="row">	
		<div class="cont_form_name"></div>
		<div class="ti">		
			<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();" style="width:214px"><div>Изменить данные</div></a>
		</div>
	</div>	
</form>
<?else:?>

<h2>Пароль успешно изменен</h2>

<a href="/user/cabinet">Перейти в личный кабинет.</a>



<?endif?>
