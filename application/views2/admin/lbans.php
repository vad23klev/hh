<ul class="branch"><li class="header">Баннеры

<a class="add" href="/admin/banners?type=1&pos=2">+</a>
</li></ul>
<?foreach ($elems as $i=>$elem):?>
<!--switchElem('lb<?=$i?>')-->
<!--ul class="branch1"><li class="header">&nbsp;&nbsp;<span class="dashed"><?=$elem['name']?></span><a class="add" href="/admin/banners?type=1&pos=<?=$i?>">Добавить</a></li></ul-->
	<div id="lb<?=$i?>" style="display:block">

		<ul>
		<?foreach ($elem['banners'] as $banner) :?>
				<li style="padding-left:15px;width:250px">
				<a href="/admin/banners?id=<?=$banner->id?>&type=1"><?=$banner->name?></a>
				<a class="dele" onclick="javascript:return confirm('Вы уверены?')" href="/admin/banners/?del=1&page=0&id=<?=$banner->id?>"><img src="/img/del1.png"></a>
				
				</li>
		<?endforeach?>
		</ul>
	</div>
<?endforeach?>

