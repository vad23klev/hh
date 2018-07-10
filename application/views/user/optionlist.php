			<div id="so<?=$scc->id?>" style="display:none" class="subopt1">
							<?$options = ORM::factory('option')->where('category_id','=',$scc->id)->find_all();?>
							<?if ($options->count() > 0) :?>		

							
                                <div class="form-group">
									<div class="col-md-12">&nbsp;</div>
									<label class="col-md-4">&nbsp;</label>
                                    <label class="col-md-5"><strong>Заполните дополнительные поля.</strong><br/>Для получения более точной оценки стоимости запрашиваемой услуги рекомендуем заполнять все поля.</label>
									
                                    <div class="col-md-12" >
									<?foreach($options as $scc):?>
	
										<div class="form-group">
											<label class="col-md-4 control-label" style="padding-top:0px;"><table style="width:100%;border-collapse:collapse"><tr><td style="height:34px;text-align:right"><?=$scc->name?></td><tr></table></label>
												<div class="col-md-5" >
			
													<?if ($scc->type2 == 1):?>
										
										<?if ($scc->type == 2):?>
											
											<input class="form-control datepicker" placeholder="Введите дату" type="text" value="<?=$_POST['o'][$scc->id]?>">
											
											<!--span class="input-group-addon"><i class="fa fa-calendar"></i></span-->
											
										<?else:?>														
											<input type="text" name="o[<?=$scc->id?>]" class="form-control" value="<?=$_POST['o'][$scc->id]?>">	
										<?endif?>	
																																			
										
													<?endif?>
													
													<?if ($scc->type2 == 2):?>
														<?$val = explode(',',$scc->values)?>
														<select name="o[<?=$scc->id?>]" class="form-control">
															<option value="-">-</option>
															<?foreach ($val as $jj=>$v):?>
																<option <?if ($_POST['o'][$scc->id]==$v):?>selected<?endif?> value="<?=$v?>"><?=$v?></option>
															<?endforeach?>
														</select>
													<?endif?>

													<?if ($scc->type2 == 3):?>
														<?$val = explode(',',$scc->values)?>
														
															<?foreach ($val as $jj=>$v):?>
																<input type="radio" <?if ($_POST['o'][$scc->id] == $v):?>checked<?endif?> name="o[<?=$scc->id?>]" value="$v"> <?=$v?><br/>
															<?endforeach?>

													<?endif?>

													
													<?if ($scc->type2 == 4):?>
														<table style="width:100%;border-collapse:collapse"><tr><td style="height:34px;"><input type="hidden" name="o[<?=$scc->id?>]" value="0">
														<input type="checkbox" <?if ($_POST['o'][$scc->id]==1):?>checked<?endif?> name="o[<?=$scc->id?>]" value="1"></td><tr></table>
													<?endif?>
												</div>
											</div>		<div class="clearfix"></div>
									<?endforeach?>
                                        
                                    </div>
                                </div>							

					<?endif?>
			</div>