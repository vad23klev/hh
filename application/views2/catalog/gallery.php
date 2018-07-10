<?if (count($brends)>0):?>
<form method="GET" action="">	
<select style="position:absolute;right:30px;top:50px;z-index:9999" name="brend" onchange="javascript:this.form.submit()">
			<option value="0">Выбор по брендам</option>
			<?foreach ($brends as $brend):?>
				<option <?if ($brend['id']==$_GET['brend']):?>selected<?endif?> value="<?=$brend['id']?>"><?=$brend['name']?></option>
			<?endforeach?>
		</select>
</form>		
<?endif?>		


	<div class="row-fluid" style="background-color:#fff; margin:1% 3% 0 3%; padding: 1% 0% 3% 0%; width:94%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">

<h4 style="color:#555; margin-top:15px;" align="center"><?=$prod->name?></h4>
<hr style="width:85%; margin:20px auto 20px;">

		<?$j=0?>
		<?if (count($photos)>0):?>
			<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
			<?foreach ($photos as $j=>$photo):?>
				<div class="span3" align="center">
					<a href="/img/photos/<?=$photo->name?>" rel="zoom_group" title="<?=$photo->description?>">
					<img src="/resize/resizer.php?image=<?=$photo->name?>&width=280&height=250&type=photos&method=crop" alt="">
					<p align="center"><?=$photo->description?></p></a>
				</div>
				<?if ($j%4==3):?>
					</div>
					<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
				<?endif?>
			<?endforeach?>
			</div>
		<?endif?>

	<?if (count($prods)>0):?>
<h4 style="color:#555; margin-top:15px;" align="center"><?=$cat->name?></h4>
<hr style="width:85%; margin:20px auto 20px;">
	
<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
<?$j=0?>
	<?foreach ($prods as $i=>$prod):?>
	
			
			<div class="span3" align="center">
				<a href="<?=URL::site()?><?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" style="margin:auto;"  >
					<?if (strlen($prod['picture'])>0):?>
						<img src="/resize/resizer.php?image=<?=$prod['picture']?>&width=280&height=200&type=catalog&method=crop" border="0">
					<?endif?>	
					<?=$prod['name']?>
				</a>
			</div>
			<?if ($j%4==3):?>
				</div>
				<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
			<?endif?>
	<?endforeach?>
	</div>
<?endif?>	
	</div>	

