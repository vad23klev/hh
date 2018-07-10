
			<div class="row title1">
				<h3><?=$cat->name?></h3>
			</div>
			
			<?if (count($subcats)>0):?>
					<ul>
					<?$i=0?>

					<?foreach ($subcats as $subcat):?>
						<li><a href="<?=URL::site()?><?=$subcat->parent_chpu?>/<?=$subcat->alias?>"><?=$subcat->name?></a></li>	
					<?endforeach?>
				</ul>	
				<div style="clear:both"></div>
			<?endif?>
			
			
				<?if (count($prods)>0):?>
					<div class="row padded">
					<?$i=0?>
					<?foreach ($prods as $prod):?>
					
						<p>
							<a href="<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" style="font-weight: bold;"><?=$prod['name']?></a>
						</p>
						
					<?endforeach?>

				</div>
			<?endif?>		
			
			<div class="row">
				<?=$cat->html?>
			</div>			
