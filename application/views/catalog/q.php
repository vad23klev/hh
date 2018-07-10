					<h1 class="page-header">
										<?=$prod->title?>
					</h1>


		<div style="padding:0px 20px">
			<!-- begin row -->
			<div class="row">
				<div class="col-md-11">
					<div class="panel panel-primary">
						<div class="panel-body">
						
						<div style="padding:20px;color:#2A72B5">
							<p style="text-align:justify"><?=$prod->name?></p>
							
							<div class="m-t-10">
							<i class="fa fa-clock-o"></i> <?=date('d.m.Y',$prod->cts)?>  
		<?if ($showform == 0) :?>
		<i class="fa fa-pencil-square m-l-10"></i> Ответов: <?=count($feeds)?>						
		<form action="/user/delete/" id="delform" style="float:right">
			<input type="hidden" name="del" value="<?$prod->id?>">
			<button class="btn btn-danger btn-xs" onclick="return confirm('Вы уверены?')">Удалить вопрос</button>
			</form>
		<?endif?>
									
							
							
							</div>
						</div>
						<hr/>
						
						
						<?if (count($feeds) >0):?>	
										<ul class="media-list media-list-with-divider media-messaging">
											<?foreach ($feeds as $feed) :?>
												<li class="media media-sm">
													<?if ($feed['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$feed['photo'])):?>
														<a href="javascript:;" class="pull-left"><img alt="" class="media-object rounded-corner" src="/img/uimgs/<?=$feed['photo']?>" /></a>
													<?endif?>
										<div class="media-body">
											<h5 class="media-heading"><?=$feed['fio']?> <?=$feed['lastname']?> <?=$feed['surname']?> <small><?=$feed['cts']?></small></h5>
											<p><?=$feed['text']?></p>
											<!--a href="/img/feeds/<?=$feed['file']?>">Скачать файл (<?=$feed['file']?>)</a-->
											<div class="clearfix"></div>
											<?$likes = ORM::factory('like')->where('feed_id','=',$feed['id'])->find_all()?>
											<?$voted = ORM::factory('like')->where('user_id','=',$user_id)->where('feed_id','=',$feed['id'])->find()?>
											<div class="comment-rating pull-right">
											<?// && $owner->id != $user_id?>
											<?if ($voted->id == 0) :?>
												<a href="/forum/like?id=<?=$feed['id']?>" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-up"></i> Лучший ответ</a>
												<a href="javascript:;;" class="m-l-10 text-inverse"><i class="fa fa-thumbs-up text-primary fa-lg"></i> <?=$likes->count()?></a>
											<?else:?>
												<a href="javascript:;;" class="m-l-10 text-inverse"><i class="fa fa-thumbs-up text-primary fa-lg"></i> <?=$likes->count()?></a>	
											<?endif?>
											</div>
										</div>
									</li>
								<?endforeach?>
										</ul>
						<?else:?>
							<p>На этот вопрос ответов от экспертов пока не поступало.</p>
						<?endif?>
						
						</div>
						
														<?if ($showform == 1) :?>
									<div class="panel-footer">
										<form method="POST" class="form-horizontal jq138<?=$exp['id']?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html?num=<?=$j?>" enctype="multipart/form-data">
									

                                <div class="form-group col-md-12 col-sm-12">
																				<input type="hidden" value="<?=$prod->user_id?>" name="preuser" >	
												<input type="hidden" name="uid" value="<?=$prod->id?>">	
									<textarea class="form-control" style="height:70px" name="ticket" placeholder="Ваш ответ"><?=trim($data['ticket'])?></textarea>
									                                    <!--input type="text" class="form-control input-sm" name="ticket" placeholder="Введите комментарий" value="<?=trim($data['ticket'])?>" /-->
                                    <div class="m-t-10">
                                        <input type="submit" value="Отправить ответ" class="btn btn-primary btn-sm" />
                                    </div>
                                </div>
								<div class="clearfix"></div>
								
								<div class="input-group" style="margin-top:-20px;display:none">
								<span class="btn btn-primary fileinput-button btn-sm blau">                                    
                                    <span>Отправить файл</span>
                                    <input type="file" class="btn btn-success input-sm" name="filename"  />
                                </span></div>

									</form>
                                </div>

								<?endif?>
						
					</div>
				</div>
			</div>
		</div>	