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
                    <span class="pull-right hidden-print">
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>				
                    <?=$prod->name?>
                </div>	
                				
                <div class="invoice-content">
                    <?=$expert->oferta?>
                </div>
                <?$docname = "Договор оферты"?>
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