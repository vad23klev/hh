<?
function convdate($dta) {
	$darray = explode("-",$dta);
	$months = array("1"=>"янв","2"=>"фев","3"=>"мар","4"=>"апр","5"=>"май","6"=>"июн","7"=>"июл","8"=>"авг","9"=>"сен","10"=>"окт","11"=>"ноя","12"=>"дек");
	$str = $darray[2]." ".$months[intval($darray[1])]." ".$darray[0];
	return $str;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$title?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?=$description?>" name="description" />
	<meta content="<?=$title?>" name="keywords" />

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
	<link href="/blog/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/blog/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/blog/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/blog/assets/css/style.css" rel="stylesheet" />
	<!--link href="/forum1/assets/css/style.css" rel="stylesheet" /-->
	<link href="/blog/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/blog/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/blog/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #header -->
    <div id="header" style="height:54px" class="header navbar navbar-default navbar-fixed-top navbar-small" data-state-change="disabled">
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
                        <img src="/img/logo.png">
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <div class="collapse navbar-collapse" id="header-navbar">
						<?require $_SERVER['DOCUMENT_ROOT']."/application/views/logpop.php"?>                    
					</div>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
    <!-- end #header -->
    
    <!-- begin #content -->
    <div>
        <!-- begin container -->
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					
				</div>	
			</div>
            <!-- begin row -->
			<div class="content" id="content">
            <div class="row">
                <!-- begin col-9 -->
                <div class="col-md-9">
                    <!-- begin post-detail -->
                    <div class="post-detail section-container">
                        
						<ol class="breadcrumb pull-left">
						<li><a href="/">Главная</a></li>
						<li><a class="active" href="<?=$link?>"><?=$name?></a></li>
						<!--li><span><?=$prod->name?></span></li-->
						</ol>
						<div style="clear:both"></div>
						
                        <h4 class="post-title"><?=$prod->name?></h4>
                        <div class="post-by">
                            <?=convdate($prod->date)?> 
							<?if ($prod->sname != '' && $prod->slink != ''):?>
								<span class="divider">|</span> Источник: <a target="_blank" href="<?=$prod->slink?>"><?=$prod->sname?></a>
							<?endif?>
                        </div>
                        <!-- begin post-image -->
                        <?if (strlen($prod->picture)>0) :?>
						<div class="post-image">
							<img src="/img/news/<?=$prod->picture?>" border="0">
                        </div>
						<?endif?>
                        <!-- end post-image -->
                        <!-- begin post-desc -->
                        <div class="post-desc">
                            <?=$prod->text?>
							
							
                        </div>
						
						<hr/>
						
						<div class="pull-left">				
		<table><tr><td style="vertical-align:middle;height:29px"><h5 style="margin:0px;color:black">Поделиться новостью: &nbsp; </h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table></div>
                        <!-- end post-desc -->
                        <!-- begin post-image -->
                       
                        <!-- end post-desc -->
                    </div>
                    <!-- end post-detail -->
                    
                    
                    <!-- end section-container -->
                </div>
                <!-- end col-9 -->
                <!-- end col-3 -->
				
				
				<div class="col-md-3">
				
					<div class="section-container">
                        <div class="input-group sidebar-search" style="width:100%">
							<form method="get" action="<?=$cat->parent_chpu?>/<?=$cat->alias?>">
                            <table style="width:100%" cellpadding="0" cellspacing="0"><tr><td>
                            <input type="text" name="search" value="<?=trim($_GET['search'])?>" class="form-control" placeholder="Поиск новостей..." /></td><td style="width:39px">
                            <span class="input-group-btn">
                                <button class="btn btn-inverse" type="button"><i class="fa fa-search"></i></button>
                            </span></td></tr></table>
							</form>
                        </div>
                    </div>
				
                    <!-- begin section-container -->
                    <div class="section-container" style="margin-top:5px">
                        <h4 class="section-title"><span>Рубрики</span></h4>
                        <ul class="sidebar-list">
							<?foreach ($leftmenu as $item):?>
								<li><?$nc=$item->news->find_all()?>
								<?if ($nc->count() >0) :?>
								<a <?if ($item->id == $cat->id):?>style="font-weight:bold"<?endif?> href="<?=$item->parent_chpu?>/<?=$item->alias?>"><?=$item->name?> (<?=$nc->count()?>)</a>
								<?else:?>
								<p style="margin-bottom:0px;line-height: 20px;color: #333;border-bottom: 1px solid #DDD;display: block;padding: 10px 0px;"><?=$item->name?> (<?$nc=$item->news->find_all()?><?=$nc->count()?>)</p>
								<?endif?></li>
							<?endforeach?>
                        </ul>
                    </div>

					<div class="section-container">
                        <h4 class="section-title"><span>Последние новости</span></h4>
                        <ul class="sidebar-recent-post">
							<?foreach ($lastnews as $item):?>
                            <li>
                                <div class="info">
                                    <h4 class="title"><a href="/<?=$item->parent_chpu?>/<?=$item->alias?>.html"><?=$item->name?></a></h4>
                                    <div class="date"><?=convdate($item->date)?></div>
                                </div>
                            </li>
							<?endforeach?>
                            
                        </ul>
                    </div>
					
					<div class="section-container">
                        <h4 class="section-title"><span>Подписаться</span></h4>
                        <table style="width:100%">
							<tr><td style="width:26%"></td><td>
							<ul class="sidebar-social-list">
								<li><a href="https://vk.com/public100500488"><i class="fa fa-vk"></i></a></li>
								<li><a href="https://www.facebook.com/russiagoingglobal"><i class="fa fa-facebook"></i></a></li>                          
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							</ul>
							</td></tr>
						</table>	

                    </div>					
                    <!-- end section-container -->
                </div>
            </div>
			
			
			
			</div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #content -->
    
    
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
    
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/blog/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/blog/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/blog/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/blog/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/blog/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/blog/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/blog/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/blog/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
	    $(document).ready(function() {
	        App.init();
	    });
	</script>
	

<div class="modal fade" id="modal-login">
			<form method="POST" action="/user/login" id="jq13912" class="form-horizontal">
			<div class="modal-dialog">
				<div class="modal-content">
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

</body>
</html>