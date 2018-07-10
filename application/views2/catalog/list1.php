<?if (count($subcats)>0):?>
<div id="photolist">
<ul>
<?foreach ($subcats as $subcat):?>
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
<?if (count($subcats)==0):?>
	<?if (count($prods)>0):?>
	
	<div id="photolist">
	<ul>
	<?foreach ($prods as $prod):?>
		<?if (strlen($prod['picture'])>0):?>
			<li> 		
			<a href="<?=URL::site()?>img/catalog/<?=$prod['picture']?>" rel='zoom_group'>
			<img src="/resize/resizer.php?image=<?=$prod['picture']?>&width=326&height=257&type=catalog&method=crop" border="0">
			</a>
			</li>
		<?endif?>	
	<?endforeach?>
	</ul>
	</div>

	<?endif?>
<?endif?>