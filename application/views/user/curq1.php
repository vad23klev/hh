
	<div class="col-md-12">
						<!-- begin panel -->



		
		

			        <div class="panel-group" id="accordion">
					
					
	<?foreach ($data as $i=>$st) :?>
		<?if (count($data[$i]['prods']) > 0) :?>
						<?foreach ($st['prods'] as $prod):?>
						
						<div class="panel panel-primary overflow-hidden">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled opq" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$prod['id']?>" style="position:relative;top:7px;z-index:6">
									    <i class="fa fa-plus-circle pull-right"></i> 
									</a>	
									<h6 style="color:white">
									<?=$prod['title']?> (<?=$prod['cat']->name?>) 
									<i class="fa fa-clock-o  m-l-10"></i> Добавлено: <?=date('d.m.Y',$prod['cts'])?> <i class="fa fa-pencil-square m-l-10"></i> Отзывов: <?=$prod['feeds']->count()?>
									</h6>
								</h3>
							</div>
							<div id="collapse<?=$prod['id']?>" class="panel-collapse collapse">
								<div class="panel-body">
<?=$prod['name']?>
									<?if($prod['feeds']->count() >0):?>
										<?foreach ($prod['feeds'] as $feed) :?>
											<ul class="media-list media-list-with-divider media-messaging">	
												<li class="media media-sm">
													<a href="javascript:;" class="pull-left">
														<img src="/assets/img/user-5.jpg" alt="" class="media-object rounded-corner" />
														<?if ($feed->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$feed->photo)):?>
															<a href="javascript:;" class="image"><img alt="" src="/img/uimgs/<?=$feed->photo?>" /></a>
														<?endif?>													
														
													</a>
													<div class="media-body">
														<h5 class="media-heading"><?if ($prod['userdata']->id != $user):?><?=$prod['userdata']->shortname?><?else:?>Вы<?endif?></h5>
														<p>					<?=date('d.m.Y H:i',$prod['feed']->cts)?><br/>									<?=$feed->text?>
															<?if ($feed->file != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed->file)):?>
																<br/><a href="/img/feeds/<?=$feed->file?>">Скачать файл</a>
															<?endif?></p>
													</div>
												</li>

											</ul>
										<?endforeach?>	
									<?endif?>	
								</div>
								<?if($nochat==0) :?>
									<div class="panel-footer">
										<form method="POST" class="form-horizontal jq138" id="altForm" action="" enctype="multipart/form-data">
									

										<div class="input-group">
																						<input type="hidden" value="<?=$exp['user_id']?>" name="preuser" >	
														<input type="hidden" name="uid" value="<?=$prod->id?>">	

											<input type="text" class="form-control input-sm" name="ticket" placeholder="Введите комментарий" value="<?=trim($data['ticket'])?>" />
											<span class="input-group-btn">
												<input type="submit" value="Отправить" class="btn btn-primary btn-sm" />
											</span>
										</div>
		<p>&nbsp;</p>
										
										<div class="input-group" style="margin-top:-20px">
										<span class="btn btn-primary fileinput-button btn-sm blau">                                    
											<span>Отправить файл</span>
											<input type="file" class="btn btn-success input-sm" name="filename"  />
										</span></div>

											</form>
										</div>								
								<?endif?>
								
							</div>
						</div>
						<?endforeach?>
		<?endif?>	
	<?endforeach?>
					
									</div>
			    </div>		

		
	