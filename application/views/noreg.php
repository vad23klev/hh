<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link rel="stylesheet" type="text/css" href="/public/js/colorbox/colorbox.css" media="screen" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/op/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/op/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/op/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/op/assets/css/style.css" rel="stylesheet" />
	<link href="/op/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/op/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<link href="/op/css/style1.css" id="theme" rel="stylesheet" />
	<link href="/public/css/row.css?r=792322461" rel="stylesheet" type="text/css" />
	<!-- ================== BEGIN BASE JS ================== -->
	
  	<link href="/assets/plugins/isotope/isotope.css" rel="stylesheet" />
  	<link href="/assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	
	
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
	<style>
	.parsley-error {
background: #ffdedd!important;
border-color: #ff5b57!important;
}
	
	</style>
	
	<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?45"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ru'}
</script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?113"></script>
<script type="text/javascript">
  VK.init({apiId: 4858942, onlyWidgets: true});
</script>
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51" class="main">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' textarea').removeClass('parsley-error');
		
		$(id + ' input[type="text"]').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);

		$(id + ' textarea').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);
		
		var fio = $(id + ' input[name="fio"]').val();
		var email = $(id + ' input[name="email"]').val();
		var mess = $(id + ' textarea[name="message"]').val();
		
		if (err == 1) {return false;} else {
			var data={fio:fio,email:email,mess:mess};
			$.post('/answer/mail',data).done(function(answer){
				$('#contform').html(answer);
				$(id + ' input[type="text"]').val('');
				$(id + ' textarea').val('');
				//console.log(answer);
			});		
		}
	
	}

</script>


</script>


    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-transparent navbar-fixed-top" style="overflow:hidden">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand">
                        
                        <span class="brand-text" style="position:relative;top:-10px">
							<img src="/main/logo.jpg" />
                        </span>
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">

                        <li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="/#about">О сервисе</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="/#service">Преимущества</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="/#whom">Для кого</a></li>
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="/#works">Как это работает</a></li>
						<!--li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#news">Новости</a></li-->
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="/#ratings">Россия в рейтингах</a></li>
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="/#contact11">Контакты</a></li>
						<li><a class="text_shadow" id="elem69" href="#modal-login" data-toggle="modal">Вход</a></li>

                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->
<div style="clear:both"></div>
       <!-- begin #client -->
       <div id="about" class="content" data-scrollview="true">
			<div class="container" style="padding-top:50px;">
				<?=$content?>
			</div>	
		</div>
<div style="clear:both"></div>		
        <!-- begin #footer -->
        <div id="footer" class="footer">
            <div class="container">
			
			
                <div class="footer-brand">
                    <img src="/main/pwhite.png" title="Некоммерческое партнерство профессионалов и участников внешнеэкономической деятельности «ПРОВЭД»"/>
                </div>
                <p style="color:white">&copy; 2015 Некоммерческое партнерство профессионалов и участников внешнеэкономической деятельности «ПРОВЭД»<br />
Все права защищены.
				
                </p>
                <p class="social-list">
                    <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-fw"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                    <a href="#"><i class="fa fa-google-plus fa-fw"></i></a>
                    <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                </p>
            </div>
        </div>
        <!-- end #footer -->
        
    </div>
    <!-- end #page-container -->

	
	
				<div class="modal fade" id="modal-login">
			<form method="POST" action="/user/login" id="jq13912" class="form-horizontal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h4 class="modal-title">Войти</h4>
					</div>
					<div class="modal-body">
					


					<?//print_r($_REQUEST)?>
                               <div class="form-group">
                                    <label class="col-md-3 control-label">E-mail  <span>*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="username" class="form-control" placeholder="E-mail" />
                                    </div>
                                </div>
								<div style="clear:both"></div>
								<div class="form-group">
                                    <label class="col-md-3 control-label">Пароль  <span>*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="password" class="form-control" placeholder="Пароль" />
                                    </div>
                                </div>
								<div style="clear:both"></div>

								<div class="form-group">
                                    <label class="col-md-3 control-label">Запомнить меня  <span>*</span></label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="remember"  />
                                    </div>
                                </div>
								<div style="clear:both"></div>
								

					</div>
					<div class="modal-footer">						
						<a href="javascript:;"  onclick="javascript:$('#jq13912').submit();" class="btn btn-sm btn-inverse">Войти</a> &nbsp; 
						<a href="/user/forgot" >Забыли пароль</a> &nbsp; <a href="/user/register" >Регистрация</a>											
					</div>
				</div>			
		</form>
		</div>
		</div>	

	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/op/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/op/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/op/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/op/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/op/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/op/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	
	
	<script type="text/javascript" src="/public/js/colorbox/jquery.colorbox.js"></script>
	<script src="/op/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/op/assets/plugins/scrollMonitor/scrollMonitor.js"></script>
	<script src="/assets/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="/assets/js/gallery.demo.js"></script>
	<script src="/op/assets/js/apps.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>    
	    $(document).ready(function() {
	        App.init();
			Gallery.init();
			$(".zoom").colorbox({photo:true,transition:"none",innerHeight:'600px'});
	    });
	</script>

	
	
</body>
</html>
