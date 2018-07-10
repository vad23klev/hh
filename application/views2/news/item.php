		<div class="row-fluid" style="background-color: rgba(255, 255, 255, 1); margin:.5% 3% 0 3%; padding: 2% 0% 3% 2%; width:92%; border: 1px solid #b7ddd9; border-radius:5px; box-shadow: 1px 1px 10px #b7ddd9;">
			<div class="span12">
				<h3><?=$cat->name?></h3>

			</div>



					<h5><span class="dropcap"><strong><?=$prod->date?></strong></span><br/><?=$prod->name?></h5>
          <div class="wrapper pad_bot2">
		  <?if (strlen($prod->picture)>0) :?>
			<img src="/resize/resizer.php?image=<?=$prod->picture?>&width=150&height=100&type=news&method=crop" border="0">
		<?endif?>	
            
            <div style="padding:20px"><?=$prod->text?></div>
            </div>




<div align="right" style="padding-right:20px;">
<b><a href="<?=$link?>"  class="border backs">Все новости</a></b>
</dv>
</div>