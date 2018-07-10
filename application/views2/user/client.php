
<h2><?if (intval($_GET['user_id']) == 0):?>Добавить консультанта<?else:?>Изменить данные консультанта <?=$data->fio?><?endif?></h2>

	<script type="text/javascript">
	
	jQuery(function(){
		$("input[name='phone']").mask("+7 (999) 999-9999");		
	});
	</script>
	
<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>	
	
<form method="POST" id="jq137" enctype="multipart/form-data" action="/user/client<?if (intval($_GET['user_id']) > 0):?>?user_id=<?=intval($_GET['user_id'])?><?endif?>">
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
			
			
	<div class="row">
					
			<div class="cont_form_name">Имя пользователя <span>*</span></div>
			<div class="ti">		
			<input type="text" class="fld" <?if (intval($_GET['user_id']) > 0):?>readonly<?endif?> name="username"  value="<?if (count($errors)>0) :?><?=$_POST['username']?><?else:?><?=$data->user->username?><?endif?>">
			</div>
			</div>
			
	<div class="row">
		<div class="cont_form_name">Введите пароль <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld w200" name="password" >
		</div>
	</div>	
	
	<div class="row">	
		<div class="cont_form_name">Повторите пароль <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld w200" name="password_confirm" >
		</div>
	</div>				
			
	
	<div class="row">	
			<div class="cont_form_name">ФИО <span>*</span></div>
			<div class="ti">
			<input type="hidden"  class="fld" name="role" value="<?=$data->user->role?>">
			<input type="text"  class="fld" name="fio" value="<?if (count($errors)>0) :?><?=$_POST['fio']?><?else:?><?=$data->fio?><?endif?>">
			</div>
			</div>
			<div class="row">		

			<div class="cont_form_name">Фото <span>*</span></div>
			<div class="ti"><input type="file" name="photo" value=""></div>
			</div>
			
					<?if ($data->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$data->photo)):?>
					<div class="row">		
						<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/uimgs/<?=$data->photo?>" /></div>
					</div>	
					<?endif?>

					
			<div class="row">		
			
			
			<div class="cont_form_name">E-mail <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="email" <?if (intval($_GET['user_id']) > 0):?>readonly<?endif?>  value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
			</div>
					</div>
			<div class="row">
			<div class="cont_form_name">Телефон <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="phone"  value="<?if (count($errors)>0) :?><?=$_POST['phone']?><?else:?><?=$data->phone?><?endif?>">
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name">Регион <span>*</span></div>
			<div class="ti">
			<?$regions = ORM::factory('region')->find_all()?>
			<select name="region">
	<?foreach ($regions as $s):?>
		<option value="<?=$s->id?>" <?if ($s->id==$data->region):?>selected<?endif?>><?=$s->name?></option>
	<?endforeach?>
	</select>
			
			</div>
			</div>
			<div class="row">
			<div class="cont_form_name">Город <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="city"  value="<?if (count($errors)>0) :?><?=$_POST['city']?><?else:?><?=$data->city?><?endif?>">
			</div>
					</div>
			
			<div class="row">
			<div class="cont_form_name"></div>
			<div class="ti">
			<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();"><div>Добавить</div></a>
			</div></div>
	</form>