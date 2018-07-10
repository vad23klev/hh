<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
<link href="<?=URL::site()?>public/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=URL::site()?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=URL::site()?>AjexFileManager/ajex.js"></script>
<script type="text/javascript" src="<?=URL::site()?>ckeditor/lang/_languages.js"></script>



<script src="/public/js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
<script src="/public/js/jquery.cookie.js" type="text/javascript"></script>
<link type="text/css" href="/public/js/le-frog/jquery-ui-1.8.9.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/public/js/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="/public/js/colorbox/colorbox.css" media="screen" />
	
<script>
		
	$(document).ready(function() {
		$(".inline").colorbox({inline:true,transition:"none"});
		$(".regg").colorbox({inline:true,transition:"none",innerWidth:"520"});
		$(".regg1").colorbox({inline:true,transition:"none",innerWidth:"600"});
		$(".regg2").colorbox({inline:true,transition:"none",innerWidth:"800"});
		$(".zoom").colorbox({transition:"fade",innerWidth:"800",innerHeight:"600",photo:true,slideshow:true,slideshowAuto:false,current:"Фото {current} из {total}"});
		$("a[rel='zoom_group']").colorbox({transition:"fade",innerWidth:"800",innerHeight:"600",photo:true,slideshow:true,slideshowAuto:false,current:"Фото {current} из {total}"});
	});

	$(function(){
		  $("#tabs").tabs();
		$("#menu_tabs").tabs({
			cookie: { expires:1 }
		});
	});
</script>



<title>Управление сайтом</title>
</head>
<body>
<table style="height:100%;margin:0 auto" align="left">
<tr><td valign="top" class="lefttable">
<?if ($login>0):?>
<div id="wlinks">
<?if ($role==2 || $role==99):?>
		<div id="menu_tabs">
<ul style="padding-bottom:22px;">

	<li><a href="#section-1">Контент и настройки</a></li>
	<li><a href="#section-2">Список страниц</a></li>
	</ul>
	<div id="section-1">

	<?foreach ($wmenu as $key=>$wmen):?>
	<?if (strlen($wmen)>0):?>

	<?if (strpos($wmen,"http://")===false):?>
		<a href="<?=URL::site()?><?=$wmen?>"><?=$key?></a><br/>
	<?else:?>
		<a href="<?=$wmen?>"><?=$key?></a><br/>
	<?endif?>
	<?else:?>
	<?=$key?><br/>
	<?endif?>
	<?endforeach?>

</div>
<div id="section-2">
<a href="/admin/categories">Добавить страницу</a><br/>
<a href="/admin/categories?type=1&c_id=-1">Добавить раздел каталога</a>


<?=$navi?>
<?=$bans?>
</div>
</div>
<?else:?>
	<a href="/admin/agoods">Заявки</a><br/>
	<a href="/admin/logout">Выход</a>
<?endif?>
</div>

<?endif?>

</td><td valign="top" style="width:875px" id="righttable">

<table width="100%" border="0" cellpadding="4" cellspacing="0" >
<tr>
<td valign="top"><?=$content?></td>
</tr>
</table>
</td></tr>
</table>
</body>
</html>
