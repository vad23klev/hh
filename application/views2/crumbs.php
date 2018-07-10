			<div class="inner_content_path">
				<a href="/">Главная</a>&nbsp;&nbsp;»&nbsp;&nbsp;

				<?foreach ($crumbs as $i=>$crumb):?>
						<a href="/<?=$crumb['chpu']?>" ><?=$crumb['name']?></a>&nbsp;&nbsp;»&nbsp;&nbsp;
				<?endforeach?>
			</div>