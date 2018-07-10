					<h1 class="page-header">						
										 <?if ($nochat == 1) :?>Мои вопросы экспертам<?else:?>Вопросы от пользователей<?endif?>				 
					</h1>


		<div style="padding:0px 20px">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-11">
					<div class="col-md-12 text-left" style="padding-right:0px;padding-left:0px">
						<?$ff = array('1'=>'openq','0'=>'providerq')?>
						<form action="/user/<?=$ff[$nochat]?>/" method="get" id="sform">
			            <div class="input-group" style="width:300px;float:left">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input type="text" class="form-control input-sm input-white" name="search" value="<?=$_GET['search']?>" placeholder="Поиск вопроса" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-inverse" style="margin-right:10px" type="button" onclick="$('#sform').submit()"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
			        </form>
					
					
					
						<div class="email-btn-row hidden-xs" >							
							<?if ($nochat==1) :?>
								<div class="btn-group" style="padding-right:5px;margin-right:5px">
									<a href="#" class="btn btn-inverse btn-sm " data-toggle="dropdown">Фильтр <i class="fa fa-angle-down m-l-5"></i></a>
									<ul class="dropdown-menu">
									<li <?if(intval($_GET['gr'])==0):?>class="active"<?endif?>><a href="/user/openq?gr=0">Все</a></li>
									<?foreach ($groups as $i=>$group) :?>						                        					
										<li <?if($i==$_GET['gr']):?>class="active"<?endif?>><a href="/user/openq?gr=<?=$i?>"><?=$group?></a></li>
										<?$j++?>
									<?endforeach?>
									</ul>
								</div>
								<?if(intval($_GET['gr'])>0 || strlen($_GET['search'])>0):?>
									<a href="/user/openq/" class="btn btn-sm btn-inverse">Все</a>
								<?endif?>

							<?else:?>	
								<div class="btn-group">
									<a href="#" class="btn btn-inverse btn-sm " data-toggle="dropdown">Фильтр<i class="fa fa-angle-down m-l-5"></i></a>
									<ul class="dropdown-menu">
									<li <?if(intval($_GET['gr'])==0):?>class="active"<?endif?>><a href="/user/providerq?gr=0">Все</a></li>
									<?foreach ($groups as $i=>$group) :?>						                        					
										<li <?if($i==$_GET['gr']):?>class="active"<?endif?>><a href="/user/providerq?gr=<?=$i?>"><?=$group?></a></li>
										<?$j++?>
									<?endforeach?>
									</ul>
								</div>
								<?if(intval($_GET['gr'])>0 || strlen($_GET['search'])>0):?>
									<a href="/user/providerq/" class="btn btn-sm btn-inverse">Все</a>
								<?endif?>								
							<?endif?>
							<?if ($nochat==1) :?>
								<a href="/user/addlot?sale_type=1" class="btn btn-sm btn-inverse m-r-5">Добавить вопрос</a>
								<a href="#" onclick="$('#delp').submit()" class="btn btn-sm btn-inverse  m-r-5">Удалить</a>
							<?endif?>				
						</div>
					</div>

					
					<div class="clearfix"></div>
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
					<form method="POST" action="/user/delpaket" id="delp">
  					<?foreach ($data as $i=>$st) :?>
						
						<?if (count($data[$i]['prods']) > 0) :?>
							<div class="email-content"  id="st<?=$i?>">
							
									<table class="table table-email" id="tb<?=$i?>">
									
									<thead>
																<tr >
									<?if ($nochat==1) :?>												
									<th style="width:40px"><input type="checkbox" onclick="javascript:checkAll(<?=$i?>)" id="check<?=$i?>" /></th>
									<?endif?>

									<th  style="text-align:left;">
											Тема						
									</th>
									<th style="width:200px">Сфера деятельности
									
									</th>
									<th class="dttd" >Дата&nbsp;создания</th>
									<th class="dttd" ><?if ($nochat==1) :?>	Ответов<?endif?>	</th>
								
									

									
									</tr>
									</thead>
									
									<tbody>
									
										<?foreach ($st['prods'] as $prod):?>
									<tr >
									<?if ($nochat==1) :?>
									<td class="email-select dttd">									
										<input type="checkbox" name="del[]" class="zay" onclick="" value="<?=$prod['id']?>" id="del<?=$prod['id']?>" /><label for="del<?=$prod['id']?>"></label>
									</td>
									<?endif?>
									
									<td  style="text-align:left" class="email-title">
										
											<a  style="color: #242A30;font-size:110%;<?if ($prod['feeds']->count() == 0):?>font-weight:bold<?endif?>" href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?></a>

									</td>
									<td><?=$prod['cat']->name?></td>
									<td style="text-align:center"><?=date('d.m.Y',$prod['cts'])?></td>
									<td style="text-align:center">
									<?if ($nochat==1) :?>									
									<?=$prod['feeds']->count()?>
									<?else:?>
									<a class="btn btn-xs btn-primary" href="/user/accept?id=<?=$prod['id']?>&reject=1" onclick="return confirm('Вы уверены?')">Удалить</a>									
									<?endif?>
									</td>
									
									
									
									</tr>
								<?endforeach?>
									
									</tbody>
								</table>
									
									<div class="email-footer clearfix">
										Вопросов: <?=count($st['prods'])?>
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
							<div class="email-content"  id="st<?=$i?>"> Данные не найдены
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
	

