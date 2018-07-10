<script>

	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' .pc1').text('');
		$(id + ' .pc').text('');
		/*if ($(id + ' input[name="password"]').val() != $(id + ' input[name="password_confirm"]').val())
		{
			$(id + ' input[name="password"]').addClass('parsley-error');
			$(id + ' .pc1').text('Поля должны совпадать');

			$(id + ' input[name="password_confirm"]').addClass('parsley-error');
			$(id + ' .pc').text('Поля должны совпадать');			
		}*/		
		
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
	

	function outphoto(srcelem,id){
		var files = document.getElementById(srcelem).files[0];
		if (window.File && window.FileReader && window.FileList && window.Blob) {
	  // Only process image files.
			  var reader = new FileReader();

			  // Closure to capture the file information.
			  reader.onload = (function(theFile) {
				return function(e) {					
					cfile = e.target.result;												
					
					if (theFile.type.indexOf('image') > -1) {
						$('#'+id).html('<img src="' + cfile + '" width="180px" />');	
					} else {
						$('#'+id).html(files.name);
					}
					
				};
			  })(files);
			  
			  // Read in the image file as a data URL.
			  reader.readAsDataURL(files);
		} else {						
			$('#'+id).append(files.name);
			//alert('The File APIs are not fully supported in this browser.');
		}
		
	}	
	
</script>

<h1 class="page-header"><?if (intval($_GET['user_id']) == 0):?>Добавить консультанта<?else:?>Изменить данные консультанта <?=$data->fio?><?endif?></h1>

	<script type="text/javascript">
	
	jQuery(function(){
		$("input[name='phone']").mask("+7 (999) 999-9999");		
	});
	</script>

<form method="POST" id="jq138" class="form-horizontal" enctype="multipart/form-data" action="/user/client<?if (intval($_GET['user_id']) > 0):?>?user_id=<?=intval($_GET['user_id'])?><?endif?>">	
<div class="col-md-12" >
<div class="panel panel-inverse">	
	<div class="col-md-8 m-t-20 m-b-20" >
	
	
<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>	
	

			<input type="hidden" name="user_id" value="<?=intval($_GET['user_id'])?>">
			<input type="hidden" name="parent_user_id" value="<?=$parent_id->user_id?>">
			<input type="hidden" name="company" value="<?=$udata->company?>">
			<input type="hidden" name="logo" value="<?=$udata->logo?>">			
			<input type="hidden" name="shortname" value="<?=$udata->shortname?>">
			<input type="hidden" name="fullname" value="-">
			<input type="hidden" name="dolz" value="-">
			<input type="hidden" name="street" value="-">
			<input type="hidden" name="house" value="-">
			<input type="hidden" name="phone1" value="-">
			<input type="hidden" name="web" value="-">
			
			
			<!--div class="form-group">
	<label class="col-md-4 control-label">Пароль <span>*</span></label>
	<div class="col-md-8">
	<input  type="text" class="form-control" name="password_confirm" >
	<div class="pc1"></div>
	</div>
</div>
	<div class="clearfix"></div>
	

			<div class="form-group">
	<label class="col-md-4 control-label">Повторите пароль <span>*</span></label>
	<div class="col-md-8">
	<input  type="text" class="form-control" name="password" >
	<div class="pc"></div>
	</div>
</div-->
	<div class="clearfix"></div>			
			
	
			<div class="form-group">
                <label class="col-md-4 control-label">ФИО <span>*</span></label>
                                    <div class="col-md-8">
			<input type="hidden"  class="form-control" name="role" value="<?=$data->user->role?>">
			<input type="text"  class="form-control" name="fio" value="<?if (count($errors)>0) :?><?=$_POST['fio']?><?else:?><?=$data->fio?><?endif?>">
			</div>
			</div>
							
			<div class="form-group">
                                    <label class="col-md-4 control-label">E-mail <span>*</span></label>
                                    <div class="col-md-8">
			<input type="text"  class="form-control" name="email" <?if (intval($_GET['user_id']) > 0):?>readonly<?endif?>  value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
			</div>
					</div>
					
			<div class="form-group">
                                    <label class="col-md-4 control-label">Телефон <span>*</span></label>
                                    <div class="col-md-8">
			<input type="text"  class="form-control" name="phone"  value="<?if (count($errors)>0) :?><?=$_POST['phone']?><?else:?><?=$data->phone?><?endif?>">
			</div>
			</div>

			<div class="form-group">
                                    <label class="col-md-4 control-label">Регион <span>*</span></label>
                                    <div class="col-md-8">
				<?$regions = ORM::factory('region')->find_all()?>
				<select name="region">
					<?foreach ($regions as $s):?>
						<option value="<?=$s->id?>" <?if ($s->id==$data->region):?>selected<?endif?>><?=$s->name?></option>
					<?endforeach?>
				</select>			
			</div>
			</div>

			<div class="form-group">
            <label class="col-md-4 control-label">Город <span>*</span></label>
                                    <div class="col-md-8">
			<input type="text" class="form-control" name="city"  value="<?if (count($errors)>0) :?><?=$_POST['city']?><?else:?><?=$data->city?><?endif?>">
			</div>
					</div>
					
					

<div class="form-group"><label class="col-md-4"></label>
			<div class="col-md-8">
			<input type="submit" class="btn btn-inverse" onclick="return controlform('#jq138');" value="Сохранить" />
			
			</div>
</div>

					
	</div>
		
			
	

<div class="col-md-4  m-t-20 m-b-20">	<p>&nbsp;</p>

					
					
										<div class="form-group text-center m-t-25">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tdphoto">
						<?if ($data->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$data->photo)):?>
							<img src="/img/uimgs/<?=$data->photo?>?rand=<?=rand()?>" />
						<?endif?>
					
					</td></tr></table></div>
					</div>	
					
					<div class="form-group">
			<div class="col-md-12 text-center">
							<span class="btn btn-inverse fileinput-button  btn-sm">                                    
                                    <span>Загрузить фото</span>
                                    <input name="photo" id="photo" onchange="outphoto('photo','tdphoto');" multiple="" type="file">
                                </span>
			</div>
			</div>


</div>
<div style="clear:both"></div>

</div>

</div>	
</form>