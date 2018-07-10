
		<div class="container">					
			<div class="row title1">
				<h3><?=$cat->name?></h3>
			</div>
			<div class="row">
				<div class="goods_item">
					<?if (strlen($prod->picture)>0):?>
						<img src="/imnew.php?type=catalog&width=500&height=340&method=auto&image=<?=$prod->picture?>"  alt="<?=$cat->name?>"/>		
					<?endif?>
					
					<ul>
					<?foreach ($photos as $j=>$photo):?>
						<li><a href="/img/photos/<?=$photo->name?>" rel="zoom_group"><img src="/resize/resizer.php?image=<?=$photo->name?>&width=100&height=68&type=photos&method=auto" alt=""></a></li>
					<?endforeach?>	
					</ul>

					<h1><?=$prod->name?></h1>
					<article><?=$prod->description?></article>
				</div>
			</div>
			<?if (count($cgs)>0) :?>
			<div class="row title1">
				<h3>ADDITIONAL OFFERS</h3>

			</div>
			<div class="row">
				<?foreach ($cgs as $prod):?>
						<div class="goods_catalog">
							<a href="<?=URL::site()?><?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html">
								<?if (strlen($prod['picture'])>0 && file_exists($_SERVER['DOCUMENT_ROOT']."/img/catalog/".$prod['picture'])):?>
									<img src="/imnew.php?type=catalog&width=220&height=150&method=auto&image=<?=$prod['picture']?>"  alt="<?=$prod['name']?>"/>
								<?else:?>
									<img src="/imnew.php?type=pages&width=220&height=150&method=auto&image=00.jpg"  alt="<?=$prod['name']?>"/>
								<?endif?>

								<h6><?=$prod['name']?></h6>
								<p><?=$prod['sizetable']?></p>
								<span class="more">More…</span>
							</a>
						</div>

						<?$i++?>					
						<?if ($i%4==0):?>
							</div>
							<div class="row" >
						<?endif?>
				<?endforeach?>

			</div>
			<?endif?>
		</div>		