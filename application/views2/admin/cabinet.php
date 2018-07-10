<h1>Личный кабинет </h1>
<br/>
<a href="/admin/ausers">Пользователи</a>
<br/><br/>

<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>


<form method="POST" id="jq137" action="/admin/cabinet?user=<?=$data->id?>">
		<div class="cont_form_name">Компания </div>
		<div class="ti">
		<input type="text"  class="fld" name="company"  value="<?=$data->company?>">
		</div>
		
		<div class="cont_form_name">ИНН <span>*</span></div>
		<div class="ti">		
		<input type="text"  class="fld" name="username"  value="<?=$data->user->username?>">
		</div>

		<div class="cont_form_name">Полное наименование <span>*</span></div>
		<div class="txtar">		
			<textarea style="width:300px;height:100px;" name="fullname"><?=$data->fullname?></textarea>
		</div>

		<div class="cont_form_name">Краткое наименование <span>*</span></div>
		<div class="txtar">
			<textarea style="width:300px;height:100px;" name="shortname"><?=$data->shortname?></textarea>
		</div>
		
		<br/>
<div style="clear:both"></div>
		<h3>Адрес</h3>		

		<div class="cont_form_name">Регион </div>
		<div class="ti">
		<input type="text"  class="fld" name="region"  value="<?=$data->region?>">
		</div>
		
		<div class="cont_form_name">Город </div>
		<div class="ti">
		<input type="text"  class="fld" name="city"  value="<?=$data->city?>">
		</div>		
		
		<div class="cont_form_name">Улица </div>
		<div class="ti">
		<input type="text"  class="fld" name="street"  value="<?=$data->street?>">
		</div>
		
		<div class="cont_form_name">Дом</div>
		<div class="ti">		
		<input type="text"  class="fld" name="house"  value="<?=$data->house?>">
		</div>

		<div class="cont_form_name">Телефон компании</div>
		<div class="ti">		
		<input type="text"  class="fld" name="phone1"  value="<?=$data->phone1?>">
		</div>

		<div class="cont_form_name">Web-сайт</div>
		<div class="ti">		
		<input type="text"  class="fld" name="web"  value="<?=$data->web?>">
		</div>		
		
		
		<br/>
<div style="clear:both"></div>
		<h3>Представитель компании</h3>


		<div class="cont_form_name">ФИО <span>*</span></div>
		<div class="ti">
		<input type="hidden"  class="fld" name="role" value="<?=$data->user->role?>">
		<input type="text"  class="fld" name="fio" value="<?=$data->fio?>">
		</div>

		<div class="cont_form_name">Должность <span>*</span></div>
		<div class="ti">		
		<input type="text"  class="fld" name="dolz"  value="<?=$data->dolz?>">
		</div>
		
		
		<div class="cont_form_name">E-mail <span>*</span></div>
		<div class="ti">		
		<input type="text"  class="fld" name="email"  value="<?=$data->user->email?>">
		</div>
		<div class="cont_form_name">Телефон</div>
		<div class="ti">
		<input type="text"  class="fld" name="phone"  value="<?=$data->phone?>">
		</div>
		
		<?if ($data->user->role==4 || $data->user->role==5):?>
				
		<div id="ess">
			<h3>Укажите категории услуг:</h3>
			<div class="cont_form_name">Категория 1</div>
			<div >
				<select name="c[]">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option <?if ($cs[0]['category_id'] == $cat->id):?>selected<?endif?> value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>

			<div class="cont_form_name">Категория 2</div>
			<div>				
				<select name="c[]">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option <?if ($cs[1]['category_id'] ==$cat->id):?>selected<?endif?> value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>

			</div>

			<div class="cont_form_name">Категория 3</div>
			<div>				
				<select name="c[]">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option <?if ($cs[2]['category_id'] ==$cat->id):?>selected<?endif?> value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>

			</div>

			<div class="cont_form_name">Поставщик услуг подтвержден</div>
			<div class="ti">
			<input type="hidden" value="0"  class="fld" name="expert" />
			<input type="checkbox" value="1"  class="fld" name="expert"  <?if ($data->expert==1):?>checked<?endif?> />
			</div>
			
		</div>
		<?endif?>		
		
		<div class="cont_form_name">Права <span>*</span></div>
		<select name="role">
		<?$roles = array(1=>'пользователь',3=>'оператор',4=>'провайдер услуги',5=>'эксперт-консультант',2=>'администратор')?>
		<?foreach ($roles as $i=>$stat):?>
		<option <?if ($i==$data->user->role):?>selected<?endif?> value="<?=$i?>"><?=$stat?></option>
		<?endforeach?>
		</select>

		
		<div class="cont_form_name">Пароль <span>*</span></div>
		<div class="ti">
		<input  type="password" class="fld" name="password_confirm" >
		</div>
		<div class="cont_form_name">Повторите пароль <span>*</span></div>
		<div class="ti">
		<input  type="password" class="fld" name="password" >
		</div>		
		
		
		
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();"><div>Изменить данные</div></a>
</form>