		<div class="row-fluid" style="background-color: rgba(255, 255, 255, 1); margin:.5% 3% 0 3%; padding: 2% 0% 3% 2%; width:92%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">
			
			<div class="span8">
	<?if (strlen($prod->picture)>0):?>
		<a href="/resize/resizer.php?image=<?=$prod->picture?>&width=800&height=600&type=catalog&method=crop" title="<?=$prod->name?>" rel="zoom_group">
		<img src="/resize/resizer.php?image=<?=$prod->picture?>&width=640&height=480&type=catalog&method=crop" border="0"></a>
	<?endif?>

			</div>		
			
			<div class="span3"><br>
				<h3><?=$prod->name?></h3>
				<p><?=$prod->description?>
				</p>
				
				<p><br>дополнительно фото этой коллекции в интерьере можно увидеть <a href="/galereya" align="center"> здесь</a></p>
				
			</div>
		</div>				

		
		<?if (count($photos)>0):?>
			<h4 style="margin-left:50px;">Другие элементы коллекции</h4>
			<div class="row-fluid" style="background-color: rgba(255, 255, 255, 1); margin:2% 3% 0 3%; padding: 1% 2% 1% 2%; width:90%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">
			<?foreach ($photos as $j=>$photo):?>
				<div class="span2" style="width:190px;">
					<a href="/img/photos/<?=$photo->name?>" rel="zoom_group" title="<?=$photo->description?>">
					
					<img src="/resize/resizer.php?image=<?=$photo->name?>&width=<?=$photo->width?>&height=<?=$photo->height?>&type=photos&method=auto" alt="">
					<p align="center"><p><?=$photo->description?></p>
					</a>
				</div>
			<?endforeach?>
			</div>
		<?endif?>