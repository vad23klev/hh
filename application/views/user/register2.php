
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



	function swSubcats(scid, sc) {
		$(sc).hide();
		$(sc + ' .subcat').hide();
		$(sc + ' #sc' + scid).show();
		$(sc).show();
	}
</script>

<h1 class="page-header m-t-35">Регистрация </h1>
<!--div class="vertical-box">
<div class="vertical-box-column"></div></div

<div style="color:red;display:none">
<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
</div>



-->
<div class="col-md-8" >


<ul class="nav nav-pills">
						<?if (!$_GET['type'] || $_GET['type'] == 'provider'):?>
							<li <?if (!$_GET['type'] || $_GET['type'] == 'provider'):?>class="active"<?endif?>><a href="#nav-pills-tab-1" data-toggle="tab">ПРОВАЙДЕР</a></li>
						<?endif?>	
						<?if (!$_GET['type'] || $_GET['type'] == 'export'):?>
							<li <?if ($_GET['type'] == 'export'):?>class="active"<?endif?>><a href="#nav-pills-tab-2" data-toggle="tab">ЭКСПОРТЕР</a></li>
						<?endif?>	
						<?if (!$_GET['type'] || $_GET['type'] == 'import'):?>
							<li <?if ($_GET['type'] == 'import'):?>class="active"<?endif?>><a href="#nav-pills-tab-25" data-toggle="tab">ИМПОРТЕР</a></li>
						<?endif?>		
						<?if (!$_GET['type'] || $_GET['type'] == 'expert'):?>
							<li <?if ($_GET['type'] == 'expert'):?>class="active"<?endif?>><a href="#nav-pills-tab-3" data-toggle="tab">ЭКСПЕРТ</a></li>
						<?endif?>	
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="nav-pills-tab-1">
							<p>
<form method="POST" id="jq13701" class="form-horizontal">
	
<input type="hidden" class="form-control" name="expert"  value="4" >
<div class="form-group">
	<label class="col-md-2 control-label">ФИО <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="fio" value="<?=$_POST['fio']?>">

	</div>
</div>
	<div class="clearfix"></div>	

<div class="form-group">
	<label class="col-md-2 control-label">E-mail <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="email"  value="<?=$_POST['email']?>">

	</div>
</div>
	<div class="clearfix"></div>


		<div class="form-group ess" >

			<label class="col-md-2 control-label">Выберите сферу деятельности: </label>
			
			<div class="col-md-10">
				<select name="c[]"class="form-control" onchange="swSubcats($(this).val(),'#sc1')">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>	

			<div id="sc1" class="" style="display:none">
				<div class="col-md-12">
					<label class="col-md-2 control-label"></label>
						<?foreach ($cats as $cat):?>
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>								
								<div id="sc<?=$cat->id?>" style="display:none"  class="subcat col-md-10">
									<div style="margin-bottom:10px">Выберите специализацию:</div>
									<?foreach($subcats as $scc):?>									
										<input type="checkbox" name="c[]" value="<?=$scc->id?>" id="sc1cc<?=$scc->id?>" />
										<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label><br/>
									<?endforeach?>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

		<div class="form-group">
	<label class="col-md-2 control-label">ИНН <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="username" value="<?=$_POST['username']?>">
	
	</div>
</div>
	<div class="clearfix"></div>

			<div class="form-group">
	<label class="col-md-2 control-label">Пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password_confirm" >
	<div class="pc1"></div>
	</div>
</div>
	<div class="clearfix"></div>
	

			<div class="form-group">
	<label class="col-md-2 control-label">Повторите пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password" >
	<div class="pc"></div>
	</div>
</div>
	<div class="clearfix"></div>

	
			<div class="form-group" style="margin-bottom:-5px">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-10">
	<input  type="submit" class="btn btn-inverse" value="Зарегистрироваться"  onclick="javascript:return controlform('#jq13701')">

	</div>
</div>
	<div class="clearfix"></div>
	
		
		
</form>
							</p>
						</div>
						
						<div class="tab-pane fade" id="nav-pills-tab-2">
							<p>
<form method="POST" id="jq13702" class="form-horizontal">
	
<input type="hidden" class="form-control" name="expert"  value="3" >
<div class="form-group">
	<label class="col-md-2 control-label">ФИО <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="fio" value="<?=$_POST['fio']?>">

	</div>
</div>
	<div class="clearfix"></div>	

<div class="form-group">
	<label class="col-md-2 control-label">E-mail <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="email"  value="<?=$_POST['email']?>">

	</div>
</div>
	<div class="clearfix"></div>

		<div class="form-group">
	<label class="col-md-2 control-label">ИНН <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="username" value="<?=$_POST['username']?>">

	</div>
</div>
	<div class="clearfix"></div>

<div class="form-group" style="display:none">
	<label class="col-md-2 control-label">Вид деятельности:</label>
	<div class="col-md-10">
	<input type="text" readonly class="form-control" name="export"  value="экспортер">

	</div>
</div>
	<div class="clearfix"></div>	
	
	
	
	
			<div class="form-group">
	<label class="col-md-2 control-label">Пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password_confirm" >
<div class="pc"></div>
	</div>
</div>
	<div class="clearfix"></div>
	

			<div class="form-group">
	<label class="col-md-2 control-label">Повторите пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password" >
	<div class="pc1"></div>

	</div>
</div>
	<div class="clearfix"></div>

	
			<div class="form-group" style="margin-bottom:-5px">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-10">
	<input  type="submit" class="btn btn-inverse" value="Зарегистрироваться"  onclick="javascript:return controlform('#jq13702')">

	</div>
</div>
	<div class="clearfix"></div>
	
		
		
</form>
							</p>
						</div>
						
<div class="tab-pane fade" id="nav-pills-tab-25">
							<p>
<form method="POST" id="jq13703" class="form-horizontal">
	
<input type="hidden" class="form-control" name="expert"  value="3" >
<div class="form-group">
	<label class="col-md-2 control-label">ФИО <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="fio" value="<?=$_POST['fio']?>">

	</div>
</div>
	<div class="clearfix"></div>	

<div class="form-group">
	<label class="col-md-2 control-label">E-mail <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="email"  value="<?=$_POST['email']?>">

	</div>
</div>
	<div class="clearfix"></div>

		<div class="form-group">
	<label class="col-md-2 control-label">ИНН <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="username" value="<?=$_POST['username']?>">

	</div>
</div>
	<div class="clearfix"></div>

<div class="form-group" style="display:none">
	<label class="col-md-2 control-label">Вид деятельности:</label>
	<div class="col-md-10">
	<input type="text" readonly class="form-control" name="export"  value="импортер">

	</div>
</div>
	<div class="clearfix"></div>	
	
	
	
	
			<div class="form-group">
	<label class="col-md-2 control-label">Пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password_confirm" >
<div class="pc"></div>
	</div>
</div>
	<div class="clearfix"></div>
	

			<div class="form-group">
	<label class="col-md-2 control-label">Повторите пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password" >
	<div class="pc1"></div>

	</div>
</div>
	<div class="clearfix"></div>

	
			<div class="form-group" style="margin-bottom:-5px">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-10">
	<input  type="submit" class="btn btn-inverse" value="Зарегистрироваться"  onclick="javascript:return controlform('#jq13703')">

	</div>
</div>
	<div class="clearfix"></div>
	
		
		
</form>
							</p>
						</div>						
						
						
						
						
						<div class="tab-pane fade" id="nav-pills-tab-3">
							<p>
								<form method="POST" id="jq13704" class="form-horizontal">
	
<input type="hidden" class="form-control" name="expert"  value="5" >
<div class="form-group">
	<label class="col-md-2 control-label">ФИО <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="fio" value="<?=$_POST['fio']?>">

	</div>
</div>
	<div class="clearfix"></div>	

<div class="form-group">
	<label class="col-md-2 control-label">E-mail <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="email"  value="<?=$_POST['email']?>">

	</div>
</div>
	<div class="clearfix"></div>


		<div class="form-group ess" >

			<label class="col-md-2 control-label">Выберите сферу деятельности: </label>
			
			<div class="col-md-10">
				<select name="c[]"class="form-control" onchange="swSubcats($(this).val(),'#sc2')">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>	

			<div id="sc2" class="" style="display:none">
				<div class="col-md-12">
					<label class="col-md-2 control-label"></label>
						<?foreach ($cats as $cat):?>
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>								
								<div id="sc<?=$cat->id?>" style="display:none"  class="subcat col-md-10">
									<div style="margin-bottom:10px">Выберите специализацию:</div>
									<?foreach($subcats as $scc):?>									
										<input type="checkbox" name="c[]" value="<?=$scc->id?>" id="sc1cc<?=$scc->id?>" />
										<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label><br/>
									<?endforeach?>
								</div>
							<?endif?>
						<?endforeach?>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

		<div class="form-group">
	<label class="col-md-2 control-label">Имя пользователя <span>*</span></label>
	<div class="col-md-10">
	<input type="text"  class="form-control" name="username" value="<?=$_POST['username']?>">

	</div>
</div>
	<div class="clearfix"></div>

			<div class="form-group">
	<label class="col-md-2 control-label">Пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password_confirm" >
<div class="pc"></div>
	</div>
</div>
	<div class="clearfix"></div>
	

			<div class="form-group">
	<label class="col-md-2 control-label">Повторите пароль <span>*</span></label>
	<div class="col-md-10">
	<input  type="text" class="form-control" name="password" >
<div class="pc1"></div>
	</div>
</div>
	<div class="clearfix"></div>

	
			<div class="form-group" style="margin-bottom:-5px">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-10">
	<input  type="submit" class="btn btn-inverse" value="Зарегистрироваться"  onclick="javascript:return controlform('#jq13704')">

	</div>
</div>
	<div class="clearfix"></div>
	
		
		
</form>
						</div>						
					</div>			
</div>	



                <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-body">
                            <form action="/" method="POST" data-parsley-validate="true" name="form-wizard">
								<div id="wizard">
									<ol>
										<li>
										    Identification 
										    <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small>
										</li>
										<li>
										    Contact Information
										    <small>Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin.</small>
										</li>
										<li>
										    Login
										    <small>Phasellus lacinia placerat neque pretium condimentum.</small>
										</li>
										<li>
										    Completed
										    <small>Sed nunc neque, dapibus non leo sed, rhoncus dignissim elit.</small>
										</li>
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identification</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group block1">
														<label>First Name</label>
														<input type="text" name="firstname" placeholder="John" class="form-control" data-parsley-group="wizard-step-1" required />
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Middle Initial</label>
														<input type="text" name="middle" placeholder="A" class="form-control" data-parsley-group="wizard-step-1" required />
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Last Name</label>
														<input type="text" name="lastname" placeholder="Smith" class="form-control" data-parsley-group="wizard-step-1" required />
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									<!-- begin wizard step-2 -->
									<div class="wizard-step-2">
										<fieldset>
											<legend class="pull-left width-full">Contact Information</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" name="phone" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="number" required />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
													<div class="form-group">
														<label>Email Address</label>
														<input type="email" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="email" required />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-2 -->
									<!-- begin wizard step-3 -->
									<div class="wizard-step-3">
										<fieldset>
											<legend class="pull-left width-full">Login</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <div class="controls">
                                                            <input type="text" name="username" placeholder="johnsmithy" class="form-control" data-parsley-group="wizard-step-3" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password" placeholder="Your password" class="form-control" data-parsley-group="wizard-step-3" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Confirm Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password2" placeholder="Confirmed password" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                        </fieldset>
									</div>
									<!-- end wizard step-3 -->
									<!-- begin wizard step-4 -->
									<div>
									    <div class="jumbotron m-b-0 text-center">
                                            <h1>Login Successfully</h1>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
                                            <p><a class="btn btn-success btn-lg" role="button">Proceed to User Profile</a></p>
                                        </div>
									</div>
									<!-- end wizard step-4 -->
								</div>
							</form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
					
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards-validation.demo.js"></script>
	
		<script>
		$(document).ready(function() {
			//App.init();
			FormWizardValidation.init();
		});
	</script>
					
					