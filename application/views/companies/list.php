        <div class="content" data-scrollview="true" style="margin-top:0px">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <!-- begin row -->
				
<?if ($role==0):?>
<div class="row" style="margin-bottom:0px;">
<div class="col-md-12">
<?$block = ORM::factory('categorie')->where('id','=',432)->find()?>
<?=$block->html?></div>

</div>
<hr class="m-t-10 m-b-15"/>
<?else:?>
<div class="row" style="margin-bottom:0px;">
<div class="col-md-12">
<?$block = ORM::factory('categorie')->where('id','=',434)->find()?>
<?=$block->html?></div>

</div>
<hr class="m-t-10 m-b-15"/>
<?endif?>				

<?if (intval($_GET['step'])==0 && intval($_GET['country'])==0 && $_GET['search']==''):?>
<div class="row"><div class="col-md-12 m-b-15">
		<table><tr><td style="vertical-align:middle;height:29px"><h5 style="font-weight:normal;margin:0px">
		Поделиться: </h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table>
</div></div>
<?endif?>
				
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-12">

<div class="row" style="margin-bottom:20px">
		<form action="/companies/list/<?=$role?>?step=<?=$step?>" method="get" id="sform">
			<div class="col-md-4" style="padding-left:10px">
			
						<select class="select3 form-control" name="step" onchange="$('#sform').submit()">
							<option value="0" >Выберите область компетенций</option>
							
								<?foreach ($steps as $i=>$group) :?>						                        					
								<option value="<?=$group->id?>" <?if($group->id==$_GET['step']):?>selected<?endif?>><?=$group->name?></option>
								<?endforeach?>							

						</select>			
		</div>

			<div class="col-md-4">
				
						<select class="select2 form-control" name="country" onchange="$('#sform').submit()">
							<option value="0" >Выберите страну специализации</option>
							<?foreach ($countries as $i=>$s) :?>
								<option value="<?=$s->id?>" <?if ($s->id == $_GET['country']):?>selected<?endif?>><?=$s->name?></option>
							<?endforeach?>	
						</select>
				
			</div>
						
			<div class="col-md-4" style="padding-right:10px">	
				
					<?if(intval($_GET['country'])>0 || strlen($_GET['search'])>0 || intval($_GET['step'])>0):?>
							<a href="/companies/list/<?=$role?>" class="btn btn-sm btn-success pull-right" style="padding:3px 12px">Сбросить результаты поиска</a>
					<?else:?>
						<div class="input-group text-right">
							<input type="hidden" value="<?=intval($_GET['gr'])?>" />
                            <input  type="text" class="form-control input-sm input-white" style="border:1px solid #ddd;" name="search" value="<?=$_GET['search']?>" placeholder="Искать <?if ($role==0):?>компанию<?else:?>специалиста<?endif?>" />
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" style="padding:3px 12px;margin-right:0px;padding-bottom:4px" type="button" onclick="$('#sform').submit()">Поиск</button>
                            </span>
                        </div>	

			<?endif?>
			</div>
			
		</form>		
					
</div>

<div style="clear:both"></div>

<?if (count($experts) >0) :?>
<?foreach ($experts as $expert) :?>
<?if ($expert['shortname'] != '-1') :?>
<div class="panel panel-primary" style="border-width:1px;color:black" data-sortable-id="ui-general-1">
                        <div class="panel-body">
							<div class="fade in col-md-2" style="padding-left:0px;padding-right:0px">
			<div style="text-align:center;border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;width:150px;overflow:hidden;height:110px;display:table-cell;vertical-align:middle">
	<?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" style="max-height:110px;max-width:130px;" />
			<?else:?>
				<img src="/img/catalog/nophoto.jpg" style="max-height:110px;" />
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="max-height:110px;max-width:130px;" />
			<?else:?>	
				<img src="/img/catalog/nophoto.jpg" style="max-height:110px;" />
			<?endif?>
	<?endif?>
			</div>
							</div>
							
<div class="fade in col-md-4">
<div style="padding-left:20px">
<?if ($expert['shortname'] != '') :?>
<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><span style="font-size:16px;text-transform:uppercase;line-height:0px"><?=$expert['shortname']?> <?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></span></a>
<br/>
<?else:?>
<a href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>"><span style="font-size:16px;text-transform:uppercase;line-height:0px"><?=$expert['fio']?> <?=$expert['lastname']?> <?=$expert['surname']?><?$region = ORM::factory('region')->where('id','=',$expert['region'])->find()?></span></a>
<br/>



<?endif?>
<?=$expert['opisanie']?>
</div>
</div>							
							
<div class="fade in col-md-2 text-center">
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
<p>		
<b>Компетенция</b><br/><?$catname = $v->cat->name?>
<?

if (strlen($catname) > 100)
			{
				$catname = substr($catname,0,100);
				$ta = explode(' ',$catname);
				//print_r($ta);
				if(count($ta) > 1) {
					unset($ta[count($ta)-1]);
				}
				$catname = implode(' ',$ta);

			}

?>


<?=$catname?>
</p>
</div>
<div class="fade in col-md-2 text-center" style="padding-right:0px">
<?if (trim($expert['lands']) != ''):?>
<p>		
<b>Страна&nbsp;специализации</b><br/>
<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<?foreach($landnames as $l):?>
<?=$l->name?><br/>
<?endforeach?>
</p>
<?endif?>
</div>

<div class="fade in col-md-2 text-right service1" style="padding-right:0px">
<a class="btn btn-outline" href="/companies/one/<?=$role?>/<?=$page?>/<?=$expert['user_id']?>?step=<?=$step?>&country=<?=$country?>&search=<?=$_GET['search']?>">Подробнее</a>
</div>		

							
                        </div>
                    </div>
<?endif?>
<?endforeach?>

<?=$pagination?>
<?else:?>
<h3 ><?if ($role==0):?>Компаний<?else:?>Консультантов<?endif?>, удовлетворяющих условиям поиска, пока в каталоге нет.<br/>Попробуйте изменить критерии поиска.</h3>
<?endif?>

</div>
                    <!-- end col-6 -->
                    <!-- begin col-6 -->
                   
                    <!-- end col-6 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>