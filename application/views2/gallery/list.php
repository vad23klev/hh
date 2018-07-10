	<div class="row-fluid" style="background-color:#fff; margin:1% 3% 0 3%; padding: 1% 0% 3% 0%; width:94%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">

			<?foreach ($photos as $j=>$photo):?>
				<?if (strlen($photo->name)>0):?>
				<div class="span3" style="width:208px;margin-left:1.7%">
					<a href="/img/shopphotos/<?=$photo->name?>" rel="zoom_group" title="<?=$photo->description?>">
					<img src="/resize/resizer.php?image=<?=$photo->name?>&width=200&height=200&type=shopphotos&method=crop" alt="">
					<p align="center"><?=$photo->description?></p></a>
				</div>				
			<?else:?>	
				<div style="clear:both"></div>
				<h4 style="margin-left:20px"><?=$photo->description?></h4>
			<?endif?>
			<?endforeach?>

	</div>