<div class="pagination-container text-center">
                    <ul class="pagination m-t-0 m-b-0">
<?if ($current - $min['number']>4):?>
	<?if ($current-1>$min['number']):?>
	<li><a href="/companies/list/<?=$role?>/0?step=<?=$sstep?>&country=<?=$country?>&search=<?=$search?>"><<</a></li> <li>...</li>
	<?endif?>
<?endif?>
	
<?foreach ($pages as $i=>$pg):?>
<?if ($current!=$i):?>
	<li><a href="/companies/list/<?=$role?>/<?=$i?>?step=<?=$sstep?>&country=<?=$country?>&search=<?=$search?>"><?=$i+1?></a> </li>
<?else:?>
	<li class="active" ><a href="/companies/list/<?=$role?>/<?=$i?>?step=<?=$sstep?>&country=<?=$country?>&search=<?=$search?>"><?=$i+1?></a></li>
<?endif?>
<?endforeach?>

<?if ($max['number'] - $current>4):?>
	<?if ($current<$max['number']-1):?>
	<li>...</li> <li><a href="/companies/list/<?=$role?>/<?=$max['number']-1?>?step=<?=$sstep?>&country=<?=$country?>&search=<?=$search?>">>></a></li>
	<?endif?>
<?endif?>
</ul>
                </div>

