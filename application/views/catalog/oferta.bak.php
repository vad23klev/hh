<div style="display:none">
	<div class="input-group file m-b-10 col-md-12 oferta-file-group" id="outt0">
<!--		<label class="text-left nopl">Введите описание файла</label>-->

<!--		<div class="form-group col-md-12">-->
<!--			<textarea style="resize:none" name="fdsc[]" class="form-control req2" placeholder="Введит-описание файл<!--а"><?//=$job->name?></textarea>-->
<!--		</div>-->

		<table>
			<tr>
				<td class="hidden file-icon_container">
					<i class="fa fa-file-text-o fa-2x"></i>
				</td>
				<td>
					<span class="btn btn-primary fileinput-button btn-sm blau">
						<i class="fa fa-upload"></i> <span>Загрузить файл</span>
						<input type="file" id="file10" class="btn btn-success input-sm"  onchange="addAttacment.call(this, 'file10','outfile0', 'delb0')" name="file[]"  />
					</span>
				</td>
				<td id="outfile0" class="attachment_editable_name" style="width: 200px;"></td>
				<td class="editable_name_container">
					<input type="text" name="fdsc[]" style="width: 200px;" class="hidden editable_name_value form-control input-sm" value="">
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
						<a href="javascript:;;" style="display:none" id="delb0" onclick='javascript:removeFile1($(this))' class="btn-remove_attachment btn btn-danger btn-sm">
							<i class="glyphicon glyphicon-trash"></i> Удалить
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="input-group" id="out0" style="margin-top:-20px;">
		<table>
			<tr>
				<td>
					<span class="btn btn-primary fileinput-button btn-sm blau">
						<span>Отправить файл</span>
						<input type="file" id="file" class="btn btn-success input-sm"  onchange="outphoto('file','out0');" name="filename"  />
					</span>
				</td>
				<td id="out" style="padding-left:10px"></td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="col-md-12 col-sm-12 text-left nopl" style="margin-left:0px">
						<a href="javascript:;;" onclick='javascript:removeFile($(this))' class="m-b-5 btn btn-danger btn-xs">Удалить</a>
					</div>
				</td>
			</tr>
		</table>
	</div>


				
<div class="costs" id="trd0">
														
														<div class="col-md-6 col-sm-6 form-group control">	
														
														
														
															<input type="hidden" name="prod[]" value="<?=$prod->id?>"/>
															<textarea style="height:100px;resize:none" name="name[]"  data-parsley-group="wizard-step-1" required class="form-control req2" placeholder="Введите наименование услуги"></textarea>
															
														</div>

														
														<div class="col-md-6 col-sm-6">
														<div class="col-md-5 col-sm-5 form-group">	
<div class="col-md-12 text-left nopl m-b-5">Укажите&nbsp;срок: 
																</div>														
															<input type="text"  data-parsley-group="wizard-step-1" required onkeyup="return proverka(this);" onchange="return proverka(this);"  name="date[]" value="" class="form-control req1" placeholder="Укажите срок (количество дней) исполнения">
														</div>	
														
														<div class="col-md-5 col-sm-5 form-group" style="margin-left:15px;">	
														<div class="col-md-12 text-left nopl m-b-5">Укажите&nbsp;стоимость: 
																</div>														
															<input type="text"  data-parsley-group="wizard-step-1" required onkeyup="return proverka(this);" onchange="return proverka(this);"  name="cost[]" value="" class="form-control req" placeholder="Укажите стоимость">
														</div>	
														
														<div class="col-md-2 col-sm-2 form-group" style="margin-left:15px;">	
															<div class="form-group">
																<div class="col-md-12 m-b-5" style="padding-left:0px">Укажите&nbsp;валюту: 
																</div>
																<div class="col-md-12 text-left">
																	<select name="valuta[]">
																		<option value="RUR" >RUR</option>
																		<option value="USD" >USD</option>
																		<option value="EUR" >EUR</option>
																	</select>
																</div>
															</div>
														</div>
														
														
														<div class="clearfix"></div>

																<div class="col-md-12 col-sm-12 text-left nopl" style="margin-left:0px">
																
																
																<!--style="display:none"-->
																<a  href="javascript:;;" style="display:none" onclick='javascript:removeDoc($(this))' class="m-b-5 btn btn-danger btn-xs">Удалить</a>
																
																</div>														
														
															</div>
															
															
															<div class="clearfix"></div>
															
<div style="border-top:1px solid #CCD0D4;margin:10px auto"/></div>												
												
												
														
													</div>


</div>


<div class="modal-body text-center">												
				<form action="/user/accept?id=<?=$prod->id?>&reject=0" name="form-wizard" data-parsley-validate="true" id="accform" method="post" class="form-horizontal" enctype="multipart/form-data">
							<div id="wizard">
									<ol>
										<li>
										    Введите этапы работ 										    
										</li>
										<li>
											Введите текст оферты
										</li>
										<li>
											Отправить предложение
										</li>

									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
														<fieldset>
														<div class="alert alert-danger m-b-10 m-t-10 text-left">
												<h4><i class="icon-bulb"></i>  Указывайте максимально точные данные</h4>
												<p>Данная форма предназначена для создания Вашего коммерческого предложения (оферты) и отправки его Заказчику. Формулируйте наименования услуг/работ также, как Вы их обычно формулируете в разделе «предмет договора». Максимально точно указывайте стоимость и сроки выполнения работ. В случае акцепта Вашей оферты Заказчиком и безосновательного отказа с Вашей стороны от сделанного предложения, Заказчик имеет право написать на Вас негативный отзыв и дать соответствующую оценку, что скажется на Вашем рейтинге надежности Провайдера.</p>
											</div>
											<div >
											<div id="counter"></div>
											<?//print_r($exp['jobs'])?>
											<?foreach ($exp['jobs'] as $i=>$job) :?>
														<?if ($job->name != '') :?>
														<div class="costs1" id="job<?=$job->id?>">
														
														<label class="col-md-12 text-left nopl"><?=$i+1?>. <?=$job->name?></label>
														<div class="col-md-6 col-sm-6 form-group">	
														
														
														
															<input type="hidden" name="prod[]" value="<?=$prod->id?>"/>
															<textarea style="height:100px;resize:none" name="name[]"  data-parsley-group="wizard-step-1" required class="form-control req2" placeholder="Введите наименование услуги"><?=$job->name?></textarea>
															
														</div>

														
														<div class="col-md-6 col-sm-6">
														<div class="col-md-5 col-sm-5 form-group">	
<div class="col-md-12 text-left nopl m-b-5">Укажите&nbsp;срок: 
																</div>														
															<input type="text"  data-parsley-group="wizard-step-1" required onkeyup="return proverka(this);" onchange="return proverka(this);"  name="date[]" value="<?=$job->date?>" class="form-control req1" placeholder="Укажите срок (количество дней) исполнения">
														</div>	
														
														<div class="col-md-5 col-sm-5 form-group" style="margin-left:15px;">	
														<div class="col-md-12 text-left nopl m-b-5">Укажите&nbsp;стоимость: 
																</div>														
															<input type="text"  data-parsley-group="wizard-step-1" required onkeyup="return proverka(this);" onchange="return proverka(this);"  name="cost[]" value="<?=$job->cost?>" class="form-control req" placeholder="Укажите стоимость">
														</div>	
														
														<div class="col-md-2 col-sm-2 form-group" style="margin-left:15px;">	
															<div class="form-group">
																<div class="col-md-12 m-b-5" style="padding-left:0px">Укажите&nbsp;валюту: 
																</div>
																<div class="col-md-12 text-left">
																	<select name="valuta[]">
																		<option value="RUR" <?if ($job->valuta == 'RUR'):?>selected<?endif?>>RUR</option>
																		<option value="USD" <?if ($job->valuta == 'USD'):?>selected<?endif?>>USD</option>
																		<option value="EUR" <?if ($job->valuta == 'EUR'):?>selected<?endif?>>EUR</option>
																	</select>
																</div>
															</div>
														</div>
														
														
														<div class="clearfix"></div>

																<div class="col-md-12 col-sm-12 text-left nopl" >
																
																<a href="javascript:;;" onclick="$('#job<?=$job->id?>').empty()" class="btn btn-danger btn-xs">Удалить</a>
																
																</div>															
														
															</div>
															
															
															<div class="clearfix"></div>
															
<div style="border-top:1px solid #CCD0D4;margin:10px auto"/></div>



														</div>
														<?endif?>
														
														<?endforeach?>

												<div id="costs">
												
	<?if (count($exp['jobs']) == 0):?>
	
	<script>
		$(document).ready(function() {
			addDoc();
		});
	</script>
<?endif?>								
</div>
													</fieldset>
													
													<a href="javascript:;;" onclick='javascript:addDoc();' class="m-t-5 btn btn-primary btn-xs">Добавить этап работ</a>
</div>
													<div class="wizard-step-2">
											<div class="alert alert-danger m-b-10 m-t-10 text-left">
												<p><i class="icon-bulb"></i> Вы можете воспользоваться редактором, который сформирует договор со всеми реквизитами или прикрепить готовый файл с договором</p>
											</div>
<div class="clearfix"></div>

<div class="m-t-10 text-left">	
	
			<div class="form-group">
			                                    <div class="col-md-1">
									<input type="radio" 
									<?if($expert->dogovor != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$expert->dogovor)):?>checked<?endif?> value="0" name="oferta_type" onclick="switchDogovor(0)" />
                                    </div>

                                    <label class="col-md-4">Загрузить файл договора оферты</label>
                                </div>	

			<div class="form-group">
                                   <div class="col-md-1">
									<input type="radio"  name="oferta_type" value="1" onclick="switchDogovor(1)" onclick="" <?if($expert->dogovor == '' || 
									!file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$expert->dogovor)):?>checked<?endif?> />
                                    </div>

                                    <label class="col-md-4">Ввести текст договора оферты</label>
                                </div>	
								
	
</div>
<!--Загрузить договор 18.05.2015-->
<div id="dogovor_file" class="m-t-10 text-left" style="display:none">	
	<?if($expert->dogovor != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/oferta/'.$expert->dogovor)):?>
		<h4 style="margin-top:0px">Договор:</h4>
		<table>
			<tr><td style="padding-right:15px;padding-bottom:10px">
			<a class="m-b-10" target="_blank" href="/img/oferta/<?=$expert->dogovor?>">Просмотр договора</a>
			</td><td style="padding-right:15px;padding-bottom:10px">
			<!--a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a-->
			</td></tr>
		</table>
	<?endif?>	
<!---->
						
<!--Загрузить договор 18.05.2015-->						
<div class="input-group file m-b-10 col-md-12" id="outt477">								
	<table>
		<tr>
			<td id="agreement-file-icon_container" class="hidden file-icon_container">
				<i class="fa fa-file-text-o fa-2x"></i>
			</td>

			<td id="dogo1">
				<span class="btn btn-primary fileinput-button btn-sm blau" id="add_agreement_button">
					<i class="fa fa-upload"></i> <span>Загрузить файл договора</span>
					<input type="file" id="file477" class="btn btn-success input-sm"  onchange="upload_agreement('477')" name="dogovor[]"  />
				</span>
			</td>
			<td id="outfile477" style="padding-left:10px"></td>

			<td style="padding-left:15px">
				<a href="javascript:void(0)" style="display:none" onclick="remove_agreement()" id="remove_agreement_button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
			</td>
		</tr>
	</table>
</div>
<!---->
</div>
<!----  /ЗАГРУЗКА ДОГОВОРА  !-->
<!--Ввести текст договора 18.05.2015-->	
<div id="dogovor_text" style="display:none">
											<p>&nbsp;</p>
																<div class="col-md-12 m-b-5 text-left" style="padding-left:0px">Укажите&nbsp;текст оферты: 
																</div>	
														<div class="col-md-12 col-sm-12 form-group">	
															<fieldset>
														
															<textarea name="oferta" data-parsley-group="wizard-step-2" required  class="form-control req3 ckeditor" id="oferta_text" placeholder="Введите текст договора оферты"><?=$expert->oferta?></textarea>
																														
															<script type="text/javascript"></script>
															
															<div class="clearfix"></div>
						
															
															<?//print_r($exp)?>
															</fieldset>
														</div>
														<div class="clearfix"></div>
</div>
<!----  ЗАГРУЗКА ФАЙЛОВ  !-->

<div id="files1" class="m-t-10 text-left">	
								<?if($exp['files']->count() > 0):?>
									<h4 style="margin-top:0px">Файлы:</h4>
									<table>
									<?foreach($exp['files'] as $i=>$file) :?>							
										<tr><td style="padding-right:15px;padding-bottom:10px">
										<a class="m-b-10" target="_blank" href="/img/files/<?=$file->name?>"><?=$i+1?>. <?=$file->description?></a>
										</td><td style="padding-right:15px;padding-bottom:10px">
										<?if ($file->owner_id == 0) :?>
										<a href="/user/delfile?del=<?=$file->id?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Удалить</a><?endif?>
										</td></tr>
									<?endforeach?>
									</table>
								<?endif?>	
							</div>




<div class="text-left">
	<div id="files" class="m-t-10">
	<!--a href="#modal-file" data-toggle="modal" class="btn btn-sm btn-primary w192 text-left"><i class="fa fa-user"></i> &nbsp;&nbsp;Файлы</a-->
	</div>

	<a href="javascript:;;" onclick="javascript:addFile1();" style="display:none" id="add1" class="m-t-5 btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Добавить файл
	</a>
</div>

<!----  /ЗАГРУЗКА ФАЙЛОВ  !-->
														
</div>

<div class="wizard-step-3"><fieldset>

											<div class="alert alert-danger m-b-10 m-t-10 text-left">
												<p><i class="icon-bulb"></i> Напоминаем, что по условиям пользовательского соглашения направляемое Вами коммерческое предложение является офертой. Если получатель (адресат) принимает Вашу оферту (выражает согласие и акцептует её), это означает дальнейшее заключение между сторонами договора на оговоренных в оферте условиях	</p>
											</div>



<input class="btn btn-primary" type="submit" value="Отправить" /></fieldset>
</div>
</div>
													</form>
												</div>


												
												
