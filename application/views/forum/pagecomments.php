<ul class="pagination m-t-0 m-b-15">
<?if ($current - $min['number']>4):?>
	<?if ($current-1>$min['number']):?>
	<li><a href="/forum/one/0/<?=$step?>/<?=$category?>/<?=$id?>/<?=$pastpage?>?search=<?=$search?>"><<</a></li> <li class="text">...</li>
	<?endif?>
<?endif?>

<?foreach ($pages as $i=>$pg):?>
<?if ($current!=$i):?>
	<li><a href="/forum/one/<?=$i?>/<?=$step?>/<?=$category?>/<?=$id?>/<?=$pastpage?>?search=<?=$search?>"><?=$i+1?></a> </li>
<?else:?>
	<li class="active" ><a href="/forum/one/<?=$i?>/<?=$step?>/<?=$category?>/<?=$id?>/<?=$pastpage?>?search=<?=$search?>"><?=$i+1?></a></li>
<?endif?>
<?endforeach?>

<?if ($max['number'] - $current>4):?>
	<?if ($current<$max['number']-1):?>
	<li class="text">...</li> <li><a href="/forum/one/<?=$max['number']-1?>/<?=$step?>/<?=$category?>/<?=$id?>/<?=$pastpage?>?search=<?=$search?>">>></a></li>
	<?endif?>
<?endif?>
<?if ($current < $max['number']) :?>
<li class="right"><a href="/forum/one/<?=$current+1?>/<?=$step?>/<?=$category?>/<?=$id?>/<?=$pastpage?>?search=<?=$search?>"><i class="fa fa-chevron-right"></i></a></li>
<?endif?>

                        </ul>