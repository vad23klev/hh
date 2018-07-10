<div class="invoice">  
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
						<a href="/pdf/invoice?id=<?=$exp['eid']?>" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> в PDF</a>
						<a href="/invoice/invoice?id=<?=$exp['eid']?>" onclick="window.print()" class="print btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Печать</a>
						<div style="font-size:13px">
						<small>
						Коммерческое предложение</small> <br/>							
						<?=date('d.m.Y',$exp['uts'])?> 
							#<?=$exp['id']?>-<?=$prod->id?>
					
					</div>
                    </span>					
				
					<?$dir = intval($dir)?>
					<?if ($dir == 0) :?>
						<table><tr><td style="">
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
								<img style="max-height:80px" src="/img/logos/<?=$exp['logo']?>"/>
							<?endif?>
						</td><td style="vertical-align:top;<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>padding-left:30px<?endif?>">
						<h3 class="nopt"><?=$exp['fullname']?></h3></td></tr></table>
					<?else:?>	
						<table><tr><td style="">
							<?if ($udata->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$udata->logo)):?>
								<img style="max-height:80px" src="/img/logos/<?=$udata->logo?>"/>
							<?endif?>
						</td><td style="vertical-align:top;<?if ($udata->logo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$udata->logo)):?>padding-left:30px<?endif?>">
						<h3 class="nopt"><?=$udata->fullname?></h3></td></tr></table>
					<?endif?>

                </div>	
				<?$docname = "Коммерческое предложение"?>
				<?$dir = intval($dir)?>
				<?require "reqs".$dir.".php"?>
                
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice" id="jobs_preview">
                            <thead>
                                <tr>
                                    <th style="width:50%;text-transform:uppercase">Перечень услуг / работ </th>
                                    <th style="width:25%;text-align:center;text-transform:uppercase">Срок исполнения (дни)</th>
                                    <th style="width:25%;text-align:center">СТОИМОСТЬ</th>
                                </tr>
                            </thead>
                            <tbody>				
										
							</tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                </div>
                                <!--div class="sub-price">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="sub-price">
                                    <small>PAYPAL FEE (5.4%)</small>
                                    $108.00
                                </div-->
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>ИТОГО</small> <span id="pre_itogo"></span>
                        </div>
                    </div>
                </div>

					
				                <div class="invoice-note">
					<!--			
                    * Make all cheques payable to [Your Company Name]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]-->
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> matiasgallipoli.com</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> rtiemps@gmail.com</span>
                    </p>
                </div>
            </div>