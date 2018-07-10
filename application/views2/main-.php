<!DOCTYPE html>
<html lang="ru">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="author" content="Zabolotskiy" />
	<meta name="copyright" content="copyright" />

	<meta name="keywords" content="keywords" />
	<meta name="description" content="content_description" />
	<meta name="robots" content="index, follow" />

	<link rel="icon" type="image/png" href="favicon.png" />
	<!--[if IE]><link rel="shortcut icon" type="image/vnd.microsoft.icon" href="url_to_favicon/favicon.ico" /><![endif]-->

	<link rel="alternate" type="application/rss+xml" title="RSS" href="path_to_rss_channel" />
	
	<link rel="stylesheet" href="/public/css/bootstrap.css" type="text/css" />
<!--	<link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css" /> -->
	<link rel="stylesheet" href="/public/css/custom.css" type="text/css"/>

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/public/js/bootstrap.js"></script>
	
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />

</head> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />

<link href="/public/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" ></script>

 	<link href="/public/js/mb.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/public/js/mb.js"></script>
	
	<!-- for lightbox -->
   	<script type="text/javascript" src="/public/js/colorbox/jquery.colorbox.js"></script>		
   	<link rel="stylesheet" type="text/css" href="/public/js/colorbox/colorbox.css" media="screen" /> 
 
  
 <script type="text/javascript">
jQuery(function(){
		$(".zoom").colorbox({transition:"fade"});
		$(".inline").colorbox({inline:true,transition:"fade"});
		$(".regg").colorbox({inline:true,transition:"fade"});
		$("a[rel='zoom_group']").colorbox({transition:"fade",photo:true,slideshow:true,slideshowAuto:false,current:"Фото {current} из {total}"});
});
</script>
 
 
 <script type="text/javascript">

 	$(document).ready(function(){
		$('#main_photolist li').hover(
			function() {
				$(this).addClass("active");
				$(this).find('div').stop(true, true);
				$(this).find('div').show();
			},
			function() {
				$(this).removeClass("active");
				$(this).find('div').hide(20);
			}
		);
	
	});
 
 
$(document).ready(function(){
	$('.slider').mobilyslider({
				transition: 'fade',
				animationSpeed: 3000,
				autoplay: true,
				autoplaySpeed: 6000,
				animationStart: function(){$('#between').fadeIn('500');},
				animationComplete: function(){$('#between').fadeOut('500');}
			});
		}); 
  
    </script>




</head>

<body>
<div id="page">
<div id="header">
<a id="logo" href="/"><img src="/img/logo.jpg" /></a>
<div id="topmenu">

<table id="vert"><tr>
	  <?foreach ($vertmenu as $i=>$item):?>
	  <td>
	  <a <?if ($i==$root):?>class="active"<?endif?>href="<?=URL::site()?><?=$item['link']?>"><?=$item['name']?></a>
	  </td>
	  <?endforeach?>
	  </tr>
</table>

</div>
<div id="phone"><?=$info->phone?></div>
</div>
<div id="content">
<?if (!$main) :?>
	<?if ($root!=$cat_id):?>
		<?=$crumbs?>
	<?endif?>
	<?=$content?>
<?else:?>	

		<div class="slider slider1">
			<div class="sliderContent">
			<?foreach ($banners2 as $banner):?>
            <div class="item">
				<img alt=""  src="/imnew.php?type=banners&banner2&image=<?=$banner->filename?>" border="0"/>
			</div>
			<?endforeach?>
						
</div></div>
<div id="main_photolist">
<ul>
<?foreach ($tops as $subcat):?>
	<?if (strlen($subcat->picture)>0):?>
		<li> 		
		<a href="<?=URL::site()?><?=$subcat->parent_chpu?>/<?=$subcat->alias?>">
		<img src="/resize/resizer.php?image=<?=$subcat->picture?>&width=326&height=257&type=pages&method=crop" border="0">
		<div><?=$subcat->name?></div></a>
		</li>
	<?endif?>	
<?endforeach?>
</ul>
</div>

<?endif?>

</div>
<div id="footer">
	<div id="copyright">
		<?=$info->text1?>
	</div>
    
	<div id="downmenu">
    	<table align="center">
        <tr><td valign="top">
        <div class="dmenuhead">Фотографии</div>
		
		<?foreach ($portfolio as $port) :?>
			<a href="<?=$port['link']?>"><?=$port['name']?></a><br />
		<?endforeach?>
		
        </td><td valign="top">
        <div class="dmenuhead">Контакты</div>
		<?foreach ($contacts as $port) :?>
			<a href="<?=$port['link']?>"><?=$port['name']?></a><br />
		<?endforeach?>
        </td></tr>        
        </table>
	</div>    

	<div id="social">
	
	<?=$info->text2?>
	
	</div>    
</div>
</div>
</body>
</html>
