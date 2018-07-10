			<ol class="breadcrumb pull-right">
				<li><a href="/">Главная</a></li>

				<?foreach ($crumbs as $i=>$crumb):?>
						<li><a href="/<?=$crumb['chpu']?>" ><?=$crumb['name']?></a></li>
				<?endforeach?>
			</ol>