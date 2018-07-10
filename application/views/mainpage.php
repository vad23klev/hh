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
	<meta property="og:image" content="/main/fb.png"/>
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
<body data-spy="scroll" data-target="#header-navbar" data-offset="51" class="main mambo">

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

	function controlvedform(id) {
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

		var ved = $(id + ' input[name="ved"]').val();
		var fio = $(id + ' input[name="fio"]').val();
		var email = $(id + ' input[name="email"]').val();


		if (err == 1) {return false;} else {
			var data={fio:fio,email:email,ved:ved,title:"Запрос на подбор экспортного рынка"};
			$.post('/answer/mail1',data).done(function(answer){
				$('#vedform').modal('hide');
				$('#vedform input[type="text"]').val('');
				$('#change').modal('show');
				//console.log(answer);
			});
		}

	}

	function controlvedform2(id) {
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

		var quest = $(id + ' select[name="quest"]').val();
		var fio = $(id + ' input[name="fio"]').val();
		var email = $(id + ' input[name="email"]').val();
		var qtext = $(id + ' textarea[name="qtext"]').val();


		if (err == 1) {return false;} else {
			var data={fio:fio,email:email,quest:quest,qtext:qtext,title:"Ваш вопрос"};
			$.post('/answer/mail2',data).done(function(answer){
				$('#vedform2').modal('hide');
				// $('#vedform2 input[type="text"]').val('');
				$('#change').modal('show');
				//console.log(answer);
			});
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
			var data={fio:fio,email:email,mess:mess,title:"Сообщение через форму обратной связи на главной странице"};
			$.post('/answer/mail',data).done(function(answer){
				$('#contform input[type="text"]').val('');
				$('#contform textarea').val('');
				$('#change').modal('show');
				//console.log(answer);
			});
		}

	}

</script>



    <!-- begin #page-container -->
    <div id="page-container"  class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-transparent navbar-fixed-top" style="background:white">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-header -->
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand" >
                        <img src="/img/logo-main.png" style="height:50px" />
                        <!--span class="brand-logo"></span>
                        <span class="brand-text">
                            <span class="text-theme"><span style="color:red">Russia</span> <span style="color:black">Going Global</span></span>
                        </span-->
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
					<?require "logpop_main.php"?>
                    <ul class="nav navbar-nav navbar-right">

                        <li><a class="text_shadow" id="elem69" style="" data-click="scroll-to-target" href="#about">О проекте</a></li>
                        <li><a class="text_shadow" id="elem69" style="" data-click="scroll-to-target" href="#work-box">Как это работает</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#action-box">Возможности</a></li>
						<li><a class="text_shadow" id="elem69"  data-click="scroll-to-target" href="#service">Преимущества</a></li>
						<li><a class="text_shadow" id="elem69" data-click="scroll-to-target" href="#contact11">Контакты</a></li>
						<li class="navbar-line"></li>
						<!--li><a class="text_shadow" id="elem69" href="#modal-login" data-toggle="modal">Вход</a></li-->
						<li><a class="text_shadow" id="elem69" href="http://app.russiagoingglobal.com/reg">Регистрация</a></li>
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
            <div class="content-bg" id="subhome">
                <img src="/main/i13.jpg" style="margin:0 auto" alt="Home" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container home-content" >

                <h1 class="content-title">RUSSIA GOING GLOBAL</h1>
				<h3>ЛОКАЛЬНЫЕ КОМПЕТЕНЦИИ<br/>ГЛОБАЛЬНОЕ ПРИСУТСТВИЕ</h3>
                <p><span style="color:white">
                    НАЦИОНАЛЬНЫЙ СЕРВИС ДЛЯ ВЗАИМОДЕЙСТВИЯ ЭКСПОРТЕРОВ И ПРОВАЙДЕРОВ УСЛУГ<br/> ПО ИНТЕРНАЦИОНАЛИЗАЦИИ И ПРОДВИЖЕНИЮ НА ВНЕШНИЕ РЫНКИ</span>
					<br/><br/>
					<span style="color:white">
                    ЗАРЕГИСТРИРОВАТЬСЯ КАК</span><br/><br/>
				<a class="btn btn-outline btn-lg" id="elem69"  href="http://app.russiagoingglobal.com/reg"><strong style="color:white;">ЭКСПОРТЕР</strong></a>
				<a class="btn btn btn-outline btn-lg" id="elem69"  href="http://app.russiagoingglobal.com/reg"><strong style="color:white;">ПРОВАЙДЕР УСЛУГ</strong></a>
				<br/>
				<br/>
				<a class="btn  btn-link"   data-click="scroll-to-target"  href="#about"><strong style="color:white;">УЗНАТЬ БОЛЬШЕ О СЕРВИСЕ</strong></a>


<!--br/><br/>
<a data-click="scroll-to-target" href="#about" style="text-transform:uppercase">узнать больше о проекте</a-->
				</p>


            </div>
            <!-- end container -->
        </div>
        <!-- end #client -->



        <!-- begin #about -->
        <div id="about" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">О сервисе </h2>
                <!-- begin row -->
                <div class="row">

				                     <!-- begin col-4 -->

                    <!-- end col-4 -->
                    <!-- begin col-4 -->
<div class="col-md-6 col-sm-6">
                        <!--h3>Миссия</h3-->
                        <!-- begin about-author -->
                        <div class="about-author">
                            <div class="quote bg-silver">
                                <i class="fa fa-quote-left"></i>
                                <h4 style="font-style:italic; font-size: 14px; text-align: justify;">
                                    России нужны компании, которые не только способны обеспечить страну современной качественной продукцией, но и завоевывать мировые рынки.<br/><br/>
                                    Выход на внешние рынки, экспансия российской продукции должны стать естественной стратегией развития национального бизнеса, всей российской экономики.
                                </h4>
                                <i class="fa fa-quote-right"></i>
                            </div>
                            <div class="author">
                                <div class="image">
                                    <img src="/main/putin_128.png"  />
                                </div>
                                <div class="info about1">
                                     <span style="font-size:90%;">— В.В. Путин, <span style="font-weight:normal">Президент России</span></span>
                                </div>
                            </div>
                        </div>
                        <!-- end about-author -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                   <div class="col-md-6 col-sm-6">
                        <!-- begin about -->
                        <div class="about about1" style="color:black">
                            <!--h3>О проекте</h3-->
                            <p style="text-align:justify"><strong>Russia Going Global</strong> – российский проект, призванный внести вклад в развитие национальной инфраструктуры поддержки российского несырьевого экспорта и его продвижение на рынки зарубежных стран.</p><p style="text-align:justify">Цель проекта – стать общенациональной площадкой частных услуг, где российские малые и средние экспортно-ориентированные компании смогут найти исчерпывающий набор доступных решений, необходимых для выхода и продвижения на внешних рынках.</p><p style="text-align:justify"><strong>Russia Going Global</strong> собирает на одной площадке российских и зарубежных провайдеров услуг, частных консультантов-экспертов и экспортеров и предоставляет удобный сервис для взаимодействия заинтересованных пользователей.</p>
	<div class="text-right">
		<a href="/o_proekte">Подробнее</a>
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

<div class="content has-bg" data-scrollview="true" style="padding:60px 0;">
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
                            <!-- <i class="fa fa-globe"></i> -->
                            <img src="/main/logoп.png" alt="" class="logo-mini">
                        </div>
                        <h3>НАЧНИТЕ ЭКСПОРТИРОВАТЬ СЕГОДНЯ!</h3>
                        <p style="text-indent:0px;padding-left:85px;color:white">
                           Если Вы задумываетесь об экспорте, интернационализации, географической экспансии Вашего бизнеса на внешние рынки, но не знаете с чего начать, тогда воспользуйтесь сервисом Russia Going Global. Тысячи профессионалов готовы помочь Вам реализовать Ваш экспортный проект.
                        </p>
                    </div>
					<div class="col-md-3 col-sm-3" style="margin-top:30px">
                        <a href="http://app.russiagoingglobal.com/reg" style="padding:15px 0" class="btn btn-outline btn-block">Регистрация</a>
                    </div>
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

<div id="work-box" class="content " data-scrollview="true" style="padding:20px 0  0 !important;">
            <!-- begin content-bg -->

            <div class="container fadeInRight contentAnimated" data-animation="true" data-animation-type="fadeInRight">
                <!-- begin row -->
                <h2 class="content-title" style="margin-bottom: 0;"> Как это работает </h2>
                <div class="row action-box">
                 	<img src="/main/howitworks.jpg" style="margin-bottom: -30px;" width="100%" />
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

 <div id="action-box" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Возможности</h2>

                <p class="content-desc">
                    <?$a1 = ORM::factory('article')->where('category_id','=',400)->find_all()?>
					<?//=strip_tags($a1->html)?>
                </p>
                <!-- begin row -->
                <div class="row">
					<?$icons = array('0'=>'Businessmen_salutation_standing_one_in_front_the_other_and_one_carrying_a_suitcase_32.png','1'=>'Chat_room_32.png','2'=>'Magnifier_tool_on_Earth_globe_32.png')?>
						<?foreach ($a1 as $i=>$v) :?>
							<div class="col-md-4 col-sm-4">
								<div class="service">
									<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn">
										<img src="/op/icons/<?=$icons[$i]?>"/>
									<!--i class="fa <?=$icons[$i]?>"></i-->
									</div>
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


<div id="quote" class="content bg-black-darker has-bg" style="background: 17293D;" data-scrollview="true">
            <!-- begin content-bg -->
            <!-- <div class="content-bg">
                <img src="/op/assets/img/quote-bg.jpg" alt="Quote">
            </div> -->
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container fadeInLeft contentAnimated" data-animation="true" data-animation-type="fadeInLeft">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12 quote">

                        <i class="fa fa-quote-left"></i> Малый и средний бизнес, действующий на международных рынках,<br/> имеет вдвое больше шансов на успешное развитие <br/>по сравнению с компаниями, работающими только<br/> в рамках одной страны</span>!
                        <i class="fa fa-quote-right"></i>
                        <small>«Интернационализация как инструмент эффективности малого и среднего бизнеса», исследование IHS для DHL Express</small>
                    </div>
                    <!-- end col-12 -->
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
					<?$icons = array('0'=>'Verification_of_delivery_list_clipboard_symbol_32.png','1'=>'Businessman_delegating_work_in_others_32.png','2'=>'provider.png')?>
						<?foreach ($a1 as $i=>$v) :?>
							<div class="col-md-4 col-sm-4">
								<div class="service">
									<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn">
									<img src="/op/icons/<?=$icons[$i]?>" /></div>
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



<div id="action-box" class="content " data-scrollview="true" style="padding:0px 0 0px;">
            <!-- begin content-bg -->
            <!-- <div class="content-bg"> -->
                <!-- <img src="/op/assets/img/map_new.png" alt="Action"> -->
                <!-- <div class="content-bg grad_bl"> -->

                <!-- </div> -->
            <!-- </div> -->
            <!-- end content-bg -->
            <!-- begin container -->
            
            <div class="container fadeInRight contentAnimated" data-animation="true" data-animation-type="fadeInRight">
            	<h2 class="content-title" style="margin-bottom: 40px; margin-top: -60px; height: 10px;"> &nbsp; </h2>
                <!-- begin row -->
                <div class="row action-box">
                    <!-- begin col-9 -->
                    <!-- Commented companies logo.
					<div class="col-md-12 col-sm-12 text-center">
						<table style="width:100%"><tr>
						<td><img src="/op/logos/image001.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image003.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image005.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image007.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image009.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image011.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image015.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image019.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image017.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image021.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						<td><img src="/op/logos/image023.png" style="max-height:85px;" data-animation="true" data-animation-type="fadeInRight"/></td>
						</tr></table>
					</div>
                    <div class="col-md-12 col-sm-12 text-center">
						<p style="padding-top:15px; color: #172E52;">
                        <h3 style="font-size: 17px; font-weight: bold;">Эти российские компании уже присутствуют на зарубежных рынках. Хотите быть среди них?<br/> Воспользуйтесь сервисом Russia Going Global.</h3>
                        </p>
                        <a href="http://app.russiagoingglobal.com/reg" style="max-width: 25%; margin: 15px auto 0 auto; color: #172E52; border-color: #172E52; padding:15px 10px" class="btn btn-outline btn-block map-reg_btn">Регистрация</a>
                    </div>
                    -->
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- end #about -->


        <!--div id="works" class="content" data-scrollview="true">
            <div class="container about1">
                <h2 class="content-title">Как это работает</h2>

					<?//$a1 = ORM::factory('categorie')->where('id','=',394)->find()?>
					<?//=$a1->html?>

            </div>
        </div-->
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
        <div id="ratings" class="content" data-scrollview="true"  style="display:none">
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

        <div id="contact1" class="content" data-scrollview="true" style="display:none">
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
        <div id="contact11" class="content " data-scrollview="true" style="background: #F4F6F7;">
            <!-- begin container -->
            <div class="container">

				<?$a1 = ORM::factory('categorie')->where('id','=',396)->find()?>
				<?//=$a1->html?>

				<p style="display:none" class="content-desc">
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-3 col-sm-3">

                    </div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                    <div id="cont" class="col-md-6 col-sm-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<h2 class="content-title">Написать нам</h2>
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
        <!-- end #contact -->
		<div  class="content " data-scrollview="true">
            <!-- begin container -->
            <div class="container">
            	<div class="row action-box">
                    <!-- begin col-9 -->
					<div class="col-md-12 col-sm-12 text-center">
						<table style="width:100%; margin-top: 20px;"><tr>
						<td width="10%"></td>
						<td><a href="http://www.ved.gov.ru/"><img src="/main/l1.jpg" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
						<td><a href="http://minpromtorg.gov.ru/"><img src="/main/l2.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
						<td><a href="http://ruexport.org/"><img src="/main/l3.jpg" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
								<td><a href="http://www.ved21.ru"><img src="/main/2.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
						<!-- <td><a href="https://www.exiar.ru/"><img src="/main/l4.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td> -->
						<td width="10%"></td>
						</tr>
						<tr>
						<td width="10%"></td>
						<td><a href="http://asi.ru/investclimate/export/"><img src="/main/l5.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
						<td><a href="http://veb.ru/strategy/export/s1w/"><img src="/main/l6.jpg" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
					<!-- 	<td><a href="http://exportcenter.ru/"><img src="/main/l7.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>

 -->				
 						<td><a href="http://export-ugra.ru"><img src="/main/11.png" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
 						<td><a href="http://russiancouncil.ru/aplusstandard/"><img src="/main/l8.jpg" style="max-height:75px; margin: 0 10px 35px 0" data-animation="true" data-animation-type="fadeInRight"/></a></td>
						<td width="10%"></td>
						</tr>
						<tr>
						<td width="10%"></td>
						<td><a href="http://r45.ved.gov.ru/"><img src="/main/kg.jpg" style="max-height:75px; margin: 0 10px 35px 0;" data-animation="true" data-animation-type="fadeInRight"/></a></td>
							
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>
						</table>
					</div>
                </div>
            </div>
        </div>

<div id="footer" class="footer">
            <div class="container">

				<div style="color:white;" class="text-left col-md-3 nopr pull-right">
					<!-- <a style="color:white;" href="/privetstvie">Приветствие</a> -->
					<br/><a style="color:white; display: none;" href="/novosti">Новости</a>
					<a style="color:white; display: none;" href="/forum">Форум</a>
					<a style="color:white;" href="/o_proekte">О проекте</a>
					<br/>
					<a style="color:white;" href="/chasto_zadavaemie_voprosi">Часто задаваемые вопросы</a>
					<br/>
					<!-- <a style="color:white;" href="/companies/list/0">Каталог компаний</a> -->
					<br/>
					<!-- <a style="color:white;" href="/companies/list/1">Каталог консультантов</a> -->
				</div>


                <div style="color:white;" class="col-md-4 nopr nopl pull-left">
				<?=$info->text2?>
                </div>
<div style="color:white;" class="text-left col-md-4 nopr pull-left">
				<p class="text-center">
					<img src="/img/logo-white.png" style="margin-bottom:10px" /><br/>
                    <a href="https://vk.com/public100500488"><i class="fa fa-vk fa-fw fa-2x"></i></a>
					<a href="https://www.facebook.com/russiagoingglobal/"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
					<a href="https://www.linkedin.com/company/globalizeme.pro?report%2Esuccess=KJ_KkFGTDCfMt-A7wV3Fn9Yvgwr02Kd6AZHGx4bQCDiP6-2rfP2oxyVoEQiPrcAQ7Bf"><i class="fa fa-linkedin fa-fw fa-2x"></i></a>
                </p>
			</div>

            </div>
        </div>

    </div>
    <!-- end #page-container -->

	<div class="modal fade" id="vedform">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h4 class="modal-title">Поиск экспортного рынка</h4>
					</div>
					<div class="modal-body">
                             <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="codved" name="ved" placeholder="Код ТН ВЭД" rel="Код ТН ВЭД"  class="form-control" />
                                </div>
                            </div>

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

                                <div class="col-md-12 text-left">
                                    <button onclick="return controlvedform('#vedform')"  class="btn btn-primary btn-block">Отправить</button>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="vedform2">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h4 class="modal-title">Задать вопрос</h4>
					</div>
					<div class="modal-body">
                         <div class="form-horizontal">
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
                                	<select name="quest" class="form-control">
<option selected="true" style="display:none;">Тема вопроса</option>
<option value="" disabled>Нефинансовая поддержка</option>
<option value="Оценка готовности к экспорту">&nbsp;&nbsp;&nbsp;&nbsp;Оценка готовности к экспорту</option>
<option value="Подбор и анализ экспортных рынков">&nbsp;&nbsp;&nbsp;&nbsp;Подбор и анализ экспортных рынков</option>
<option value="Продвижение продукции (разработка, перевод и адаптация маркетинговых материалов, реклама, PR, продвижение через Интернет)">&nbsp;&nbsp;&nbsp;&nbsp;Продвижение продукции (разработка, перевод и адаптация маркетинговых материалов, реклама, PR, продвижение через Интернет)</option>
<option value="Организация деловых мероприятий (бизнес-миссии, выставки, ярмарки, тендеры, конкурсы и т.п.)">&nbsp;&nbsp;&nbsp;&nbsp;Организация деловых мероприятий (бизнес-миссии, выставки, ярмарки, тендеры, конкурсы и т.п.)</option>
<option value="Консультирование (общее) по организации экспорта">&nbsp;&nbsp;&nbsp;&nbsp;Консультирование (общее) по организации экспорта</option>
<option value="Поиск зарубежных партнеров (поиск, проверка, организация переговоров)">&nbsp;&nbsp;&nbsp;&nbsp;Поиск зарубежных партнеров (поиск, проверка, организация переговоров)</option>
<option value="Юридическое сопровождение экспорта">&nbsp;&nbsp;&nbsp;&nbsp;Юридическое сопровождение экспорта</option>
<option value="Бухгалтерское сопровождение экспорта (возврат НДС)">&nbsp;&nbsp;&nbsp;&nbsp;Бухгалтерское сопровождение экспорта (возврат НДС)</option>
<option value="Обучение экспорту">&nbsp;&nbsp;&nbsp;&nbsp;Обучение экспорту</option>
<option value="Получение разрешительной документации для экспорта">&nbsp;&nbsp;&nbsp;&nbsp;Получение разрешительной документации для экспорта</option>
<option value="Экспортный контроль (лицензирование)">&nbsp;&nbsp;&nbsp;&nbsp;Экспортный контроль (лицензирование)</option>
<option value="Сертификация">&nbsp;&nbsp;&nbsp;&nbsp;Сертификация</option>
<option value="Защита интеллектуальной собственности">&nbsp;&nbsp;&nbsp;&nbsp;Защита интеллектуальной собственности</option>
<option value="Валютный контроль">&nbsp;&nbsp;&nbsp;&nbsp;Валютный контроль</option>
<option value="Таможенное оформление">&nbsp;&nbsp;&nbsp;&nbsp;Таможенное оформление</option>
<option value="Транспортировка и логистика">&nbsp;&nbsp;&nbsp;&nbsp;Транспортировка и логистика</option>
<option value="Управление экспортным проектом (аутсорсинг)">&nbsp;&nbsp;&nbsp;&nbsp;Управление экспортным проектом (аутсорсинг)</option>
<option value="" disabled>Финансовая поддержка</option>
<option value="Кредитование">&nbsp;&nbsp;&nbsp;&nbsp;Кредитование</option>
<option value="Страхование">&nbsp;&nbsp;&nbsp;&nbsp;Страхование</option>
<option value="Гарантии">&nbsp;&nbsp;&nbsp;&nbsp;Гарантии</option>
                                	</select>
                                    <!-- <input type="text"  name="quest"  rel="Тип вопроса"  class="form-control" /> -->
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="qtext" rel="Текст вопроса" placeholder="Ваш вопрос"  class="form-control" /></textarea>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12 text-left">
                                    <button onclick="return controlvedform2('#vedform2')"  class="btn btn-primary btn-block">Отправить</button>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

	 <!-- action="/user/login" -->
		<div class="modal fade" id="modal-login">
			<form method="POST" id="jq13912" action="/user/login" class="form-horizontal">
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
	<script src="/public/js/mi.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
	    $(document).ready(function() {
	        App.init();
			Gallery.init();
			$(".zoom").colorbox({photo:true,transition:"none",innerHeight:'600px'});
			$("#codved").mask("9999999999");
	    });
	</script>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'Jy5mcoW8Cu';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>
