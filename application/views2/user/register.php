<h2>Регистрация </h2>
<script>
	function swSubcats(scid, sc) {
		$(sc).hide();
		$(sc + ' .subcat').hide();
		$(sc + ' #sc' + scid).show();
		$(sc).show();
	}
</script>
<div style="color:red">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>
<h3 class="tooltip" title="Тестовая регистрация">Зарегистрироваться как:</h3>
<div id="tabs">
<ul>
<li><a href="#tabs-1">провайдер услуг</a></li>
<li><a href="#tabs-2">экспортер / импортер</a></li>
<li><a href="#tabs-3">эксперт</a></li>
</ul>
<div id="tabs-1">

	<form method="POST" id="jq1370">
	
		<div class="row">
			<div class="cont_form_name">ФИО <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="fio" value="<?=$_POST['fio']?>">
			</div>
		</div>


		<div class="row">
			<div class="cont_form_name">E-mail <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="email"  value="<?=$_POST['email']?>">
			</div>
		</div>
			
		<div style="clear:both"></div>
				
		<input type="hidden" class="fld" name="expert"  value="4" >

		<div class="ess" >
			<div class="row">
			<div class="cont_form_name">Выберите сферу деятельности: </div>
			
			<div class="ti">
				<select name="c[]" onchange="swSubcats($(this).val(),'#sc1')">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>	
			</div>		

			<div id="sc1" style="display:none">
				<div class="row">
					<div class="cont_form_name"></div>
			
					<div>							
						<?foreach ($cats as $cat):?>
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>								
								<div id="sc<?=$cat->id?>" style="display:none"  class="subcat">
									<div style="margin-bottom:10px">Выберите специализацию:</div>
									<?foreach($subcats as $scc):?>									
										<input type="checkbox" name="c[]" value="<?=$scc->id?>" id="sc1cc<?=$scc->id?>" />
										<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label>
									<?endforeach?>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="cont_form_name">ИНН <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld inn" name="username" style="width:80px" value="<?=$_POST['username']?>">
			</div>
		</div>		
		
		<div class="row">
			<div class="cont_form_name">Пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password_confirm" >
			</div>
		</div>
		<div class="row">
			<div class="cont_form_name">Повторите пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password" >
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name"></div>
			<div class="ti">
		<a class="cont_form_send_butt1" style="width:214px;" href="javascript:void(0);" onclick="javascript:$('#jq1370').submit();"><div>Зарегистрироваться</div></a>
		</div>
		</div>

		<div style="clear:both"></div>
</form>


</div>
<div id="tabs-2">
	<form method="POST" id="jq1371">
	

		
		<div class="row">
			<div class="cont_form_name">ФИО <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="fio" value="<?=$_POST['fio']?>">
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name">E-mail <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="email"  value="<?=$_POST['email']?>">
			</div>
		</div>
			
		<div style="clear:both"></div>
				
		<input type="hidden"  name="expert"  value="1" >
		
		<div class="row">
			<div class="cont_form_name">ИНН <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld inn" style="width:80px" name="username" value="<?=$_POST['username']?>">
			</div>
		</div>
		
		
		<div class="row">
			<div class="cont_form_name">Пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password_confirm" >
			</div>
		</div>
		<div class="row">
			<div class="cont_form_name">Повторите пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password" >
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name"></div>
			<div class="ti">
		<a class="cont_form_send_butt1" style="width:214px;" href="javascript:void(0);" onclick="javascript:$('#jq1371').submit();"><div>Зарегистрироваться</div></a>
		</div>
		</div>

		<div style="clear:both"></div>
</form>
</div>
<div id="tabs-3">
	<form method="POST" id="jq1372">
	

		
		<div class="row">
			<div class="cont_form_name">ФИО <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="fio" value="<?=$_POST['fio']?>">
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name">E-mail <span>*</span></div>
			<div class="ti">		
			<input type="text"  class="fld" name="email"  value="<?=$_POST['email']?>">
			</div>
		</div>
			
		<div style="clear:both"></div>
				
		<input type="hidden" class="fld" name="expert"  value="5">
		

		<div class="ess" >
			<div class="row">
			<div class="cont_form_name">Выберите сферу деятельности: </div>
			
			<div class="ti">
				<select name="c[]" onchange="swSubcats($(this).val(),'#sc2')">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>	
			</div>		

			<div id="sc2" style="display:none">
				<div class="row">
					<div class="cont_form_name"></div>
			
					<div>							
						<?foreach ($cats as $cat):?>
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>								
								<div id="sc<?=$cat->id?>" style="display:none"  class="subcat">
									<div style="margin-bottom:10px">Выберите специализацию:</div>
									<?foreach($subcats as $scc):?>
										<input type="checkbox" name="c[]" value="<?=$scc->id?>" id="sc2cc<?=$scc->id?>" />
										<label class="es1" for="sc2cc<?=$scc->id?>"> <?=$scc->name?></label>
									<?endforeach?>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name">Имя пользователя <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="username" onfocus='$(this).tooltip({my: "left+15 center", at: "right center"});' title='"Имя пользователя" может состоять из любых символов и в дальнейшем будет использоваться как логин для входа в личный кабинет' value="<?=$_POST['username']?>">
			</div>
		</div>		
		<div class="row">
			<div class="cont_form_name">Пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password_confirm" >
			</div>
		</div>
		<div class="row">
			<div class="cont_form_name">Повторите пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password" >
			</div>
		</div>
		
		<div class="row">
			<div class="cont_form_name"></div>
			<div class="ti">
		<a class="cont_form_send_butt1" style="width:214px;" href="javascript:void(0);" onclick="javascript:$('#jq1372').submit();"><div>Зарегистрироваться</div></a>
		</div>
		</div>

		<div style="clear:both"></div>
</form>
</div>


</div>




