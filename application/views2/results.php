

<!--h4 style="color:#555; margin-top:15px;" align="center">Результаты поиска:</h4>
<h4 style="color:#555; margin-top:15px;" align="center"><?=$message?></h4-->
<h2>Результаты поиска по слову: "<?=$message?>"</h2>


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
			<?$d_arr = explode('.',$prod['description'])?>
			<p><?=strip_tags($d_arr[0])?>. <?=strip_tags($d_arr[1])?></p>
			
		<?endforeach?>

	</div>
<?endif?>



<?if (count($cats)==0 && count($prods)==0):?>
	<h2>По вашему запросу результатов не найдено</h2>
<?endif?>
</div>