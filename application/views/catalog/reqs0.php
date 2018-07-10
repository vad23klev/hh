<div class="invoice-header" style="margin:0">
                    <div >
                        
                        <address class="m-b-5">
						
							<table class="vtop w100p">
							
							<tr><td   colspan="2">
								<small>От</small>
							</td>
							<td   colspan="2">
								<small>Кому </small>
							</td>
							
							</tr>
							<tr><td  colspan="2">
							<?if ($exp['jur'] > 0) :?>						
								<strong><?=$exp['fullname']?></strong><br />
							<?else:?>	
								<strong><?=$exp['fio']?> <?=$exp['lastname']?> <?=$exp['surname']?></strong><br />
							<?endif?>
							</td>
							<td   colspan="2">
							<?if ($udata->jur > 0) :?>						
								<strong><?=$udata->fullname?></strong><br />
							<?else:?>	
								<strong><?=$udata->fio?> <?=$udata->lastname?> <?=$udata->surname?></strong><br />
							<?endif?>
							</td>
							
							</tr>							
							</table>
							<table class="vtop w100p">

							<tr><td style="width:140px;" >
                            Юридический адрес:</td><td  > <?=$exp['fa']?></td>							
							<td style="width:140px;">
							Юридический адрес:</td><td  > <?=$udata->fa?></td>							
							</tr>

							<tr><td   >
                            Почтовый адрес:</td><td  > <?=$exp['city']?></td>
							<td   >
                            Почтовый адрес:</td><td  > <?=$udata->city?></td>
							</tr>							
							
							<tr><td   >
							ИНН:</td><td  > <?=$exp['inn']?></td>
							
							<td   >
							ИНН:</td><td  > <?=$udata->inn?></td>
							</tr>
							<tr>
							<?if ($exp['kpp'] != "" && $exp['jur'] > 0) :?>
								<td   >
								КПП:</td><td  > <?=$exp['kpp']?></td>
							<?else:?>	
								<td  >
								</td><td  ></td>
							<?endif?>
							<?if ($udata->kpp != "" && $udata->jur > 0) :?>
								<td   >
								КПП:</td><td  > <?=$udata->kpp?></td>
							<?else:?>	
								<td  >
								</td><td  ></td>								
							<?endif?>							
							
							</tr>
							<tr><td   >
							ОГРН:</td><td  > <?=$exp['ogrn']?></td>
							
							<td   >
							ОГРН:</td><td  > <?=$udata->ogrn?></td>
							
							</tr>
							<tr><td   >
							Расчетный счет:</td><td  > <?=$exp['rsch']?></td>
							<td   >
							Расчетный счет:</td><td  > <?=$udata->rsch?></td>
							</tr>							
							<tr><td   >
							Наименование банка:</td><td  > <?=$exp['bank']?></td>
							
							<td   >
							Наименование банка:</td><td  > <?=$udata->bank?></td>
							
							
							</tr>

							<tr><td   >
							Корреспондентский счет:</td><td  > <?=$exp['ksch']?></td>
							<td   >
							Корреспондентский счет:</td><td  > <?=$udata->ksch?></td>
							</tr>
							<tr><td   >
							БИК:</td><td  > <?=$exp['bik']?></td>
							<td   >
							БИК:</td><td  > <?=$udata->bik?></td>
							
							</tr>							
                            <tr><td   >
							Телефон:</td><td  ><?=$exp['landcode1']?> <?=$exp['citycode1']?> <?=$exp['phone1']?></td>
							<td   >
							Телефон:</td><td  ><?=$udata->landcode1?> <?=$udata->citycode1?> <?=$udata->phone1?></td>
							
							</tr>
							</table>
                        </address>
                    </div>
                    <!--div class="invoice-to">
                        <small>Кому </small>
                        <address class="m-t-5 m-b-5">

							<table class="vtop">
							<tr><td  >
							</td><td  >
							<?if ($udata->jur > 0) :?>						
								<strong><?=$udata->fullname?></strong><br />
							<?else:?>	
								<strong><?=$udata->fio?> <?=$udata->lastname?> <?=$udata->surname?></strong><br />
							<?endif?>
							</td></tr>
							</table>
							<table class="vtop">

							<tr><td  >
							Юридический адрес:</td><td  > <?=$udata->fa?></td></tr>							

							<tr><td  >
                            Почтовый адрес:</td><td  > <?=$udata->city?></td></tr>							

							<tr><td  >
							ИНН:</td><td  > <?=$udata->inn?></td></tr>
							<?if ($udata->kpp != "" && $udata->jur > 0) :?>
								<td  >
								КПП:</td><td  > <?=$udata->kpp?></td>
							<?endif?>
							<tr><td  >
							ОГРН:</td><td  > <?=$udata->ogrn?></td></tr>
							<tr><td  >
							Расчетный счет:</td><td  > <?=$udata->rsch?></td></tr>
							<tr><td  >
							Наименование банка:</td><td  > <?=$udata->bank?></td></tr>						
							<tr><td  >
							Корреспонденсткий счет:</td><td  > <?=$udata->ksch?></td></tr>
							<tr><td  >
							БИК:</td><td  > <?=$udata->bik?></td></tr>
							
                            <tr><td  >
							Телефон:</td><td  > <?=$udata->phone?></td></tr>
							</table>						
						
                        </address>
                    </div-->

                </div>			