<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$cat->title?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<!--link href="/op/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/op/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/op/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/op/assets/css/style.css" rel="stylesheet" />
	<link href="/op/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/op/assets/css/theme/default.css" id="theme" rel="stylesheet" /-->
	
	
	<link href="/forum1/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/forum1/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style.css" rel="stylesheet" />
	<link href="/forum1/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/forum1/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<style>
	.parsley-error {
background: #ffdedd!important;
border-color: #ff5b57!important;
}
	
	</style>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/op/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	
	
<script>	
	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' textarea').removeClass('parsley-error');
		
		$(id + ' input[type="text"]').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Заполните поле ' + $(this).attr('rel'));
					err = 1;
				}
			}		
		);

		$(id + ' textarea').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Заполните поле ' + $(this).attr('rel'));
					err = 1;
				}
			}		
		);
		
		var fio = $(id + ' input[name="fio"]').val();
		var email = $(id + ' input[name="email"]').val();
		var mess = $(id + ' textarea[name="message"]').val();
		
		if (err == 1) {return false;} else {
			var data={fio:fio,email:email,mess:mess,title:"Сообщение через форму обратной связи на странице «Часто задаваемые вопросы»"};
			$.post('/answer/mail',data).done(function(answer){				
				$('#contform input[type="text"]').val('');
				$('#contform textarea').val('');
				$('#change').modal('show');
				//$('#contform').html(answer);
				//console.log(answer);
			});		
		}
	
	}

</script>

	
</head>
<body class="page-navbar-fixed-top-sm">



<div class="modal" id="change" >
	<div class="modal-dialog"  style="z-index:999999">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

				<h4 class="modal-title">Отправка сообщения</h4>
				<div style="clear:both"></div>
			</div>
			<div class="modal-body">												

			
			<div class="alert alert-success m-b-0">
												<h4>Спасибо, Ваше сообщение успешно отправлено. <br/>
Мы ответим Вам в ближайшее время.</h4>
											</div>
			</div>		
		</div>			
	</div>
</div>

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
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
                        <!-- <span class="navbar-logo"></span>
                        <span class="brand-text">
                            <span class="text-theme"><span style="color:red">Russia</span> <span style="color:black">Going Global</span></span>
                        </span> -->
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <div class="collapse navbar-collapse" id="header-navbar">
						<?require $_SERVER['DOCUMENT_ROOT']."/application/views/logpop_main.php"?>                    
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
                <h2 class="content-title"><?=$cat->name?></h2>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-12">
                        <!-- begin nav-tabs -->
						<?=$cat->html?>	
                        <!-- end tab-content -->
                    </div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                   
                    <!-- end col-6 -->
                </div>
                <!-- end row -->
				<div style="clear:both"></div>	
				<div class="row" style="padding-top:15px">
                    <!-- begin col-6 -->
                    <div class="col-md-3 col-sm-3">
						
                    </div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                    <div id="cont" class="col-md-6 col-sm-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<h2 class="content-title">Не нашли ответ?</h2>
                        <div class="form-horizontal" id="contform">
                            <div class="form-group">                                
                                <div class="col-md-12">
                                    <input type="text" name="fio" placeholder="Ваше имя" rel="Ваше имя"  class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-12">
                                    <input type="text" name="email" placeholder="Ваш Email" rel="Ваш Email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="form-control" placeholder="Ваше сообщение" rel="Ваше сообщение" name="message" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <div class="col-md-12 text-left">
                                    <button onclick="return controlform('#contform')"  class="btn btn-primary btn-block">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-md-3 col-sm-3">
						
                    </div>
					
                    <!-- end col-6 -->
                </div>				
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
       
        <!-- end theme-panel -->
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

