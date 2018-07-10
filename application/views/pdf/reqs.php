<div class="invoice-header" style="margin:0">
                    <div class="invoice-from">
                        <small>От Исполнителя</small>
                        <address class="m-t-5 m-b-5">
						
							
												
								
														<table class="vtop">
							<tr><td>
							<?if ($author->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$author->logo)):?>
								<img style="max-height:80px" src="/img/logos/<?=$author->logo?>"/>
							<?endif?>
						
							</td><td>
							<?if ($author->jur > 0) :?>						
								<strong><?=$author->fullname?></strong><br />
							<?else:?>	
								<strong><?=$author->fio?> <?=$author->lastname?> <?=$author->surname?></strong><br />
							<?endif?>
							</td></tr>
							</table>
							<table class="vtop">
							<tr><td>
                            Юридический адрес:</td><td> <?=$author->fa?></td></tr>

							<tr><td>
                            Почтовый адрес:</td><td> <?=$author->city?></td></tr>							
							
							<tr><td>
							ИНН:</td><td> <?=$author->inn?></td></tr>
							<?if ($author->kpp != "" && $author->jur > 0) :?>
								<tr><td>
								КПП:</td><td> <?=$author->kpp?></td></tr>
							<?endif?>
							<tr><td>
							ОГРН:</td><td> <?=$author->ogrn?></td></tr>
							<tr><td>
							<tr><td>
							Расчетный счет:</td><td> <?=$author->rsch?></td></tr>							
							<tr><td>
							Наименование банка:</td><td> <?=$author->bank?></td></tr>

							<tr><td>
							Корреспонденсткий счет:</td><td> <?=$author->ksch?></td></tr>
							<tr><td>
							БИК:</td><td> <?=$author->bik?></td></tr>							
                            <tr><td>
							Телефон:</td><td> <?=$author->phone?></td></tr>
							</table>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>От Заказчика </small>
                        <address class="m-t-5 m-b-5">

							<table class="vtop">
							<tr><td>
							<?if ($owner->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$owner->logo)):?>
								<img style="max-height:80px" src="/img/logos/<?=$owner->logo?>"/>
							<?endif?>
						
							</td><td>
							<?if ($owner->jur > 0) :?>						
								<strong><?=$owner->fullname?></strong><br />
							<?else:?>	
								<strong><?=$owner->fio?> <?=$owner->lastname?> <?=$owner->surname?></strong><br />
							<?endif?>
							</td></tr>
							</table>
							<table class="vtop">

							<tr><td>
							Юридический адрес:</td><td> <?=$owner->fa?></td></tr>							

							<tr><td>
                            Почтовый адрес:</td><td> <?=$owner->city?></td></tr>							

							<tr><td>
							ИНН:</td><td> <?=$owner->inn?></td></tr>
							<?if ($owner->kpp != "" && $owner->jur > 0) :?>
								<tr><td>
								КПП:</td><td> <?=$owner->kpp?></td></tr>
							<?endif?>
							<tr><td>
							ОГРН:</td><td> <?=$owner->ogrn?></td></tr>
							<tr><td>
							Расчетный счет:</td><td> <?=$owner->rsch?></td></tr>
							<tr><td>
							Наименование банка:</td><td> <?=$owner->bank?></td></tr>						
							<tr><td>
							Корреспонденсткий счет:</td><td> <?=$owner->ksch?></td></tr>
							<tr><td>
							БИК:</td><td> <?=$owner->bik?></td></tr>
							
                            <tr><td>
							Телефон:</td><td> <?=$owner->phone?></td></tr>
							</table>						
						
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small><?=$docname?></small>
                        <div class="date m-t-5"><?=date('d.m.Y',$expert->uts)?></div>
                        <div class="invoice-detail">
                            #<?=$expert->id?>-<?=$prod->id?><br />
                            
                        </div>
                    </div>
                </div>			