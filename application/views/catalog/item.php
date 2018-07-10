<script type="text/javascript" src="/public/js/jquery.print.page.js"></script>
<script src="/public/js/photo.js"></script>
<script src="/public/modules/itemp/oferta.js"></script>

	<script>
		$(document).ready(function() {
			<?foreach($experts as $exp) :?>
				addFile1('files<?=$exp['id']?>');
			<?endforeach?>
			addFile2();
			$(".print").printPage();
		});
	</script>

<script>
	var count_docs = 1;
	var html;
	
	function proverka(input) {
	    input.value = input.value.replace(/[^\d,]/g, '');
	}

	function addFile1(elem){
		$('#outt0').clone().appendTo('#' + elem);	
		//alert(123);
		var html = $('#' + elem + ' .file:last').html();

		var IDString = '#outt' + count_docs;

		html = html.replace(/#outt\d+/g, IDString);
		html = html.replace(new RegExp('file10','g'),'file1' + count_docs);
		html = html.replace(new RegExp('outfile0','g'),'outfile' + count_docs);
		html = html.replace(new RegExp('delb0','g'),'delb' + count_docs);
		html = html.replace(new RegExp('shared-files','g'),elem);
		
		$('#' + elem + ' .file:last').html(html);

		if ($('#' + elem + ' .file').length > 1) {
			//$('#files a').show();
		}

		count_docs ++;
		
	}	

	function addFile2(){
		
		$('#outt0').clone().appendTo('#shared-files');	
		//alert(123);
		var html = $('#shared-files .file:last').html();

		var IDString = '#outt' + count_docs;

		html = html.replace(/#outt\d+/g, IDString);
		html = html.replace(new RegExp('file10','g'),'file1' + count_docs);
		html = html.replace(new RegExp('outfile0','g'),'outfile' + count_docs);
		html = html.replace(new RegExp('delb0','g'),'delb' + count_docs);
		
		$('#shared-files .file:last').html(html);

		if ($('#shared-files .file').length > 1) {
			//$('#files a').show();
		}

		count_docs ++;
		
	}	

	function switchFiles(type,uid) {
		$('.switcher').removeClass('btn-inverse');
		$('.switcher').addClass('btn-white');
		$('#of_but_'+type + uid).addClass('btn-inverse');
		$('.taba').hide();
		$('#of_type_'+type + uid).show();
	}

	
	
	function removeFile1(elem,dstelem){
		elem.parent().parent().parent().parent().parent().parent().remove();
		
		if ($('.out').length > 0) {
			$('#' + dstelem).parent().find('input[type=submit]').show();
		} else {
			$('#' + dstelem).parent().find('input[type=submit]').hide();
		}	
		
	}
</script>

<div style="display:none">

								<div class="input-group file m-b-10 col-md-12 oferta-file-group" id="outt0">
<!--		<label class="text-left nopl">Введите описание файла</label>-->

<!--		<div class="form-group col-md-12">-->
<!--			<textarea style="resize:none" name="fdsc[]" class="form-control req2" placeholder="Введит-описание файл<!--а"><?//=$job->name?></textarea>-->
<!--		</div>-->

		<table class="filelist">
			<tr>
				<td class="hidden file-icon_container">
					<i class="fa fa-file-text-o fa-2x"></i>
					<div class="tohide"></div>
				</td>
				<td>
					<span class="btn btn-primary fileinput-button btn-sm blau">
						<i class="fa fa-upload"></i> <span>Выбрать файл</span>
						<input type="file" id="file10" class="btn btn-success input-sm"  onchange="addAttacmentByID.call(this, 'file10','outfile0', 'delb0', 'shared-files')" name="file[]"  />
					</span>
				</td>
				<td id="outfile0" class="attachment_editable_name" style="width: 200px;"></td>
				<td class="editable_name_container">
					<input type="text" name="fdsc[]" style="width: 200px;" class="hidden editable_name_value form-control input-sm" value="<?=$job->name?>">
				</td>
				<td>
					<a href="javascript:;;" onclick="changeAttachmentName.call(this);" class="btn-change_name hidden btn btn-success btn-sm">
						<i class="fa fa-edit"></i> <span>Изменить название</span>
					</a>
				</td>
				<td>
					<a href="javascript:;;" onclick="leaveChangeAttachmentNameDialog.call(this);" class="btn-leave_changename hidden btn btn-white btn-sm">
						<i class="fa fa-undo"></i> Не сохранять
					</a>
				</td>
				<td colspan="2">
					<div class="col-md-12 col-sm-12  text-left">
						<a href="javascript:;;" style="display:none" id="delb0" onclick='javascript:removeFile1($(this),"shared-files")' class="btn-remove_attachment btn btn-danger btn-sm">
							<i class="glyphicon glyphicon-trash"></i> Удалить
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>								


<div class="modal fade" id="modal-dialog-out-files<?=$exp['id']?>">
								<div class="modal-dialog" >
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 style="color:#707478">Приложения к заявке: <?=$exp['shortname']?></h4>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">	

<h5>Добавьте к описанию заявки дополнительную информацию, которая поможет потенциальному исполнителю более детально разобраться в поставленной задаче</h5>
<div class="text-left">		

<form enctype="multipart/form-data" method="POST" action="/user/addimgs" class="form-horizontal">
<input type="hidden" value="<?=$prod->id?>" name="prod" />
							<div id="shared-files" class="m-t-10">								
							
							</div>	

							
<input type="submit" class="btn btn-success btn-sm hidden" value="Добавить файлы к заявке" />							 

</form>

<?if($imgs->count() > 0):?>
									<h5>Приложения к заявке:</h5>
									<table>
									<?foreach($imgs as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px;vertical-align:middle">
										<?=$i+1?>. <a class="m-b-10" target="_blank" href="/img/photos/<?=$file->name?>"><?=$file->description?></a>
										</td><td style="padding-right:15px;padding-bottom:10px;vertical-align:middle">
										<a href="/user/delimg?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
										</td></tr>
									<?endforeach?>
									</table>
								<?endif?>



</div>
		
										
										</div>		
									</div>			
								</div>
							</div>



	<h1 class="page-header"><?=$cat->name?>  > <?=$prs?> </h1>
	<div class="col-md-12"  style="padding-top:0px">
	<div class="panel panel-primary" style="margin-bottom:15px">
						<!-- begin panel -->
									<div class="panel-heading" style="height:40px">
									<p class="tt"><?=$title1?></p>
									<!--h1 class="panel-title itemp" style="font-size:16px;float:left">
										
									</h1-->
									
									<div class="panel-heading-btn">
									
																	<?if ($view == 0) :?>	
																	
								<div class="modal fade" id="modal-del">
									<div class="modal-dialog m-t-50"  style="width:500px">
										<div class="modal-content">											
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 style="color:#707478">Удалить заявку</h4>
													<div style="clear:both"></div>
												</div>
												<div class="modal-body text-center">												
														<form action="/user/delete/" id="delform" method="post">
															<input type="hidden" name="del[]" value="<?=$prod->id?>">
															<button class="btn btn-danger m-r-20">Удалить</button>
															<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Отменить</button>
														</form>
												</div>		
										</div>			
									</div>
								</div>																	
																	
																	
																	
																	

			<a href="#modal-del" data-toggle="modal" class="btn btn-danger btn-xs" >Удалить заявку</a>

		<?endif?>
									
									</div><div class="clearfix"></div>
									
								</div>
								
					<div class="panel-body" >
						<!-- begin wrapper -->
						<!-- end wrapper -->
						<!-- begin wrapper -->
								<div <?if (strlen(strip_tags($prod->name))>2000 || $options->count() >0):?>class="col-md-12"  data-scrollbar="true" data-height="250px"<?else:?>class="col-md-12"<?endif?> style="padding-left:0px;width:100%">
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
								
								<p class="m-t-15">
											<a href="#modal-dialog-out-files<?=$exp['id']?>" data-toggle="modal" class="btn btn-sm btn-primary w192 text-left">
											<i class="fa fa-file-archive-o"></i> &nbsp;Приложения к заявке</a>
								</p>


<div class="text-left noshow">		<h5>Добавить документ:</h5>
<form enctype="multipart/form-data" method="POST" action="/user/addimgs" class="form-horizontal">
							<!--div id="shared-files" class="m-t-10">								
							
							</div-->	

<a href="javascript:;;" onclick="javascript:addFile2();" style="display:none" id="add2" class="add2 m-t-5 btn btn-success btn-sm"><i class="fa fa-plus"></i> Добавить файл</a>												
</form>		
</div>
								
						
								
								</div>
								
								
								
								
							
						</div>
						
						<!--div class="panel-footer" style="padding-bottom:0px;padding-top:15px">

								</div-->
						
						</div>
						
	</div>					
	
<?if (count($experts)>0):?>	
					<div class="clearfix"></div>
	<div class="vertical-box col-md-12">
	
	
	<div class="vertical-box-column">
				
						<div class="panel panel-primary itempanel" data-sortable-id="table-basic-2">
							<div class="panel-heading">

								<h4 class="panel-title"><?if ($view == 0) :?>Потенциальные подрядчики<?else:?>Податель заявки<?endif?></h4>
							</div>
							<div data-scrollbar="true" data-height="375px">
							<div class="panel-body">
								<table class="table table-hover" id="ulist">
									<thead>
										<tr>
											<th>#</th>
											<th>Компания</th>
											<th>Цена</th>
										</tr>
									</thead>
									<tbody>
										<?foreach ($experts as $k=>$exp) :?>
											<tr <?if ($choosen==0 || ($choosen==1 && $exp['choosen']==1)):?>onclick="javascript:switchtr($(this));" rel="<?=$exp['id']?>" class="acc <?if($exp['choosen']==1):?>success<?endif?>"<?else:?>style="color:#aaa"<?endif?>>
												<td><?=$k+1?></td>
												<td><?=$exp['shortname']?> </td>
												<td><?=$exp['total']?> <?=$exp['valuta']?> 

							<?if ($exp['choosen'] == 1):?>
								<div class="modal fade" id="modal-cls<?=$exp['id']?>">
									<div class="modal-dialog"  style="width:1000px">
										<div class="modal-content">
											<form class="form-horizontal" method="post" action="/user/close?id=<?=$prod->id?>">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 style="color:#707478">Закрыть заявку</h4>
													<div style="clear:both"></div>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
														<div class="form-group">
														<textarea class="form-control" style="height:70px" name="reason" placeholder="Введите комментарий"></textarea>
														</div>
													
														
														<div class="form-group">
															<div class="col-md-3" style="padding-top:7px;padding-left:0px">
																Оцените работу компании: 
															</div>
															<div class="col-md-9">
																<select name="rating" class="form-control" style="width:200px">
																	<option value="0">-</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select>
															</div>
														</div>
													</div>
													
												</div>		
												<div class="modal-footer">												
													<input type="submit" value="Закрыть заявку" class="btn btn-primary btn-sm" />
												</div>
											</form>
										</div>			
									</div>
								</div>
							<?endif?>													
												
							<?if ($exp['reject'] == 0):?>
								<div class="modal fade" id="modal-feed<?=$exp['id']?>">
									<div class="modal-dialog m-t-50"  style="width:500px">
										<div class="modal-content">
											<form class="form-horizontal" method="post" action="/user/reject/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 style="color:#707478">Отказаться от предложения компании: <?=$exp['shortname']?></h4>
													<div style="clear:both"></div>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
														<div class="form-group">
														<textarea class="form-control" style="height:70px" name="reason" placeholder="Опишите причину отказа"></textarea>
														</div>
													
														
														<div class="form-group">
															<div class="col-md-3" style="padding-top:7px;padding-left:0px">
																Оцените работу компании: 
															</div>
															<div class="col-md-9">
																<select name="rating" class="form-control" style="width:200px">
																	<option value="0">-</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select>
															</div>
														</div>
													</div>

												</div>		
												<div class="modal-footer">												
													<input type="submit" value="Отказаться от услуг компании" class="btn btn-primary btn-sm" />
												</div>
											</form>
										</div>			
									</div>
								</div>
							<?endif?>												
												
							<div class="modal fade" id="modal-cp<?=$exp['id']?>">
								<div class="modal-dialog"  style="width:900px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h3 ><?//=$exp['shortname']?></h3>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">												

						
										<?require "invoice.php"?>
										
										
										
										</div>		
									</div>			
								</div>
							</div>

							<div class="modal fade" id="modal-oferta<?=$exp['id']?>">
								<div class="modal-dialog"  style="width:900px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h3 ><?//=$exp['shortname']?></h3>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">												

						
										<?require "dogovor.php"?>
										
										
										
										</div>		
									</div>			
								</div>
							</div>
							

							<div class="modal fade" id="modal-dialog-myfiles<?=$exp['id']?>">
								<div class="modal-dialog" >
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 style="color:#707478">Файлы для работы с компанией: <?=$exp['shortname']?></h4>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">												
								<?if($exp['files']->count() > 0):?>
									<h5 style="margin-top:0px">Файлы:</h5>
									<?foreach($exp['files'] as $file) :?>							
										<a class="m-b-10" style="display:block" target="_blank" href="/img/files/<?=$file->name?>"><?=$file->file?></a>
									<?endforeach?>

								<?endif?>	
								
										
										</div>		
									</div>			
								</div>
							</div>							



							

							<div class="modal fade" id="modal-dialog-files<?=$exp['id']?>" >
								<div class="modal-dialog" style="width:900px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 style="color:#707478">Приложения к заявке от компании: <?=$exp['shortname']?></h4>
											<div style="clear:both"></div>
										</div>
										<div class="modal-body">	
<div class="col-md-12 grayed nopl">
						<a id="of_but_0<?=$exp['id']?>" onclick="switchFiles(0,<?=$exp['id']?>);return false;" class="btn btn-inverse btn-sm switcher" href="javascript:;;" >Входящие файлы </a>
						<a id="of_but_1<?=$exp['id']?>" onclick="switchFiles(1,<?=$exp['id']?>);return false;" class="btn btn-white btn-sm switcher" href="javascript:;;" >Исходящие файлы</a>
</div><div class="clearfix"></div>

<div id="of_type_0<?=$exp['id']?>" class="taba">						
								<?if($exp['files']->count() > 0):?>
									<h5 style="margin-top:0px">Файлы:</h5>
									
									<table>
									<?foreach($exp['files'] as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px">
										<?=$i+1?>. <a class="m-b-10" target="_blank" href="/img/files/<?=$file->name?>"><?=$file->description?></a>
										</td><td style="padding-right:15px;padding-bottom:10px">
										<?if ($file->owner_id == $prod->user_id) :?>
										<a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a><?endif?>
										</td></tr>
									<?endforeach?>
									</table>									
									
								<?endif?>	
</div>
<div id="of_type_1<?=$exp['id']?>"  class="taba" style="display:none">
<h5>Добавить файлы для работы с компанией</h5>
<div class="text-left">		

<form enctype="multipart/form-data" method="POST" action="/user/addfiles" class="form-horizontal">
<input type="hidden" value="<?=$prod->id?>" name="prod" />
<input type="hidden" value="<?=$exp['id']?>" name="expert" />
							<div id="files<?=$exp['id']?>" class="m-t-10">								
							
							</div>	
							
<input type="submit" class="btn btn-success btn-sm hidden" value="Добавить файлы к заявке" />							 

									
</form>

<?if(count($exp['outfiles']) > 0):?>
									<h5>Приложения к заявке для работы с компанией <?=$exp['shortname']?>:</h5>
									<table class="filelist">
									<?foreach($exp['outfiles'] as $i=>$file) :?>

									<tr>
									
									<td style="">
									<?=$i+1?>. 
									</td>					
									<td class="file-icon_container">
										<i class="fa fa-file-text-o fa-2x"></i>
									</td>
																		
									<td class="editable_name_container1">
										<input type="text" name="descriptions[<?=$file->id?>]" style="width: 200px;" class="hidden editable_name_value1 form-control input-sm" 
										value="<?=$file->description?>">
									
										<a class="m-b-10" target="_blank" style="display:block;width: 200px;" href="/img/files/<?=$file->name?>"><?=$file->description?></a>
									</td>
										
									<td>
										<a href="javascript:;;" onclick="changeAttachmentNameList.call(this);" class="btn-change_name btn btn-success btn-sm">
											<i class="fa fa-edit"></i> <span>Изменить название</span>
										</a>
									</td>										

									<td>
										<a href="javascript:;;" onclick="leaveChangeAttachmentNameDialogList.call(this);" class="btn-leave_changename hidden btn btn-white btn-sm">
										<i class="fa fa-undo"></i> Не сохранять
										</a>
									</td>
									
									<td style="">
										<?if ($file->user_id == $prod->user_id) :?>
										<a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a><?endif?>
										</td></tr>
									<tr><td colspan="8" style="height:10px"></td></tr>

									
										<!--tr><td style="padding-right:15px;padding-bottom:10px">
										<?=$i+1?>. <a class="m-b-10" target="_blank" href="/img/files/<?=$file->name?>"><?=$file->description?></a>
										</td><td style="padding-right:15px;padding-bottom:10px">
										<?if ($file->user_id == $prod->user_id) :?>
										<a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a><?endif?>
										</td></tr-->
									<?endforeach?>
									</table>
					<?endif?>


<?if($imgs->count() > 0):?>
									<h5>Приложения к заявке:</h5>
									<table>
									<?foreach($imgs as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px;vertical-align:middle">
										<?=$i+1?>. <a class="m-b-10" target="_blank" href="/img/photos/<?=$file->name?>"><?=$file->description?></a>
										</td><td style="padding-right:15px;padding-bottom:10px;vertical-align:middle">
										<a href="/user/delimg?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
										</td></tr>
									<?endforeach?>
									</table>
					<?endif?>



</div></div>
		
										
										</div>		
									</div>			
								</div>
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
												
	<div id="profile<?=$exp['id']?>" class="profiles">
	
	
								<div class="panel-heading">
								<h4 class="panel-title"><?=$exp['shortname']?></h4>
							</div>
							<div class="panel-body centered">
								<div style="text-align:center;height:auto"class="imgr1">
												<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
													<table><tr><td>
														<img style="width:200px;height:auto" src="/img/logos/<?=$exp['logo']?>" />
													</td></tr></table>
												<?endif?>
								</div>			
								
																<p class="centered">
									Средний рейтинг компании <br/>
									<?=str_repeat("<img src='/img/st1.jpg'>", $exp['rate']['rate'])?><?=str_repeat("<img src='/img/st2.jpg'>", 5 - $exp['rate']['rate'])?>
									
									<br/> Отзывы (<?=$exp['rate']['feeds']?>)
								</p>

								
								
								<p>
											<a href="#modal-dialog<?=$exp['id']?>" data-toggle="modal" class="btn btn-sm btn-primary w192 text-left"><i class="fa fa-user"></i> &nbsp;Профиль компании</a>
								</p>				
																
						<?if ($view == 0) :?>
						
							<?if ($choosen == 0):?><p><a class="btn btn-sm btn-primary w192 text-left" href="/user/choose/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>"><i class="fa fa-thumbs-o-up"></i> &nbsp;Выбрать компанию</a></p>	
							<?else:?>
								<?if ($prod->stock_type != 4) :?>
									<p><a class="btn btn-sm btn-primary w192 text-left" data-toggle="modal" href="#modal-cls<?=$exp['id']?>"><i class="fa fa-thumbs-o-up"></i> &nbsp;Закрыть заявку</a></p>	
								<?endif?>	
							<?endif?>
							
							<?if ($exp['reject'] == 0):?>		
								<?if ($prod->stock_type != 4) :?>	
									<p><a class="btn btn-sm btn-primary w192 text-left" data-toggle="modal" href="#modal-feed<?=$exp['id']?>"><i class="fa fa-thumbs-o-down"></i> &nbsp;Отказаться от компании</a></p>
								<?endif?>	
							<?else:?>	
								<p><a class="btn btn-sm btn-danger w192 text-left"  href="javascript:;" data-toggle="modal"><i class="fa fa-thumbs-o-down"></i> &nbsp;Вы отказались от компании</a></p>
							<?endif?>

							<p><a data-toggle="modal" class="btn btn-sm btn-primary <?//if ($exp['choosen'] == 0):?><?//endif?> w192 text-left" target="_blank" href="#modal-cp<?=$exp['id']?>" ><i class="fa fa-check-square-o"></i> &nbsp;просмотреть предложение</a></p>	

<?if($exp['dogovor'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$exp['dogovor'])):?>							
							<p><a data-toggle="modal" class="btn btn-sm btn-primary w192 text-left" target="_blank" href="<?='/img/oferta/'.$exp['dogovor']?>" ><i class="fa fa-check-square-o"></i> &nbsp;просмотреть договор</a></p>	
<?else:?>
						<p><a data-toggle="modal" class="btn btn-sm btn-primary w192 text-left" href="#modal-oferta<?=$exp['id']?>" target="blank" ><i class="fa fa-check-square-o"></i> &nbsp;просмотреть договор </a></p>	
<?endif?>							
							
								<p>
											<a href="#modal-dialog-files<?=$exp['id']?>" data-toggle="modal" class="btn btn-sm btn-primary w192 text-left">
											<i class="fa fa-file-archive-o"></i> &nbsp;Документы</a>
								</p>							
							
							<!-- data-toggle="modal"p><a data-toggle="modal" class="btn btn-sm btn-primary <?if ($exp['choosen'] == 0):?>disabled<?endif?> w192 text-left" href="#modal-cls<?=$exp['id']?>" ><i class="fa fa-check-square-o"></i>
 &nbsp;Выполнено</a></p-->	


						<?else:?>
							<?if ($na == 0):?>
								<p><a class="btn btn-sm btn-primary w192 text-left" href="/user/accept?id=<?=$prod->id?>&reject=0">Откликнуться на заявку</a></p>	

								<p><a class="btn btn-sm btn-primary w192 text-left" href="/user/accept?id=<?=$prod->id?>&reject=1" onclick="return confirm('Вы уверены?')">Отказаться от заявки</a></p>	

							<?else:?>
								<?if ($reject) :?>
									<p>К сожалению клиент отказался от Ваших услуг <?=date('d.m.Y H:i',$reject)?> &nbsp;</p>	
									<p><a class="btn btn-sm btn-primary text-left" href="/user/rejecte/?uid=<?=$prod->id?>&expert=<?=$user?>">Подтвердить отказ от услуги</a></p>	
								<?endif?>
								
							<?endif?>
							<?if (isset($_GET['accept'])) :?>

								<?$acc=array(1=>'Вы отказались от заявки',0=>'Вы откликнулись на заявку')?>
								<?=$acc[$_GET['accept']]?>

							<?endif?>
						<?endif?>
											
								
							</div>
						
	</div>

	</td>
											</tr>
										<?endforeach?>
									</tbody>
								</table>							
							</div>							
							</div>
							</div>
						
</div>							
						

		<div class="vertical-box-column" style="padding:0px 15px">
						<!-- begin panel -->
						<div class="panel panel-primary itempanel" data-sortable-id="table-basic-1" id="profilelist">

						</div>
						
						<!-- end panel -->
						<!-- begin panel -->

		</div>
						
<div class="vertical-box-column">

<div class="panel panel-primary itempanel" id="feedlist" style="overflow:hidden">
<?$j=0?>
						<?foreach ($experts as $k=>$exp) :?>
						
	<div id="feeds<?=$exp['id']?>" class="expfeeds panel-primary">											
		
								<div class="panel-heading">
									<h4 class="panel-title">Отправить сообщение <?=$exp['shortname']?></h4>
								</div>
		<?if (count($exp['feeds']) >0):?>																							
								<div class="panel-body bg-silver">
									<div data-scrollbar="true" data-height="350px">
										<ul class="chats" style="padding-right:0px;">
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
								<?if ($showform == 1 && ($choosen == 0  || ($choosen==1 && $exp['choosen']==1)) && $prod->stock_type != 4) :?>
									<div class="panel-footer"  style="padding-top:13px">
										<form method="POST" class="form-horizontal jq138<?=$exp['id']?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html?num=<?=$j?>" enctype="multipart/form-data">
									

                                <div class="input-group" >
																				<input type="hidden" value="<?=$exp['user_id']?>" name="preuser" >	
												<input type="hidden" name="uid" value="<?=$prod->id?>">	

                                    <input type="text" class="form-control input-sm" name="ticket" placeholder="Введите комментарий" value="<?=trim($data['ticket'])?>" />
                                    <span class="input-group-btn">
                                        <input type="submit" value="Отправить" class="btn btn-primary btn-sm" />
                                    </span>
                                </div>
							
								<!--div class="input-group" style="margin-top:-20px;">
									<table><tr><td>
										<span class="btn btn-primary fileinput-button btn-sm blau">                                    
											<span>Отправить файл</span>
											<input type="file" id="file" class="btn btn-success input-sm"  onchange="outphoto('file','out');" name="filename"  />
										</span>
									</td><td id="out" style="padding-left:10px"></td></tr></table>										
								</div-->

									</form>
                                </div>

								<?endif?>
													
	</div>								<?$j++?>
	<?endforeach?>					

						</div>
</div>
			<?endif?>		
	
		
	</div>					

<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/assets/js/form-wysiwyg.demo.min.js"></script>
	
	
	<script>
		function switchtr(elem) {
			id = elem.attr('rel');
			//alert(id);
			$('.expfeeds').hide();
			$('#ulist tr:not(.rej)').css('background','white');
			elem.css('background','#e5e5e5');
			$('#feeds' + id).show();
			//alert('#feeds' + id);
			$('#profilelist').html($('#profile' + id).html());
		}	
	
	
		$(document).ready(function() {
			//alert(<?=intval($num)?>);
			//$('.expfeeds').hide();$('.expfeeds:eq(<?=intval($num)?>)').show();			
			//$('#profilelist').html($('.profiles:eq(<?=intval($num)?>)').html());			
			//$('.acc:eq(<?=intval($num)?>)').css('background','#e5e5e5');
			switchtr($('.acc:eq(0)'));

			FormWysihtml5.init();
		});
	</script>