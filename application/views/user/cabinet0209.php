  	<link href="/assets/plugins/isotope/isotope.css" rel="stylesheet" />
  	<link href="/assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
<style>
textarea {resize:vertical}
</style>

<script>

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


	function swSubcats(scid, sc) {
		$(sc).hide();
		$(sc + ' .subcat').hide();
		$(sc + ' #sc' + scid).show();
		$(sc).show();
	}
	
	function swVid() {
		//alert($("#expert").val());
		if ($("#expert").val() != 3 && $("#expert").val() != 6) {
			$('#vid1').show();
			$('#vid2').show();
			
			$('#ved').hide();
		} else {
			$('#vid1').hide();
			$('#vid2').hide();
			if ($("#expert").val() == 3) {
				$('#vedch').text('Выберите экспортируемый товар:');
			} else {
				$('#vedch').text('Выберите импортируемый товар:');
			}
			
			$('#ved').show();
		}
	}
	
	var kpp;
	
	function changeINNmask() {
		if ($('select[name=jur]').val() == 0) {
			kpp = $("input[name=kpp]").val();
			$("input[name=kpp]").val("-");
			$('#kpp').hide();
			$("input[name=inn]").mask("999999999999");
		} else {
			$("input[name=kpp]").val(kpp);
			$('#kpp').show();
			$("input[name=inn]").mask("9999999999");
		}	
	}	

	function proverka(input) {
	    input.value = input.value.replace(/[^\d,]/g, '');
	}
	
	
</script>


	<script>
		$(document).ready(function() {
			$("#expert").change(function(){
				swVid();
			});
		
			$("#nf").click(function(){
				
			})
		
		
			swVid();
		});
	</script>


<?$uc = ORM::factory('u2c')->where('spec','=','355')->where('user_id','=',$data->user_id)->find()?>
<?if ($uc->id > 0) :?>
	<script>
		$(document).ready(function() {
			swSubcats('<?=$uc->category_id?>','#sc1')
		});
	</script>

<?endif?>

<?if (intval($success0) > 0):?>
	<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				setTimeout("$('#change').modal('show')",500);
				/*$.gritter.add({
					text: '',
					<?if ($data->complete == 1) :?>
						title: 'Ваши данные были успешно изменены.',
					<?else:?>	
						title: 'Ваши данные переданы администраторам сайта для проверки и дальнейшей авторизации',
					<?endif?>	
					image: '',
					sticky: true,
					time: 5000,
					class_name: 'my-sticky-class'
				});*/
			}, 1000);									
		});
	</script>
<?endif?>


<?if (intval($success) == 0):?>
<?$roles = array(4=>'провайдер услуги',5=>'эксперт-консультант',3=>'экспортер',2=>'администратор')?>
<h1 class="page-header">Мой профиль <!--(<?=$roles[$data->user->role]?>)--></h1>


                <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-body">
                            <form action="/user/cabinet" enctype="multipart/form-data" method="POST" data-parsley-validate="true" name="form-wizard" class="form-horizontal">
<input type="hidden" name="username" value="<?=$data->user->username?>">
							<div id="wizard">
									<ol>
										<li>
										    Персональная информация 										    
										</li>
										<li>
											Общая информация о компании
										</li>
										<li>
										    Реквизиты компании
										</li>
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Персональная информация</legend>
											<div class="clearfix"></div>
                                            <!-- begin row -->
<?if ($data->complete==0):?>

<div class="note note-danger">
								<h4>Ваш профиль пока не активирован.</h4>
								<p>
								    Для активации профиля Вам необходимо заполнить данные вашего профиля.<br/> <span style="color: #E20000;">*</span> - поля обязательные для заполнения
                                </p>
							</div>

<?endif?>											
											
											
	<div class="col-md-8 nopl">											
	<div class="form-group"><label class="col-md-12">Фамилия <span>*</span></label>
				<div class="col-md-12">
				<?if ($data->complete==1):?><input type="hidden" name="fio" value="<?=$data->fio?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="fio" data-parsley-group="wizard-step-1"  value="<?if (count($errors)>0) :?><?=$_POST['fio']?><?else:?><?=$data->fio?><?endif?>">
				</div>
				</div>

	<div class="form-group">
	<label class="col-md-12">Имя <span>*</span></label>
	<div class="col-md-12">
	<?if ($data->complete==1):?><input type="hidden" name="lastname" value="<?=$data->lastname?>"/><?endif?>
	<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" data-parsley-group="wizard-step-1"  name="lastname" value="<?if (count($errors)>0) :?><?=$_POST['lastname']?><?else:?><?=$data->lastname?><?endif?>">

	</div>
</div>
	<div class="clearfix"></div>	


<div class="form-group">
	<label class="col-md-12">Отчество </label>
	<div class="col-md-12">
	<?if ($data->complete==1):?><input type="hidden" name="surname" value="<?=$data->surname?>"/><?endif?>
	<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="surname" value="<?if (count($errors)>0) :?><?=$_POST['surname']?><?else:?><?=$data->surname?><?endif?>">

	</div>
</div>
	<div class="clearfix"></div>				

	<div class="form-group"><label class="col-md-12">Должность </label>
				<div class="col-md-12">		
				<input type="text"  class="form-control" name="dolz" value="<?if (count($errors)>0) :?><?=$_POST['dolz']?><?else:?><?=$data->dolz?><?endif?>">
				</div>
				</div>			

	<!--div class="form-group"><label class="col-md-12">Телефон </label>
				<div class="col-md-12">
				<input type="text"  class="form-control" id="masked-input-phone"  name="phone" value="<?if (count($errors)>0) :?><?=$_POST['phone']?><?else:?><?=$data->phone?><?endif?>">
				</div>
				</div-->		

	<div class="form-group col-md-12"><label class="col-md-12 nopl">Городской телефон </label>
				<div class="col-md-3 col-sm-3 nopl"><label>Код страны</label>
				</div>
				<div class="col-md-3 col-sm-3 nopl"><label>Код города</label>
				</div>
				<div class="col-md-6 col-sm-6 nopl"><label>Номер телефона</label>
				</div>
				<div class="clearfix"></div>
	
				<div class="col-md-3 col-sm-3 nopl">
				<input type="text" maxlength="4" placeholder="7" class="form-control" onkeyup="return proverka(this);" onchange="return proverka(this);" name="landcode" value="<?if (count($errors)>0) :?><?=$_POST['landcode']?><?else:?><?=$data->landcode?><?endif?>">
				</div>
				<div class="col-md-3 col-sm-3 nopl">
				<input type="text" maxlength="6" placeholder="495" class="form-control" onkeyup="return proverka(this);" onchange="return proverka(this);" name="citycode" value="<?if (count($errors)>0) :?><?=$_POST['citycode']?><?else:?><?=$data->citycode?><?endif?>">
				</div>


				<div class="col-md-6 col-sm-6 nopl">
				<input type="text"  class="form-control" placeholder="3948112" id="masked-input-phone1" onkeyup="return proverka(this);" onchange="return proverka(this);" name="phone" value="<?if (count($errors)>0) :?><?=$_POST['phone']?><?else:?><?=$data->phone?><?endif?>">
				</div>
				</div>

<div class="form-group col-md-12"><label class="col-md-12 nopl">Мобильный </label>
				<div class="col-md-3 col-sm-3 nopl"><label>Код страны</label>
				</div>
				<div class="col-md-3 col-sm-3 nopl"><label>Код&nbsp;оператора</label>
				</div>
				<div class="col-md-6 col-sm-6 nopl"><label>Номер телефона</label>
				</div>
				<div class="clearfix"></div>
	
				<div class="col-md-3 col-sm-3 nopl">
				<input type="text" maxlength="4" placeholder="7" class="form-control" onkeyup="return proverka(this);" onchange="return proverka(this);" name="mlandcode" value="<?if (count($errors)>0) :?><?=$_POST['mlandcode']?><?else:?><?=$data->mlandcode?><?endif?>">
				</div>
				<div class="col-md-3 col-sm-3 nopl">
				<input type="text" maxlength="6" placeholder="495" class="form-control" onkeyup="return proverka(this);" onchange="return proverka(this);" name="mcitycode" value="<?if (count($errors)>0) :?><?=$_POST['mcitycode']?><?else:?><?=$data->mcitycode?><?endif?>">
				</div>


				<div class="col-md-6 col-sm-6 nopl">
				<input type="text"  class="form-control" placeholder="3948112" id="masked-input-phone1" onkeyup="return proverka(this);" onchange="return proverka(this);" name="mphone" value="<?if (count($errors)>0) :?><?=$_POST['mphone']?><?else:?><?=$data->mphone?><?endif?>">
				</div>
				</div>
				

	<div class="form-group"><label class="col-md-12">E-mail</label>
				<div class="col-md-12">		
				<input type="text"  class="form-control" readonly name="email" value="<?if (count($errors)>0) :?><?=$_POST['email']?><?else:?><?=$data->user->email?><?endif?>">
				</div>
						</div>	
	

						
</div>												

<div class="col-md-4" >				
				<div class="form-group text-center m-t-20">
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
										<?if ($data->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$data->photo)):?>
											<span>Изменить фото</span>
										<?else:?>
											<span>Загрузить фото</span>										
										<?endif?>
										<input name="photo" id="photo" onchange="outphoto('photo','tdphoto');" multiple="" type="file">
									</span>
				</div>
			</div>


</div>	
											
				<div class="clearfix"></div>							
							<div class="col-md-12 nopl">
							
<?if ($data->complete == 0) :?>
<input type="submit" name="draft" class="btn btn-inverse btn-sm" value="Сохранить без завершения" />
<?else:?>
<input type="submit" name="complete" class="btn btn-inverse btn-sm" value="Изменить данные" />
<?endif?>
							

</div><div class="clearfix"></div>							
											                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									

									<div class="wizard-step-2">
									
											
									
									
										<fieldset>
										<legend class="pull-left width-full">Общая информация о компании</legend>

											
										
										
<div class="col-md-6" style="padding-left:0px;display:none">
<div class="form-group"><label class="col-md-12">Организационно-правовая форма  <span>*</span></label>
			<div class="col-md-12">
			<?if ($data->complete==1):?><input type="hidden" name="jur" value="<?=$data->jur?>"/><?endif?>
			<?$roles = array(0=>'индивидуальный предприниматель',1=>'юридическое лицо')?>
			<select name="jur" class="form-control" onchange="changeINNmask()" <?if ($data->complete==1):?>disabled<?endif?>>
	<?foreach ($roles as $i=>$s):?>
		<option value="<?=$i?>" <?if ($i == $data->jur):?>selected<?endif?>><?=$s?></option>
	<?endforeach?>
	</select>
			</div>
			</div>
			</div>			
<div class="clearfix"></div>											
										
					
<div class="col-md-6" style="padding-left:0px">										
			<div class="form-group"><label class="col-md-12">Категория пользователя <span>*</span></label>
						<div class="col-md-12">
						<?$roles = array(3=>'экспортер',4=>'провайдер услуг',5=>'эксперт консультант')?>
						<?if ($data->complete==1):?><input type="hidden" name="expert" value="<?=$data->user->role?>"/><?endif?>
						<select id="expert" name="expert" class="form-control" <?if ($data->complete==1):?>disabled<?endif?>>
				<?foreach ($roles as $i=>$s):?>
					<option value="<?=$i?>" <?if ($i == $data->user->role):?>selected<?endif?>><?=$s?></option>
				<?endforeach?>
				</select>
			
			</div>
			</div>
</div>	
<div class="clearfix"></div>		
									
<div id="ved">


<div class="form-group  col-md-10"><label class="col-md-12 nopl">Выберите экспортируемый/импортируемый товар</label>
						

<select name="v[]" class="multiple-select2 form-control" multiple="multiple" <?if ($data->complete==1):?>disabled<?endif?>>
					<?foreach ($veds as $ved):?>
						<optgroup label="<?=$ved->chapter?> <?=$ved->name?>">
							<?$subveds = ORM::factory('ved')->where('ved_id','=',$ved->id)->find_all();?>
							<?foreach($subveds as $scc):?>
								<?
									$sel = "";
									foreach ($u2vs as $u2v) {
										if ($u2v->ved_id == $scc->id)
										{
											$sel = "selected";
										}
										
									}
								
								?>
							
								<option <?=$sel?> value="<?=$scc->id?>"><?=$scc->chapter?> <?=$scc->name?></option>
							<?endforeach?>	
						</optgroup>
					<?endforeach?>
				</select>						
</div>
				


<div class="clearfix"></div>
<div class="col-md-12">	
									
			<div id="sc2" class="" style="display:none">
				<div class="col-md-12" style="padding-left:0px">
						<?foreach ($veds as $ved):?>
							<?$subveds = ORM::factory('ved')->where('ved_id','=',$ved->id)->find_all();?>
							<?if ($subveds->count() > 0) :?>								
								<div id="sc<?=$ved->id?>" style="display:none"  class="subcat col-md-12">
									<div style="margin:10px 0">Выберите специализацию:</div>
									<table class="m-b-20 vd1">
									<?foreach($subveds as $scc):?>									
										<tr><td>
										<?$uc1 = ORM::factory('u2v')->where('ved_id','=',$scc->id)->where('user_id','=',$data->user_id)->find()?>
										<input <?if ($data->complete==1):?>disabled<?endif?> <?if ($uc1->id > 0):?>checked<?endif?> type="checkbox" name="v[]" value="<?=$scc->id?>" id="sc2cc<?=$scc->id?>" />
										</td><td class="p-l-10">
										<label class="es2" style="text-transform:lowercase" for="sc2cc<?=$scc->id?>"> <?=$scc->name?></label><br/>
										</td></tr>
									<?endforeach?>
									</table>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>	
<div class="clearfix"></div>		


</div>
									
										
<div id="vid1">										
<div class="col-md-6" style="padding-left:0px">										
		<div class="form-group" ><label class="col-md-12">Область компетенций:</label>
			<div class="col-md-12">
				<?if ($data->complete==1):?>
					<?foreach ($cats as $cat1):?>
						<input type="hidden" name="c1" value="<?=$uc->category_id?>">
					<?endforeach?>	
				<?endif?>
				<select name="c1" class="form-control" onchange="swSubcats($(this).val(),'#sc1')" <?if ($data->complete==1):?>disabled<?endif?>>
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option <?if ($uc->category_id == $cat->id) :?>selected<?endif?> value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			
			</div>
			
			
		</div>
</div>			

<div id="vid2" class="col-md-6" style="padding-left:0px;position:relative;top:-2px">										
		<div class="form-group" > <label class="col-md-12"> <input style="position:relative;top:2px" <?if ($data->complete==1):?>disabled<?endif?> type="checkbox" id="nf" onclick='$("#nf2").toggle();' <?if ($data->notfound != ''):?>checked<?endif?>> &nbsp; Я не нашел свою область компетенции в списке:</label>
			<div class="col-md-12">
			
			
			<input <?if ($data->complete==1):?>disabled<?endif?> <?if ($data->notfound == ''):?>style="display:none"<?endif?> type="text"  class="form-control" id="nf2" name="notfound" value="<?if (count($errors)>0) :?><?=$_POST['notfound']?><?else:?><?=$data->notfound?><?endif?>">
			
			</div>
			
			
		</div>
</div>			
		
<div class="clearfix"></div>										


<div class="clearfix"></div>
<div class="col-md-6">										
			<div id="sc1" class="">
				<div class="col-md-12" style="padding-left:0px">
						<?foreach ($cats as $cat):?>
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>								
								<div id="sc<?=$cat->id?>" style="display:none"  class="subcat col-md-12">
									<div style="margin:10px 0">Выберите специализацию:</div>
									<table class="m-b-20 vd1">
									<?foreach($subcats as $scc):?>									
										<tr><td>
										<?$uc1 = ORM::factory('u2c')->where('category_id','=',$scc->id)->where('user_id','=',$data->user_id)->find()?>
										<?if ($data->complete==1):?>
											<?if ($uc1->id > 0):?>
												<input type="hidden" name="c[<?=$scc->id?>]" value="1"  />
											<?endif?>	
										<?else:?>	
											
										<?endif?>
										<input <?if ($data->complete==1):?>disabled<?endif?> <?if ($uc1->id > 0):?>checked<?endif?> type="checkbox" name="c[<?=$scc->id?>]" value="1" id="sc1cc<?=$scc->id?>" />
										</td><td class="p-l-10">
										<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label><br/>
										</td></tr>
									<?endforeach?>
									</table>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>			
<div class="clearfix"></div>										
					</div>

<div class="col-md-12 nopl">					
			
<?if ($data->user->role != 5):?>
<div class="form-group"><label class="col-md-12">Краткое описание деятельности <span>*</span><br/><small>(макс. длина поля - 350 символов)</small></label>
<?else:?>
<div class="form-group"><label class="col-md-12">Краткая справка об эксперте <span>*</span><br/><small>(макс. длина поля - 350 символов)</small></label>
<?endif?>
			<div class="col-md-12">		
				<textarea name="opisanie" class="form-control" maxlength="350" data-parsley-group="wizard-step-2"  ><?if (count($errors)>0) :?><?=$_POST['opisanie']?><?else:?><?=$data->opisanie?><?endif?></textarea>
			</div>
			</div> 			
</div>
<div class="clearfix"></div>
			
<div class="col-md-12 nopl">					
			
<?if ($data->user->role != 5):?>
<div class="form-group"><label class="col-md-12">Полное описание <span>*</span><br/><small>(макс. длина поля - 1000 символов)</small></label>

			<div class="col-md-12">		
				<textarea name="opisanie2" class="form-control" maxlength="1000" data-parsley-group="wizard-step-2"  ><?if (count($errors)>0) :?><?=$_POST['opisanie2']?><?else:?><?=$data->opisanie2?><?endif?></textarea>
			</div>
			</div> 			
</div>
<?endif?>
<div class="clearfix"></div>
					
					
<div class="col-md-6" style="display:none">						

		<div class="form-group">
			<label class="col-md-12">Презентация о компании </label>
			<div class="col-md-12 text-left" >
					<table><tr><td style="vertical-align:top">	
							<span class="btn btn-inverse fileinput-button  btn-sm">
									<?if ($data->reg != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/reg/'.$data->reg)):?>
										<span>Изменить</span>
									<?else:?>
										<span>Загрузить</span>
									<?endif?>
                                    <input name="reg" id="reg" onchange="outphoto('reg','tdreg');" type="file">
                                </span>
							</td><td >	
								<div id="tdreg" class="m-l-10 im100">
									<?if ($data->reg != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/reg/'.$data->reg)):?>
										<i class="fa fa-file-text-o fa-2x"></i>
										
										<a class="m-l-5" title="Презентация о компании <?=$data->shortname?>" href="/img/reg/<?=$data->reg?>?rand=<?=rand()?>">											
											Скачать
										</a>	
									<?endif?>
								</div>
							</td></tr></table>	
			</div>
			</div>
</div>



<div class="clearfix"></div>
<?if ($data->user->role != 5):?>
<label class="col-md-12 nopl"><strong>Презентация о компании (загрузите 4 слайда) </strong></label>

<div class="col-md-3">
<div class="form-group">
			

				
					<div class="form-group text-center">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tdreg7">
						<?if ($data->svid != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/svid/'.$data->svid)):?>
							<img src="/img/svid/<?=$data->svid?>?rand=<?=rand()?>"  width="180px"/>
						<?endif?>
					
					</td></tr></table></div>
					</div>
					

			<div class="col-md-12 text-center">							<span class="btn btn-inverse btn-sm fileinput-button">
                                    <?if ($data->svid != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/svid/'.$data->svid)):?>
										<span>Изменить слайд 1</span>
									<?else:?>
										<span>Загрузить слайд 1</span>
									<?endif?>
                                    <input name="svid" id="reg7" onchange="outphoto('reg7','tdreg7');" type="file">
                                </span></div>
					</div>
</div>



<div class="col-md-3">		
<div class="form-group">
			

				
					<div class="form-group text-center">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tdust">
						<?if ($data->ust != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/ust/'.$data->ust)):?>
							<img src="/img/ust/<?=$data->ust?>?rand=<?=rand()?>" width="180px" />
						<?endif?>
					
					</td></tr></table></div>
					</div>
					

			<div class="col-md-12 text-center">							<span class="btn btn-inverse btn-sm fileinput-button">
                                    <?if ($data->ust != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/ust/'.$data->ust)):?>
										<span>Изменить слайд 2</span>
									<?else:?>
										<span>Загрузить слайд 2</span>
									<?endif?>
                                    <input name="ust" id="ust" onchange="outphoto('ust','tdust');" type="file">
                                </span></div>
					</div>
</div>



<div class="col-md-3">		
<div class="form-group">
			

				
					<div class="form-group text-center">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tdegr">
						<?if ($data->egr != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/egr/'.$data->egr)):?>
							<img src="/img/egr/<?=$data->egr?>?rand=<?=rand()?>" width="180px" />
						<?endif?>
					
					</td></tr></table></div>
					</div>
					

			<div class="col-md-12 text-center">							<span class="btn btn-inverse btn-sm fileinput-button">
                                    <?if ($data->egr != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/egr/'.$data->egr)):?>
										<span>Изменить слайд 3</span>
									<?else:?>
										<span>Загрузить слайд 3</span>
									<?endif?>
                                    <input name="egr" id="egr" onchange="outphoto('egr','tdegr');" type="file">
                                </span></div>
					</div>
</div>


<div class="col-md-3">		
<div class="form-group">
			

				
					<div class="form-group text-center">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tddov">
						<?if ($data->dov != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/dov/'.$data->dov)):?>
							<img src="/img/dov/<?=$data->dov?>?rand=<?=rand()?>" width="180px" />
						<?endif?>
					
					</td></tr></table></div>
					</div>
					

			<div class="col-md-12 text-center">							<span class="btn btn-inverse btn-sm fileinput-button">
                                    <?if ($data->dov != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/dov/'.$data->dov)):?>
										<span>Изменить слайд 4</span>
									<?else:?>
										<span>Загрузить слайд 4</span>
									<?endif?>
                                    <input name="dov" id="dov" onchange="outphoto('dov','tddov');" type="file">
                                </span></div>
					</div>
</div>


<div class="clearfix"></div>
<?endif?>

<div class="col-md-6">
<div class="form-group"><label class="col-md-12 nopl">Регион <span>*</span></label>
			<div class="col-md-12 nopl">
			<?$regions = ORM::factory('region')->find_all()?>
			<select name="region" class="form-control" >
	<?foreach ($regions as $s):?>
		<option value="<?=$s->id?>" <?if ($s->id==$data->region):?>selected<?endif?>><?=$s->name?></option>
	<?endforeach?>
	</select>
			
			</div>
			</div>
			
<?if ($data->user->role == 4 || $data->user->role == 5) :?>
<div class="form-group"><label class="col-md-12 nopl">Страна специализации <span>*</span></label>
			<div class="col-md-12 nopl">
<?$lands = explode(";",$data->lands)?>
			<?$regions = ORM::factory('country')->order_by('name','asc')->find_all()?>
			<select name="country[]" class="form-control" >
	<?foreach ($regions as $s):?>
		<option value="<?=$s->id?>" <?if (in_array($s->id, $lands)==1):?>selected<?endif?>><?=$s->name?></option>
	<?endforeach?>
	</select>
			
			</div>
			</div>
<?endif?>


	<div class="form-group"><label class="col-md-12 nopl">Телефон </label>
				<div class="col-md-3 col-sm-3 nopl"><label>Код страны</label>
				</div>
				<div class="col-md-3 col-sm-3 nopl"><label>Код города </label>
				</div>
				<div class="col-md-6 col-sm-6 nopl"><label>Номер телефона</label>
				</div>
				<div class="clearfix"></div>
	
	
				<div class="col-md-3 nopl">
				<input type="text"  class="form-control" maxlength="4" placeholder="7" onkeyup="return proverka(this);" onchange="return proverka(this);"  name="landcode1" value="<?if (count($errors)>0) :?><?=$_POST['landcode1']?><?else:?><?=$data->landcode1?><?endif?>">
				</div>
				<div class="col-md-3 nopl">
				<input type="text"  class="form-control" maxlength="6" placeholder="495" onkeyup="return proverka(this);" onchange="return proverka(this);"  name="citycode1" value="<?if (count($errors)>0) :?><?=$_POST['citycode1']?><?else:?><?=$data->citycode1?><?endif?>">
				</div>


				<div class="col-md-6 nopl">
				<input type="text"  class="form-control" placeholder="3948112"  id="masked-input-phone1" name="phone1" value="<?if (count($errors)>0) :?><?=$_POST['phone1']?><?else:?><?=$data->phone1?><?endif?>">
				</div>
				</div>

<div class="form-group"><label class="col-md-10 nopl">Web-сайт</label>
			<div class="col-md-12 nopl">		
			<input type="text"  class="form-control" placeholder="http://<?=$_SERVER['HTTP_HOST']?>" name="web" value="<?if (count($errors)>0) :?><?=$_POST['web']?><?else:?><?=$data->web?><?endif?>">
			</div>		
			</div>


<div class="form-group"><label class="col-md-12 nopl">Язык</label>
				<div class="col-md-12 nopl">		
					<?$langs = array('русский','английский','немецкий','китайский')?>
				
				<select name="lang" class="form-control" >
					<?foreach ($langs as $lang):?>
						<option value="<?=$lang?>" <?if ($data->lang == $lang):?>selected<?endif?>><?=$lang?></option>
					<?endforeach?>
				</select>
				</div>
						</div>

<div class="form-group"><label class="col-md-12 nopl">Skype</label>
				<div class="col-md-12 nopl">		
				<input type="text"  class="form-control" name="skype" value="<?if (count($errors)>0) :?><?=$_POST['skype']?><?else:?><?=$data->skype?><?endif?>">
				</div>
						</div>						
	
	</div>		

<div class="col-md-6">		
<div class="form-group">
			

				
					<div class="form-group text-center" style="margin-top:20px">
					<label class="col-md-12"></label>
					<div class="imgr"><table><tr><td id="tdlogo">
						<?if ($data->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$data->logo)):?>
							<img src="/img/logos/<?=$data->logo?>?rand=<?=rand()?>" />
						<?endif?>
					
					</td></tr></table></div>
					</div>
					

			<div class="col-md-12 text-center">							<span class="btn btn-inverse btn-sm fileinput-button">
                                    <?if ($data->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$data->logo)):?>
										<span>Изменить логотип</span>
									<?else:?>
										<span>Загрузить логотип</span>
									<?endif?>
                                    <input name="logo" id="logo" onchange="outphoto('logo','tdlogo');" type="file">
                                </span></div>
					</div>
</div>			
		<div class="clearfix"></div>				
<?if ($data->user->role == 5):?>
<div class="row">
	<div class="form-group col-md-6"><label class="col-md-12">Facebook</label>
				<div class="col-md-12" style="padding-right:0px">		
				<input type="text"  class="form-control" name="fb" value="<?if (count($errors)>0) :?><?=$_POST['fb']?><?else:?><?=$data->fb?><?endif?>">
				</div>
						</div>	
	<div class="clearfix"></div>
	
	
		<div class="form-group col-md-6"><label class="col-md-12">LinkedIn</label>
				<div class="col-md-12" style="padding-right:0px">		
				<input type="text"  class="form-control" name="vk" value="<?if (count($errors)>0) :?><?=$_POST['vk']?><?else:?><?=$data->vk?><?endif?>">
				</div>
						</div>	
	<div class="clearfix"></div>
</div>

<div class="col-md-12 nopl">					
<div class="form-group"><label class="col-md-12">Практический опыт и достижения</label>
			<div class="col-md-12">		
				<textarea name="experience" class="form-control" data-parsley-group="wizard-step-2"><?if (count($errors)>0) :?><?=$_POST['experience']?><?else:?><?=$data->experience?><?endif?></textarea>
			</div>
			</div> 			
</div>
<div class="clearfix"></div>
<?endif?>
			
				
							<div class="col-md-12 nopl">
<?if ($data->complete == 0) :?>
<input type="submit" name="draft" class="btn btn-inverse btn-sm" value="Сохранить без завершения" />
<?else:?>
<input type="submit" name="complete" class="btn btn-inverse btn-sm" value="Изменить данные" />
<?endif?>

</div><div class="clearfix"></div>							
                                            <!-- end row -->
                                        </fieldset>
									</div>												
									
									<!-- begin wizard step-2 -->
									<!-- end wizard step-2 -->
									<!-- begin wizard step-3 -->
									<div class="wizard-step-3">
										<fieldset>
											<legend class="pull-left width-full">Реквизиты компании</legend>
                                            <!-- begin row -->
											
<div class="form-group"><label class="col-md-12">Краткое наименование <span>*</span></label>
			<div class="col-md-12">
			<?if ($data->complete==1):?><input type="hidden" name="shortname" value="<?=$data->shortname?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?>  class="form-control" name="shortname" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['shortname']?><?else:?><?=$data->shortname?><?endif?>">
			</div>
			</div>
		
<div class="form-group"><label class="col-md-12">Полное наименование <span>*</span></label>
			<div class="col-md-12">		
			<?if ($data->complete==1):?><input type="hidden" name="fullname" value="<?=$data->fullname?>"/><?endif?>
				<textarea name="fullname" <?if ($data->complete==1):?>disabled<?endif?> class="form-control"  data-parsley-group="wizard-step-3"  ><?if (count($errors)>0) :?><?=$_POST['fullname']?><?else:?><?=$data->fullname?><?endif?></textarea>
			</div>
			</div>                  
              
			
			<div class="form-group"><label class="col-md-12">Фактический адрес <span>*</span></label>
				<div class="col-md-12">
				<?if ($data->complete==1):?><input type="hidden" name="city" value="<?=$data->city?>"/><?endif?>
				<textarea  class="form-control" <?if ($data->complete==1):?>disabled<?endif?> placeholder="Укажите данные фактического с следующем порядке: Индекс, Город, Улица, Дом/корпус, офис" name="city" data-parsley-group="wizard-step-3"   ><?if (count($errors)>0) :?><?=$_POST['city']?><?else:?><?=$data->city?><?endif?></textarea>
				</div>
				</div>
<div class="clearfix"></div>
			
<!--div class="form-group"><label class="col-md-12">Почтовый адрес  <span>*</span> </label>
			<div class="col-md-12" >
				<textarea <?if ($data->city == $data->pa):?>style="display:none"<?endif?> class="form-control" placeholder="Укажите данные фактического с следующем порядке: Индекс, Город, Улица, Дом/корпус, офис"  name="pa" data-parsley-group="wizard-step-3"   ><?if (count($errors)>0) :?><?=$_POST['pa']?><?else:?><?=$data->pa?><?endif?></textarea>

			</div>
			</div-->			
			
<div class="form-group"><label class="col-md-12">Юридический адрес <span>*</span>  ( <input  onclick="$('textarea[name=fa]').toggle();$('textarea[name=fa]').val($('textarea[name=city]').val());" type="checkbox" <?if ($data->city == $data->fa):?>checked<?endif?> name="ffa" class="m3" /> совпадает с фактическим)</label>
			<div class="col-md-12">
				<?if ($data->complete==1):?><input type="hidden" name="fa" value="<?=$data->fa?>"/><?endif?>
				<textarea  class="form-control" <?if ($data->complete==1):?>disabled<?endif?> placeholder="Укажите данные фактического с следующем порядке: Индекс, Город, Улица, Дом/корпус, офис"   <?if ($data->city == $data->fa):?>style="display:none"<?endif?> name="fa" data-parsley-group="wizard-step-3"   ><?if (count($errors)>0) :?><?=$_POST['fa']?><?else:?><?=$data->fa?><?endif?></textarea>
			</div>
			</div>				
			
	<div class="form-group col-md-6"><label class="col-md-12 nopl">ИНН <span>*</span></label>
				
				<?if ($data->complete==1):?><input type="hidden" name="inn" value="<?=$data->inn?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?><?endif?> class="form-control"  data-parsley-group="wizard-step-3"  name="inn" data-parsley-group="wizard-step-5"   value="<?if (count($errors)>0) :?><?=$_POST['inn']?><?else:?><?=$data->inn?><?endif?>">
				
				</div>			
<?if ($data->jur == 1) :?>
	<div class="form-group col-md-6 nopl pull-right" id="kpp"><label class="col-md-12">КПП <span>*</span></label>
				
				<?if ($data->complete==1):?><input type="hidden" name="kpp" value="<?=$data->kpp?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="kpp" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['kpp']?><?else:?><?=$data->kpp?><?endif?>">
				
				</div>
<?endif?>				
	<div class="clearfix"></div>
	
	<div class="form-group col-md-6"><label class="col-md-12 nopl">ОГРН <span>*</span></label>

				<?if ($data->complete==1):?><input type="hidden" name="ogrn" value="<?=$data->ogrn?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="ogrn" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['ogrn']?><?else:?><?=$data->ogrn?><?endif?>">
				
				</div>
			


	<div class="form-group col-md-6 nopl pull-right"><label class="col-md-12 nopl">Наименование банка <span>*</span></label>
				<?if ($data->complete==1):?><input type="hidden" name="bank" value="<?=$data->bank?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="bank" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['bank']?><?else:?><?=$data->bank?><?endif?>">
				
				</div>
	<div class="clearfix"></div>
	
	<div class="form-group col-md-6"><label class="col-md-12 nopl">Расчетный счет <span>*</span></label>
				
				<?if ($data->complete==1):?><input type="hidden" name="rsch" value="<?=$data->rsch?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="rsch" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['rsch']?><?else:?><?=$data->rsch?><?endif?>">
				
				</div>

	<div class="form-group col-md-6 nopl pull-right"><label class="col-md-12">Корреспондентский счет <span>*</span></label>
				
				<?if ($data->complete==1):?><input type="hidden" name="ksch" value="<?=$data->ksch?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="ksch" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['ksch']?><?else:?><?=$data->ksch?><?endif?>">
				
				</div>
	<div class="clearfix"></div>
				
	<div class="form-group col-md-6"><label class="col-md-12 nopl" >БИК <span>*</span></label>
				
				<?if ($data->complete==1):?><input type="hidden" name="bik" value="<?=$data->bik?>"/><?endif?>
				<input type="text" <?if ($data->complete==1):?>disabled<?endif?> class="form-control" name="bik" data-parsley-group="wizard-step-3"   value="<?if (count($errors)>0) :?><?=$_POST['bik']?><?else:?><?=$data->bik?><?endif?>">
				
				</div>				
	<div class="clearfix"></div>
	
	
<div class="col-md-12 col-sm-12 text-left nopl m-b-10" style="color:#242A30">	
<strong>Лицо, уполномоченное для подписания договора</strong><br/>
</div>			<div class="clearfix"></div>												
														<div class="col-md-6 col-sm-6 form-group" style="color:#242A30">
															<label class="col-md-12 nopl" >ФИО <span>*</span></label>	
															<input name="fio_dg" data-parsley-group="wizard-step-3"  class="form-control " value="<?=$data->fio_dg?>" />
														</div>														
														<div class="col-md-6 col-sm-6 form-group nopl pull-right"  style="color:#242A30">	
															<label class="col-md-12 " >Должность <span>*</span></label>
															<input name="dolz_dg" data-parsley-group="wizard-step-3"  class="form-control " value="<?=$data->dolz_dg?>" />
														</div>	
	<div class="clearfix"></div>
	
	
			<!-- end row -->				
<p>
<?if ($data->complete == 0) :?>
<input type="submit" name="complete" class="btn btn-inverse btn-sm" value="Отправить на модерацию" />
<?else:?>
<input type="submit" name="complete" class="btn btn-inverse btn-sm" value="Изменить данные" />
<?endif?>
</p>
			
											
                                           
                                            <!-- end row -->
                                        </fieldset>
									</div>
															
									<!-- end wizard step-4 -->
								</div>
							</form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
<?else:?>
				<div class="col-md-12">
			<div class="panel panel-inverse m-t-15">

			    <div class="panel-body">

				<div class="jumbotron m-b-0 text-center">
	<h3>
		Благодарим Вас за регистрацию на сайте НП «ПРОВЭД»!</h3>
<div class="col-md-6" style="margin:0 auto;float:none">
	<p style="text-align:justify">
		<div class="col-md-2" style="font-size:60px;">
		<i class="icon-info"></i></div> 
		<div class="col-md-10"><p style="text-align:justify">На указанный Вами адрес электронной почты отправлено сообщение с информацией с Вашим логином и паролем для доступа в личный кабинет.</p> </div>
		<div class="clearfix"></div>

		<div class="col-md-2 " style="color:red;font-size:60px;">
		<i class="icon-bulb"></i> </div> 
		<div class="col-md-10"><p style="text-align:justify;color:red">Ваш профиль еще не авторизован. Для авторизации Вам необходимо на странице Вашего профиля заполнить все поля, отмеченные как обязательные для заполнения.</p> </div>
		
		<div class="col-md-2 " style="color:red;font-size:60px;">
		</div> 
		<div class="col-md-10">
			<a class="btn btn-inverse btn-sm" style="float:left" href="/user/cabinet" role="button">Перейти на страницу Вашего профиля.</a>
		</div>
		
		<div class="clearfix"></div>
		
</p>
</div>
	<p>
		</p>
</div>

</div></div></div>
<?endif?>


<div class="modal" id="change" >
	<div class="modal-dialog"  >
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

				<h4 class="modal-title">Изменение данных профиля</h4>
				<div style="clear:both"></div>
			</div>
			<div class="modal-body">												

			
			<div class="alert alert-success m-b-0">
												<h4><i class="fa fa-info-circle"></i> Данные успешно изменены!</h4>
												<p>
					<?if ($data->complete == 1) :?>
						Ваши данные были успешно изменены.
					<?else:?>	
						Ваши данные переданы администраторам сайта для проверки и дальнейшей авторизации
					<?endif?>	</p>
											</div>
			</div>		
		</div>			
	</div>
</div>


	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards-validation.demo.js"></script>
	
	
	<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.js"></script>
	<script src="/assets/js/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			changeINNmask();
			FormPlugins.init();
			FormWizardValidation.init();			
			//alert(wdth);
			//$('.select2-container').css()
			
		});
	</script>	
	
	