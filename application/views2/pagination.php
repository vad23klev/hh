<ul class="nav">
<?if ($current - $min['number']>4):?>
	<?if ($current-1>$min['number']):?>
	<li><a href="?<?=$min['link']?>"><<</a></li> <li>...</li>
	<?endif?>
<?endif?>
	
<?foreach ($pages as $i=>$pg):?>
<?if ($current!=$i):?>
	<li><a href="?<?=$pg['link']?>"><?=$i+1?></a> </li>
<?else:?>
	<li><a class="selected" href="?<?=$pg['link']?>"><?=$i+1?></a></li>
<?endif?>
<?endforeach?>

<?if ($max['number'] - $current>4):?>
	<?if ($current<$max['number']-1):?>
	<li>...</li> <li><a href="?<?=$max['link']?>">>></a></li>
	<?endif?>
<?endif?>
</ul>



