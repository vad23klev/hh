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
	<!--meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /-->
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/public/js/mi.js"></script> 
	
	<link href="/public/css/row.css" rel="stylesheet" type="text/css" />
	
		<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<!--script src="/assets/plugins/pace/pace.min.js"></script-->
	<!-- ================== END BASE JS ================== -->

	
</head>
<body>
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="/" class="navbar-brand"><img src="http://faq.proved-np.org/img/logo.jpg" height="35px" /></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<!--li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<span class="label">5</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Notifications (5)</li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Server Error Reports</h6>
                                        <div class="text-muted f-s-11">3 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">John Smith</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">25 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="/assets/img/user-2.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Olivia</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">35 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New User Registered</h6>
                                        <div class="text-muted f-s-11">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New Email From John</h6>
                                        <div class="text-muted f-s-11">2 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-footer text-center">
                                <a href="javascript:;">View more</a>
                            </li>
						</ul>
					</li-->
					<?if ($login['name'] != -1) :?>
						<li class="dropdown navbar-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
								<img src="/assets/img/user-13.jpg" alt="" /> 
								<span class="hidden-xs">Adam Schwartz</span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu animated fadeInLeft">
								<li class="arrow"></li>
								<li><a href="javascript:;">Edit Profile</a></li>
								<li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
								<li><a href="javascript:;">Calendar</a></li>
								<li><a href="javascript:;">Setting</a></li>
								<li class="divider"></li>
								<li><a href="javascript:;">Log Out</a></li>
							</ul>
						</li>
					<?else:?>
						<li class="dropdown navbar-user">
							<table class="table">
                                <tbody>
                                    <tr>
							            <td><a href="#modal-login" class="btn btn-sm btn-success" data-toggle="modal">Войти</a></td>
							        </tr>
                                </tbody>
                            </table>
						</li>
					<?endif?>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<?if ($login['name'] != -1) :?>
					<ul class="nav">
						<li class="nav-profile">
							<?if ($login['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$login['photo'])):?>
								<div class="image">
									<a href="/user/cabinet"><img src="/img/uimgs/<?=$login['photo']?>" alt="" /></a>
								</div>
							<?endif?>
						
							<div class="info">
								<?=$login['fio']?><br/>
								<?$roles = array(4=>'провайдер услуги',5=>'эксперт-консультант',3=>'экспортер/импортер',2=>'администратор')?>
								<small><?=$roles[$login['role']]?></small>								
							</div>
						</li>
					</ul>
				<?else:?>
					<ul class="nav">
						<li class="nav-profile">
							<div class="info">&nbsp;
							</div>
						</li>
					</ul>
				<?endif?>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
							<?$reject = "Вы пока не можете работать с заявками и пользоваться сервисом консультаций, так как Ваш профиль еще не активирован. Для активации профиля Вам необходимо на странице Вашего профиля заполнить все поля, отмеченные как обязательные для заполнения"?>
				
			<?if ($login['name'] != -1) :?>
				<?$newq = array(4=>'Новые заявки',5=>'Новые вопросы')?>
				<?$newq1 = array(4=>'Заявки',5=>'Вопросы')?>
				<?//if ($login['expert'] == 1):?>
					<ul class="nav">
					<?if (($login['role'] == 4 || $login['role'] == 5)):?>
						
							<!--li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openanswers/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>> <?=$newq[$login['role']]?></a></li-->
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/providerlots/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> <?=$newq1[$login['role']]?></a><?if ($nm > 0):?><span style="color:red">(<?=$nm?>)</span><?endif?></li>
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/provideractivity/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Сообщения</a>  <?if ($nm1 > 0):?><span style="color:red">(<?=$nm1?>)</span><?endif?></li>
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/ausers/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Мои пользователи</a></li>
					<?else:?>										
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openlots/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Заявки</a></li>
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/activity/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Сообщения</a></li>
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Создать заявку</a></li>
							<li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot?sale_type=1"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Задать вопрос эксперту</a></li>							
					<?endif?>
					<li><a class="text_shadow" id="elem77" href="/user/cabinet/"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Мой профиль</a></li>
					<li><a class="text_shadow" id="elem77" href="/user/chpass/"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Смена пароля</a></li>
					<li><a class="text_shadow" id="elem75" href="/user/logout/"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Выход</a></li>
					<li><a class="text_shadow" id="elem79" href="/chasto_zadavaemie_voprosi"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Часто<br/> задаваемые вопросы</a></li>
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><b class="caret pull-right"></b><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			<?else:?>
				<ul class="nav">
					<li><a class="text_shadow" id="elem79" href="/chasto_zadavaemie_voprosi"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Часто<br/> задаваемые вопросы</a></li>
					<li><a class="text_shadow" id="elem70" href="/napravit_obraschenie" ><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Направить обращение</a></li>
					<li><a href="#modal-login" data-toggle="modal"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> Личный кабинет</a></li>						
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			<?endif?>

				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!--ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li class="active">Dashboard</li>
			</ol-->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<?=$content?>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
		
		<div class="modal fade" id="modal-login">
			<form method="POST" action="/user/login" id="jq13912">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h4 class="modal-title">Войти</h4>
					</div>
					<div class="modal-body">
                               <div class="form-group">
                                    <label class="col-md-3 control-label">ИНН / Имя пользователя  <span>*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="username" class="form-control" placeholder="ИНН / Имя пользователя" />
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
								

					</div>
					<div class="modal-footer">						
						<a href="javascript:;"  onclick="javascript:$('#jq13912').submit();" class="btn btn-sm btn-success">Войти</a>
						<a href="/user/forgot" >Забыли пароль</a> &nbsp; <a href="/user/register" >Регистрация</a>											
					</div>
				</div>			
		</form>
		</div>
		</div>
		
		
	</div>
	
	
	
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	
	<!--[if lt IE 9]>
		<script src="/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="/assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/js/dashboard.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			//Dashboard.init();
		});
	</script>
</body>
</html>