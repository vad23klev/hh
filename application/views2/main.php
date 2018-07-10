<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
 <meta content="" name="abstract"/>
   <meta name="autor" content="" />
  <meta name="copyright" content="" />
  <link rel="stylesheet" href="/public/js/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="/public/js/coin-slider/coin-slider-styles.css" />

  <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="/favicon.ico" type="image/x-icon" >
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  
  <link href="/public/js/rating_simple.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/public/js/rating_simple.js"></script>
  <meta property="og:image" content="/main/fb.png"/>

  
  <script type="text/javascript" src="/public/js/jqtransformplugin/jquery.jqtransform.js"></script>
  <script type="text/javascript" src="/public/js/coin-slider/coin-slider.js"></script>
  <script type="text/javascript" src="/public/js/jquery.tools.min.js"></script>
  <!--script type="text/javascript" src="/public/js/jquery.textshadow.js"></script-->
  <script type="text/javascript" src="/public/js/cufon-yui.js"></script>
  <script type="text/javascript" src="/public/js/HeliosC_400-HeliosC_700-HeliosC_italic_400-HeliosC_italic_700.font.js"></script>
  <script type="text/javascript" src="/public/js/Arial_Narrow_400-Arial_Narrow_700-Arial_Narrow_italic_400-Arial_Narrow_italic_700.font.js"></script>
  <script type="text/javascript" src="/public/js/hovers.js"></script>
   	<script type="text/javascript" src="/public/js/colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript" src="/public/js/jquery.autosize.js"></script>	
	<link rel="stylesheet" type="text/css" href="/public/js/colorbox/colorbox.css" media="screen" />
	<script src="/public/js/jquery.spoiler.js"></script> 
	
	<script>
		
	$(document).ready(function() {
		$(".spoiler").spoiler(); 
		$( ".tooltip" ).tooltip();
		$('textarea').autosize();    
		$('#tabs').tabs();
		$('#tabs1').tabs();
		$(".inline").colorbox({inline:true,transition:"none"});
		$(".regg").colorbox({inline:true,transition:"none",innerWidth:"520"});
		$(".regg1").colorbox({inline:true,transition:"none",innerWidth:"600"});
		$(".regg2").colorbox({inline:true,transition:"none",innerWidth:"800"});
		/*$(".zoom").colorbox({transition:"fade",innerWidth:"800",innerHeight:"600",photo:true,slideshow:true,slideshowAuto:false,current:"Фото {current} из {total}"});
		$("a[rel='zoom_group']").colorbox({transition:"fade",innerWidth:"800",innerHeight:"600",photo:true,slideshow:true,slideshowAuto:false,current:"Фото {current} из {total}"});*/
	});
	</script>

	<script type="text/javascript" src="/public/js/mi.js"></script> 
		<!--script type="text/javascript" src="/public/js/affix.js"></script--> 
	
  <script type="text/javascript">
    $(
    function()
      {
        $('form.jqtr').jqTransform({imgPath:'jqtransformplugin//public/images/'});

        jQuery('#coin-slider').coinslider(
            {
                effect: 'rain',
                width: 1206,
                height: 343,
                spw: 5,
                sph: 5,
                delay: 5000
            }
        );

        $(".scrollable").scrollable(
            {
            onBeforeSeek: function(event, i) {

                if (i > ($(".scrollable").scrollable().getSize()-6)) {
                    return false;
                }
            }
         });

         //$(".text_shadow").textShadow();
      }
    );
  </script>
	
	

  </head>
  <body class="mambo">
    <table id="main" cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td class="main_lf"><div style="width:5px;"></div></td>
            <td class="main_cn" valign="top">
			<div style="width:998px;overflow:hidden">		
                <div class="header_logo_bl">
                    <a class="header_logo" href="/">
					<!--div>некоммерческое партнерство профессионалов<br/> и участников внешнеэкономической деятельности</div-->
					</a>
					<div id="call1">
						НЕКОММЕРЧЕСКОЕ ПАРТНЕРСТВО ПРОФЕССИОНАЛОВ И УЧАСТНИКОВ ВНЕШНЕЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ
					</div>
					
					<div id="call">
			<?if ($login['name'] != -1) :?>	
			
				<b><?=$login['name']?></b> / <a href="/user/logout">Выход</a><br/>
				<?if ($nm>0) :?>
					Новых сообщений: <span style="color:red">(<?=$nm?>)</span><br/>
										
				<?endif?>	
				<!--a href="/user/addlot/" style="text-transform:none">Направить обращение</a-->
			<?else:?>					

				<a href="#inline_block" class="regg">Вход и регистрация</a>
			
			<?endif?>
					</div>
					
                    <div class="header_search_bl" <?if ($login['name'] != -1) :?>style="margin-top:52px"<?endif?>>
                        <div class="header_search_lang">
                        </div>
                        <div class="header_search">
							
					<form id="search" class="block" method="POST" action="/order/search">
					<input type="hidden" name="search-or-mode" id="search-and-mode" value="1">
                     <input onfocus="javascript: if(this.value == 'Поиск') this.value = '';" onblur="javascript: if(this.value == '') { this.value = 'Поиск';}" maxlength="255" name="search">
                            <a href="javascript:void(0)" onclick="$('#search').submit()"><div>Найти</div></a>
					</form>

                        </div>
                    </div>
                </div>
				
				

		<div class="menu_top_bl">
		<table style="width:100%" cellpadding="0" cellspacing="0">
			<tr>
			<td style="width:85px"><a class="menu_top_first" href="http://proved-np.org"><div></div></a></td>
				<td><a class="text_shadow" id="elem69" href="http://proved-np.org/services/o_nas/"><div>О нас</div></a></td>	<td><a class="text_shadow" id="elem70" href="http://proved-np.org/services/centr_sodejstviya_ved/"><div>Центр содействия ВЭД</div></a></td>	<td><a class="text_shadow" id="elem119" href="http://proved-np.org/services/novosti/"><div>Пресс-центр</div></a></td><td><a class="act text_shadow" id="elem72" href="/"><div>Горячая линия</div></a></td>	<td><a class="text_shadow" id="elem73" href="http://proved-np.org/services/obratnaya_svyaz/"><div>Обратная связь</div></a></td>

			<td><a class="text_shadow" id="elem87" href="http://proved-np.org/services/o_nas/vstupit/"><div>Вступить</div></a></td>
			</tr>
			</table>
		</div>				

                <div class="inner_content_bl marg_centr">
<?if (!$main):?>
				<?//=$crumbs?>
<?endif?>
                    <div class="inner_content_left_col">
						
		<div class="inner_content_left_razd_title">
		</div>

<?if (!$main):?>
			
          <h1 style="margin-left:10px;margin-right:10px">
				<?//=$h1?> Личный кабинет
			</h1>
<?else:?>		
          <h1 style="margin-left:10px;margin-right:10px">
				Горячая линия
			</h1>	
<?endif?>

			<?$reject = "Вы пока не можете работать с заявками и пользоваться сервисом консультаций, так как Ваш профиль еще не активирован. Для активации профиля Вам необходимо на странице Вашего профиля заполнить все поля, отмеченные как обязательные для заполнения"?>
				
			<?if ($login['name'] != -1) :?>
				<?$newq = array(4=>'Новые заявки',5=>'Новые вопросы')?>
				<?$newq1 = array(4=>'Заявки',5=>'Вопросы')?>
				<?//if ($login['expert'] == 1):?>
					<?if (($login['role'] == 4 || $login['role'] == 5)):?>
						<ul class="inner_content_left_razd">
							<!--li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openanswers/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>> <?=$newq[$login['role']]?></a></li-->
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/providerlots/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>><?=$newq1[$login['role']]?></a><?if ($nm > 0):?><span style="color:red">(<?=$nm?>)</span><?endif?></li>
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/provideractivity/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Сообщения</a>  <?if ($nm1 > 0):?><span style="color:red">(<?=$nm1?>)</span><?endif?></li>
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/ausers/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Мои пользователи</a></li>
						</ul>	
					<?else:?>										
						<ul class="inner_content_left_razd">
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/openlots/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Заявки</a></li>
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/activity/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Сообщения</a></li>
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot/"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Создать заявку</a></li>
							<li><a class="text_shadow <?if ($login['complete']==0 || $login['expert']==0) :?>disabled tooltip<?endif?>" id="elem73" <?if ($login['complete']==1 && $login['expert']==1) :?>href="/user/addlot?sale_type=1"<?else:?>href="javascript:void(0)" title="<?=$reject?>"<?endif?>>Задать вопрос эксперту</a></li>
						</ul>
					<?endif?>
				<?//endif?>
				
				<?if ($login['complete'] == 1):?>
					<ul class="inner_content_left_razd">
					</ul>
				<?endif?>	
				<ul class="inner_content_left_razd">
					<li><a class="text_shadow" id="elem77" href="/user/cabinet/">Мой профиль</a></li>
					<li><a class="text_shadow" id="elem77" href="/user/chpass/">Смена пароля</a></li>
					<li><a class="text_shadow" id="elem75" href="/user/logout/"><div>Выход</div></a></li>
					<li><a class="text_shadow" id="elem79" href="/chasto_zadavaemie_voprosi">Часто<br/> задаваемые вопросы</a></li>
				</ul>
			<?else:?>
				<ul class="inner_content_left_razd">
					<li><a class="text_shadow" id="elem79" href="/chasto_zadavaemie_voprosi">Часто<br/> задаваемые вопросы</a></li>
					<li><a class="text_shadow" id="elem70" href="/napravit_obraschenie" ><div>Направить обращение</div></a></li>
					<li><a class="text_shadow regg" id="elem70" href="#inline_block" ><div>Личный кабинет</div></a></li>						
				</ul>
			<?endif?>

						
												
	
						
						
                    </div>
                    <div class="inner_content_right_col">
                        <div class="inner_content_right_inn">
                            <div class="inner_content_tx">
							
									<?=$content?>
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="bottom_red_blue_polos"></div>
                <div class="bottom_blue_bl">					
                    <div class="bottom_blue_marg">

								<div class="bottom_blue_cols">
		<div class="bottom_blue_cols_title">
О нас
		</div>
			<a href="http://proved-np.org/services/o_nas/obwaya_informaciya/">Общая информация</a><a href="http://proved-np.org/services/o_nas/napravleniya_deyatelnosti/">Направления деятельности</a><a href="http://proved-np.org/services/o_nas/rukovodstvo/">Структура</a><a href="http://proved-np.org/services/o_nas/ekspertnyj_sovet/">Экспертный совет</a><a href="http://proved-np.org/services/o_nas/partnery/">Партнеры</a><a href="/services/o_nas/vstupit/">Вступить</a>
	</div>	<div class="bottom_blue_cols">
		<div class="bottom_blue_cols_title">
Центр содействия ВЭД
		</div>
			<a href="http://proved-np.org/services/centr_sodejstviya_ved/yuridicheskoe_soprovozhdenie_ved/">Юридическое сопровождение ВЭД</a><a href="http://proved-np.org/services/centr_sodejstviya_ved/buhgalterskij_konsalting_i_soprovozhdenie_ved/">Бухгалтерский консалтинг и сопровождение ВЭД</a><a href="http://proved-np.org/services/centr_sodejstviya_ved/adaptaciya_biznesa_k_rabote_v_usloviyah_vto/">Адаптация бизнеса к работе в условиях ВТО</a><a href="http://proved-np.org/services/centr_sodejstviya_ved/informacionnoanaliticheskie_uslugi_v_sfere_ved/">Маркетинговые и информационно-аналитические услуги</a>
	</div>

							<div class="bottom_blue_cols">
		<div class="bottom_blue_cols_title">
Пресс-центр
		</div>
			<a href="http://proved-np.org/services/novosti/novosti_ved/">Новости ВЭД</a><a href="http://proved-np.org/services/novosti/partners/">Новости партнерства</a><a href="http://proved-np.org/services/novosti/announces/">Анонсы мероприятий</a><a href="http://proved-np.org/services/novosti/experts/">Экспертное мнение</a>
	</div>					
                        <div class="bottom_blue_copyr_bl">
							<p><a class="copyr_logo" href="/"></a></p>
<div class="copyr_soc"><a style="margin-right: 10px;" href="https://www.facebook.com/provednp?ref=br_rs"><img src="/public/images/fb.png" border="0" alt="" width="18" height="18" /></a> <a style="margin-right: 10px;" href="http://www.linkedin.com/company/non-commercial-partnership-for-foreign-trade-proved-?trk=top_nav_home"><img src="/public/images/in.png" border="0" alt="" width="18" height="18" /></a> <a href="#"><img src="/public/images/vk.png" border="0" alt="" width="18" height="18" /></a></div>
<div style="display: block; padding: 5px 0px; position: absolute; right: 95px; top: -10px; width: 105px; height: 21px; overflow: hidden;"><iframe frameborder="0" src="http://www.facebook.com/plugins/like.php?href=http://proved-np.org//services/o_nas/&amp;send=false&amp;layout=button_count&amp;width=50&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21"></iframe></div>
<div class="bottom_blue_copyr_tx">&copy; 2013 Некоммерческое партнерство                                 профессионалов и участников                                 внешнеэкономической деятельности &laquo;ПРОВЭД&raquo;                                 <a href="http://kwebstudio.ru/">
<div><span>Kings Web Studio</span></div>
<img src="/public/images/ico_kweb.png" alt="" width="16" height="16" />
<div><span>Веб-студия</span> Москвы &mdash;</div>
</a></div>
                        </div>
                    </div>
                </div>
				
	<div id="white-overlay">
		<div id="inline_block" style="overflow:hidden;padding:10px;width:500px">
			  
	  	<form method="POST" action="/user/login" id="jq13912">
		
			<div class="row">
			<div class="cont_form_name1">ИНН / Имя пользователя <span>*</span></div>
			<div class="ti">
			<input type="text"  class="fld" name="username" style="width:300px">
			</div>
			</div>
			
			<div class="row">
			<div class="cont_form_name1">Пароль <span>*</span></div>
			<div class="ti">
			<input  type="password" class="fld" name="password" >
			</div>
			</div>
			
			<div class="row">
			<div class="cont_form_name1"></div>
			<div class="ti">
			<a class="cont_form_send_butt1" style="width:212px" href="javascript:void(0);" onclick="javascript:$('#jq13912').submit();"><div style="padding:3px 0">Вход</div></a>
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name1"></div>
			<div class="ti" style="padding-top:10px">
			<a href="/user/register" style="color:black">Регистрация</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/forgot"  style="color:black">Забыли пароль</a>
			</div>
			</div>			
			
		</form>



		</div>
	</div>
				
						
	</div>
				

				
            </td>
            <td class="main_rg"><div style="width:5px;"></div></td>
        </tr>
    </table>


	
	
<script type="text/javascript">
    Cufon.replace(".heliosc", { fontFamily: 'HeliosC', hover: true });
    Cufon.replace(".arialnarrow", { fontFamily: 'Arial Narrow' });
</script>
<script type="text/javascript"> Cufon.now(); </script>

  </body>
</html>
<!-- This page generated in 0.061974 secs by TPL, SITE MODE -->s