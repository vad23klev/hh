<div class="row">
		<form action="/companies/list/<?=$role?>?step=<?=$step?>" method="get" id="sform">
			<div class="col-md-3">
                    <div class="email-btn-row hidden-xs">
						<div class="btn-group">
									<a href="#" class="btn btn-primary btn-sm " style="padding:3px 12px" data-toggle="dropdown">Область компетенций <i class="fa fa-angle-down m-l-5"></i></a>
									<ul class="dropdown-menu">
									<li <?if(intval($_GET['step'])==0):?>class="active"<?endif?>><a href="/companies/list/<?=$role?>?step=0">Все</a></li>
									<?foreach ($steps as $i=>$group) :?>						                        					
										<li <?if($group->id==$_GET['step']):?>class="active"<?endif?>><a href="/companies/list/<?=$role?>?step=<?=$group->id?>"><?=$group->name?></a></li>
									<?endforeach?>
									</ul>
								</div>
                    </div>
		</div>

			<div class="col-md-3">
				
						<select class="select2 form-control" name="country" onchange="$('#sform').submit()">
							<option value="0" >Выберите страну специализации</option>
							<?foreach ($countries as $i=>$s) :?>
								<option value="<?=$s->id?>" <?if ($s->id == $_GET['country']):?>selected<?endif?>><?=$s->name?></option>
							<?endforeach?>	
						</select>
				
			</div>
			<div class="col-md-4">
			        
			            <div class="input-group m-b-15">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input type="text" class="form-control input-sm input-white" name="search" value="<?=$_GET['search']?>" placeholder="Искать специалиста" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" style="padding:3px 12px;margin-right:10px" type="button" onclick="$('#sform').submit()"><i class="fa fa-search"></i></button>
                            </span>
                        </div>	
                </div>			
			<div class="col-md-2">	
			<?if(intval($_GET['country'])>0 || strlen($_GET['search'])>0 || intval($step)>0):?><a href="/companies/list/<?=$role?>" class="btn btn-sm btn-primary" style="padding:3px 12px">Все</a><?endif?>
			</div>
		</form>		
				
					
</div>

                            <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th ></th>
                                            <th style="vertical-align:top">Название</th>
                                            <th style="vertical-align:top" >
											<?if ($expert['role']==5):?>
		<b>Краткая справка об эксперте </b>
		<?else:?>
		<b>Описание деятельности компании </b>
		<?endif?></th>
                                            <th style="vertical-align:top"><b>Компетенция</b></th>
                                            <th><b>Страна специализации</b></th>
											<th class="sorting_disabled"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?foreach ($experts as $expert) :?>
										<?if ($expert['shortname'] != '') :?>
                                        <tr class="odd gradeX">
                                            <td><?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" />
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="margin-bottom:10px;border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;" />
			<?endif?>
	<?endif?></td>
                                            <td><a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><?=$expert['shortname']?> <?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></a></td>
											
											<td style="line-height:135%;border:none">
											<?=$expert['opisanie']?>
											</td>
											
                                            <td>
	<?$u2cs = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
	
	
		<!--table>		<tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
			<td>  </td>
			</tr><tr>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<td>Специализация:</td>
				<td><ul style="margin-left:0px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="margin-left:0px;line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>
		</table-->	
<?=$v->cat->name?>
</td>
                                            <td><?if (trim($expert['lands']) != ''):?>

<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<?foreach($landnames as $l):?>
<?=$l->name?><br/>
<?endforeach?>

<?endif?></td>
                                            <td>
											<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>?step=<?=$step?>&country=<?=$country?>&search=<?=$_GET['search']?>">Подробнее</a></td>
                                        </tr>
                                        <?endif?>
									<?endforeach?>
<?foreach ($experts as $expert) :?>
										<?if ($expert['shortname'] != '') :?>
                                        <tr class="odd gradeX">
                                            <td><?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" />
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="margin-bottom:10px;border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;" />
			<?endif?>
	<?endif?></td>
                                            <td><a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><?=$expert['shortname']?> <?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></a></td>
											
											<td>
											<?=$expert['opisanie']?>
											</td>
											
                                            <td>
	<?$u2cs = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
	
	
		<!--table>		<tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
			<td>  </td>
			</tr><tr>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<td>Специализация:</td>
				<td><ul style="margin-left:0px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="margin-left:0px;line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>
		</table-->	
<?=$v->cat->name?>
</td>
                                            <td><?if (trim($expert['lands']) != ''):?>

<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<?foreach($landnames as $l):?>
<?=$l->name?><br/>
<?endforeach?>

<?endif?></td>
                                            <td>
											<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>?step=<?=$step?>&country=<?=$country?>&search=<?=$_GET['search']?>">Подробнее</a></td>
                                        </tr>
                                        <?endif?>
									<?endforeach?>
<?foreach ($experts as $expert) :?>
										<?if ($expert['shortname'] != '') :?>
                                        <tr class="odd gradeX">
                                            <td><?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" />
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="margin-bottom:10px;border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;" />
			<?endif?>
	<?endif?></td>
                                            <td><a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><?=$expert['shortname']?> <?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></a></td>
											
											<td>
											<?=$expert['opisanie']?>
											</td>
											
                                            <td>
	<?$u2cs = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
	
	
		<!--table>		<tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
			<td>  </td>
			</tr><tr>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<td>Специализация:</td>
				<td><ul style="margin-left:0px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="margin-left:0px;line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>
		</table-->	
<?=$v->cat->name?>
</td>
                                            <td><?if (trim($expert['lands']) != ''):?>

<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<?foreach($landnames as $l):?>
<?=$l->name?><br/>
<?endforeach?>

<?endif?></td>
                                            <td>
											<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>?step=<?=$step?>&country=<?=$country?>&search=<?=$_GET['search']?>">Подробнее</a></td>
                                        </tr>
                                        <?endif?>
									<?endforeach?>									
									<?foreach ($experts as $expert) :?>
										<?if ($expert['shortname'] != '') :?>
                                        <tr class="odd gradeX">
                                            <td><?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" />
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="margin-bottom:10px;border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;" />
			<?endif?>
	<?endif?></td>
                                            <td><a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><?=$expert['shortname']?> <?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></a></td>
											
											<td>
											<?=$expert['opisanie']?>
											</td>
											
                                            <td>
	<?$u2cs = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
	
	
		<!--table>		<tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
			<td>  </td>
			</tr><tr>

			<?if ($u2cs1[0]->id != $v->id):?>	
				<td>Специализация:</td>
				<td><ul style="margin-left:0px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="margin-left:0px;line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>
		</table-->	
<?=$v->cat->name?>
</td>
                                            <td><?if (trim($expert['lands']) != ''):?>

<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<?foreach($landnames as $l):?>
<?=$l->name?><br/>
<?endforeach?>

<?endif?></td>
                                            <td>
											<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>?step=<?=$step?>&country=<?=$country?>&search=<?=$_GET['search']?>">Подробнее</a></td>
                                        </tr>
                                        <?endif?>
									<?endforeach?>
                                    </tbody>
                                </table>


<?=$pagination?>

	<script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="/assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
	<script src="/assets/js/table-manage-fixed-columns.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			TableManageFixedColumns.init();
		});
	</script>