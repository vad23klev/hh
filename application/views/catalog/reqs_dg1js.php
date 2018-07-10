<div class="invoice-header" style="margin:0">
                    <div>
                        
                        <address class="m-b-5">
							<h4 class="nopt">Реквизиты сторон:</h4>
							<table class="vtop w100p">
							
							<tr><td   colspan="2">
								<small>От исполнителя</small>
							</td>
							<td   colspan="2">
								<small>От заказчика </small>
							</td>
							
							</tr>
							<tr>
							<td   colspan="2">
							<?if ($udata->jur > 0) :?>						
								<strong><?=$udata->fullname?></strong><br />
							<?else:?>	
								<strong><?=$udata->fio?> <?=$udata->lastname?> <?=$udata->surname?></strong><br />
							<?endif?>
							</td>
							<td  colspan="2">
							<?if ($exp['jur'] > 0) :?>						
								<strong><?=$exp['fullname']?></strong><br />
							<?else:?>	
								<strong><?=$exp['fio']?> <?=$exp['lastname']?> <?=$exp['surname']?></strong><br />
							<?endif?>
							</td>
							</tr>							
							</table>
							<table class="vtop w100p">

							<tr>							
							<td style="width:140px;">
							Юридический адрес:</td><td  > <?=$udata->fa?></td>	
							<td style="width:140px;" >
                            Юридический адрес:</td><td  > <?=$exp['fa']?></td>							
							</tr>

							<tr>
							<td   >
                            Почтовый адрес:</td><td  > <?=$udata->city?></td>
							<td   >
                            Почтовый адрес:</td><td  > <?=$exp['city']?></td>
							</tr>							
							
							<tr>
							
							<td   >
							ИНН:</td><td  > <?=$udata->inn?></td>
							<td   >
							ИНН:</td><td  > <?=$exp['inn']?></td>
							</tr>
							<tr>
							
							<?if ($udata->kpp != "" && $udata->jur > 0) :?>
								<td   >
								КПП:</td><td  > <?=$udata->kpp?></td>
							<?else:?>	
								<td  >
								</td><td  ></td>								
							<?endif?>							
							<?if ($exp['kpp'] != "" && $exp['jur'] > 0) :?>
								<td   >
								КПП:</td><td  > <?=$exp['kpp']?></td>
							<?else:?>	
								<td  >
								</td><td  ></td>
							<?endif?>
							</tr>
							<tr>
							
							<td   >
							ОГРН:</td><td  > <?=$udata->ogrn?></td>
							<td   >
							ОГРН:</td><td  > <?=$exp['ogrn']?></td>
							</tr>
							<tr>
							<td   >
							Расчетный счет:</td><td  > <?=$udata->rsch?></td>
							<td   >
							Расчетный счет:</td><td  > <?=$exp['rsch']?></td>
							</tr>							
							<tr>
							
							<td   >
							Наименование банка:</td><td  > <?=$udata->bank?></td>
							<td   >
							Наименование банка:</td><td  > <?=$exp['bank']?></td>
							
							</tr>

							<tr>
							<td   >
							Корреспондентский счет:</td><td  > <?=$udata->ksch?></td>
							<td   >
							Корреспондентский счет:</td><td  > <?=$exp['ksch']?></td>
							</tr>
							<tr>
							<td   >
							БИК:</td><td  > <?=$udata->bik?></td>
							<td   >
							БИК:</td><td  > <?=$exp['bik']?></td>
							</tr>							
						
							<tr>
							<td   >
							Должность:</td><td  > <?=$udata->dolz_dg?></td>
							<td   >
							Должность:</td><td  > 
							<?if ($exp['dolz_dg'] != '') :?>
								<?=$exp['dolz_dg']?>
							<?else:?>
								<?=$exp['dolz']?>
							<?endif?>
							</td>
							</tr>

							<tr>
							<td   >
							ФИО авторизованного пользователя :</td><td  ><?=$udata->fio?> <?=$udata->lastname?> <?=$udata->surname?></td>
							<td   >
							ФИО авторизованного пользователя :</td><td  >
							<?if ($exp['fio1'] != '') :?>
								<?=$exp['fio1']?>
							<?else:?>							
								<?=$exp['fio']?> <?=$exp['lastname']?> <?=$exp['surname']?>
							<?endif?>
							
							</td>
							</tr>
							
							</table>
                        </address>
                    </div>
                    
                </div>			