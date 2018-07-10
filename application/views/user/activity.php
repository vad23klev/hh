	<div class="col-md-12">
						<!-- begin panel -->

									<h1 >
										Последние сообщения
									</h1>

		
		

			        <div class="panel-group" id="accordion">
					
					
	<?foreach ($data as $i=>$st) :?>
		<?if (count($data[$i]['prods']) > 0) :?>
						<?foreach ($st['prods'] as $prod):?>
						
						<div class="panel panel-primary overflow-hidden">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$prod['id']?>">
									    <i class="fa fa-plus-circle pull-right"></i> 
											<?if (!isset($_GET['na'])):?>
												<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title1']?><br/>(<?=$prod['cat']->name?>)</a>
											<?else:?>
												<?=$prod['title1']?><br/>(<?=$prod['cat']->name?>)
											<?endif?>
									</a>
									<h5 style="color:white">
									<i class="fa fa-clock-o"></i> <?=date('d.m.Y',$prod['cts'])?>
									</h5>
								</h3>
							</div>
							<div id="collapse<?=$prod['id']?>" class="panel-collapse collapse">
								<div class="panel-body">
									<h5>
									<?=$prod['title']?>
									</h5><p>&nbsp;</p>
									<?if($prod['feed']->id >0):?>

										<ul class="media-list media-list-with-divider media-messaging">	
											<li class="media media-sm">
												<a href="javascript:;" class="pull-left">
													<img src="/assets/img/user-5.jpg" alt="" class="media-object rounded-corner" />
													<?if ($feed['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$feed['photo'])):?>
														<a href="javascript:;" class="image"><img alt="" src="/img/uimgs/<?=$feed['photo']?>" /></a>
													<?endif?>													
													
												</a>
												<div class="media-body">
													<h5 class="media-heading"><?if ($prod['userdata']->id != $user):?><?=$prod['userdata']->shortname?><?else:?>Вы<?endif?></h5>
													<p>					<?=date('d.m.Y H:i',$prod['feed']->cts)?><br/>									<?=$prod['feed']->text?>
														<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
															<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
														<?endif?></p>
												</div>
											</li>

										</ul>
									<?endif?>	
								</div>
							</div>
						</div>
						<?endforeach?>
		<?endif?>	
	<?endforeach?>
					
									</div>
			    </div>		

		
	