<h2><?=$prod->title?> (<?=$cat->name?>)</h2>
				
<div class="row padded">			
	<?=$prod->name?>
	<hr/>

<?if ($view == 0) :?>	
	<form action="/user/delete/" id="delform">
		<input type="hidden" name="del" value="<?$prod->id?>">
		<button class="mtop" onclick="return confirm('Вы уверены?')">Удалить заявку</button>
		</form>
	
	
	<p>&nbsp;</p>
	<?endif?>	
</div>	

	<?if (count($experts)>0):?>
			<div id="tabs">
<ul>
<?foreach ($experts as $exp) :?>
	<li><a href="#exp<?=$exp['id']?>" ><?=$exp['shortname']?> </a></li>
<?endforeach?>

</ul>
	
	
					<?foreach ($experts as $exp) :?>
					<div id="exp<?=$exp['id']?>">
						<div >			
						<table class="nobold nospace p5px" style="width:100%;table-layout:fixed"><tr>
						<td style="vertical-align:middle">
						Компания: <?=$exp['shortname']?> <br/>
						Представитель: <?=$exp['fio']?> 
						<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?><br/>
						Регион: <?=$region->name?> <br/>
						<a href="#expdata<?=$exp['id']?>" class="regg2">Профиль компании</a>
						
										<input name="my_input" value="<?=$exp['rating']?>" id="rating_simple<?=$exp['id']?>" type="hidden">

										<script>
													$(function() {
														$("#rating_simple<?=$exp['id']?>").webwidget_rating_simple({
															rating_star_length: '5',
															rating_initial_value: '<?=$exp['rating']?>',
															rating_function_name: 'rateOut(<?=$exp['id']?>)',//this is function name for click
															directory: '/public/js'
														});
													});
										</script>
		
		<div style="display:none">
		<div id="expdata<?=$exp['id']?>" style="padding:20px">
		
		
	
		<?if ($exp['role']==5):?>

					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div style="margin-bottom:10px;font-weight:normal"><br/><strong>Сфера деятельности:</strong> <?=$v->cat->name?></div>
			

			<?//if ($u2cs1[0]->id != $v->id):?>	
				<strong>Специализация:</strong>
				<ul style="margin-left:-25px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul>
			<?//endif?>			
		<?endif?>		
	<?endforeach?>
		
					<?if ($exp['parent_user_id']>0):?>		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['logo']?>" /></div>
					</div>	
					<?endif?>
					
			<div class="row">
			<div class="cont_form_name">Наименование компании </div>
			<div class="ti">
			<?=$exp['shortname']?>
			</div>
			</div>	
			<?endif?>			
						
						
						<div class="row">
			<div class="cont_form_name">ФИО </div>
			<div class="ti">
			<?=$exp['fio']?>
			</div>
			</div>
			
								<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['photo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['photo']?>" /></div>
					</div>	
					<?endif?>
			
			<div class="row">
			<div class="cont_form_name">Город </div>
			<div class="ti">
			<?=$exp['city']?>
			</div>
			</div>							
						
						
			<div class="row">
			<div class="cont_form_name">Регион </div>
			<div class="ti">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			</div>
			</div>

			<div class="row">
			<div class="cont_form_name">Улица </div>
			<div class="ti">
			<?=$exp['street']?>
			</div>
			</div>	
						<div class="row">
			<div class="cont_form_name">Дом </div>
			<div class="ti">
			<?=$exp['house']?>
			</div>
			</div>	
		<?else:?>
		
		<table style="width:700px"><tr><td style="width:400px;vertical-align:top">
		
							<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/logos/<?=$exp['logo']?>" /></div>
					</div>	
					<?endif?>
					
			<div class="row">
			<div class="cont_form_name">Наименование компании </div>
			<div class="ti">
			<?=$exp['fullname']?>
			</div>
			</div>	
			
					<?$u2cs = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$exp['id'])->find_all();?>
			<div style="margin-bottom:10px;font-weight:normal"><br/><strong>Сфера деятельности:</strong> <?=$v->cat->name?></div>
			

			<?//if ($u2cs1[0]->id != $v->id):?>	
				<strong>Специализация:</strong>
				<ul style="margin-left:-25px">
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li style="line-height:1.1"><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul>
			<?//endif?>			
		<?endif?>		
	<?endforeach?>
		
		
								<div class="row">
			<div class="cont_form_name">Регион </div>
			<div class="ti">
			<?$region = ORM::factory('region')->where('id','=',$exp['region'])->find()?>
			<?=$region->name?>
			</div>
			</div>
						
										<div class="row">
			<div class="cont_form_name">Город </div>
			<div class="ti">
			<?=$exp['city']?>
			</div>
			</div>		
						
				


			<?if ($role == 3):?>
						<div class="row">
			<div class="cont_form_name">Вид деятельности <span>*</span></div>
			<div class="ti">
						<?=$exp['export']?>
			</div>
			</div>
			<?endif?>			
			


			

			
			
			</tD><td style="width:300px;vertical-align:top">			
	
								<?if ($exp['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$exp['photo'])):?>
					<div class="row">
					<div class="cont_form_name"></div>
						<div style="display:table-cell"><img src="/img/uimgs/<?=$exp['photo']?>" /></div>
					</div>	
					<?endif?>

	
						<div class="row">
			<div class="cont_form_name">Представитель </div>
			<div class="ti">
			<?=$exp['fio']?>
			</div>
			</div>
			

			
			<div class="row">
			<div class="cont_form_name">Должность </div>
			<div class="ti">
			<?=$exp['dolz']?>
			</div>
			</div>
		
					<div class="cont_form_name">Телефон компании </div>
			<div class="ti">
			<?=$exp['phone1']?>
			</div>
			</div>	

												<div class="row">
			<div class="cont_form_name">E-mail </div>
			<div class="ti">
			<?=$exp['email']?>
			</div>
			</div>	
			
			
									<div class="row">
			<div class="cont_form_name">Web-сайт </div>
			<div class="ti">
			<?=$exp['web']?>
			</div>
			</div>	
		
				</td></tr></table>
		
			<?endif?>			
			</div></div>						
						</td>
						<td style="width:150px;height:140px;">
							<div style="display:block;height:140px;overflow:hidden;">
								<div style="display:table-cell;height:140px;overflow:hidden;vertical-align:middle">
									<?if ($exp['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$exp['logo'])):?>
										<img src="/img/logos/<?=$exp['logo']?>" width="150px" />
									<?endif?>
								</div>
							</div>	
						</td>
						</tr><tr>
						<td colspan="2">
						<?if ($view == 0) :?>
						<table style="width:100%" ><tr><td width="33%" style="padding-left:0px;">
						<?if ( $exp['reject'] == 0 && $exp['choosen'] == 0):?><a href="/user/choose/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Выбрать компанию</a><?endif?>&nbsp;</td>
						<?if ($exp['reject'] == 0):?>
							<td width="33%" align="center"><a href="/user/reject/?uid=<?=$prod->id?>&expert=<?=$exp['user_id']?>">Отказаться от услуг компании</a></td>
						<?endif?>
						<td width="33%" align="right"><a href="/user/close?id=<?=$prod->id?>" onclick="return confirm('Вы уверены?')">Закрыть заявку</a></td>

						</tr></table>
						<?else:?>
							<?if ($na == 0):?>
							<table style="width:100%" ><tr>
								<td align="left"><a style="margin-left:-10px" href="/user/accept?id=<?=$prod->id?>&reject=0">Откликнуться на заявку</a></td>
								<td align="right">
								<a href="/user/accept?id=<?=$prod->id?>&reject=1" onclick="return confirm('Вы уверены?')">Отказаться от заявки</a></td>

							</tr></table>
							
							<?else:?>
							<table style="width:100%" ><tr>
								<td align="left">&nbsp;
								</td><td align="right">
								<?if ($reject) :?>
									К сожалению клиентом отказался от Ваших услуг <?=date('d.m.Y H:i',$reject)?> <br/>
									<a href="/user/rejecte/?uid=<?=$prod->id?>&expert=<?=$user?>">Подтвердить отказ от услуги</a>
								<?endif?></td>

							</tr></table>
							
							<?endif?>
							<?if (isset($_GET['accept'])) :?>
								<?$acc=array(1=>'Вы отказались от заявки',0=>'Вы откликнулись на заявку')?>
								<?=$acc[$_GET['accept']]?>
							<?endif?>
						<?endif?>
						</td>
						</tr></table>
						
<hr style="border-top:2px solid #999"/>						



<?if ($showform == 1) :?>
<a name="addc<?=$exp['id']?>"></a>
						<div class="padded">
						<form method="POST" class="form-horizontal" id="jq138<?=$prod->id?>" id="altForm" action="/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html" enctype="multipart/form-data">
	
	<input type="hidden" value="<?=$exp['user_id']?>" name="preuser" >	
	
	<div class="row">
	<div class="cont_form_name">Комментарий <span>*</span></div>
	<input type="hidden" name="uid" value="<?=$prod->id?>">						
		<div class="txtar"><textarea name='ticket' onkeyup="$.colorbox.resize()"><?=trim($data['ticket'])?></textarea></div>
	</div>
	
	<div class="row">
	<div class="cont_form_name">Файл: <span>*</span></div>
	<input type="hidden" name="uid" value="<?=$prod->id?>">						
		<div class="ti"><input type="file" name="filename" value=""></div>
	</div>
		<div class="row">
	<div class="cont_form_name"></div>
		<div class="ti"><a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq138<?=$prod->id?>').submit();"><div>Отправить</div></a></div></div>
		
		<div style="clear:both"></div>
		 
	</form></div>
						<?endif?>
<!--hr/-->

						</div>
						<?foreach ($exp['feeds'] as $feed) :?>
							<?if ($feed['user_id'] == $user):?>
								<div class="green rounded padded">
								<?=$feed['text']?>
												<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
										<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
									<?endif?>

								</div>
								<div style="padding:5px;text-align:left">
									Вы <?=$feed['cts']?> 			
								</div>
								<hr/>
							<?else:?>
								<div class="blue rounded padded">
								<?=$feed['text']?>
									<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
										<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
									<?endif?>

								</div>
								<div style="padding:5px;text-align:right;padding-bottom:5px">
									Эксперт <?=$feed['shortname']?> <?=$feed['cts']?> 								
								</div><div style="clear:both"></div>
								<!--hr/-->
							<?endif?>
						<?endforeach?>

												
						<?if ($exp['reject'] == 0 && $reject == 0 && count($exp['feeds']) > 0) :?>
						<div class="padded">
<?if ($showform == 1) :?>						
						<a href="#addc<?=$exp['id']?>">Добавить комментарий</a>
<?endif?>						
						</div>
						<?endif?>
<!--hr/-->
						
						</div>
					<?endforeach?>
	</div>
	<?endif?>
<?if (count($experts) >0) :?>
	
	<?endif?>

</div>	
