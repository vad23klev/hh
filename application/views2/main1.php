<!DOCTYPE html>
<html lang="en">
	<head>
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width;">

	    <link rel="shortcut icon" href="/favicon.ico"> 
	    <meta property="og:image" content="/main/fb.png"/>
	    <link rel="stylesheet" type="text/css" href="/public/css/style.css" media="all"/>
		<link rel="stylesheet" href="/public/css/reset.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="/public/css/custom.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="/public/js/mb.css" type="text/css" media="all"/>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
		<script type="text/javascript" src="/public/js/modernizr.custom.04022.js"></script>

		<script type="text/javascript" src="/public/js/core.js"></script>	
		<script type="text/javascript" src="/public/js/control.js"></script>			
		<script type="text/javascript" src="/public/js/mb.js"></script>
		
		 <script type="text/javascript">

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
		<a href="/" id="logo"></a>
					<div id="basket">
				</div>
	
			<nav class="top-nav">
				<a href="/user/login">Вход</a>
				<a href="/user/register">Регистрация</a>
				<a href="/user/cabinet">Личный кабинет</a>
			</nav>
				
			<nav class="mid-nav">
		        <ul id="menu">
				  <?foreach ($hormenu as $i=>$item):?>
					  <li><a <?if ($i==$root):?>class="active"<?endif?>href="<?=URL::site()?><?=$item['link']?>"><?=$item['name']?></a>
					  
						<?if(count($item['children'])>0) :?>
							<ul>
							<?foreach ($item['children'] as $j=>$elem1):?>
								<li><a href="<?=URL::site()?><?=$elem1['link']?>"><?=$elem1['name']?></a>
								
									<?if(count($elem1['children'])>0) :?>
										<ul>
											<?foreach ($elem1['children'] as $j=>$elem2):?>
												<li><a href="<?=URL::site()?><?=$elem2['link']?>"><?=$elem2['name']?></a>
											<?endforeach?>
										</ul>
									<?endif?>
							<?endforeach?>
							</ul>
						<?endif?>
					  </li>
					  <?endforeach?>
					</ul>
	 		</nav>
<?if (!$main) :?>
	<div class="container">
		<?=$crumbs?>
		<?if ($root!=$cat_id):?>
			
		<?endif?>
		<?=$content?>
	</div>
<?else:?>	

		<div class="container">
			<div class="bread" style="margin-top:-20px;margin-bottom:40px">
				<ul>
					<li>Главная</li>
					<li>/</li>
					<li>Каталог</li>
				</ul>
			</div>
			
			
		<div class="slider slider1">
			<div class="sliderContent">
			<?foreach ($banners as $banner):?>
            <div class="item">
					<?if (strlen($banner->link)>0) :?>
						<a href="<?=$banner->link?>"><img alt="<?=$title?>" title="<?=$title?>" src="/imnew.php?type=banners&banner2&image=<?=$banner->filename?>" border="0"/></a>
					<?else:?>
						<img alt=""  src="/imnew.php?type=banners&width=960&height=327&image=<?=$banner->filename?>" border="0"/>
					<?endif?>						

			</div>
			<?endforeach?>
						
		</div></div>
			<?if (count($pgoods)>0):?>
				<div class="row title1">
					<h3>Новые товары</h3>
				</div>
					<div class="row padded">
					<?$i=0?>
					<?foreach ($pgoods as $prod):?>
						
						<div class="goods_catalog">
							<a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">
								<h6><?=$prod['name']?></h6>
							</a>
							<a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">
								<?if (strlen($prod['picture'])>0 && file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$prod['picture'])):?>
									<img src="/imnew.php?type=catalog&width=200&height=130&method=auto&image=<?=$prod['picture']?>"  alt="<?=$prod['name']?>"/>
								<?else:?>
									<img src="/imnew.php?type=pages&width=200&height=130&method=auto&image=00.jpg"  alt="<?=$prod['name']?>"/>
								<?endif?>
							</a>
							<!--span><a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">подробнее</a></span-->
						</div>

						<?$i++?>					
						<?if ($i%3==0):?>
							</div>
							<div class="row padded" >
						<?endif?>
						
					<?endforeach?>

				</div>
			<?endif?>				
			
			<?if (count($hits)>0):?>
				<div class="row title1">
					<h3>Топ продаж</h3>
				</div>			
					<div class="row padded">
					<?$i=0?>
					<?foreach ($hits as $prod):?>
						
						<div class="goods_catalog">
							<a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">
								<h6><?=$prod['name']?></h6>
							</a>
							<a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">
								<?if (strlen($prod['picture'])>0 && file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$prod['picture'])):?>
									<img src="/imnew.php?type=catalog&width=200&height=130&method=auto&image=<?=$prod['picture']?>"  alt="<?=$prod['name']?>"/>
								<?else:?>
									<img src="/imnew.php?type=pages&width=200&height=130&method=auto&image=00.jpg"  alt="<?=$prod['name']?>"/>
								<?endif?>
							</a>
							<!--span><a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">подробнее</a></span-->
						</div>

						<?$i++?>					
						<?if ($i%3==0):?>
							</div>
							<div class="row padded" >
						<?endif?>
						
					<?endforeach?>

				</div>
			<?endif?>	

		</div>
<?endif?>		
		<footer class="modal-footer">
<?=$info->phone?><br/><?=$info->email?>
		</footer>
		
<noindex>
<script type="text/javascript">
	CalcBasket(0,0,0,0,0);
</script>
<div id="overlay">
</div>
<div id="bskt" style="display:none">
&nbsp;
</div>

</noindex>		
		
		
		
	</body>
</html>