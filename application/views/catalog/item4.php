<div class="col-md-12">&nbsp;
</div>
<div class="col-md-12">
	<div class="panel panel-inverse">
								<div class="panel-heading">
								<h1 class="panel-title" style="font-size:24px">
									<?=$prod->title?> (<?=$cat->name?>)
								</h1>
							</div>
							
		        <div class="panel-body">
		            <!-- begin wrapper -->
		            <!-- end wrapper -->
		            <!-- begin wrapper -->
                    <div class="wrapper">
                        <!--h4 class="m-b-15 m-t-0 p-b-10 underline"><?=$prod->title?> (<?=$cat->name?>)</h4-->                        
                        
                        <p class="f-s-12 text-inverse"> 
                            <?=$prod->name?>
                        </p>
						
						<?if ($view == 0) :?>	
	<form action="/user/delete/" id="delform">
		<input type="hidden" name="del" value="<?$prod->id?>">
		<button class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить заявку</button>
		</form>
	
	
	<p>&nbsp;</p>
	<?endif?>
						
						
                    </div></div>							
							
							
	</div>						
</div>


<div class="col-md-12">
					
					<div class="panel panel-inverse">

					
<div class="panel-group" id="accordion">

<?if (count($experts)>0):?>
<?foreach ($experts as $k=>$exp) :?>
						<div class="panel panel-inverse overflow-hidden">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$exp['id']?>">
									    <i class="fa fa-plus-circle pull-right"></i> 
										<?=$exp['shortname']?>
									</a>
								</h3>
							</div>
							<div id="collapse<?=$exp['id']?>" class="panel-collapse collapse in">
								<div class="panel-body">
									<div >			
						<table class="nobold nospace p5px" style="width:100%;table-layout:fixed"><tr>
						<td style="vertical-align:middle">
						
										<input name="my_input" value="<?=$exp['rating']?>" id="rating_simple<?=$exp['id']?>" type="hidden">

										<script>
													$(function() {
														/*$("#rating_simple<?=$exp['id']?>").webwidget_rating_simple({
															rating_star_length: '5',
															rating_initial_value: '<?=$exp['rating']?>',
															rating_function_name: 'rateOut(<?=$exp['id']?>)',//this is function name for click
															directory: '/public/js'
														});*/
													});
										</script>
		
		
							<div class="modal fade" id="modal-dialog<?=$exp['id']?>">
								<div class="modal-dialog"  style="width:1000px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title"><?=$exp['shortname']?></h4>
										</div>
										<div class="modal-body">
											
											
											
		<?if ($exp['role']==5):?>
<div class="col-md-12">
					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div ><br/><strong>Сфера деятельности:</strong> <?=$v->cat->name?></div>
			

			<?//if ($u2cs1[0]->id != $v->id):?>	
				<strong>Специализация:</strong>
				<ul >
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul>
			<?//endif?>			
		<?endif?>		
	<?endforeach?>
		
					<?if ($exp['parent_user_id']>0):?>		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['logo']?>" /></div>
					</div>	
					<?endif?>

			<?endif?>			
						
						
						<div class="row">
			<div class="cont_form_name">ФИО </div>
			<div class="ti">
			<?=$exp['fio']?>
			</div>
			</div>
			
				<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['photo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['photo']?>" /></div>
					</div>	
					<?endif?>
			
			<div class="row">
			<div class="cont_form_name">Город </div>
			<div class="ti">
			<?=$exp['city']?>
			</div>
			</div>							
						
						
			<div class="row">
			<div class="cont_form_name">Регион </div>
			<div class="ti">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name">Улица </div>
			<div class="ti">
			<?=$exp['street']?>
			</div>
			</div>	
						<div class="row">
			<div class="cont_form_name">Дом </div>
			<div class="ti">
			<?=$exp['house']?>
			</div>
			</div>	
		
		</div>
		<?else:?>
		
		<div class="col-md-6">
		
		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="col-md-12">
						<img src="/img/logos/<?=$exp['logo']?>" />
					</div>	
					<div class="col-md-12">&nbsp;</div>
					<?endif?>
					
			<div class="col-xs-5"><strong>Наименование компании</strong> </div>
			<div class="col-xs-7"><?=$exp['fullname']?> </div>
			<div class="clearfix"></div>
			
					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div class="col-xs-5"><strong>Сфера деятельности:</strong> </div>
			<div class="col-xs-7"><?=$v->cat->name?> </div>
			<div class="clearfix"></div>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<div class="col-xs-5"><strong>Специализация:</strong></div>
				<div class="col-xs-7"><ul>
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></div>
				<div class="clearfix"></div>
			<?endif?>			
		<?endif?>		
	<?endforeach?>
		
		
								<div class="col-xs-5"><strong>Регион </strong></div>
			<div class="col-xs-7">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			
			</div><div class="clearfix"></div>
						
			<div class="col-xs-5"><strong>Город </strong></div>
			<div class="col-xs-7">
			<?=$exp['city']?>
			</div>	<div class="clearfix"></div>
						
				


			<?if ($role == 3):?>
			<div class="col-xs-5"><strong>Вид деятельности <span>*</span></strong></div>
			<div class="col-xs-7">
						<?=$exp['export']?>
			</div><div class="clearfix"></div>

			<?endif?>			
										
			</div>			
			<div  class="col-md-6">
						
							
	
								<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['photo'])):?>
					<div class="col-xs-12">
						<img src="/img/uimgs/<?=$exp['photo']?>" />
					</div>	<div class="col-md-12">&nbsp;</div>
					<?endif?>

	
						<div class="col-xs-5"><strong>Представитель</strong></div>
			<div class="col-xs-7">
			<?=$exp['fio']?>
			</div><div class="clearfix"></div>
			

			
			<div class="col-xs-5"><strong>Должность</strong></div>
			<div class="col-xs-7">
			<?=$exp['dolz']?>
			</div><div class="clearfix"></div>
		
		<div class="col-xs-5"><strong>Телефон компании</strong></div>
			<div class="col-xs-7">
			<?=$exp['phone1']?>
			</div><div class="clearfix"></div>


		<div class="col-xs-5"><strong>E-mail </strong></div>
			<div class="col-xs-7">
			<?=$exp['email']?>
			</div><div class="clearfix"></div>
			
			
		<div class="col-xs-5"><strong>Web-сайт </strong></div>
			<div class="col-xs-7">
			<?=$exp['web']?>
			</div>

		</div>
						
			<div style="clear:both"></div>			
		
			<?endif?>			
			</div></div>						
						</td>
						<td style="width:150px;height:140px;">
							<div style="display:block;height:140px;overflow:hidden;">
								<div style="display:table-cell;height:140px;overflow:hidden;vertical-align:middle">
									<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
										<img src="/img/logos/<?=$exp['logo']?>" width="150px" />
									<?endif?>
								</div>
							</div>	
						</td>
						</tr><tr>
						<td colspan="2">
						<?if ($view == 0) :?>
						<table style="width:100%" ><tr><td width="33%" style="padding-left:0px;">
						<?if ( $exp['reject'] == 0 && $exp['choosen'] == 0):?><a href="/user/choose/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Выбрать компанию</a><?endif?>&nbsp;</td>
						<?if ($exp['reject'] == 0):?>
							<td width="33%" align="center"><a href="/user/reject/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Отказаться от услуг компании</a></td>
						<?endif?>
						<td width="33%" align="right"><a href="/user/close?id=<?=$prod->id?>" onclick="return confirm('Вы уверены?')">Закрыть заявку</a></td>

						</tr></table>
						<?else:?>
							<?if ($na == 0):?>
							<table style="width:100%" ><tr>
								<td align="left"><a style="margin-left:-10px" href="/user/accept?id=<?=$prod->id?>&reject=0">Откликнуться на заявку</a></td>
								<td align="right">
								<a href="/user/accept?id=<?=$prod->id?>&reject=1" onclick="return confirm('Вы уверены?')">Отказаться от заявки</a></td>

							</tr></table>
							
							<?else:?>
							<table style="width:100%" ><tr>
								<td align="left">&nbsp;
								</td><td align="right">
								<?if ($reject) :?>
									К сожалению клиентом отказался от Ваших услуг <?=date('d.m.Y H:i',$reject)?> <br/>
									<a href="/user/rejecte/?uid=<?=$prod->id?>&expert=<?=$user?>">Подтвердить отказ от услуги</a>
								<?endif?></td>

							</tr></table>
							
							<?endif?>
							<?if (isset($_GET['accept'])) :?>
								<?$acc=array(1=>'Вы отказались от заявки',0=>'Вы откликнулись на заявку')?>
								<?=$acc[$_GET['accept']]?>
							<?endif?>
						<?endif?>
						</td>
						</tr></table>
						
<hr style="border-top:2px solid #999"/>						

					</div>
						
						
<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Сообщения</h4>
						</div>
						
						<div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <ul class="chats">
									<?foreach ($exp['feeds'] as $feed) :?>
										<li class="<?if ($feed['user_id'] == $user):?>left<?else:?>right<?endif?>">
											<span class="date-time"><?=$feed['cts']?></span>
											<a href="javascript:;" class="name"><?if ($feed['user_id'] == $user):?>Вы:<?else:?>Эксперт <?=$feed['shortname']?><?endif?></a>
											<?if ($feed['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$feed['photo'])):?>
												<a href="javascript:;" class="image"><img alt="" src="/img/uimgs/<?=$feed['photo']?>" /></a>
											<?endif?>
											
											<div class="message">
												<?=$feed['text']?>
												<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
													<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
												<?endif?>
											</div>
										</li>
									<?endforeach?>
                                </ul>
                            </div>
                        </div>
	
						<?if ($showform == 1) :?>
							<div class="panel-footer">
								<form method="POST" class="form-horizontal" id="jq138<?=$prod->id?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html" enctype="multipart/form-data">
								
								<div class="form-group">
                                    <label class="col-md-12 control-label"><?if (intval($_GET['sale_type'])==0):?>Комментарий<?else:?>Тема<?endif?> <span>*</span></label>
                                    <div class="col-md-12">
                                        		
		<textarea class="ckeditor" name='ticket' ><?=trim($data['ticket'])?></textarea>

                                    </div>
									<label class="col-md-12 control-label">&nbsp;</label>
									<div class="col-md-3">
                                        		<input type="hidden" name="uid" value="<?=$prod->id?>">	
		<input type="file" class="form-control" name="title"  value="<?if (count($errors)>0) :?><?=$_POST['title']?><?else:?><?=$data['title']?><?endif?>">

                                    </div>
									<div class="clearfix"></div>
									<label class="col-md-12 control-label">&nbsp;</label>
									<div class="col-md-3">
									<a class="btn btn-success" href="javascript:void(0);" onclick="javascript:$('#jq138<?=$prod->id?>').submit();"><div>Отправить</div></a>
									</div>
                                </div>
	
								</form>
							</div>
						<?endif?>
					</div>						
					
<!--hr/-->
						
						</div>
			</div>



			
								</div>
							</div>
						</div>
<?endforeach?>							
<?endif?>					
					
	<?if (count($experts)>0):?>
			<div id="tabs">
<ul class="nav  nav-tabs">
<?foreach ($experts as $i=>$exp) :?>
	<li <?if ($i==0):?>class="active"<?endif?>><a data-toggle="tab" href="#exp<?=$exp['id']?>" ><?=$exp['shortname']?> </a></li>
<?endforeach?>

</ul>
	
	<div class="tab-content">
					<?foreach ($experts as $k=>$exp) :?>
					<div class="tab-pane fade <?if ($k==0):?>active in<?endif?>" id="exp<?=$exp['id']?>">
						<div >			
						<table class="nobold nospace p5px" style="width:100%;table-layout:fixed"><tr>
						<td style="vertical-align:middle">
						Компания: <?=$exp['shortname']?> <br/>
						Представитель: <?=$exp['fio']?> 
						<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?><br/>
						Регион: <?=$region->name?> <br/>
						<a href="#modal-dialog<?=$exp['id']?>" class="btn btn-sm btn-success" data-toggle="modal">Профиль компании</a>
						
										<input name="my_input" value="<?=$exp['rating']?>" id="rating_simple<?=$exp['id']?>" type="hidden">

										<script>
													$(function() {
														/*$("#rating_simple<?=$exp['id']?>").webwidget_rating_simple({
															rating_star_length: '5',
															rating_initial_value: '<?=$exp['rating']?>',
															rating_function_name: 'rateOut(<?=$exp['id']?>)',//this is function name for click
															directory: '/public/js'
														});*/
													});
										</script>
		
		
							<div class="modal fade" id="modal-dialog<?=$exp['id']?>">
								<div class="modal-dialog"  style="width:1000px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title"><?=$exp['shortname']?></h4>
										</div>
										<div class="modal-body">
											
											
											
		<?if ($exp['role']==5):?>
<div class="col-md-12">
					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div ><br/><strong>Сфера деятельности:</strong> <?=$v->cat->name?></div>
			

			<?//if ($u2cs1[0]->id != $v->id):?>	
				<strong>Специализация:</strong>
				<ul >
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul>
			<?//endif?>			
		<?endif?>		
	<?endforeach?>
		
					<?if ($exp['parent_user_id']>0):?>		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['logo']?>" /></div>
					</div>	
					<?endif?>

			<?endif?>			
						
						
						<div class="row">
			<div class="cont_form_name">ФИО </div>
			<div class="ti">
			<?=$exp['fio']?>
			</div>
			</div>
			
				<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['photo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['photo']?>" /></div>
					</div>	
					<?endif?>
			
			<div class="row">
			<div class="cont_form_name">Город </div>
			<div class="ti">
			<?=$exp['city']?>
			</div>
			</div>							
						
						
			<div class="row">
			<div class="cont_form_name">Регион </div>
			<div class="ti">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name">Улица </div>
			<div class="ti">
			<?=$exp['street']?>
			</div>
			</div>	
						<div class="row">
			<div class="cont_form_name">Дом </div>
			<div class="ti">
			<?=$exp['house']?>
			</div>
			</div>	
		
		</div>
		<?else:?>
		
		<div class="col-md-6">
		
		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="col-md-12">
						<img src="/img/logos/<?=$exp['logo']?>" />
					</div>	
					<div class="col-md-12">&nbsp;</div>
					<?endif?>
					
			<div class="col-xs-5"><strong>Наименование компании</strong> </div>
			<div class="col-xs-7"><?=$exp['fullname']?> </div>
			<div class="clearfix"></div>
			
					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div class="col-xs-5"><strong>Сфера деятельности:</strong> </div>
			<div class="col-xs-7"><?=$v->cat->name?> </div>
			<div class="clearfix"></div>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<div class="col-xs-5"><strong>Специализация:</strong></div>
				<div class="col-xs-7"><ul>
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></div>
				<div class="clearfix"></div>
			<?endif?>			
		<?endif?>		
	<?endforeach?>
		
		
								<div class="col-xs-5"><strong>Регион </strong></div>
			<div class="col-xs-7">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			
			</div><div class="clearfix"></div>
						
			<div class="col-xs-5"><strong>Город </strong></div>
			<div class="col-xs-7">
			<?=$exp['city']?>
			</div>	<div class="clearfix"></div>
						
				


			<?if ($role == 3):?>
			<div class="col-xs-5"><strong>Вид деятельности <span>*</span></strong></div>
			<div class="col-xs-7">
						<?=$exp['export']?>
			</div><div class="clearfix"></div>

			<?endif?>			
										
			</div>			
			<div  class="col-md-6">
						
							
	
								<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['photo'])):?>
					<div class="col-xs-12">
						<img src="/img/uimgs/<?=$exp['photo']?>" />
					</div>	<div class="col-md-12">&nbsp;</div>
					<?endif?>

	
						<div class="col-xs-5"><strong>Представитель</strong></div>
			<div class="col-xs-7">
			<?=$exp['fio']?>
			</div><div class="clearfix"></div>
			

			
			<div class="col-xs-5"><strong>Должность</strong></div>
			<div class="col-xs-7">
			<?=$exp['dolz']?>
			</div><div class="clearfix"></div>
		
		<div class="col-xs-5"><strong>Телефон компании</strong></div>
			<div class="col-xs-7">
			<?=$exp['phone1']?>
			</div><div class="clearfix"></div>


		<div class="col-xs-5"><strong>E-mail </strong></div>
			<div class="col-xs-7">
			<?=$exp['email']?>
			</div><div class="clearfix"></div>
			
			
		<div class="col-xs-5"><strong>Web-сайт </strong></div>
			<div class="col-xs-7">
			<?=$exp['web']?>
			</div>

		</div>
						
			<div style="clear:both"></div>			
		
			<?endif?>			
			</div></div>						
						</td>
						<td style="width:150px;height:140px;">
							<div style="display:block;height:140px;overflow:hidden;">
								<div style="display:table-cell;height:140px;overflow:hidden;vertical-align:middle">
									<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
										<img src="/img/logos/<?=$exp['logo']?>" width="150px" />
									<?endif?>
								</div>
							</div>	
						</td>
						</tr><tr>
						<td colspan="2">
						<?if ($view == 0) :?>
						<table style="width:100%" ><tr><td width="33%" style="padding-left:0px;">
						<?if ( $exp['reject'] == 0 && $exp['choosen'] == 0):?><a href="/user/choose/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Выбрать компанию</a><?endif?>&nbsp;</td>
						<?if ($exp['reject'] == 0):?>
							<td width="33%" align="center"><a href="/user/reject/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Отказаться от услуг компании</a></td>
						<?endif?>
						<td width="33%" align="right"><a href="/user/close?id=<?=$prod->id?>" onclick="return confirm('Вы уверены?')">Закрыть заявку</a></td>

						</tr></table>
						<?else:?>
							<?if ($na == 0):?>
							<table style="width:100%" ><tr>
								<td align="left"><a style="margin-left:-10px" href="/user/accept?id=<?=$prod->id?>&reject=0">Откликнуться на заявку</a></td>
								<td align="right">
								<a href="/user/accept?id=<?=$prod->id?>&reject=1" onclick="return confirm('Вы уверены?')">Отказаться от заявки</a></td>

							</tr></table>
							
							<?else:?>
							<table style="width:100%" ><tr>
								<td align="left">&nbsp;
								</td><td align="right">
								<?if ($reject) :?>
									К сожалению клиентом отказался от Ваших услуг <?=date('d.m.Y H:i',$reject)?> <br/>
									<a href="/user/rejecte/?uid=<?=$prod->id?>&expert=<?=$user?>">Подтвердить отказ от услуги</a>
								<?endif?></td>

							</tr></table>
							
							<?endif?>
							<?if (isset($_GET['accept'])) :?>
								<?$acc=array(1=>'Вы отказались от заявки',0=>'Вы откликнулись на заявку')?>
								<?=$acc[$_GET['accept']]?>
							<?endif?>
						<?endif?>
						</td>
						</tr></table>
						
<hr style="border-top:2px solid #999"/>						

					</div>
						
						
<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Сообщения</h4>
						</div>
						
						<div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <ul class="chats">
									<?foreach ($exp['feeds'] as $feed) :?>
										<li class="<?if ($feed['user_id'] == $user):?>left<?else:?>right<?endif?>">
											<span class="date-time"><?=$feed['cts']?></span>
											<a href="javascript:;" class="name"><?if ($feed['user_id'] == $user):?>Вы:<?else:?>Эксперт <?=$feed['shortname']?><?endif?></a>
											<?if ($feed['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$feed['photo'])):?>
												<a href="javascript:;" class="image"><img alt="" src="/img/uimgs/<?=$feed['photo']?>" /></a>
											<?endif?>
											
											<div class="message">
												<?=$feed['text']?>
												<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
													<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
												<?endif?>
											</div>
										</li>
									<?endforeach?>
                                </ul>
                            </div>
                        </div>
	
						<?if ($showform == 1) :?>
							<div class="panel-footer">
								<form method="POST" class="form-horizontal" id="jq138<?=$prod->id?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html" enctype="multipart/form-data">
								
								<div class="form-group">
                                    <label class="col-md-12 control-label"><?if (intval($_GET['sale_type'])==0):?>Комментарий<?else:?>Тема<?endif?> <span>*</span></label>
                                    <div class="col-md-12">
                                        		
		<textarea class="ckeditor" name='ticket' ><?=trim($data['ticket'])?></textarea>

                                    </div>
									<label class="col-md-12 control-label">&nbsp;</label>
									<div class="col-md-3">
                                        		<input type="hidden" name="uid" value="<?=$prod->id?>">	
		<input type="file" class="form-control" name="title"  value="<?if (count($errors)>0) :?><?=$_POST['title']?><?else:?><?=$data['title']?><?endif?>">

                                    </div>
									<div class="clearfix"></div>
									<label class="col-md-12 control-label">&nbsp;</label>
									<div class="col-md-3">
									<a class="btn btn-success" href="javascript:void(0);" onclick="javascript:$('#jq138<?=$prod->id?>').submit();"><div>Отправить</div></a>
									</div>
                                </div>
	
								</form>
							</div>
						<?endif?>
					</div>						
					
<!--hr/-->
						
						</div>
					<?endforeach?>
			</div>		
	</div>
	<?endif?>
<?if (count($experts) >0) :?>
	
	<?endif?>

</div>	
</div>
</div>
					
					
					
		        </div>
		        <!-- end vertical-box-column -->
		    </div>


<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/assets/js/form-wysiwyg.demo.min.js"></script>
	
	
	<script>
		$(document).ready(function() {
			FormWysihtml5.init();
		});
	</script>