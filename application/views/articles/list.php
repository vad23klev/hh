<link rel="stylesheet" href="/public/js/jquery.treeview.css" />
<script src="/public/js/jquery.treeview.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
		
	// first example
	$("#navigation").treeview({
		collapsed: true,
		unique: false
	});

});

</script>

<h2><?=$cat->title?></h2>
<div style="padding:10px;">
<?=$cat->html?>

<ul id="navigation" class="filetree">
	<?foreach($news as $new):?>
		<?if (count($new['children'])>0) :?>
			<li class="open"><span <?if (count($new['children'])>0) :?>class="folder"<?endif?> style="font-weight:bold"> &nbsp;<?=$new['name']?></span>		
					 <ul>
						<?foreach($new['children'] as $elem):?>
							<?$product = ORM::factory('product')->where('category_id','=',$elem['id'])->find_all()?>
								<?if ($product->count()>0) :?>
									<li><span class="folder"> &nbsp;<?=$elem['name']?></span>						
										<?//$product->count()?>						
											<ul>
											<?foreach ($product as $prod):?>
												<li><a href="<?=$elem['link']?>/<?=$prod->alias?>.html"><?=$prod->name?></a></li>
											<?endforeach?>
											</ul>						
									</li>
								<?endif?>
						<?endforeach?>
					 </ul>			
			</li>
		<?endif?>

	<?endforeach?>
</ul>

</div>