<?if ($complete==0):?>
<h2>Забыли пароль?</h2>
<form action="" method="POST" id="jq139">
	<div class="row">
		<div class="cont_form_name">E-mail <span>*</span></div>
		<div class="ti">
		<input type="text" class="text" name="email" value="<?=$_POST['email']?>">
		</div>	
	</div>	
	
	<div class="row">
		<div class="cont_form_name"></div>
		<div class="ti">
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq139').submit();"><div>Выслать пароль</div></a>	
		</div>	
	</div>	
	

</form>

<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
<?else:?>
	<h2>Новый пароль выслан на e-mail, указанный при регистрации</h2>
<?endif?>