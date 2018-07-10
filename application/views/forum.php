<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$title?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<?if ($stitle != '' && $sdescr != ''):?>
	<meta itemprop="name" content="<?=$stitle?>"/>
	<meta itemprop="description" content="<?=$sdescr?>"/>
	
	<meta name="twitter:card" content="summary"/>  <!-- Тип окна -->
	<meta name="twitter:site" content="Russia Going Global"/>
	<meta name="twitter:title" content="<?=$stitle?>">
	<meta name="twitter:description" content="<?=$sdescr?>"/>
	
	<meta property="og:type" content="profile"/>
	<meta property="og:title" content="<?=$stitle?>"/>
	<meta property="og:description" content="<?=$sdescr?>"/>
	<?endif?>
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/forum1/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/forum1/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<link href="/assets/plugins/select2/dist/css/select2.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<link href="/forum1/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/forum1/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<style>
	*{outline:none}
	</style>
		
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
	
	
	
	    $(document).ready(function() {
			//$(".select2").select2({ placeholder: "Выберите страну",tags: true});
			//$(".select3").select2({ placeholder: "Выберите страну",tags: true,minimumResultsForSearch: Infinity});
	        //App.init();
	    });
	</script>
	
</head>
<body>


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
					<?require "logpop.php"?>                    
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
    <!-- end #header -->

    
    <!-- begin page-title -->

    
	<?=$content?>
    <!-- end content -->
    
    <div id="footer" class="footer">
            <div class="container">
			
				<div style="color:white;" class="text-left col-md-3 nopr pull-right">
					<a style="color:white;" href="/privetstvie">Приветствие</a><br/><a style="color:white;" href="/o_proekte">О проекте</a><br/><a style="color:white;" href="/chasto_zadavaemie_voprosi">Часто задаваемые вопросы</a><br/><a style="color:white;" href="/companies/list/0">Каталог компаний</a><br/><a style="color:white;" href="/companies/list/1">Каталог консультантов</a>
				</div>
			
			
                <div style="color:white;" class="col-md-4 nopr nopl pull-left">
				<?=$info->text2?>
                </div>
<div style="color:white;" class="text-left col-md-4 nopr pull-left">
				<p class="text-center">
					<img src="/img/logo-white.png" style="margin-bottom:10px" /><br/>
                    <a href="#"><i class="fa fa-vk fa-fw fa-2x"></i></a>                    
					<a href="#"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
					<a href="#"><i class="fa fa-linkedin fa-fw fa-2x"></i></a>
                </p>
			</div>

            </div>
        </div>
    
	<script>
	function controlform(id) {
		var err = 0;
		$(id + ' textarea').removeClass('parsley-error');
		
		$(id + ' .req').each(
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
</script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/forum1/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/forum1/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/forum1/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/forum1/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/forum1/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/forum1/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/forum1/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/forum1/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/forum1/assets/js/forum-details-page.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->


	<script src="/forum1/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/plugins/select2/dist/js/select2.js"></script>
	<script src="/forum1/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	
	<script>    
	    $(document).ready(function() {
	        App.init();
			ForumDetailsPage.init();			
			$(".select3").select2({ placeholder: "Выберите компетенцию",tags: true,minimumResultsForSearch: Infinity});
			$(".select3").on("hover",function() {$(".select3").select2("open")});
	    });
	</script>


<div class="modal" id="change" >
	<div class="modal-dialog"  >
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

				<h4 class="modal-title">Добавление ответа</h4>
				<div style="clear:both"></div>
			</div>
			<div class="modal-body">												

			
			<div class="alert alert-success m-b-0">
												<h4><i class="fa fa-info-circle"></i> Ответ успешно добавлен!</h4>
											</div>
			</div>		
		</div>			
	</div>
</div>	




<div class="modal fade" id="modal-login">
			<form method="POST" action="/user/login" id="jq13912" class="form-horizontal">
			<div class="modal-dialog">
				<div class="modal-content" style="color:black">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Войти</h4>
					</div>
					<div class="modal-body">
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
                                    <label class="col-md-3 control-label" style="padding-top:0px">Запомнить меня</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="remember"  />
                                    </div>
                                </div>
								<div style="clear:both"></div>
								

					</div>
					<div class="modal-footer">						
						<a href="javascript:;"  onclick="javascript:return controllogin('#jq13912')" class="btn btn-sm btn-primary">Войти</a> &nbsp; 
						<a href="/user/forgot" >Забыли пароль</a> &nbsp; <a href="/user/register" >Регистрация</a>											
					</div>
				</div>			
		</form>
		</div>
		</div>	
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'Jy5mcoW8Cu';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->	
</body>
</html>
