<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="/public/js/photo.js"></script>
<script src="/public/modules/itemp/oferta.js"></script>

<link rel="stylesheet" href="/public/modules/itemp/oferta.css" type="text/css" />

<?if (count($experts)>0):?>						
	<h1 class="page-header"><?=$prod->title?></h1>

<script>
	var count_docs = 1;
	var html;

	function switchDogovor(type) {
	    if (type == 0) {
			$('#dogovor_file').show();
			$('#dogovor_text').hide();
			$('#oferta_text').val('<p></p>');
		} else {
			$('#file477').val('');
			$('#dogovor_file').hide();
			$('#dogovor_text').show();
			
		}
	}
	
	function proverka(input) {
	    input.value = input.value.replace(/[^\d,]/g, '');
	}

	function addFile1()
	{
		$('#outt0').clone().appendTo('#files');	
		//alert(123);
		var html = $('#files .file:last').html();

		var IDString = '#outt' + count_docs;

		html = html.replace(/#outt\d+/g, IDString);
		html = html.replace(new RegExp('file10','g'),'file1' + count_docs);
		html = html.replace(new RegExp('outfile0','g'),'outfile' + count_docs);
		html = html.replace(new RegExp('delb0','g'),'delb' + count_docs);
		
		$('#files .file:last').html(html);

		if ($('#files .file').length > 1) {
			//$('#files a').show();
		}

		$('#add1').hide();
		count_docs ++;
		
	}	

	function removeFile1(elem){
		elem.parent().parent().parent().parent().parent().parent().remove();	
		
		if ($('#files .file').length > 1) {
			//$('#files a').show();
		} else {
			//$('#files a').hide();
		}

//		$(this).parents('.oferta-file-group:first').find('input:file').removeClass('hidden');
		
		if ($('#files .file').length ==0) {
			addFile1();
			//$('#add1').show();
		}


	}	
	
	function addDoc(){
		$('#trd0').clone().appendTo('#costs');	

		if (($('#costs .costs').length + $('.costs1').length) > 1) {
			$('#costs a').show();
		}		
		
	}
	
	function addHtml(elem){
		//alert(html);
		$(elem).html(html);			
	}	

	
	function removeDoc(elem){
		elem.parent().parent().parent().remove();	
		//alert($('#costs .costs').length);
		if (($('#costs .costs').length + $('.costs1').length) < 2) {
			$('#costs a').hide();	
		}

	}


	function controlform(id) {
		var err = 0;
		$(id + ' .req').removeClass('parsley-error');		
		$(id + ' .req').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Укажите стоимость работы');
					err = 1;
				}
			}		
		);
//alert (err);		
		$(id + ' .req1').removeClass('parsley-error');		
		$(id + ' .req1').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Укажите срок (количество дней) выполнения услуги');
					err = 1;
				}
			}		
		);
//alert (err);		
		$(id + ' .req2').removeClass('parsley-error');		
		$(id + ' .req2').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Введите наименование услуги');
					err = 1;
				}
			}		
		);

//alert (err);		
		if (err == 1) {
			return false;
		} else {
			return true;
		}
	
	}
</script>	

<script>
	$(document).ready(function() {
		addFile1();
		switchDogovor(<?if($expert->dogovor != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$expert->dogovor)):?>0<?else:?>1<?endif?>);
	});
</script>		
	


<?if ($_GET['accept'] == '0'):?>
	<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				$.gritter.add({
					title: '',
					text: 'Вы откликнулись на заявку.',
					image: '',
					sticky: true,
					time: '',
					class_name: 'my-sticky-class'
				});
			}, 1000);									
		});
	</script>
<?endif?>	
	
	
	<div class="vertical-box col-md-12">
	
	
						
<div class="vertical-box-column">
		<div class="panel panel-primary itempanel">
						<!-- begin panel -->
									<div class="panel-heading" style="height:40px">
									<p class="tt">Заявка</p>
									
									<div class="clearfix"></div>
									
								</div>
								
					<div class="panel-body" >
						<!-- begin wrapper -->
						<!-- end wrapper -->
						<!-- begin wrapper -->
								<div <?if (strlen(strip_tags($prod->name))>2000 || $options->count() >0):?>class="col-md-12"  data-scrollbar="true" data-height="370px"<?else:?>class="col-md-12"<?endif?> style="padding-left:0px;width:100%">
								<?=$prod->name?>
								
								<?if ($options->count() >0):?>
									<div class="" style="15px 0px">
										<div style="margin:0 auto;border-top:1px solid #CCD0D4;margin-top:20px;padding-bottom:20px">
										</div>
									</div>

								 									<table class="table">
									<tbody>
                            
								<?foreach ($options as $opt):?>
									                            <tr>
                                    <td style="padding:5px;padding-left:0px" nowrap>
                                        <strong><?=$opt->option1->name?></strong>:
                                    </td>
                                    <td style="padding:5px;padding-left:0px"> <?if($opt->option1->type2 !=4) :?><?=$opt->value?><?else:?>
									<?$vars = array('0'=>'нет','1'=>'да')?>
									<?=$vars[$opt->value]?>
									<?endif?></td>
                                </tr>								
								<?endforeach?>	
								</tbody>
                        </table>
									<div class="" style="15px 0px">
										<div style="margin:0 auto;border-top:1px solid #CCD0D4;margin-top:20px;padding-bottom:20px">
										</div>
									</div>


								<?endif?>
								
								<?if($imgs->count() > 0):?>
									<h5>Документы по заявке:</h5>
									<table>
									<?foreach($imgs as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px;vertical-align:middle">
										<a class="m-b-10" target="_blank" href="/img/photos/<?=$file->name?>"><?=$i+1?>. <?=$file->description?></a>
										</td></tr>
									<?endforeach?>
									</table>
								<?endif?>								
								
								
								</div>
								
								
								
								
							
						</div>
						
						<!--div class="panel-footer" style="padding-bottom:0px;padding-top:15px">

								</div-->
						
						</div>
	</div>
						
						
		<div class="vertical-box-column" style="padding:0px 15px">
						<!-- begin panel -->
						<div class="panel panel-primary itempanel" data-sortable-id="table-basic-1" id="profilelist">
								<?foreach ($experts as $k=>$exp) :?>
								
								<div class="panel-heading">
								<h4 class="panel-title"><?=$exp['shortname']?></h4>
							</div>
							<div class="panel-body centered">
								<div style="text-align:center"class="imgr1">
												<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
													<table><tr><td>
														<img src="/img/logos/<?=$exp['logo']?>" />
													</td></tr></table>
												<?endif?>
								</div>			
									<p class="centered">
									Средний рейтинг компании <br/>
									<?=str_repeat("<img src='/img/st1.jpg'>", $exp['rate']['rate'])?><?=str_repeat("<img src='/img/st2.jpg'>", 5 - $exp['rate']['rate'])?>
									
									<br/> Отзывы (<?=$exp['rate']['feeds']?>)
									</p>
								<p>
											<a href="#modal-dialog<?=$exp['id']?>" data-toggle="modal" class="btn btn-sm btn-primary w192 text-left"><i class="fa fa-user"></i> &nbsp;&nbsp;Профиль компании</a>
								</p>				
			
								
								
<div class="modal fade" id="modal-cost1">
									<div class="modal-dialog m-t-50"  style="width:900px">
										<div class="modal-content">											
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 style="color:#707478">Форма для создания коммерческого предложения</h4>
													<div style="clear:both"></div>
												</div>
												
												<?require "oferta.php"?>												
												
										</div>			
									</div>
								</div>
				
							<?if ($na == 0):?>
								<p><a class="btn btn-sm btn-primary w192 text-left" href="#modal-cost1" data-toggle="modal"><i class="fa fa-thumbs-o-up"></i> &nbsp;&nbsp;Принять заявку</a></p>	

								
								
								
								
								<div class="modal fade" id="modal-cost">
									<div class="modal-dialog m-t-50"  style="width:500px">
										<div class="modal-content">											
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 style="color:#707478">Укажите стоимость Вашей работы</h4>
													<div style="clear:both"></div>
												</div>
												<form action="/user/accept?id=<?=$prod->id?>&reject=0" id="accform" method="post">
												<div class="modal-body text-center">												
											
														<div class="alert alert-danger m-b-10 m-t-10 text-left">
												<h4><i class="icon-bulb"></i> Указывайте максимально точную стоимость</h4>
												<p>Необходимо указывать максимально точную стоимость, так в случае сильного расхождения между указанной стоимостью и которая получится в результате необходимых дальнейших уточнений, есть риск что провайдеру откажут и будет дан негативный отзыв.</p>
											</div>


														
														<input type="text" name="price" class="form-control req" placeholder="Введите стоимость Вашей работы">
														
														<div class="form-group m-t-10">
															<div class="col-md-5" style="padding-left:0px">Укажите валюту стоимости: 
															</div>
															<div class="col-md-7 text-left">
																<select name="valuta">
																	<option value="RUR">RUR</option>
																	<option value="USD">USD</option>
																	<option value="EUR">EUR</option>
																</select>
															</div>
														</div>


														
												</div>
												<div class="modal-footer">
													<input class="btn btn-primary" onclick="return controlform('#accform')" type="submit" value="Принять заявку" />
												</div>
												</form>
										</div>			
									</div>
								</div>
								
							<?else:?>

								
								
								
								
								
								<?if ($reject) :?>
									<p><a class="btn btn-sm btn-danger w192 text-left"  href="#modal-del" data-toggle="modal"><i class="fa fa-thumbs-o-down"></i> &nbsp;&nbsp;Отказ клиента</a></p>
									<div class="modal fade" id="modal-del">
											<div class="modal-dialog m-t-50"  style="width:500px">
												<div class="modal-content">											
													<form action="/user/accept?id=<?=$prod->id?>&reject=0" id="delform1" method="post">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 style="color:#707478">Отказ от вашего предложения </h4>
															<div style="clear:both"></div>
														</div>
														<div class="modal-body text-center">												
																<div class="alert alert-danger m-b-10 m-t-10 text-left">
												<h4><i class="icon-bulb"></i> К сожалению клиент отказался от Ваших услуг <?=date('d.m.Y H:i',$reject)?></h4>
												
												<p>К сожалению, Ваше предложение отклонено.</p>
												<?if ($choosen == 0):?>
													<p>&nbsp;</p>
													<p><strong>Причина отказа: </strong><?=$expert->reason?></p>	
													<p>&nbsp;</p>
												
													<p>У Вас есть 3 дня, чтобы скорректировать Ваше предложение (по цене, по срокам и т.п.).
	Для этого мы рекомендуем еще раз связаться с потенциальным клиентом и прояснить причины отказа.
	Если Вы не готовы скорректировать предложение, Вы можете самостоятельно подтвердить отказ от заявки или заявка будет удалена автоматически через 3 дня.
	</p>
												<?else:?>	
													<p>Клиент выбрал другую компанию.</p>
												<?endif?>
											</div>
											<?if ($choosen == 0):?>
											<input type="text" name="price" class="form-control req" placeholder="Введите стоимость Вашей работы">
														
														<div class="form-group m-t-10">
															<div class="col-md-5" style="padding-left:0px">Укажите валюту стоимости: 
															</div>
															<div class="col-md-7 text-left">
																<select name="valuta">
																	<option value="RUR">RUR</option>
																	<option value="USD">USD</option>
																	<option value="EUR">EUR</option>
																</select>
															</div>
														</div>
											
											<?endif?>					
																
														</div>
														<div class="modal-footer text-center">	
															<?if ($choosen == 0):?>
																<input type="submit" class="btn btn-danger"  onclick="return controlform('#delform1')" value="Изменить данные" />
																<a class="btn btn-primary text-left" href="/user/rejecte/?uid=<?=$prod->id?>&expert=<?=$user?>">Подтвердить</a>
															<?endif?>	
															<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Отменить</button>
														</div>
													</form>	
												</div>			
											</div>
										</div>

								<?else:?>			
									
										<p><a class="btn btn-sm btn-primary w192 text-left" href="#modal-cost1"  data-toggle="modal"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Ваше предложение</a></p>	
								
								
										<p><a class="btn btn-sm btn-primary w192 text-left"  href="#modal-del" data-toggle="modal"><i class="fa fa-thumbs-o-down"></i> &nbsp;&nbsp;Отказаться от заявки</a></p>	
								
								
										<div class="modal fade" id="modal-del">
											<div class="modal-dialog m-t-50"  style="width:500px">
												<div class="modal-content">											
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 style="color:#707478">Отказаться от заявки</h4>
															<div style="clear:both"></div>
														</div>
														<div class="modal-body text-center">												
																<form action="/user/accept?id=<?=$prod->id?>&reject=1" id="delform">
																	<input type="hidden" name="del" value="<?=$prod->id?>">
																	<button class="btn btn-danger m-r-20">Отказаться</button>
																	<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Отменить</button>
																</form>
														</div>		
												</div>			
											</div>
										</div>	
								
								
								
									<?$acc=array(1=>'Вы отказались от заявки',0=>'Вы приняли заявку')?>
									<?$bcc=array(1=>'btn btn-sm btn-danger m-b-10 w192 text-left',0=>'btn  m-b-10 btn-sm btn-success w192 text-left')?>
									<?$icons = array(0=>'<i class="fa fa-thumbs-o-up"></i>',1=>'<i class="fa fa-thumbs-o-down"></i>');?>
									<!--a href="javascript:void(0)" class="<?=$bcc[$reject]?>"><?=$icons[$reject]?> &nbsp;&nbsp;<?=$acc[$reject]?></a-->
								
								<?endif?>

							<?endif?>
						 
											
								
							</div>
								
							<div class="modal fade" id="modal-dialog<?=$exp['id']?>">
								<div class="modal-dialog"  style="width:1000px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<table><tr><td style="padding-right:30px">
												<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
													<img style="max-height:80px" src="/img/logos/<?=$exp['logo']?>"/>
												<?endif?>
											</td><td>
											<h3 ><?=$exp['fullname']?></h3><h4 style="color:#707478"><?=$exp['shortname']?></h4></td></tr></table>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">												

										<?require "profile.php"?>
										
										
										
										</div>		
									</div>			
								</div>
							</div>	
								<?endforeach?>
						</div>
						
						<!-- end panel -->
						<!-- begin panel -->

		</div>
						
<div class="vertical-box-column">

<div class="panel panel-primary itempanel" id="feedlist">
<?$j=0?>
						<?foreach ($experts as $k=>$exp) :?>
						
	<div id="feeds<?=$exp['id']?>" class="expfeeds panel-primary">											
		
								<div class="panel-heading">
									<h4 class="panel-title">Отправить сообщение <?=$exp['shortname']?></h4>
								</div>
								<?if ($na == 0) :?>
									<div class="col-md-12 m-t-10">
									<p>Возможность коммуникации с клиентом доступна только после принятия заявки.</p>
									<p><a class="btn btn-sm btn-primary w192 text-left" href="#modal-cost" data-toggle="modal"><i class="fa fa-thumbs-o-up"></i> &nbsp;&nbsp;Принять заявку</a></p>	
									</div>
								<?endif?>
		<?if (count($exp['feeds']) >0):?>																							
								<div class="panel-body bg-silver">
									<div data-scrollbar="true" data-height="290px">
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
			<?endif?>
								<?if ($showform == 1) :?>
									<div class="panel-footer">
										<form method="POST" class="form-horizontal jq138<?=$exp['id']?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html?num=<?=$j?>" enctype="multipart/form-data">
									

                                <div class="input-group">
																				<input type="hidden" value="<?=$exp['user_id']?>" name="preuser" >	
												<input type="hidden" name="uid" value="<?=$prod->id?>">	

                                    <input type="text" class="form-control input-sm" name="ticket" placeholder="Введите комментарий" value="<?=trim($data['ticket'])?>" />
                                    <span class="input-group-btn">
                                        <input type="submit" value="Отправить" class="btn btn-primary btn-sm" />
                                    </span>
                                </div>
<p>&nbsp;</p>
								
								<div class="input-group" style="margin-top:-20px;">
									<table><tr><td>
										<span class="btn btn-primary fileinput-button btn-sm blau">                                    
											<span>Отправить файл</span>
											<input type="file" id="chatfile" class="btn btn-success input-sm"  onchange="outphoto('chatfile','chatout');" name="filename"  />
										</span>
									</td><td id="chatout" style="padding-left:10px"></td></tr></table>										
								</div>
								
									</form>
                                </div>

								<?endif?>
													
	</div>								<?$j++?>
	<?endforeach?>					

						</div>
</div>
			<?endif?>		
	
		
	</div>					

	

	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards-validation.demo.js"></script>
	
	
		<script>
//			function ()
		
		
		$(document).ready(function() {
			//App.init();
			FormWizardValidation.init();
			//FormWysihtml5.init();
			CKEDITOR.replace( 'oferta_text' )
			$('.expfeeds').hide();$('.expfeeds:eq(<?=intval($num)?>)').show();
		});
	</script>

	
	