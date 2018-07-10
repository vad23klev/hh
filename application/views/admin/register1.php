<h1>Добавление пользователя </h1>
<br/>
<a href="/admin/ausers">Пользователи</a>
<br/><br/>
<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>

	<form method="POST" id="jq137">
		<div class="cont_form_name">ФИО <span>*</span></div>
		<div class="ti">
		<input type="text"  class="fld" name="fio" value="<?=$_POST['fio']?>">
		</div>
		<div class="cont_form_name">E-mail <span>*</span></div>
		<div class="ti">		
		<input type="text"  class="fld" name="email"  value="<?=$_POST['email']?>">
		</div>
		<div class="cont_form_name">Телефон</div>
		<div class="ti">
		<input type="text"  class="fld" name="phone"  value="<?=$_POST['phone']?>">
		</div>
		<div class="cont_form_name">Компания </div>
		<div class="ti">
		<input type="text"  class="fld" name="company"  value="<?=$_POST['company']?>">
		</div>
		<div class="cont_form_name">Логин <span>*</span></div>
		<div class="ti">
		<input  type="text" class="fld" name="username"  value="<?=$_POST['username']?>">
		</div>
		
		<div class="cont_form_name">Права <span>*</span></div>
		<select name="roles">
		<?$roles = array(1=>'пользователь',3=>'оператор',2=>'администратор')?>
		<?foreach ($roles as $i=>$stat):?>
		<option <?if ($i==$_POST['role']):?>selected<?endif?> value="<?=$i?>"><?=$stat?></option>
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
		
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq137').submit();"><div>Добавить</div></a>
</form>

