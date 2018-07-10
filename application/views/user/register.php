<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Регистрация</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css1/animate.min.css" rel="stylesheet" />
	<link href="/assets/css1/style.min.css" rel="stylesheet" />
	<link href="/assets/css1/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css1/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
	function controllogin(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');

		
		if ($(id + ' input[name="username"]').val() == '') {
			$(id + ' input[name="username"]').addClass('parsley-error');
			$(id + ' input[name="username"]').attr('placeholder','Заполните поле E-mail');
			err = 1;
		}

		if ($(id + ' input[name="password"]').val() == '') {
			$(id + ' input[name="password"]').addClass('parsley-error');
			$(id + ' input[name="password"]').attr('placeholder','Заполните поле пароль');
			err = 1;
		}
		
		/*$(id + ' input').each(
			function () {
			}		
		);*/
		
		if (err == 1) {
			return false;
		} else {
			$(id).submit();
			return true;
		}
	
	}
	</script>
	
	
</head>
<body class="pace-top bg-white">


	<script type="text/javascript">
	
	jQuery(function(){
		<?if (intval($data['regnow'])==1):?>
			controlform('#jq13703');
		<?endif?>	
	});
	
	function controlform(id) {
		//var data;
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' select').removeClass('parsley-error');
		$(id + ' .pc1').text('');
		$(id + ' .pc').text('');
		if ($(id + ' input[name="password"]').val() != $(id + ' input[name="password_confirm"]').val())
		{
			$(id + ' input[name="password"]').addClass('parsley-error');
			$(id + ' .pc1').text('Поля должны совпадать');

			$(id + ' input[name="password_confirm"]').addClass('parsley-error');
			$(id + ' .pc').text('Поля должны совпадать');
			err = 1;			
		}		
		
		if ($('#expert').val() == 0) {
			$('#expert').addClass('parsley-error');
			err = 1;
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
		
		if ($('#agree').prop('checked') == false)
		{
			err = 1;
		}
		
		//alert($(id + ' input[name="cq"]').val());
	
	
		if (err == 1) {
			return false;
		} else {
		
		    $.ajax({
				cache: false,
				type: "POST",
				url: "/user/aregister",
				data:{expert:$('#expert').val(),fio:$('input[name=fio]').val(),lastname:$('input[name=lastname]').val(),email:$('input[name=email]').val(),password_confirm:$('input[name=password_confirm]').val(),password:$('input[name=password]').val(),referer:$('input[name=referer]').val(),rand:Math.random()},
				dataType: "html",
				timeout: 10000,
				success: function(data,textStatus){
					if (data.indexOf('?success') == -1) {
						$('#errs').html(data);
					} else {
						document.location = data;
					}
				},
				error: function() {}
			});		
		
			return true;
		}
	
	}
</script>


	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="/assets/img/login-bg/bg-8.jpg" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><img src="/img/logo-white.png"> Регистрация</h4>
					
                    <p style="padding-left:75px">Создайте свой аккаунт. Это бесплатно и не займет много времени.</p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
				
                <h1 class="register-header" style="padding-top:20px">
                    Регистрация                    
					<a style="font-size:12px;float:right;margin-top:17px" href="/">На главную</a>
                </h1>
				
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
				
				<!--div class="row m-b-15">
					<div class="col-md-12" >
						<label class="control-label"  style="padding-left:0px">Для автозаполнения полей используйте данные Вашего аккаунта в одной из следующих социальных сетей</label>
					</div>	
	<div class="col-md-12 m-t-10" >
	<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLoginf46a7be3" data-ulogin="display=panel;fields=first_name,last_name,middle_name,email;verify=1;providers=vkontakte,facebook,odnoklassniki,mailru,yandex,google;redirect_uri="></div>


	</div>
</div-->
<div style="clear:both"></div>
				<div method="POST" id="jq13703" >
						<div class="row row-space-10">
							<label class="col-md-6 control-label">Фамилия <span>*</span></label>
							 <label class="col-md-6  control-label">Имя <span>*</span></label>
                            <div class="col-md-6 m-b-15">
                                <input type="hidden"  class="form-control" name="referer" value="<?=$_GET['referer']?>">
								<input type="text" placeholder="Введите фамилию" class="form-control" name="fio" value="<?=$data['fio']?>">
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" placeholder="Введите имя" class="form-control" name="lastname" value="<?=$data['lastname']?>">
                            </div>
                        </div>
<div class="row row-space-10">						
				<label class="col-md-12">Категория пользователя <span>*</span></label>
					<div class="col-md-12 m-b-15">							
							<?$roles = array(3=>'экспортер',4=>'провайдер услуг',5=>'эксперт консультант')?>
							<?if ($data->complete==1):?><input type="hidden" name="expert" value="<?=$data->user->role?>"/><?endif?>
							<select id="expert" name="expert" class="form-control">
							<option value="0">выберите категорию</option>
					<?foreach ($roles as $i=>$s):?>
						<option value="<?=$i?>" <?if ($i == $data->user->role):?>selected<?endif?>><?=$s?></option>
					<?endforeach?>
					</select>
				
				</div>
				
	</div>							
						
						
						<!--div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="hidden"  class="form-control" name="referer" value="<?=$_GET['referer']?>">
								<input type="text" placeholder="Введите фамилию" class="form-control" name="fio" value="<?=$data['fio']?>">
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" placeholder="Введите имя" class="form-control" name="lastname" value="<?=$data['lastname']?>">
                            </div>
                        </div-->
						
						
                        <label class="control-label">E-mail (логин) <span>*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text"  class="form-control" placeholder="Введите E-mail" name="email"  value="<?=$data['email']?>">
                            </div>
                        </div>
						
						<label class="control-label">Пароль <span>*</span></label>
						<div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" placeholder="Введите пароль" name="password_confirm" value="<?=$data['passe']?>">
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input  type="text" class="form-control" placeholder="Повторите пароль" name="password" value="<?=$data['passe']?>">
                            </div>
                        </div>						
						
						
                        <!--label class="control-label">Пароль <span>*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                        
						<label class="control-label">Повторите пароль <span>*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                
                            </div>
                        </div-->
						<div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" id="agree"> Нажимая на кнопку «Зарегистрироваться», я соглашаюсь с <a href="">правилами сайта</a>.
                            </label>
                        </div>
   

                        <div class="register-buttons">
							<a href="javascript:;;" class="btn btn-primary btn-block btn-lg" onclick="javascript:return controlform('#jq13703')" value=""  >Зарегистрироваться</a>
                        </div>
						<div class="m-t-10 m-b-0 p-b-5" style="color:black">
						&nbsp;Уже зарегистрированы? Нажмите <a href="/user/login" data-toggle="modal">Войти</a>.
						</div>
                        <hr />
                        <div class="text-center text-inverse">
                            <?=$info->text2?>
                        </div>
                    </div>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
        
        <!-- end theme-panel -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

	
	
	
</body>
</html>
