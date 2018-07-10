<body>
<!-- begin #page-loader -->
	
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	
		
		
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content" style="margin-left:0px">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!--h1 class="page-header hidden-print"><small></small></h1-->
			<!-- end page-header -->
			
			<!-- begin invoice -->
			
<div class="invoice">  
                <div class="invoice-company">
	
                    <?=$prod->name?>
                </div>	
					
                <div class="invoice-content" style="padding-top:20px">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th style="width:40%">ПЕРЕЧЕНЬ УСЛУГ/РАБОТ </th>
                                    <th style="width:30%;text-align:center">СРОК ИСПОЛНЕНИЯ, ДНЕЙ</th>
                                    <th style="width:30%">СТОИМОСТЬ</th>
                                </tr>
                            </thead>
                            <tbody>				
							<?$total = 0?>
							<?foreach ($jobs as $job) :?>
								<?$total += $job->cost ?>
                                <tr>
                                    <td>
                                        <?=$job->name?>
                                    </td>
                                    <td align="center"><?=$job->date?></td>
                                    <td><?=number_format( $job->cost, 0, ',', ' ' ); ?> <?=$job->valuta?></td>
                                </tr>

														
							<?endforeach?>										
							</tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small><?//=$expert->oferta?></small>
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
                            <small>ИТОГО</small> <?=number_format( $total, 0, ',', ' ' ); ?>&nbsp;<?=$job->valuta?>
                        </div>
                    </div>
                </div>
				
				<?$docname = "Коммерческое предложение"?>
				<?require "reqs.php"?>
				
				                <div class="invoice-note">
								<?//=$expert->oferta?>
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
			
			<!-- end invoice -->
		</div>
		<!-- end #content -->
		
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->