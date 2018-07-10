<div class="invoice">  
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                    
					
					
					
					<a href="/pdf/oferta?id=<?=$exp['eid']?>" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> в PDF</a>
                    <a href="/invoice/oferta?id=<?=$exp['eid']?>" class="print btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Печать</a>
                    
						<!--div style="font-size:13px">
							<small>
							Договор оферты</small> <br/>							
							<?=date('d.m.Y',$exp['uts'])?> 
								#<?=$exp['id']?>-<?=$prod->id?>
						
						</div-->															
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
                				
                <div class="invoice-content" id="oferta_preview">
                    <?//=$exp['oferta']?>
                </div>
				<div class="invoice-note">
					<!--			
                    * Make all cheques payable to [Your Company Name]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]-->
                </div>
				
				<?require "reqs_dg".$dir."js.php"?>
				
				
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