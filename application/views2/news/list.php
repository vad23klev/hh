		<div class="row-fluid" style="background-color: rgba(255, 255, 255, 1); margin:.5% 3% 0 3%; padding: 2% 0% 3% 2%; width:92%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">
			<div class="span12">
				<h3><?=$cat->name?></h3>

			</div>

					<?foreach($news as $i=>$new):?>
				<div class="span6" style="background-color: #fff; padding:2em; width:90%;height:110%">
					<h4><?=$new->name?></h4>
					<article><strong><?=$new->date?></strong></article><br>
					<table style="width:100%"><tr><td valign="top">
					<?if (strlen($new->picture)>0) :?>
						<img src="/resize/resizer.php?image=<?=$new->picture?>&width=250&height=150&type=news&method=crop" border="0">
					<?endif?>	
					</td><td valign="top" style="padding-left:10px;">
					<?=$new->announce?><br/>
					<a href="<?=$new->parent_chpu?>/<?=$new->alias?>.html" class="link1">Подробнее...</a>
					</td></tr></table>
				</div>
			<?endforeach?>
			
			
		</div>