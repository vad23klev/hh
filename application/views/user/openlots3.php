
		
		<h2>Мои заявки</h2>
		
		
		
<div class="p-20">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <div class="col-md-2">
			        <form>
			            <div class="input-group m-b-15">
                            <input type="text" class="form-control input-sm input-white" placeholder="Поиск" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-inverse" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
			        </form>
			        <div class="hidden-sm hidden-xs">
                        <ul class="nav nav-pills nav-stacked nav-inbox">
								<?foreach ($stocktype as $i=>$st):?>
									<?if (count($data[$i]['prods']) > 0) :?>
										<li><a href="javascript:void(0)" onclick="javascript:switchPanels('#st<?=$i?>',$(this).parent())"><i class="fa fa-inbox fa-fw m-r-5"></i> <?=$st?></a></li>
									<?endif?>	
								<?endforeach?>
                        </ul>
                    </div>
                </div>
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-10">
                    <div class="email-btn-row hidden-xs">
                        <a href="#" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> Создать</a>
                        <a href="#" class="btn btn-sm btn-inverse">Удалить отмеченные</a>
                    </div>
					
					<?foreach ($data as $i=>$st) :?>
					<?if (count($data[$i]['prods']) > 0) :?>
			        <div class="email-content" id="st<?=$i?>">
                        				<form method="POST" action="/user/delete">
					<div class="padded w100">
						<a href="javascript:void(0)" style="margin-left:5px">Выбрать все </a>
							<button class="mright" onclick="return confirm('Вы уверены?')">Удалить</button>							
					</div>
					<div class="table-responsive">
						<table class="table lotlist table-email">
						
						                            <thead>
                                <tr>
                                    <th class="email-select"><a href="#" data-click="email-select-all"><i class="fa fa-square-o fa-fw"></i></a></th>
                                    <th colspan="3">
                                        <div class="dropdown">
                                            <a href="#" class="email-header-link" data-toggle="dropdown">View All <i class="fa fa-angle-down m-l-5"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="active"><a href="#">All</a></li>
                                                <li><a href="#">Unread</a></li>
                                                <li><a href="#">Contacts</a></li>
                                                <li><a href="#">Groups</a></li>
                                                <li><a href="#">Newsletters</a></li>
                                                <li><a href="#">Social updates</a></li>
                                                <li><a href="#">Everything else</a></li>
                                            </ul>
                                        </div>
                                    </th>
                                    <th colspan="3">
                                        <div class="dropdown">
                                            <a href="#" class="email-header-link" data-toggle="dropdown">Arrange by <i class="fa fa-angle-down m-l-5"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="active"><a href="#">Date</a></li>
                                                <li><a href="#">From</a></li>
                                                <li><a href="#">Subject</a></li>
                                                <li><a href="#">Size</a></li>
                                                <li><a href="#">Conversation</a></li>
                                            </ul>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
						
						<tbody>
						<?foreach ($st['prods'] as $prod):?>
							<tr class="theader">
							<td  class="dttd" style="text-align:center;font-size:90%;"><input type="checkbox" name="del[]" value="<?=$prod['id']?>" id="del<?=$prod['id']?>" /><label for="del<?=$prod['id']?>"></label></td>
							<td  style="text-align:left">
									<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?></a>
							
							</td>
							<td  style="text-align:left">
							
									<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?><?endif?>"><?=$prod['cat']->name?></a>
							
							</td>
							<td style="text-align:center;font-size:90%;">
									<?$stocktype = array('0' =>'На модерации', '2' => 'Ожидает ответа', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');?>
									<?=$stocktype[$prod['stock_type']]?>
							</td>
							<td class="dttd" style="text-align:center;font-size:90%;"><?=date('d.m.Y',$prod['cts'])?></td>
							<td  class="dttd" style="text-align:center;font-size:90%;"><?=date('d.m.Y',$prod['exp'])?></td>
							
							</tr>
						<?endforeach?>
						</tbody>
						</table>

					</div>

				</form>
				</div>
						<?endif?>
			        
					<?endforeach?>
			    </div>
			    <!-- end col-10 -->
			</div>
			<!-- end row -->
			</div>		
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/inbox.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			Inbox.init();
		});
	</script>	
			

	<script>
	
	
	
		function switchPanels(id,elem) {
			$('.nav-inbox li').removeClass('active');
			$('.email-content').hide();
			$(id).show();
			$(elem).addClass('active');
		}
		
		$(document).ready(function() {
			$('.email-content').hide();
			$('.email-content:eq(0)').show();
			$('.nav-inbox li:eq(0)').addClass('active');
		});
	</script>			
	
	