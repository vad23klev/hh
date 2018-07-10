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
                    <?=$expert->oferta?>
                </div>
				
<div class="invoice-header">
                    <div class="invoice-from">
                        <small>От</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=$author->shortname?></strong><br />
							<table class="vtop">
							<tr><td>
							ИНН:</td><td> <?=$author->inn?></td></tr>
							<?if ($author->kpp != "" && $author->jur > 0) :?>
								<tr><td>
								КПП:</td><td> <?=$author->kpp?></td></tr>
							<?endif?>
							<tr><td>
							ОГРН:</td><td> <?=$author->ogrn?></td></tr>
							<tr><td>
							Банк:</td><td> <?=$author->bank?></td></tr>
							<tr><td>
							Р/С:</td><td> <?=$author->rsch?></td></tr>
							<tr><td>
							К/С:</td><td> <?=$author->ksch?></td></tr>
							<tr><td>
							БИК:</td><td> <?=$author->bik?></td></tr>
							<tr><td>
                            Адрес:</td><td> <?=$author->city?></td></tr>
                            <tr><td>
							Телефон:</td><td> <?=$author->phone?></td></tr>
							</table>
                        </address>
                    </div>
                    <div class="invoice-to" style="padding-left:20px;">
                        <small>Кому</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=$owner->shortname?></strong><br />
							<table class="vtop">
							<tr><td>
							ИНН:</td><td> <?=$owner->inn?></td></tr>
							<?if ($owner->kpp != "" && $owner->jur > 0) :?>
								<tr><td>
								КПП:</td><td> <?=$owner->kpp?></td></tr>
							<?endif?>
							<tr><td>
							ОГРН:</td><td> <?=$owner->ogrn?></td></tr>
							<tr><td>
							Банк:</td><td> <?=$owner->bank?></td></tr>
							<tr><td>
							Р/С:</td><td> <?=$owner->rsch?></td></tr>
							<tr><td>
							К/С:</td><td> <?=$owner->ksch?></td></tr>
							<tr><td>
							БИК:</td><td> <?=$owner->bik?></td></tr>
							<tr><td>
                            Адрес:</td><td> <?=$owner->city?></td></tr>
                            <tr><td>
							Телефон:</td><td> <?=$owner->phone?></td></tr>
							</table>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Договор оферты</small>
                        <div class="date m-t-5"><?=date('d.m.Y',$expert->uts)?></div>
                        <div class="invoice-detail">
                            #<?=$expert->id?>-<?=$prod->id?><br />
                            
                        </div>
                    </div>
                </div>				
				
				
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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
