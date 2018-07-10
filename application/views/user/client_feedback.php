<script>

	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' .pc1').text('');
		$(id + ' .pc').text('');
		if ($(id + ' input[name="password"]').val() != $(id + ' input[name="password_confirm"]').val())
		{
			$(id + ' input[name="password"]').addClass('parsley-error');
			$(id + ' .pc1').text('Поля должны совпадать');

			$(id + ' input[name="password_confirm"]').addClass('parsley-error');
			$(id + ' .pc').text('Поля должны совпадать');			
		}		
		
		$(id + ' input[type="text"]').each(
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


	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' textarea').removeClass('parsley-error');
		
		$(id + ' input[type="text"]').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);

		$(id + ' textarea').each(
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


	function swSubcats(scid) {
		$('.subcat').hide();
		$('input [type="radio"]').removeAttr("checked");
		$('#sc' + scid).show();
		
		$('.subopt').hide();
		$('#so' + scid).show();		
		
	}

	function svs(scid) {
		//alert($('#sc1cc' + scid).prop("checked"));
		if ($('#sc1cc' + scid).prop("checked") == true) {
			$('.subopt1').hide();
			$('#so' + scid).show();		
		} else {
			$('#so' + scid).hide();		
		}	
		
	}	
	
	
</script>

<h1 class="page-header"><?if (intval($_GET['user_id']) == 0):?>Пригласить эксперта<?else:?>Изменить данные консультанта <?=$data->fio?><?endif?></h1>

	<script type="text/javascript">
	
	jQuery(function(){
		$("input[name='phone']").mask("+7 (999) 999-9999");		
	});
	</script>

<?if ($success == 0) :?>	
	<form method="POST" id="jq138" class="form-horizontal" enctype="multipart/form-data" action="/user/client1">	
	<div class="col-md-12" >
	<div class="panel panel-inverse">	
		<div class="col-md-8 m-t-20 m-b-20" >
		
		
	<div style="color:red">
	<?foreach ($errors as $error) :?>
	<?=$error?><br/>
	<?endforeach?>
	</div>	
		
				<div class="form-group">
					<label class="col-md-4 control-label">ФИО <span>*</span></label>
										<div class="col-md-8">
				<input type="hidden"  class="form-control" name="referer" value="<?=$data?>">
				<input type="text"  class="form-control" name="fio" value="<?if (count($errors)>0) :?><?=$_POST['fio']?><?else:?><?=$data->fio?><?endif?>">
				</div>
				</div>
								
				<div class="form-group">
										<label class="col-md-4 control-label">E-mail <span>*</span></label>
										<div class="col-md-8">
				<input type="text"  class="form-control" name="email" <?if (intval($_GET['user_id']) > 0):?>readonly<?endif?>  value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
				</div>
						</div>
						

	<div class="form-group"><label class="col-md-4"></label>
				<div class="col-md-8">
				<input type="submit" class="btn btn-inverse" onclick="return controlform('#jq138');" value="Пригласить" />
				
				</div>
	</div>

						
		</div>		
				
	<div style="clear:both"></div>

	</div>

	</div>	
	</form>
<?else:?>
	
	
	<div class="col-md-12">
			<div class="panel panel-inverse m-t-15">

			    <div class="panel-body">

				<div class="jumbotron m-b-0 text-center">
	<h3>
		Благодарим Вас за приглашение эксперта на сайт НП «ПРОВЭД»!</h3>
<div class="col-md-6" style="margin:0 auto;float:none">
	<p style="text-align:justify">
		<div class="col-md-2" style="font-size:60px;">
		<i class="icon-info"></i></div> 
		<div class="col-md-10"><p style="text-align:justify">На указанный Вами адрес электронной почты отправлено сообщение с предложением.</p> </div>
		<div class="clearfix"></div>

		<!--div class="col-md-2 " style="color:red;font-size:60px;">
		<i class="icon-bulb"></i> </div> 
		<div class="col-md-10"><p style="text-align:justify;color:red">Ваш профиль еще не авторизован. Для авторизации Вам необходимо на странице Вашего профиля заполнить все поля, отмеченные как обязательные для заполнения.</p> </div-->
		
		<div class="col-md-2 " style="color:red;font-size:60px;">
		</div> 
		<div class="col-md-10">
			<a class="btn btn-inverse" style="float:left" href="/user/client1" role="button">Пригласить нового эксперта.</a>
		</div>
		
		<div class="clearfix"></div>
		
</p>
</div>
	<p>
		</p>
</div>

</div></div></div>
	
<?endif?>