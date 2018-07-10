											
		<?if ($exp['role']==5):?>
		
	
<div class="col-md-12">
					
<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	
				<div class="col-md-8">
		<table><tr><td style="vertical-align:top">
		<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['photo'])):?>
			<img src="/img/uimgs/<?=$exp['photo']?>" />
		<?endif?>
</td><td style="vertical-align:top;padding-left:10px">
		<h5 style="color:#707478" class="m-l-15"><?=$exp['fio']?></h5>
		
		<table class="table">		
		<tr>
		<td>ФИО</td><td><?=$exp['fio']?></td>
		</tr>
		<tr>
		<td>Телефон</td><td><?=$exp['phone1']?></td>
		</tr>
		<tr>
		<td>E-mail</td><td><?=$exp['email']?></td>
		</tr>
		<tr>
		<td>Регион</td><td><?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?></td>
		</tr>
		<tr>
		<td>Город</td><td><?=$exp['city']?></td>
		</tr>
		<tr>
		<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<td>Сфера деятельности:</td>
			<td><?=$v->cat->name?> </td>
			

			<?if ($u2cs1[0]->id != $v->id):?>	
				<td>Специализация:</td>
				<td><ul>
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>
		
		</table>
		
</td></tr></table>		
	
	</div>
			
		</div>
		<div class="clearfix"></div>
<?else:?>
		
		<div class="col-md-6">
	<h4 style="color:#707478">Представитель</h4>
	<table><tr><td style="vertical-align:top">
		<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['photo'])):?>
			<img src="/img/uimgs/<?=$exp['photo']?>" />
		<?endif?>
</td><td style="vertical-align:top;padding-left:10px">
		<h5 style="color:#707478" class="m-l-15"><?=$exp['fio']?></h5>
		
		<table class="table">		
		<tr>
		<td>Должность</td><td><?=$exp['dolz']?></td>
		</tr>
		<tr>
		<td>Телефон компании</td><td><?=$exp['phone1']?></td>
		</tr>
		<tr>
		<td>E-mail</td><td><?=$exp['email']?></td>
		</tr>
		<tr>
		<td>Web-сайт</td><td><?=$exp['web']?></td>
		</tr>

		
		</table>
		
</td></tr></table>		
	
	</div>


<div class="col-md-6" >
	<h4  class="m-l-15" style="color:#707478">О компании</h4>
	<table><tr><td>
			<table class="table">	
<?if ($role == 3):?>			
		<tr>
		<td>Вид деятельности</td><td><?=$exp['export']?></td>
		</tr>
<?endif?>		
		<tr>
		<td>Регион</td><td>			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?></td>
		</tr>		

<tr>
		<td>Город</td><td><?=$exp['city']?></td>
		</tr>
		
			<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<td>Сфера деятельности:</td>
			<td><?=$v->cat->name?> </td>
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
		
		
		</table>
	</td></tr></table>
	
	
	
</div>
<div style="clear:both"></div>
<br/>
		<div class="col-md-12">
		<p>
		<?=$exp['opisanie']?>
		</p>
		</div>
					
			<div style="clear:both"></div>			
		
			<?endif?>			