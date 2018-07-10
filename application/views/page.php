<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$h1?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/forum1/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/forum1/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== BEGIN BASE JS ================== -->
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!--link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/op/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/op/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/op/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/op/assets/css/style.css" rel="stylesheet" />
	<link href="/op/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/op/assets/css/theme/default.css" id="theme" rel="stylesheet" /-->
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/op/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="page-navbar-fixed-top-sm">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top navbar-small" data-state-change="disabled">
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
                        <img src="/img/logo.png" />
                        <!--span class="navbar-logo"></span>
                        <span class="brand-text">
                            <span class="text-theme"><span style="color:red">Russia</span> <span style="color:black">Going Global</span></span>
                        </span-->
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                     <div class="collapse navbar-collapse" id="header-navbar">
						<?require "logpop_main.php"?>                    
					</div>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->
        <div class="container" >
				<?=$crumbs?>
		</div>
        <!-- begin tabs / accordion -->
        <div class="content" data-scrollview="true" style="padding-top:0px">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title"><?=$h1?></h2>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-12">
                        <!-- begin nav-tabs -->
						<?=$html?>	
                        <!-- end tab-content -->
                    </div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                   
                    <!-- end col-6 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end tabs / accordion -->
        
        <!-- begin #footer -->
                
<div id="footer" class="footer">
            <div class="container">

				<div style="color:white;" class="text-left col-md-3 nopr pull-right">
					<!-- <a style="color:white;" href="/privetstvie">Приветствие</a> -->
					<br><a style="color:white; display: none;" href="/novosti">Новости</a>
					<a style="color:white; display: none;" href="/forum">Форум</a>
					<a style="color:white;" href="/o_proekte">О проекте</a>
					<br>
					<a style="color:white;" href="/chasto_zadavaemie_voprosi">Часто задаваемые вопросы</a>
					<br>
					<!-- <a style="color:white;" href="/companies/list/0">Каталог компаний</a> -->
					<br>
					<!-- <a style="color:white;" href="/companies/list/1">Каталог консультантов</a> -->
				</div>


                <div style="color:white;" class="col-md-4 nopr nopl pull-left">
				<p style="text-align: left !important;">
	© 2016 Russia Going Global<br>
	Проект поддерживает государственную политику России в области развития экспорта и создания инфраструктуры для доступа на рынки зарубежных стран.</p>
                </div>
<div style="color:white;" class="text-left col-md-4 nopr pull-left">
				<p class="text-center">
					<img src="/img/logo-white.png" style="margin-bottom:10px"><br>
                    <a href="https://vk.com/public100500488"><i class="fa fa-vk fa-fw fa-2x"></i></a>
					<a href="https://www.facebook.com/russiagoingglobal/"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
					<a href="https://www.linkedin.com/company/globalizeme.pro?report%2Esuccess=KJ_KkFGTDCfMt-A7wV3Fn9Yvgwr02Kd6AZHGx4bQCDiP6-2rfP2oxyVoEQiPrcAQ7Bf"><i class="fa fa-linkedin fa-fw fa-2x"></i></a>
                </p>
			</div>

            </div>
        </div>
    <!-- end #page-container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/op/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/op/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/op/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/op/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/op/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/op/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/op/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/op/assets/plugins/scrollMonitor/scrollMonitor.js"></script>
	<script src="/op/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>    
	    $(document).ready(function() {
	        App.init();
	    });
	</script>
	
	
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'Jy5mcoW8Cu';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->	
</body>
</html>
