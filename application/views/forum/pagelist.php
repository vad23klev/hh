<ul class="pagination m-t-0 m-b-15">
<?if ($current - $min['number']>4):?>
	<?if ($current-1>$min['number']):?>
	<li><a href="/forum/list/0/<?=$step?>/<?=$category?>"><<</a></li> <li>...</li>
	<?endif?>
<?endif?>
	
<?foreach ($pages as $i=>$pg):?>
<?if ($current!=$i):?>
	<li><a href="/forum/list/<?=$i?>/<?=$step?>/<?=$category?>"><?=$i+1?></a> </li>
<?else:?>
	<li class="active" ><a href="/forum/list/<?=$i?>/<?=$step?>/<?=$category?>"><?=$i+1?></a></li>
<?endif?>
<?endforeach?>

<?if ($max['number'] - $current>4):?>
	<?if ($current<$max['number']-1):?>
	<li class="text">...</li> <li><a href="/forum/list/<?=$max['number']-1?>/<?=$step?>/<?=$category?>">>></a></li>
	<?endif?>
<?endif?>
                        </ul>