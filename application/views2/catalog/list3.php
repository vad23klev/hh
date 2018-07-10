
	<div class="row-fluid" style="background-color:#fff; margin:1% 3% 0 3%; padding: 1% 0% 3% 0%; width:94%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;position:relative">
	
	<?if (count($brends)>0):?>
<!--form method="GET" action="">	
<select style="position:absolute;right:30px;top:50px;z-index:9999" name="brend" onchange="javascript:this.form.submit()">
			<option value="0">Выбор по брендам</option>
			<?foreach ($brends as $brend):?>
				<option <?if ($brend['id']==$_GET['brend']):?>selected<?endif?> value="<?=$brend['id']?>"><?=$brend['name']?></option>
			<?endforeach?>
		</select>
</form-->		
<?endif?>		

		<?if (count($subcats)>0):?>
				<div class="navbar" style="margin:-20px auto 25px; width:91%;" >
				<nav class="navbar-inner"  style="background-image: linear-gradient(to bottom, rgb(200, 245, 255), rgb(250, 250, 250));">
					<ul class="nav" style="padding-left: 2%;">
						<?$j=0?>
						<?foreach ($subcats as $subcat):?>
							<li><a href="<?=URL::site()?><?=$subcat->parent_chpu?>/<?=$subcat->alias?>"><?=$subcat->name?></a></li>
							<?if ($j<count($subcats)-1):?><li class="divider-vertical"></li><?endif?>
							<?$j++?>
						<?endforeach?>
					</ul>
				</nav>
			</div>
			<?endif?>
			
		<?if (count($sub_items)>0):?>
				<div class="span12" style="height: 100%; width:96%;">
			<h4 style="color:#555; margin-top:15px;" align="center"><?=$cat->name?></h4> 
			

		<hr style="width:85%; margin:20px auto 20px;">

		<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
			<?$j=0?>
			<?foreach ($sub_items as $subcat):?>
				<div class="span3" align="center">
					<a href="<?=URL::site()?><?=$subcat->parent_chpu?>/<?=$subcat->alias?>" style="margin:auto;">
						<img src="/imnew.php?type=pages&width=280&height=250&method=auto&image=<?=$subcat->picture?>"  alt="<?=$subcat->name?>"/>
						<?=$subcat->name?>
					</a>
					</div>
				<?$j++?>
				
				<?if ($j%4==3):?>
					</div>
					<div class="row-fluid" style="width:95%; padding-left:2.1%;" >
				<?endif?>
				
			<?endforeach?>

	</div>

			<?endif?>
			
			
			
		<div class="span12" style="width:92%;" >
			<?=$cat->html?>
		</div>

	<?if (count($prods)>0):?>
<hr style="width:85%; margin:20px auto 20px;">
	
<!--div class="row-fluid" style="width:95%; padding-left:2.1%;" -->
<?$j=0?>
	<?foreach ($prods as $i=>$prod):?>
	
			
			<div class="span3" style="width:200px;margin-left:1.7%;margin-top:1.7%;text-align:center">
				<a href="<?=URL::site()?><?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" style="margin:auto;"  >
					<div style="width:200px;height:200px">
					<?if (strlen($prod['picture'])>0):?>						
						<img src="/resize/resizer.php?image=<?=$prod['picture']?>&width=200&height=200&type=catalog&method=auto" border="0">
						
					<?endif?>
					</div><br/>	
					<?=$prod['name']?>
				</a>
			</div>
			<?if ($j%4==3):?>
				<!--/div>
				<div class="row-fluid" style="width:95%; padding-left:2.1%;" -->
			<?endif?>
	<?endforeach?>
	<!--/div-->
<?endif?>	
	</div>	
