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
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />

    <link href="/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />	

	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>	
	<script src="/public/js/mi.js"></script>	
	
	<link href="/assets/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" />
	<link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="/public/css/row.css?r=<?=rand()?>" rel="stylesheet" type="text/css" />

	<link href="/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<link href="assets/css/invoice-print.min.css" rel="stylesheet" />

	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="/assets/plugins/select2/dist/css/select2.css" rel="stylesheet" />
	
	
		<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
		<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
	
	<script>
		function datepicker() {
			//alert(123);
				$('.datepicker').datepicker({minDate: 0,dateFormat: "dd.mm.yy",
            dayNames: ["Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье", "Понедельник"],
            dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            dayNamesShort: ["Пон", "Втр", "Срд", "Чет", "Пят", "Суб", "Вск"],
            monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            firstDay: 1});
		}
	</script>
	
	
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="/" class="navbar-brand" style="width:300px"><span class="navbar-logo"></span> <span class="text-theme"><span style="color:red">Russia</span> <span style="color:black">Going Global</span></span></a></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right m-l-15">
					<!--li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							НП "ПРОВЭД" (меню)
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="media">
                                <a href="http://proved-np.org/services/o_nas/">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">О нас</h6>
                                        <p>Обращение Генерального директора</p>
                                    </div>
                                </a>
                            </li>
							<li class="media">
                                <a href="http://http://proved-np.org/services/centr_sodejstviya_ved/">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Центр содействия ВЭД</h6>
                                        <p>Наши услуги</p>
                                    </div>
                                </a>
                            </li>
							<li class="media">
                                <a href="http://proved-np.org/services/novosti/novosti_ved/">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Пресс-центр</h6>
                                        <p>Новости ВЭД</p>
                                    </div>
                                </a>
                            </li>
							<li class="media">
                                <a href="http://proved-np.org/services/obratnaya_svyaz/">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Напишите нам!</h6>
                                        <p>Обратная связь</p>
                                    </div>
                                </a>
                            </li>							
							<li class="media">
                                <a href="http://proved-np.org/services/o_nas/vstupit/">
                                    <div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Вступить</h6>
                                        <p>Преимущества и условия</p>
                                    </div>
                                </a>
                            </li>							

                            <li class="dropdown-footer text-center">
                                <a href="http://proved-np.org">На сайт</a>
                            </li>
						</ul>
					</li-->
<?if ($login['name'] != -1) :?>

					<?else:?>
						<li class="dropdown navbar-user">
							<table class="table">
                                <tbody>
                                    <tr>
							            <td><a href="#modal-login" class="btn btn-sm btn-inverse" data-toggle="modal">Войти</a></td>
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
		<?if ($login['name'] != -1) :?>
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<?if ($login['name'] != -1) :?>
					<ul class="nav">
						<li class="nav-profile">
							<?if ($login['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$login['photo'])):?>
								<div class="image" style="display:table-cell">
									<a href="/user/cabinet"><img src="/img/uimgs/<?=$login['photo']?>" alt="" /></a>
								</div>
							<?endif?>
						
							<div class="info" style="display:table-cell">
								<?=$login['fio']?> <?=$login['lastname']?> <?=$login['surname']?><br/>
								<?$roles = array(4=>'провайдер',5=>'эксперт-консультант',3=>'импортер',2=>'администратор',6=>'экспортер')?>
								<small style="padding-left:0px"><?=$roles[$login['role']]?></small>
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
				<?if ($login['name'] != -1) :?>
				<?$newq = array(4=>'Новые заявки',5=>'Новые вопросы')?>
				<?$newq1 = array(4=>'Заявки',5=>'Вопросы')?>
				<?$newq2 = array(4=>'providerlots',5=>'providerq')?>
				<?$classes = array(4=>'icon-docs',5=>'icon-question')?>
				<?//if ($login['expert'] == 1):?>
					<ul class="nav">
					<?if (($login['role'] == 4 || $login['role'] == 5)):?>
						
							<!--li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openanswers/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>> <?=$newq[$login['role']]?></a></li-->
							<li >
								<a <?if($_SERVER['REQUEST_URI'] == '/user/'.$newq2[$login['role']] || $saletype > 0):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/<?=$newq2[$login['role']]?>/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><i class="<?=$classes[$login['role']]?>"></i> <span><?=$newq1[$login['role']]?></span> </a>							
							</li>
							<!--li><a class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/provideractivity/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><i class="fa fa-laptop"></i> <span>Сообщения</span></a>  </li-->
							<?if ($login['role'] == 4):?>
								<li >
									<a <?if($_SERVER['REQUEST_URI'] == '/user/ausers/'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/ausers/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-container="body" data-title="<?=$reject?>"<?endif?>><i class="icon-users"></i> <span>Мои эксперты</span></a>
								</li>
							<?endif?>	
					<?else:?>	
							<?if ($login['complete']==1 && $login['expert']==1) :?>
							<li >
								<a <?if($_SERVER['REQUEST_URI'] == '/user/openlots/' || $saletype == 1):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openlots/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-docs"></i> <span>Мои заявки</span></a>
							</li>
							<?endif?>
							<?if ($login['complete']==1 && $login['expert']==1) :?>
							<li >
								<a <?if($_SERVER['REQUEST_URI'] == '/user/openq/' || $saletype == 2):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openq/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-question"></i> <span>Мои вопросы экспертам</span></a>
							</li>
							<?endif?>
							<?if ($login['complete']==1 && $login['expert']==1) :?>
							<li >
								<a <?if($_SERVER['REQUEST_URI'] == '/user/addlot/'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot/"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-note"></i> <span>Создать заявку</span></a>
							</li>
							<?endif?>
							<?if ($login['complete']==1 && $login['expert']==1) :?>
							<li >
								<a <?if($_SERVER['REQUEST_URI'] == '/user/addlot?sale_type=1'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> class="<?if ($login['complete']==0 || $login['expert']==0) :?>disabled<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot?sale_type=1"<?else:?>href="javascript:void(0)" data-toggle="tooltip" data-container="body" data-placement="bottom" data-title="<?=$reject?>"<?endif?>><i class="icon-question "></i><span>Задать вопрос эксперту</span></a>
							</li>
							<?endif?>							
					<?endif?>
					<li ><a <?if($_SERVER['REQUEST_URI'] == '/user/cabinet/'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> id="elem77" href="/user/cabinet/"><i class="icon-user"></i> <span>Мой профиль</span></a></li>
					<li ><a <?if($_SERVER['REQUEST_URI'] == '/user/chpass/'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> id="elem77" href="/user/chpass/"><i class="icon-key"></i> <span>Смена пароля</span></a></li>
					<li class="has-sub"><a id="elem75" href="/user/logout/"><i class="icon-logout"></i> <span>Выход </span></span></a></li>
					<!--li><a class="text_shadow" id="elem79" href="/chasto_zadavaemie_voprosi"><i class="fa fa-laptop"></i> <span>Часто задаваемые вопросы</span></a></li-->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			<?else:?>
				<ul class="nav" style="display:none">
					<li ><a <?if($_SERVER['REQUEST_URI'] == '/chasto_zadavaemie_voprosi'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> id="elem79" href="/chasto_zadavaemie_voprosi"><i class="fa fa-laptop"></i> <span>Часто<br/> задаваемые вопросы</span></a></li>
					<li ><a <?if($_SERVER['REQUEST_URI'] == '/napravit_obraschenie'):?>style="background:none repeat scroll 0% 0% #2A72B5;color:white"<?endif?> id="elem70" href="/napravit_obraschenie" ><i class="fa fa-laptop"></i> <span>Направить обращение</span></a></li>
					<li><a href="#modal-login" data-toggle="modal"><i class="fa fa-laptop"></i> <span>Личный кабинет</span></a></li>						
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			<?endif?>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<?endif?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content content-full-width">

				<?=$content?>

				<!--div class="col-md-12 m-t-30">
					<div class="panel panel-inverse">
						<div class="panel-header">
						</div>
						<div class="panel-body">
						
						<div class="first_sub_cat_bl">
<table id="midmenu" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td width="25%"><a href="/user/register/?type=export">
<div class="im_2">
<div>Экспортерам</div>
</div>
</a></td>
<td width="25%"><a href="/user/register/?type=export">
<div class="im_1">
<div>Импортерам</div>
</div>
</a></td>
<td width="25%"><a href="/user/register/?type=provider">
<div class="im_3">
<div>Провайдерам</div>
</div>
</a></td>
<td width="25%"><a href="/user/register/?type=expert">
<div class="im_4">
<div>Экспертам</div>
</div>
</a></td>
</tr>
</tbody>
</table>
</div>
						
						</div>
					</div>
				</div-->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-inverse btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
		
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
                                    <label class="col-md-3 control-label">Запомнить меня  <span>*</span></label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="remember"  />
                                    </div>
                                </div>
								<div style="clear:both"></div>
								

					</div>
					<div class="modal-footer">						
						<a href="javascript:;"  onclick="javascript:$('#jq13912').submit();" class="btn btn-sm btn-inverse">Войти</a>
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
	
	<!--script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script-->
	<script src="/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	
	<script src="/assets/js/form-plugins.demo.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="/assets/plugins/isotope/jquery.isotope.min.js"></script>
  	<script src="/assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
	<script src="/assets/js/gallery.demo.min.js"></script>
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
	
		
			App.init();
			FormPlugins.init();
			//Gallery.init();
			/*$('.input-group-addon').datepicker({showOn:'button',dateFormat: "dd.mm.yy",
            dayNames: ["Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье", "Понедельник"],
            dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            dayNamesShort: ["Пон", "Втр", "Срд", "Чет", "Пят", "Суб", "Вск"],
            monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            firstDay: 1});*/
			
			datepicker();	
									
		});
	</script>
</body>
</html>