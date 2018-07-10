<script>
	function swSubcats(scid) {
		$('.subcat').hide();
		$('#sc' + scid).show();
	}
</script>
<script>	
	function look()
	{
		jQuery.ajax({
			url      : '/answer/look?search=' + $('#theme').val(),
			type     : 'GET',
			data     : '',
			success  : function(data) {
				//document.getElementById('addme').innerHTML = data;
				document.getElementById('getres').innerHTML = data;
			}, 
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				document.getElementById('getres').innerHTML = textStatus;
				//document.getElementById('addme').innerHTML = textStatus;
			}
		});

	}
</script>
<?
function draw_cats1($cats,$current,$dots = 0)
{
$res = "";

	foreach ($cats as $i=>$lm)
	{
		//echo str_repeat("-",$dots);echo $i;echo $lm['name']."<br/>";
		if ($lm['category_id']==0)
		{
			$dots=0;
		}
		$res .= "<option value='".$i."'";
		
		
		if ($i==$current)
		{
			$res .= 'selected';
		}
		
		$res .= ">".str_repeat("&nbsp;&nbsp;",$dots).$lm['name']."</option>";
		
		/*if (count($lm['children'])>0)
		{
			$dots++;
			$res .= draw_cats1($lm['children'],$current,$dots);
			$dots--;
		}*/
				
	}
return $res;
}
//print_r($menu);
?><?//=draw_cats1($menu,0)?>

<?if ($status==1):?>
	<h2><?if (intval($_GET['sale_type'])==0):?>Ваша заявка успешно создана. На Вашу почту отправлено подтверждающее уведомление.<?else:?>Ваш вопрос успешно создан. На Вашу почту отправлено подтверждающее уведомление.<?endif?></h2>
	<br/>
	<?if ($_GET['sale_type']==1) :?>
		<a href="/user/addlot?sale_type=<?=$_GET['sale_type']?>">Создать новый вопрос</a>
	<?else:?>
		<a href="/user/addlot?sale_type=<?=$_GET['sale_type']?>">Создать новую заявку</a>
	<?endif?>
<?else:?>	
	<h2 class="tooltip"  title="Тестовый ввод вопроса"><?if (intval($_GET['sale_type'])==0):?>Новая заявка<?else:?>Задать вопрос эксперту<?endif?></h2>


<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>

			<form method="POST" class="form-horizontal" id="jq138" id="altForm" action="/user/addlot" enctype="multipart/form-data">


			<!--div class="row">
			<div class="cont_form_name1"></div>
			
				<div class="ti">
	                    <select class="form-control" id="chosen-list1"  style="width:320px"  name="cat">
							<option value="0">-</option>
							<?if (strlen($good['id'])>0):?>
								<?=draw_cats1($menu,$good['category_id'])?>
							<?else:?>
								<?=draw_cats1($menu,0)?>
							<?endif?>
                        </select>
				</div>
			</div-->
			<div class="ess">
			<div class="row">
			<div class="cont_form_name"  style="width:256px"><?if (intval($_GET['sale_type'])==0):?>Сфера деятельности провайдера<?else:?>Сфера деятельности эксперта<?endif?>  <span>*</span> </div>
			
			<div class="ti">
				<select name="c[]" onchange="swSubcats($(this).val())" style="width:320px">
					<option value="0">-</option>
					<?foreach ($cats as $cat):?>
						<option value="<?=$cat->id?>"><?=$cat->name?></option>
					<?endforeach?>
				</select>
			</div>	
			</div>		

			<?foreach ($cats as $cat):?>
			<div id="sc<?=$cat->id?>" style="display:none" class="subcat">
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>		

			<div class="row">
					<div class="cont_form_name" style="width:256px"><?if (intval($_GET['sale_type'])==0):?>Выберите специализацию провайдера<?else:?>Выберите специализацию эксперта<?endif?>:</div>
			
					<div class="ti">							
															
								<div >
									<?foreach($subcats as $scc):?>									
										<input type="checkbox" name="c[]" value="<?=$scc->id?>" id="sc1cc<?=$scc->id?>" />
										<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label>
									<?endforeach?>
								</div>						
					</div>
				</div>
				<?endif?>
			</div>
			<?endforeach?>
			</div>
			
		<div class="row">
		<div class="cont_form_name">Укажите Ваш регион <span>*</span></div>
		<div class="ti">
		<?$regions = ORM::factory('region')->order_by('name')->find_all()?>
		<select name="region" style="width:320px">
		<option value="0" >-</option>
<?foreach ($regions as $s):?>
	<option value="<?=$s->id?>" <?if ($s->id==$data->region):?>selected<?endif?>><?=$s->name?></option>
<?endforeach?>
</select>
		
		</div>
		</div>

		<div class="row">
		<div class="cont_form_name1"><?if (intval($_GET['sale_type'])==0):?>Тема<?else:?>Тема<?endif?> <span>*</span></div>
		<div class="ti">		
		<input type="hidden" class="fld" name="sale_type"  value="<?=intval($_GET['sale_type'])?>">
		<input type="text" class="fld" name="title"  value="<?if (count($errors)>0) :?><?=$_POST['title']?><?else:?><?=$data['title']?><?endif?>">
		</div>
		</div>
		
		
		
		
	<div class="row">
	<div class="cont_form_name1"><?if (intval($_GET['sale_type'])==0):?>Описание задачи<?else:?>Вопрос<?endif?> <span>*</span></div>
		<div class="txtar"><textarea id="theme" name='description'><?=trim($data['description'])?></textarea></div>
	</div>
	

	<div class="row">
	<div class="cont_form_name1"></div>
<div class="ti">		
		
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq138').submit();"><div><?if (intval($_GET['sale_type'])==0):?>Найти провайдера<?else:?>Задать вопрос<?endif?></div></a></div>
		</div>
</form>
<div style="clear:both"></div>
<br/>
<div id="getres">
</div>
<?endif?>

 