<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Войти</title>
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
	<link href="/assets/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
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
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="/assets/img/login-bg/bg-7.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="icon-login text-primary"></i> Войти</h4>
                    <p style="padding-left:35px">
                        
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
				<div class="register register-with-news-feed">
                <h1 class="register-header" style="padding-top:100px">
                    Войти                    
					<a style="font-size:12px;float:right;margin-top:17px" href="/">На главную</a>
                </h1>				
				</div>

                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
					<?if ($fail == 1) :?>
						<div class="alert alert-danger fade in m-b-15">
								<strong>Неверный логин или пароль!</strong>
								<a href="/user/forgot">Забыли пароль?</a>.								
						</div>
					<?endif?>
				
                    <form action="/user/login" method="POST"  id="jq13703" class="margin-bottom-0">
                        <div class="form-group m-b-15">
                            <input type="text" name="username" class="form-control input-lg" placeholder="E-mail *" />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="text" name="password" class="form-control input-lg" placeholder="Пароль *" />
                        </div>
                        <div class="checkbox m-b-30">
						    <label style="padding-left:0;color:black">Запомнить меня </label> <input style="margin-left:10px;position:relative;top:1px" type="checkbox" name="remember"  />
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" onclick="javascript:return controllogin('#jq13703')">Войти</button>
                        </div>
                        <div class="m-t-20 m-b-10 p-b-10" style="color:black">
                            Еще нет аккаунта? <a href="/user/register" >Зарегистрируйтесь</a>.
                        </div>
                        <div class="m-t-0 m-b-40 p-b-40">
                            <a href="/user/forgot" >Забыли пароль?</a>
                        </div>

                        <hr />
                        <div class="text-center text-inverse" style="margin-top:-10px">
                            <?=$info->text2?>
                        </div>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
        
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
