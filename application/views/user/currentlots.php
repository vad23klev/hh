<h1 class="page-header">Мои заявки</h1>
		<div  style="padding:0px 20px">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <div class="col-md-2">
			        <form action="/user/providerlots/" method="get" id="sform">
			            <div class="input-group m-b-15">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input type="text" class="form-control input-sm input-white" name="search" value="<?=$_GET['search']?>" placeholder="Искать заявку" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-inverse" type="button" onclick="$('#sform').submit()"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
			        </form>
			        <div class="hidden-sm hidden-xs">
                        
                        <ul class="nav nav-pills nav-stacked nav-inbox">
							<!--li><a href="javascript:void(0)" onclick="javascript:switchPanels('#st0',$(this).parent())"><table><tr><td>
										<i class="fa fa-fw m-r-5 fa-circle "></i></td><td> Все заявки</td></tr></table></a></li-->
								
								<?foreach ($stocktype as $i=>$st):?>
									<?//if (count($data[$i]['prods']) > 0) :?>
										<li><a href="javascript:void(0)" onclick="javascript:switchPanels('#st<?=$i?>',$(this).parent())"><table><tr><td>
										<?=$rounds[$i]?></td><td> <?=$st?>&nbsp;<span class="color:red">(<?=count($data[$i]['prods'])?>)</span></td></tr></table></a></li>
									<?//endif?>	
								<?endforeach?>
                        </ul>

						
						
						
                    </div>
                </div>
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-10">
                    <div class="email-btn-row hidden-xs">
						<a href="#" onclick="$('#delp').submit()" class="btn btn-sm btn-inverse">Удалить выбранное из списка</a>
								<div class="btn-group">
									<a href="#" class="btn btn-inverse btn-sm " data-toggle="dropdown">Фильтр <i class="fa fa-angle-down m-l-5"></i></a>
									<ul class="dropdown-menu">
									<li <?if(intval($_GET['gr'])==0):?>class="active"<?endif?>><a href="/user/providerlots?gr=0">Все</a></li>
									<?foreach ($groups as $i=>$group) :?>						                        					
										<li <?if($i==$_GET['gr']):?>class="active"<?endif?>><a href="/user/providerlots?gr=<?=$i?>"><?=$group?></a></li>
										<?$j++?>
									<?endforeach?>
									</ul>
								</div>
						
						
						<?if(intval($_GET['gr'])>0 || strlen($_GET['search'])>0):?>
						<a href="/user/providerlots/" class="btn btn-sm btn-inverse">Все</a>
						<?endif?>
						
                    </div>

					<script>
						function checkAll(id) {
							if($('#check' + id).prop('checked') == true) {
								$('.zay').prop('checked','');
								$('#tb'+id+' .zay').attr('checked','checked');
							} else {
								$('#tb'+id+' .zay').prop('checked','');
							}
							
						}
												
					</script>					
					<form method="POST" action="/user/delpaket1" id="delp">					
  					<?foreach ($stocktype as $i=>$st) :?>
						
						<?if (count($data[$i]['prods']) > 0) :?>
							<div class="email-content"  id="st<?=$i?>">
							
									<table class="table table-email" id="tb<?=$i?>">
									
									<thead>
									<tr >
									<th style="width:40px">
										<?if ($i==1) :?>
											<input type="checkbox" onclick="javascript:checkAll(<?=$i?>)" id="check<?=$i?>" />
										<?endif?>	
									</th>
											
									<th  style="text-align:left;">
											Тема 
									</th>
									<th style="width:200px">
									
												  Сфера деятельности

									</th>									
									
									<th class="status">
										<?=$rounds[$i]?> 
									</th>
									<th class="dttd" >Дата&nbsp;создания</th>
									<th class="dttd" >Дата&nbsp;окончания</th>
									
									</tr>
									</thead>
									
									<tbody>

										<?foreach ($data[$i]['prods'] as $prod):?>
									<tr >
									
									<td class="email-select dttd">
										<?if ($i==1) :?>
										<input type="checkbox" name="del[]" class="zay" onclick="" value="<?=$prod['id']?>" id="del<?=$prod['id']?>" /><label for="del<?=$prod['id']?>"></label>
										<?endif?>
									</td>
									
									<td  style="text-align:left" class="email-title">
											<a  style="color: #242A30;" href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?> ...</a>

									</td>
									<td  style="text-align:left">							
											<a  style="color: #242A30;" href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?><?endif?>"><?=$prod['cat']->name?></a>
									</td>

									<td >
											<?$stocktype = array('0' =>'На модерации', '2' => 'Ожидает ответа', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');?>
											<?=$rounds[$prod['stock_type']]?>
											
									</td>
									<td style="text-align:center"><?=date('d.m.Y',$prod['cts'])?></td>
									<td style="text-align:center"><?=date('d.m.Y',$prod['exp'])?></td>
									
									</tr>
								<?endforeach?>
								
									</tbody>
								</table>
									
									<div class="email-footer clearfix">
										Заявок: <?=count($st['prods'])?>
										<!--ul class="pagination pagination-sm m-t-0 m-b-0 pull-right">
											<li class="disabled"><a href="javascript:;"><i class="fa fa-angle-double-left"></i></a></li>
											<li class="disabled"><a href="javascript:;"><i class="fa fa-angle-left"></i></a></li>
											<li><a href="javascript:;"><i class="fa fa-angle-right"></i></a></li>
											<li><a href="javascript:;"><i class="fa fa-angle-double-right"></i></a></li>
										</ul-->
									</div>
								
									<div class="clearfix"></div>
								</div>
						<?else:?>		
							<div class="email-content"  id="st<?=$i?>">Заявки по направлению Вашей деятельности от пользователей пока еще не поступали
							</div>	
						<?endif?>
					<?endforeach?>
					</form>
					
			    </div>
			    <!-- end col-10 -->
			</div>
			<!-- end row -->
			</div>
		
		
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/inbox.demo.min.js"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<!--script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="/assets/plugins/DataTables/js/dataTables.colVis.js"></script>
	<script src="/assets/js/table-manage-default.demo.js"></script-->
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		/*$(document).ready(function() {
			TableManageDefault.init();
		});*/
	</script>
			

	<script>
	
	
	
		function switchPanels(id,elem) {
			//$('.nav-inbox li').removeClass('active');
			$('.nav-inbox li').css('background-color','rgba(0,0,0,0)');
			$('.email-content').hide();
			$(id).show();
			$(elem).css('background-color','white');
		}
		
		$(document).ready(function() {
			$('.email-content').hide();
			$('.email-content:eq(0)').show();
			$('.nav-inbox li:eq(0)').css('background-color','white');
		});
	</script>			
		<script>
		$(document).ready(function() {			
			Inbox.init();
		});
	</script>
	