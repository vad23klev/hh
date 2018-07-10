<?if (!isset($_GET['success'])):?>
<?$roles = array(4=>'провайдер услуги',5=>'эксперт-консультант',3=>'экспортер/импортер',2=>'администратор')?>
<h2>Мой профиль (<?=$roles[$data->user->role]?>)</h2>

<?if ($data->complete==0):?>
	<strong>Ваш профиль пока не активирован. Для активации профиля Вам необходимо заполнить данные вашего профиля.<br/> <span style="color: #E20000;">*</span> - поля обязательные для заполнения</strong><br/>
<?endif?>
<!--
<?if ($data->user->role ==4 && $data->expert==0) :?>
	<strong>Провайдер услуг - не подтвержден</strong><br/>
<?endif?>
<?if ($data->user->role == 4  && $data->expert==1) :?>
	<strong>Провайдер услуг - подтвержден</strong><br/>
<?endif?>

<?if ($data->user->role == 5 && $data->expert==0) :?>
	<strong>Эксперт-консультант - не подтвержден</strong><br/>
<?endif?>
<?if ($data->user->role == 5  && $data->expert==1) :?>
	<strong>Эксперт-консультант - подтвержден</strong><br/>
<?endif?>
-->

<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>

<?if ($data->user->role ==4 || $data->user->role ==5) :?>
	<?$u2cs = $data->u2cs->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = $data->u2cs->find_all();?>
			<div style="margin-bottom:10px;font-weight:normal"><br/><strong>Сфера деятельности:</strong> <?=$v->cat->name?></div>
			

			<?//if ($u2cs1[0]->id != $v->id):?>	
			<?if ($u2cs1[0]->id != 155):?>
				<strong>Специализация:</strong>
				<ul style="margin-left:-25px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul>				
			<?endif?>			
		<?endif?>		
	<?endforeach?>	
<?endif?>
<br/>

<?if ($data->user->role != 5) :?>

	<script type="text/javascript">
	
	jQuery(function(){
		$(".inn").mask("9999999999");
		$("input[name='phone']").mask("+7 (999) 999-9999");
		$("input[name='phone1']").mask("+7 (999) 999-9999");
	});
	</script>

		<form method="POST" id="jq137" enctype="multipart/form-data">
			<div class="row">
				<div class="cont_form_name">Компания </div>
				<div class="ti">
				<input type="text"  class="fld" name="company"  value="<?if (count($errors)>0) :?><?=$_POST['company']?><?else:?><?=$data->company?><?endif?>">
				</div>
			</div>
			<div class="row">
			<div class="cont_form_name">Логотип <span>*</span></div>
			<div class="ti"><input type="file" name="logo" value=""></div>
					</div>
			
					<?if ($data->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$data->logo)):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$data->logo?>" /></div>
					</div>	
					<?endif?>
			
			<div class="row">	
			<div class="cont_form_name"><?if ($role != 5):?>ИНН<?else:?>Имя пользователя<?endif?> <span>*</span></div>
			<div class="ti">		
			<input type="text" readonly class="fld" name="username"  value="<?if (count($errors)>0) :?><?=$_POST['username']?><?else:?><?=$data->user->username?><?endif?>">
			</div>
			</div>
			

			<?if ($role == 3):?>
						<div class="row">
			<div class="cont_form_name">Вид деятельности <span>*</span></div>
			<div class="ti">
			<?$regions = array('экспортер','импортер')?>
			<select name="export">
				<?foreach ($regions as $s):?>
					<option value="<?=$s?>" <?if ($s==$data->export):?>selected<?endif?>><?=$s?></option>
				<?endforeach?>
			</select>
			
			</div>
			</div>
			<?endif?>
			
			<div class="row">
			<div class="cont_form_name">Краткое наименование <span>*</span></div>
			<div class="ti">
				<input type="text"  class="fld" name="shortname"  value="<?if (count($errors)>0) :?><?=$_POST['shortname']?><?else:?><?=$data->shortname?><?endif?>">
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name">Полное наименование <span>*</span></div>
			<div class="txtar">		
				<textarea name="fullname" ><?if (count($errors)>0) :?><?=$_POST['fullname']?><?else:?><?=$data->fullname?><?endif?></textarea>
			</div>
			</div>
			
					
			
			<br/>
	<div style="clear:both"></div>
			<h2>Адрес</h2>		

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
			
			<div class="cont_form_name">Улица <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="street"  value="<?if (count($errors)>0) :?><?=$_POST['street']?><?else:?><?=$data->street?><?endif?>">
			</div>
					</div>
			<div class="row">
			<div class="cont_form_name">Дом <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="house"  value="<?if (count($errors)>0) :?><?=$_POST['house']?><?else:?><?=$data->house?><?endif?>">
			</div>
			</div>
			<div class="row">
			<div class="cont_form_name">Телефон компании <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="phone1"  value="<?if (count($errors)>0) :?><?=$_POST['phone1']?><?else:?><?=$data->phone1?><?endif?>">
			</div>
			</div>
			<div class="row">
			<div class="cont_form_name">Web-сайт <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="web"  value="<?if (count($errors)>0) :?><?=$_POST['web']?><?else:?><?=$data->web?><?endif?>">
			</div>		
			</div>
			
			<br/>
	<div style="clear:both"></div>
			<h2>Представитель компании</h2>

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
			<div class="cont_form_name">Должность <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="dolz"  value="<?if (count($errors)>0) :?><?=$_POST['dolz']?><?else:?><?=$data->dolz?><?endif?>">
			</div>
			</div>
			<div class="row">		
			
			
			<div class="cont_form_name">E-mail <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="email"  value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
			</div>
					</div>
			<div class="row">
			<div class="cont_form_name">Телефон <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="phone"  value="<?if (count($errors)>0) :?><?=$_POST['phone']?><?else:?><?=$data->phone?><?endif?>">
			</div>
			</div>
			
			<div class="row">
			<div class="cont_form_name"></div>
			<div class="ti">
			<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();"><div>Изменить данные</div></a>
			</div></div>
	</form>
<?else:?>
	<script type="text/javascript">
	
	jQuery(function(){
		$("input[name='phone']").mask("+7 (999) 999-9999");		
	});
	</script>
<form method="POST" id="jq137" enctype="multipart/form-data">
			<input type="hidden" name="company" value="-">
			<input type="hidden" name="shortname" value="-">
			<input type="hidden" name="fullname" value="-">
			<input type="hidden" name="dolz" value="-">
			<input type="hidden" name="street" value="-">
			<input type="hidden" name="house" value="-">
			<input type="hidden" name="phone1" value="-">
			<input type="hidden" name="web" value="-">

	<div class="row">
					
			<div class="cont_form_name"><?if ($role == 4):?>ИНН<?else:?>Имя пользователя<?endif?> <span>*</span></div>
			<div class="ti">		
			<input type="text" readonly class="fld" name="username"  value="<?if (count($errors)>0) :?><?=$_POST['username']?><?else:?><?=$data->user->username?><?endif?>">
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
			<input type="text"  class="fld" name="email"  value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
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
			<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();"><div>Изменить данные</div></a>
			</div></div>
	</form>



<?endif?>

<?else:?>

<h2>Благодарим Вас за регистрацию на сайте НП «ПРОВЭД»!</h2>

На указанный Вами адрес электронной почты отправлено сообщение с информацией с Вашим логином и паролем для доступа в личный кабинет. <br/>
<br/>
<span style="color: #E20000;">Ваш профиль еще не авторизован. Для авторизации Вам необходимо на странице Вашего профиля заполнить все поля, отмеченные как обязательные для заполнения</span>
<br/><br/>
<a href="/user/cabinet">Перейти на страницу Вашего профиля.</a>



<?endif?>
