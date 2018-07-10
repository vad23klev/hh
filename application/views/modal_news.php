<div class="modal fade" id="modal-<?=$news1[$i]->id?>">			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h4 class="modal-title"><?=$news1[$i]->name?></h4><small><?=$news1[$i]->date?></small>
					</div>
					<div class="modal-body">
					
										<?if (strlen($news1[$i]->picture)>0) :?>
											<img src="/resize/resizer.php?image=<?=$news1[$i]->picture?>&width=250&height=150&type=news&method=crop" border="0">
										<?endif?> 

	<div class="col-md-12" style="padding:0px 2px">
		<div style="margin:0 auto;border-top:1px solid #CCD0D4;margin-top:20px;padding-bottom:10px">
		</div>
	</div>	
<div class="clearfix"></div>
	<div >
<table><tr><td><div class="fb-like" data-href="http://board.proved-np.org/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></td>
<td style="padding-left:30px;padding-top:1px">
<a href="http://twitter.com/share" class="twitter-share-button" data-text="Tweet" data-count="horizontal">Tweet</a>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</td><td><div ><g:plusone size="medium"></g:plusone></div></td></tr></table>
	</div>
	<div class="col-md-12" style="padding:0px 2px">
		<div style="margin:0 auto;border-top:1px solid #CCD0D4;margin-top:5px;padding-bottom:10px">
		</div>
	</div>	
<div class="clearfix"></div>										
					<p><?=strip_tags($news1[$i]->announce)?></p> <p><?=strip_tags($news1[$i]->text)?></p>
								<div style="clear:both"></div>
								

					</div>
					<div class="modal-footer">						
					</div>
				</div>			
		</div>
		</div>
