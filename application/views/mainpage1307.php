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

                        <li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#about">О сервисе</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#action-box">Преимущества</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#whom">Для кого</a></li>
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#works">Как это работает</a></li>
						<!--li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#news">Новости</a></li-->
						<!--li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#ratings">Россия в рейтингах</a></li-->
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#contact11">Контакты</a></li>
						<!--li><a class="text_shadow" id="elem69" href="#modal-login" data-toggle="modal">Вход</a></li-->
						<li><a class="text_shadow" id="elem69" href="/user/login">Вход</a></li>

                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->
<div class="clearfix"></div>
       <!-- begin #client -->
        <div id="home" class="content has-bg home" >
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="/main/home-bg.jpg" style="opacity:0.5;margin:0 auto" alt="Home" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container home-content" style="margin-top:0px">
			
				<div class="form-horizontal login-v2">
					<form action="/user/login" id="jq1391212" method="POST"/>
                             <div class="form-group">                                    
                                    <div class="col-md-12">
                                        <input type="text" name="username" class="form-control input-lg" placeholder="E-mail *" />
                                    </div>
                                </div>
								<div style="clear:both"></div>
								<div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="password" class="form-control input-lg" placeholder="Пароль *" />
                                    </div>
                                </div>
								<div style="clear:both"></div>

								<div class="form-group">
                                    <label class="col-md-8 control-label" style="color:white;text-align:left;padding-top:0px;">Запомнить меня</label>
                                    <div class="col-md-4 text-right">
                                        <input type="checkbox" name="remember"  />
                                    </div>
                                </div>
								<div style="clear:both"></div>
					
						<a href="javascript:;"  onclick="javascript:return controllogin('#jq1391212');" class="btn btn-block btn-lg btn-primary">Войти</a> 
						<div class="pull-left m-t-10">
							<a href="/user/forgot" >Забыли пароль</a>
						</div>
						<div class="pull-right m-t-10">
							<a href="/user/register" >Регистрация</a>	
						</div>	
					</form>		
				</div>			
			
			
                <h2 class="content-title">ПРОВЭД</h2>                
                <p><strong  style="color:white">
                    -ваш инструмент для поиска лучших, надежных, проверенных<br/>
					партнеров в области ВЭД</strong>
                </p>                
				
				<p><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#about"><strong style="color:white"><i class="fa fa-angle-double-down fa-5x"></i></strong></a></p>
				
				
				
				
            </div>
            <!-- end container -->
        </div>
        <!-- end #client -->

 
        
        <!-- begin #about -->
        <div id="about" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">О сервисе </h2>
                <p class="content-desc">
                    ПРОВЭД – ВАШ ИНСТРУМЕНТ ДЛЯ ПОИСКА ЛУЧШИХ, НАДЕЖНЫХ, ПРОВЕРЕННЫХ ПРОВАЙДЕРОВ УСЛУГ В ОБЛАСТИ ВЭД. <br/><br/>
					<!--strong>ПРОВЭД призван объединить всех участников ВЭД в одном месте.</strong-->
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-6">
                        <!-- begin about -->
                        <div class="about about1" style="color:black">
                            <h3>История проекта</h3>
                            <p style="text-align:justify">
	Идея создания платформы (сервиса) &laquo;ПРОВЭД&raquo; стала результатом длительного опыта работы в сфере внешнеэкономической деятельности и поиска современного и технологичного решения, которое позволило бы в одном месте решать все основные задачи, связанные с организацией внешнеэкономической деятельности.</p>
	<p style="text-align:justify">
	На протяжении последних лет, в течении которых вопросы ВЭД впервые были включены в повестку национального диалога между государством и бизнесом, мы были активными участниками многочисленных консультаций и совещаний, где участники ВЭД формулировали ключевые проблемы и предлагали различные решения.</p>
	<p class="text-right">
		<a href="#modal-about" data-toggle="modal">Подробнее</a>
	</p>	


	
	
	
                        </div>
                        <!-- end about -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
<div class="col-md-4 col-sm-6">
                        <h3>Миссия</h3>
                        <!-- begin about-author -->
                        <div class="about-author">
                            <div class="quote bg-silver">
                                <i class="fa fa-quote-left"></i>
                                <h4 style="font-style:italic">Наша миссия – сделать внешнеэкономическую деятельность доступным, понятным, безопасным и эффективным видом предпринимательской деятельности.</h4>
                                <i class="fa fa-quote-right"></i>
                            </div>
                            <div class="author">
                                <div class="image">
                                    <img src="/main/db.jpg"  />
                                </div>
                                <div class="info about1">
                                     <span style="font-size:90%;">— Денис Быченков, <span style="font-weight:normal">Основатель проекта</span></span>
									<a href="#modal-bych" data-toggle="modal">подробнее</a>
                                </div>
                            </div>
                        </div>
                        <!-- end about-author -->
                    </div>		
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-6">
                        <!-- begin about -->
                        <div class="about">
                            <h3>Возможности</h3>

<div class="panel-group m-b-0" id="accordion3">
                            <!-- begin panel -->
<?$abs = ORM::factory('article')->where('category_id','=',391)->find_all()?>							
					<?foreach ($abs as $i=>$a) :?>
						    <div class="panel panel-default">
                                <div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion-<?=$i?>">
											<i class="fa fa-plus-circle pull-right"></i> 
											<?=$a->name?>
										</a>
									</h4>
                                </div>
                                <div id="accordion-<?=$i?>" class="panel-collapse collapse">
                                    <div class="panel-body" style="padding:5px 15px">
                                        <p>
                                            <?=($a->text)?>
                                        </p>
                                    </div>
                                </div>
                            </div>
					<?endforeach?>
                            <!-- begin panel -->
                        </div>



						</div>
                        <!-- end about -->
                    </div>
					
                    			
                    <!-- end col-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #about -->

		<div class="content" style="display:none">
			            <div class="container">
                <h2 class="content-title">Сервисы</h2>
                <!-- begin row -->
                <div class="row">
                    <?$a1 = ORM::factory('categorie')->where('id','=',397)->find()?>
					<?=$a1->html?>

					<div class="clearfix"></div>
                </div>
                <!-- end row -->
            </div>
		</div>
		
<div id="action-box" class="content has-bg" data-scrollview="true" style="padding:60px 0;">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="/op/assets/img/action-bg.jpg" alt="Action">
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container fadeInRight contentAnimated" data-animation="true" data-animation-type="fadeInRight">
                <!-- begin row -->
                <div class="row action-box">
                    <!-- begin col-9 -->
                    <div class="col-md-9 col-sm-9">
                        <div class="icon-large text-theme">
                            <i class="fa fa-binoculars"></i>
                        </div> 
                        <h3>ПОРА СТАТЬ ГЛОБАЛЬНОЙ КОМПАНИЕЙ!</h3>
                        <p style="text-indent:0px;padding-left:70px;color:white">
                           Вы когда-нибудь задумывались об экспорте, интернационализации, географической экспансии вашего бизнеса?<br/>Если еще нет, или Вы думаете, что это слишком сложно, тогда Вам следует воспользоваться сервисом GetGlobalBy.pro.
                        </p>
                    </div>
					<div class="col-md-3 col-sm-3" style="margin-top:10px">
                        <a href="/user/register" style="padding:15px 0" class="btn btn-outline btn-block">Регистрация</a>
                    </div>
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>		
		
		
<!-- beign #service -->
        <div id="service" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Преимущества</h2>
				
                <p class="content-desc">
                    <?$a1 = ORM::factory('article')->where('category_id','=',398)->find_all()?>
					<?//=strip_tags($a1->html)?>
                </p>
                <!-- begin row -->				
                <div class="row">
					<?$icons = array('0'=>'fa-cog','1'=>'fa-paint-brush','2'=>'fa-file','3'=>'fa-code','4'=>'fa-shopping-cart','5'=>'fa-heart')?>
						<?foreach ($a1 as $i=>$v) :?>
							<div class="col-md-4 col-sm-4">
								<div class="service">
									<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa <?=$icons[$i]?>"></i></div>
									<div class="info">
										<h4 class="title"><?=$v->name?></h4>
										<p class="desc"><?=$v->text?></p>
									</div>
								</div>
							</div>						
						<?endforeach?>
				
					
					<?foreach ($abs as $i=>$a) :?>
	                    <!--div class="col-md-4 col-sm-4">
							<div class="service">
								<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa <?=$icons[$i]?>"></i></div>
								<div class="info">
									<h4 class="title"><?=$a->name?></h4>
									<p class="desc"><?=($a->text)?></p>
								</div>
							</div>
						</div-->
						
						<?if ($i%3 ==2 ) :?>
							<!--div class="clearfix"></div-->
						<?endif?>
					<?endforeach?>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #about -->	
		
		        <!-- begin #team -->
        <div id="whom" class="content" >
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Для кого</h2>
                <!-- begin row -->
                <div class="row about1">
                    <?$a1 = ORM::factory('categorie')->where('id','=',393)->find()?>
					<?=$a1->html?>

					<div class="clearfix"></div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #team -->
	
	
        <!-- begin #milestone -->
        <div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="/main/now.jpg" alt="Milestone" height="310px" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container">
				<h2 class="content-title">На портале уже работают</h2>
                <!-- begin row -->
                <div class="row">

                    <div class="col-md-3 col-sm-3 ">
                        <div class="milestone">
							<img src="/main/n1.png" />
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="1292">100</div>
                            <div class="title">Экспортеров</div>
                        </div>
                    </div>
				
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="milestone">
							<img src="/main/n2.png" />
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="9039">200</div>
                            <div class="title">Импортеров</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="milestone">
							<img src="/main/n3.png" />
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="89291">3</div>
                            <div class="title">Провайдеров услуг</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="milestone">
							<img src="/main/n4.png" />
                            <div class="number" data-animation="true" data-animation-type="number" data-final-number="89291">3</div>
                            <div class="title">Экспертов</div>
                        </div>
                    </div>					
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #milestone -->

        <div id="works" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container about1">
                <h2 class="content-title">Как это работает</h2>
                <!-- begin row -->
					<?$a1 = ORM::factory('categorie')->where('id','=',394)->find()?>
					<?=$a1->html?>

                
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #team -->
		
        
        
		

        <!--div id="action-box" class="content has-bg" style="height:145px" data-scrollview="true">

            <div class="content-bg">
                <img src="/main/subs.jpg" alt="Action" />
            </div>
            <div class="container" data-animation="true" data-animation-type="fadeInRight">

                <div class="row action-box">

<div class="col-md-9 col-sm-9">
						<h3>ПОДПИШИТЕСЬ НА НАШИ НОВОСТИ!</h3>
</div>

                    <div class="col-md-9 col-sm-9">

                        
                        <p>
                           <input class="form-control" />
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <a href="#" style="height:37px;line-height:36px;padding-top:0px" class=" btn btn-sm btn-primary">Подписаться</a>
                    </div>
                </div>
            </div>
        </div-->

    <div style="display:none">    
        <!-- begin #team -->
        <div id="team" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Лучшие эксперты</h2>
                <!-- begin row -->
                <div class="row">
					<?foreach ($beste as $i=>$exp) :?>
	                    <div class="col-md-4 col-sm-4">
							<!-- begin team -->
							<div class="team">             
							
						<?if ($exp['udata']->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['udata']->photo)):?>
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/img/uimgs/<?=$exp['udata']->photo?>?rand=<?=rand()?>" />
							</div>	
						<?endif?>

								<div class="info">
									<h3 class="name"><?=$exp['udata']->fio?></h3>
									<p><?=$exp['udata']->special?></p>								
									<!--p>Лучших ответов: <?=$exp['rate']?></p-->								
									<p><a href="" style="margin-top:-10px;margin-bottom:-10px;width:145px;height:40px;padding:0px;text-align:center;line-height:40px;color:#6d6d6d;background:white" class="btn btn-default">Задать вопрос</a></p>
									<div class="social">
                                    <!--a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a-->
									
									
										<?if (strlen($exp['udata']->vk)>0) :?>
											<a href="<?=$exp['udata']->vk?>"><i class="fa fa-vk"></i></a>
										<?endif?>
										<?if (strlen($exp['udata']->fb)>0) :?>
											<a href="<?=$exp['udata']->fb?>" ><i class="fa fa-facebook fa-lg fa-fw"></i></a>
										<?endif?>
										<?if (strlen($exp['udata']->tw)>0) :?>
											<a href="<?=$exp['udata']->tw?>" ><i class="fa fa-twitter fa-lg fa-fw"></i></a>
										<?endif?>

									</div>
								</div>                     
							</div>
							<!-- end team -->
						</div>
					<?endforeach?>
                    <!-- begin col-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #team -->
</div>
        <!-- begin #team -->
        <!--div id="team1" class="content" data-scrollview="true">
            
            <div class="container">
                <h2 class="content-title">Лучшие провайдеры</h2>
            
                	<?foreach ($bestp as $i=>$exp) :?>
	                    <div class="col-md-4 col-sm-4">
			
							<div class="team">             
							
						<?if ($exp['udata']->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['udata']->photo)):?>
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/img/uimgs/<?=$exp['udata']->photo?>?rand=<?=rand()?>" />
							</div>	
						<?endif?>

								<div class="info">
									<h3 class="name"><?=$exp['udata']->fio?></h3>
									<?=str_repeat("<img src='/img/stars1.jpg'>", $exp['rate'])?><?=str_repeat("<img src='/img/stars2.jpg'>", 5 - $exp['rate'])?>
									</p>								
								</div>                     
							</div>
			
						</div>
					<?endforeach?>
                </div>
            
            </div>
            
        </div-->
        <!-- end #team -->		
	

	       	
				       <!-- begin tabs / accordion -->
        <div id="ratings" class="content" data-scrollview="true">
            <!-- begin container -->
			<div style="display:none"> 
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">Россия в рейтингах</h2>
				<?$rates = ORM::factory('article')->where('category_id','=',395)->find_all()?>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-12">
                        <!-- begin panel-group -->
                        <div class="panel-group m-b-0" id="accordion">
                            <!-- begin panel -->
							
								<?foreach ($rates as $i=>$rate) :?>
									<div class="col-md-4">	
									<div class="panel panel-default">
										<div class="panel-heading"  style="padding:15px 0">
											<h4 class="panel-title text-center" style="padding-left:15px;padding-right:15px;">
												<a data-toggle="collapse" data-parent="#accordion" href="#accordion-<?=$rate->id?>"><?=$rate->name?></a>
											</h4>
											<a data-toggle="collapse" data-parent="#accordion" href="#accordion-<?=$rate->id?>" class="rating">
												<img src="/main/gr.jpg" class="graph" />
												<?$ra = explode(",",$rate->ratings);?>
												<div class="year"><strong>Место в рейтинге</strong><br/>(<?=$ra[0]?>)</div>
												<div class="place"><?=$ra[1]?>
												<?if ($ra['3']==1):?>
													<img src="/main/up.jpg"/>
												<?else:?>
													<img src="/main/down.jpg"/>
												<?endif?>
												</div>
												<div class="places">из <?=$ra[2]?></div>
												
											</a>	
										</div>
										<div id="accordion-<?=$rate->id?>" class="panel-collapse collapse">
											<div class="panel-body">
												<p>
													<?=$rate->text?>
												</p>
											</div>
										</div>
									</div>
									
									<?if ($i %3 == 2):?>
										<div class="clearfix"></div>
										<!--/div>
										<div class="col-md-4"-->	
									<?endif?>
									</div>			
								<?endforeach?>
							
                            <!-- begin panel -->
							
							<div class="clearfix"></div>
                        </div>
                        <!-- end panel-group -->
                    </div>
                    <!-- end col-6 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
		</div>
        <!-- end tabs / accordion -->
		
        <div id="contact1" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Партнеры</h2>
		
		<div class="row" style="display:none">
			    <a class="cent_item" href="http://www.rlp.su/" rel="nofollow" target="_blank" title="Русский логистический провайдер">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/firmennyj_znak_rlp_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="" rel="nofollow" target="_blank" title="Карго раппорт">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/kargo_rapport_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://www.rlp.su/" rel="nofollow" target="_blank" title="RLP Customs">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/rlp_customs_-prozrach_fon_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://www.expert-consult.su/" rel="nofollow" target="_blank" title="Экспертный консалтинг">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/expc_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://spb.gestionbroker.ru/" rel="nofollow" target="_blank" title="Партнер 111">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/bluelogo_180_70_png.png" width="162" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://www.rgwto.com/" rel="nofollow" target="_blank" title="">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/bufer_obmena-11_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://www.evrazes-bc.ru/" rel="nofollow" target="_blank" title="Деловой совет">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/logo_delovoy_sovet2_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>
    <a class="cent_item" href="http://wto.wtcmoscow.ru/" rel="nofollow" target="_blank" title="Россия в ВТО">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/wto_logo_rus21_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a>

      </div>
	  <div class="row">
		<div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <!--ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>                                
                            </ol-->

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
									<table style="margin:0 auto;width:80%"><tr><td>
                                    <a class="cent_item" href="http://www.rlp.su/" rel="nofollow" target="_blank" title="Русский логистический провайдер">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/firmennyj_znak_rlp_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td><td>
    <a class="cent_item" href="" rel="nofollow" target="_blank" title="Карго раппорт">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/kargo_rapport_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td><td>
    <a class="cent_item" href="http://www.rlp.su/" rel="nofollow" target="_blank" title="RLP Customs">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/rlp_customs_-prozrach_fon_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td><td>
    <a class="cent_item" href="http://www.expert-consult.su/" rel="nofollow" target="_blank" title="Экспертный консалтинг">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/expc_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td></tr></table>
                                </div>
                                <div class="item"><table style="margin:0 auto"><tr><td>
    <a class="cent_item" href="http://spb.gestionbroker.ru/" rel="nofollow" target="_blank" title="Партнер 111">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/bluelogo_180_70_png.png" width="162" height="70" border="0" align="absmiddle"></a></td>
								
								<td>
    <a class="cent_item" href="http://www.rgwto.com/" rel="nofollow" target="_blank" title="">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/bufer_obmena-11_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td>
								
								<td>
                                    <a class="cent_item" href="http://www.evrazes-bc.ru/" rel="nofollow" target="_blank" title="Деловой совет">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/logo_delovoy_sovet2_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td><td>
    <a class="cent_item" href="http://wto.wtcmoscow.ru/" rel="nofollow" target="_blank" title="Россия в ВТО">
     		<img src="http://proved-np.org//images/cms/thumbs/0dcd088c67883d6fbb40da0436671624dbbbec8d/wto_logo_rus21_180_70_jpg.jpg" width="180" height="70" border="0" align="absmiddle"></a></td></tr></table>

                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
			</div>
		</div></div>

        <!-- begin #contact -->
        <div id="contact11" class="content " data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h3 class="content-title">Наши контакты</h3>
				
				<?$a1 = ORM::factory('categorie')->where('id','=',396)->find()?>
				<?//=$a1->html?>
                
				<p class="content-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                    sed bibendum turpis luctus eget
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6" data-animation="true" data-animation-type="fadeInLeft">
                        <h3>If you have a project you would like to discuss, get in touch with us.</h3>
                        <p>
                            Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus.
                        </p>
                        <p>
                            <strong>SeanTheme Studio, Inc</strong><br />
                            795 Folsom Ave, Suite 600<br />
                            San Francisco, CA 94107<br />
                            P: (123) 456-7890<br />
                        </p>
                        <p>
                            <span class="phone">+11 (0) 123 456 78</span><br />
                            <a href="mailto:hello@emailaddress.com">seanthemes@support.com</a>
                        </p>
                    </div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                    <div id="cont" class="col-md-6 form-col" data-animation="true" data-animation-type="fadeInRight">
                        <div class="form-horizontal" id="contform">
                            <div class="form-group">
                                <label class="control-label col-md-3">Наименование <span class="text-theme">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="fio" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email <span class="text-theme">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Сообщение <span class="text-theme">*</span></label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="message" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-9 text-left">
                                    <button onclick="return controlform('#contform')"  class="btn btn-theme btn-block">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-6 -->
                </div>
				
				
				
            </div>
            <!-- end container -->
        </div>
        <!-- end #contact -->	
		

        
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

	
		<div class="modal fade" id="modal-bych">			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h4 class="modal-title"><table style="width:95%"><tr><td>Быченков Денис</td><td style="text-align:right;"><span style="font-size:80%">Основатель проекта</span></td></tr></table></h4>
						<div class="clearfix"></div>
					</div>
					<div class="modal-body" style="color:black;padding:25px;">
	<p style="text-align:justify"><img src="/main/db1.jpg" style="margin-right:15px;position:relative;top:5px;margin-bottom:5px;padding:5px;border:1px solid #999" align="left"/>
	<strong>ПРОФЕССИОНАЛЬНАЯ ДЕЯТЕЛЬНОСТЬ</strong><br />
	Денис имеет опыт развития различных международных проектов как в коммерческой, так и в некоммерческой сфере. </p><p style="text-align:justify">С 2010 по 2013 гг. Денис возглавлял Дирекцию по международным программам Общероссийской общественной организации &laquo;Деловая Россия&raquo;, где, помимо вопросов международного взаимодействия, координировал работу двух комитетов и одного отраслевого отделения &laquo;Деловой России&raquo; - Комитета по внешнеэкономической деятельности и таможенному регулированию, Комитета по развитию экспорта и Отраслевого отделения по таможенному делу.<br />
	С 2013 занимался развитием общественной деловой организации &ndash; Некоммерческое партнерство профессионалов внешнеэкономической деятельности &laquo;ПРОВЭД&raquo;.<br />
	<br />
	<strong>ОБРАЗОВАНИЕ</strong><br />
	Денис закончил отделение политологии философского факультета МГУ им. Ломоносова. Прошел обучение по программе повышения квалификации &laquo;Управление международным бизнесом&raquo; во Всероссийской академии внешней торговли Министерства экономического развития России.</p><p style="text-align:justify">
	В настоящее время в Национальном исследовательском университете - Высшая школа экономики готовит кандидатскую диссертацию по проблематике политических рисков.</p><p style="text-align:justify">
	Сфера компетенций: развитие международных проектов, международное сотрудничество, экспансия бизнеса на внешние рынки, анализ и оценка безопасности политической среды как компонента инвестиционного климата в стране ведения бизнеса, взаимодействие с органами государственной власти и неправительственными организациями (GR).
	</p>
<div class="team">
	<div class="about1 social">
	
		<a href="https://www.facebook.com/provednp"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
		<a href="http://ru.linkedin.com/pub/denis-bychenkov-shafran/27/278/58a/en"><i class="fa fa-linkedin fa-lg fa-fw"></i></a>
	
	</div></div>
	
					</div>
				</div>			
		</div>
		</div>	
	
	
		<div class="modal fade" id="modal-about">			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h4 class="modal-title">Наша история</h4>
					</div>
					<div class="modal-body" style="color:black;padding:25px;">
					<p>
					<img src="/main/456.jpg" width="550px"/>
					</p><p style="text-align:justify;padding-top:10px">
					
	Идея создания платформы (сервиса) &laquo;ПРОВЭД&raquo; стала результатом длительного опыта работы в сфере внешнеэкономической деятельности и поиска современного и технологичного решения, которое позволило бы в одном месте решать все основные задачи, связанные с организацией внешнеэкономической деятельности.</p><p style="text-align:justify">
	На протяжении последних лет, втечение которых вопросы ВЭД впервые были включены в повестку национального диалога между государством и бизнесом, мы были активными участниками многочисленных консультаций и совещаний, где участники ВЭД формулировали ключевые проблемы и предлагали различные решения.</p><p style="text-align:justify">
	Мы провели сотни встреч с провайдерами услуг ВЭД, экспортерами, импортерами и экспертами. Приняли участие, как спикеры, организаторы и модераторы, в десятках дискуссий и конференций, посвященных вопросам внешнеэкономической деятельности.<br />
	Изучили зарубежный опыт и практику поддержки ВЭД, в том числе, посредством набирающих популярность IT решений и on-line сервисов.</p><p style="text-align:justify">
	В результате, понимая проблемы, с которыми сталкиваются участники ВЭД, принимая во внимание запрос делового сообщества на расширение доступных для малого и среднего бизнеса инструментов для ведения внешнеэкономической деятельности, мы приняли решение создать коммуникационную рабочую платформу, цель которой объединить в одном месте участников ВЭД &ndash; провайдеров услуг, экспортеров и импортеров, а также экспертов в сфере ВЭД.</p><p style="text-align:justify">
	Нам было важно собрать в одном месте не просто всех участников ВЭД, но надежные и проверенные компании. Это достигается за счет нашего DDG-аудита (due-dilligence) каждой компании, подавшей заявку на регистрацию на платформе. Это включает в себя проверка юридической чистоты и финансовой устойчивости компании. Дополнительная оценка уже зарегистрированных участников платформы осуществляется самим участниками путем выставления оценки после выполнения работ и рекомендациями других участников платформы.</p><p>
	Мы являемся абсолютно не зависимой площадкой. В отличие от других похожих сервисов, мы не являемся афилированными с какой-либо организацией или компанией, собирая клиентскую базу и ангажировано распределяя в пользу своих учредителей заказы на те или иные услуги. Именно поэтому мы являемся платным сервисом. Наш бизнес &ndash; это предоставление качественного, надежного и удобного сервиса для участников ВЭД.</p><p style="text-align:justify">
	Приглашаем Вас стать участником платформы ПРОВЭД и найти надежных партнеров для развития Вашего бизнеса.</p>
					</div>
				</div>			
		</div>
		</div>	
	
	
		<div class="modal fade" id="modal-login">
			<form method="POST" action="/user/login" id="jq13912" class="form-horizontal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
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
                                    <label class="col-md-3 control-label">Запомнить меня</label>
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
