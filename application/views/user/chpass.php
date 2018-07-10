
<h1 class="page-header">Смена пароля </h1>


			<div class="col-md-12">
			<div class="panel panel-inverse">

			    <div class="panel-body">

<?if (!isset($_GET['success'])):?>
				
<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>
<script>
	function controlform() {
		var err = 0;
		$('#jq137 input[type="text"]').removeClass('parsley-error');
		$('#pc1').text('');
		$('#pc2').text('');
		if ($('#jq137 input[name="password"]').val() != $('#jq137 input[name="password_confirm"]').val())
		{
			$('#jq137 input[name="password"]').addClass('parsley-error');
			$('#pc1').text('Поля должны совпадать');

			$('#jq137 input[name="password_confirm"]').addClass('parsley-error');
			$('#pc2').text('Поля должны совпадать');			
		}		
		
		$('#jq137 input[type="text"]').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);
	
		if (err == 1) {
			return false;
		} else {
			return true;
		}
	
	}

</script>
<div class="col-md-8" style="float:none;margin:50px auto">

	<form method="POST" id="jq137" class="form-horizontal">
	
	<div class="form-group"><label class="col-md-4 control-label">Введите текущий пароль <span>*</span></label>
			<div class="col-md-4">
								<input maxlength="30" type="text" class="form-control" name="password1" >
								<div class="m-t-5" id="pc20"></div>
			</div>
			</div>
			
<div class="form-group"><label class="col-md-4 control-label">Введите новый пароль <span>*</span></label>
			<div class="col-md-4">
			<input maxlength="30" type="text" class="form-control" name="password" >
			<div class="m-t-5" id="pc2"></div>
			</div>			
			</div>


<div class="form-group"><label class="col-md-4 control-label">Повторите ввод нового пароля <span>*</span></label>
			<div class="col-md-4">
				<input  type="text" maxlength="30" class="form-control" name="password_confirm" >
				<div class="m-t-5" id="pc1"></div>
			</div>
			</div>			
	
				<div class="form-group"><label class="col-md-4"></label>
			<div class="col-md-4">
				<input type="submit" value="Изменить" class="btn btn-inverse" onclick="javascript:return controlform()">
			</div>
			</div>
	
</form>

</div>

<?else:?>
<div class="col-md-6" style="float:none;margin:50px auto">
<h2>Пароль успешно изменен</h2>

<a href="/user/cabinet">Перейти в личный кабинет.</a>

</div>
<?endif?>
</div></div></div>