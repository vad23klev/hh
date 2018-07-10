<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Восстановление пароля</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css1/animate.min.css" rel="stylesheet" />
	<link href="/assets/css1/style.css" rel="stylesheet" />
	<link href="/assets/css1/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css1/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
		
	    <div class="login-cover-image"><img src="/assets/img/login-bg/bg-6.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" style="margin-bottom:20px" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
					<a href="/">
					<img src="/img/logo-white.png">
                    Russia Going Global
                    <small>Напоминание пароля</small>
					</a>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
			<?if ($complete==0):?>
			<form action="" method="POST" id="jq139" class="margin-bottom-0">

			 <div class="form-group m-b-20">
                       <input type="text" class="form-control input-lg" name="email" value="<?=$_POST['email']?>" placeholder="Введите E-mail" />
             </div>
			
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Выслать пароль</button>						
                    </div>
					
					<div class="row m-t-30" style="margin-bottom:-20px">
						<div class="col-md-12">
							<div class="pull-left">
							<a href="/user/login">ВОЙТИ</a>
							</div>
							<div class="pull-right">
							<a href="/" >НА ГЛАВНУЮ</a>
							</div>
						</div>	
					</div>
					
	<?if (count($errors)>0):?>				
	<div class="alert alert-error m-t-20" style="margin: 40px 0px 0px !important;">
			<?foreach ($errors as $error) :?>
			<?=$error?><br/>
			<?endforeach?>
	</div>
	<?endif?>
			<?else:?>
				<div class="alert alert-info form-group m-b-20" id="sended" >
				<center><h3 style="margin: 0px 0px; font-size: 20px; color: #3a87ad;">Новый пароль выслан на <br/>e-mail, указанный при регистрации</h3></center>
				
				<div class="text-center m-t-30" style="margin-bottom:-47px">
					<a href="javascript:;;" onclick="$('#sended').hide();$('#jq1391212').show()">ВОЙТИ</a> 
				</div>
				</div>
				
				<form action="/user/login" method="POST" id="jq1391212" style="display:none" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" name="username" class="form-control input-lg" placeholder="E-mail *" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" name="password" class="form-control input-lg" placeholder="Пароль *" />
                    </div>
                    <div class="checkbox m-b-20">
                        <label>
                            <input  name="remember" type="checkbox" /> Запомнить меня
                        </label>
                    </div>
                    <div class="login-buttons">
                        <a href="javascript:;"  onclick="javascript:return controllogin('#jq1391212');" class="btn btn-primary btn-block btn-lg">Войти</a>
                    </div>
                    <div class="m-t-20">
                        Еще нет аккаунта? <a href="/user/register">Зарегистрируйтесь</a>.
                    </div>
                </form>
				
				
			<?endif?>

</form>

            </div>
        </div>

		<div class="text-center" style="width:450px;margin:0 auto;position:relative;z-index:9999;color:white;margin-top:10px">
		<p style="text-align: justify;">© 2015 Russia Going Global</p>
		</div>        

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
	<script src="/assets/js/login-v2.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

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
			$(id + ' input[name="password"]').attr('placeholder','Заполните поле Пароль');
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
	
	
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	

</body>
</html>