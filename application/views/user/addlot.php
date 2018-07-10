<script src="/assets/plugins/ckeditor_short/ckeditor.js"></script>
<script src="/public/js/photo.js"></script>
<script src="/public/modules/itemp/oferta.js"></script>
<?if ($status!=1):?>
<script>

	var count_docs = 1;
	var html;
	
	function proverka(input) {
	    input.value = input.value.replace(/[^\d,]/g, '');
	}

	function addFile1(){
		$('#outt0').clone().appendTo('#files');	
		//alert(123);
		var html = $('#files .file:last').html();

		var IDString = '#outt' + count_docs;

		html = html.replace(/#outt\d+/g, IDString);
		html = html.replace(new RegExp('file10','g'),'file1' + count_docs);
		html = html.replace(new RegExp('outfile0','g'),'outfile' + count_docs);
		html = html.replace(new RegExp('delb0','g'),'delb' + count_docs);
		
		$('#files .file:last').html(html);

		if ($('#files .file').length > 1) {
			//$('#files a').show();
		}

		count_docs ++;
		
	}	

	function removeFile1(elem){
		elem.parent().parent().parent().parent().parent().parent().remove();	
		if ($('#files .file').length > 1) {
			$('#files a').show();
		}
		count_docs --;
	}


	function controlform(id) {
		var err = 0;
		$(id + ' input[type="text"]').removeClass('parsley-error');
		$(id + ' textarea').removeClass('parsley-error');
		$('#sphere_text').hide();
		
		$(id + ' .req').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);

		if ($('#sphere').val() == 0)  {
			$('#sphere').addClass('parsley-error');
			$('#sphere_text').text('Выберите сферу деятельности');
			$('#sphere_text').show();
			err = 1;
		}
		
		if (err == 1) {
			return false;
		} else {
			return true;
		}
	
	}

	function swCats(scid) {
		$('.subcat').hide();
		$('.cat').find('select').find("option:first").attr("selected", "selected");
		$('input [type="radio"]').removeAttr("checked");
		$('#cat' + scid).show();
		
		$('.subopt').hide();
		//$('#so' + scid).show();		
		
	}
	
	

	function swSubcats(scid) {
		$('.subcat').hide();
		$('input [type="radio"]').removeAttr("checked");
		$('#sc' + scid).show();
		
		$('.subopt').hide();
		$('#so' + scid).show();		
		
	}

	function svs(scid) {
		//alert($('#sc1cc' + scid).prop("checked"));
		if ($('#sc1cc' + scid).prop("checked") == true) {
			$('.subopt1').hide();
			$('#so' + scid).show();		
		} else {
			$('#so' + scid).hide();		
		}	
		
	}	
	
	
</script>
<?endif?>
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
<div style="display:none">
	<div class="input-group file m-b-10 col-md-12 oferta-file-group" id="outt0">
<!--		<label class="text-left nopl">Введите описание файла</label>-->

<!--		<div class="form-group col-md-12">-->
<!--			<textarea style="resize:none" name="fdsc[]" class="form-control req2" placeholder="Введит-описание файл<!--а"><?//=$job->name?></textarea>-->
<!--		</div>-->

		<table class="filelist">
			<tr>
				<td class="hidden file-icon_container">
					<i class="fa fa-file-text-o fa-2x"></i>
				</td>
				<td>
					<span class="btn btn-primary fileinput-button btn-sm blau">
						<i class="fa fa-upload"></i> <span>Загрузить файл</span>
						<input type="file" id="file10" class="btn btn-success input-sm"  onchange="addAttacment.call(this, 'file10','outfile0', 'delb0')" name="file[]"  />
					</span>
				</td>
				<td id="outfile0" class="attachment_editable_name" style="width: 200px;"></td>
				<td class="editable_name_container">
					<input type="text" name="fdsc[]" style="width: 200px;" class="hidden editable_name_value form-control input-sm" value="<?=$job->name?>">
				</td>
				<td>
					<a href="javascript:;;" onclick="changeAttachmentName.call(this);" class="btn-change_name hidden btn btn-success btn-sm">
						<i class="fa fa-edit"></i> <span>Изменить название</span>
					</a>
				</td>
				<td>
					<a href="javascript:;;" onclick="leaveChangeAttachmentNameDialog.call(this);" class="btn-leave_changename hidden btn btn-white btn-sm">
						<i class="fa fa-undo"></i> Не сохранять
					</a>
				</td>
				<td colspan="2">
					<div class="col-md-12 col-sm-12  text-left">
						<a href="javascript:;;" style="display:none" id="delb0" onclick='javascript:removeFile1($(this))' class="btn-remove_attachment btn btn-danger btn-sm">
							<i class="glyphicon glyphicon-trash"></i> Удалить
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<?if ($status==1):?>

<div class="col-md-12">
			<div class="panel panel-inverse m-t-15">

			    <div class="panel-body">

				<div class="jumbotron m-b-0 text-center">
	<h3>
		<?if (intval($_GET['sale_type'])==0):?>Ваша заявка успешно создана.<br/> На Вашу почту отправлено подтверждающее уведомление.<?else:?>Ваш вопрос успешно создан.<br/>На Вашу почту отправлено подтверждающее уведомление.<?endif?></h3>
	
	<p>
	<?if ($_GET['sale_type']==1) :?>
		<a class="btn btn-primary btn-lg" href="/user/addlot?sale_type=<?=$_GET['sale_type']?>">Создать новый вопрос</a>
		<p>
			<a class="btn btn-primary btn-lg" href="/user/openq" style="width:222px">К вопросам</a>
		</p>

	<?else:?>
		<a class="btn btn-primary btn-lg" href="/user/addlot?sale_type=<?=$_GET['sale_type']?>">Создать новую заявку</a>
		<p>
			<a class="btn btn-primary btn-lg" href="/user/openlots" style="width:222px">К заявкам</a>
		</p>

	<?endif?>	
	</p>
	
	
</div>

</div></div></div>

<?else:?>	
<h1 class="page-header"><?if (intval($_GET['sale_type'])==0):?>Новая заявка<?else:?>Задать вопрос эксперту<?endif?></h1>


	<div class="col-md-12" >
	<div class="panel panel-inverse">
						<!-- begin panel -->
									<!--div class="panel-heading">
									<h1 class="panel-title" style="font-size:18px">
										
									</h1>
								</div-->
								
					<div class="panel-body" style="padding-bottom:0px;">
						<!-- begin wrapper -->
						<!-- end wrapper -->
						<!-- begin wrapper -->



<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>

			<form method="POST" class="form-horizontal" id="jq138" id="altForm" action="/user/addlot" enctype="multipart/form-data">		
					<h4>Выберите область компетенций</h4>
					<ul class="nav nav-pills">
						<?foreach ($steps as $i=>$step) :?>
							<li class="<?if ($i==0):?>active<?endif?>"><a style="border: 1px solid #CCD0D4;padding-top:5px;height:49px" onclick="swCats(<?=$step->id?>)" href="#nav-pills-tab-<?=$step->id?>" data-toggle="tab">
							<table><tr><td valign="middle" style="text-align:center;height:35px">
							<?$iarr = explode(" и ",$step->name)?>
								<?if (count($iarr) > 1) :?>
									<?=$iarr[0]." <br/>и ".$iarr[1]?>
								<?else:?>
									<?=$iarr[0]?>
								<?endif?></td></tr></table></a>
							</li>							
						<?endforeach?>
					</ul>
					<div class="tab-content" style="padding-bottom:0px">
						<?foreach ($steps as $i=>$step) :?>
							<div class="tab-pane fade <?if ($i==0):?>active in<?endif?>" id="nav-pills-tab-<?=$step->id?>">
								<p>
				<div id="cat<?=$step->id?>" class="cat">
					<div class="form-group">
										<label class="col-md-4 control-label"><?if (intval($_GET['sale_type'])==0):?>Компетенция провайдера<?else:?>Компетенция  эксперта<?endif?>  <span>*</span></label>
										<div class="col-md-8" style="padding-left:10px">
					<!--onchange="swSubcats($(this).val())"-->
					<select name="c[]" class="form-control"  onchange="swSubcats($(this).val())">
						<option value="0" selected>Выберите компетенцию</option>
						<?$stepcat = ORM::factory('categorie')->where('step_id','=',$step->id)->where('category_id','=',355)->find_all()?>
						<?foreach ($stepcat as $cat):?>
							<option value="<?=$cat->id?>"><?=$cat->name?></option>
						<?endforeach?>
					</select>
					<div id="sphere_text" style="display:none" class="m-t-5 m-b-5" ></div>
										</div>
                                </div>
				</div>	
				
				
	
			<?foreach ($stepcat as $cat):?>
			<div id="sc<?=$cat->id?>" style="display:none" class="subcat">
							<?$subcats = ORM::factory('categorie')->where('category_id','=',$cat->id)->find_all();?>
							<?if ($subcats->count() > 0) :?>		

							
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?if (intval($_GET['sale_type'])==0):?>Выберите специализацию провайдера<?else:?>Выберите специализацию эксперта<?endif?>:</label>
                                    <div class="col-md-8" >
									<?foreach($subcats as $scc):?>									
										<div class="checkbox" style="padding-left:20px">
											<input type="radio" name="c[]" value="<?=$scc->id?>" id="sc1cc<?=$scc->id?>" onclick="javascript:svs(<?=$scc->id?>)" />
											<label class="es1" for="sc1cc<?=$scc->id?>"> <?=$scc->name?></label>
										</div>	
										
									
										
									<?endforeach?>
                                        
                                    </div>
                                </div>		

			<?foreach($subcats as $scc):?>									
					<?require "optionlist.php";?>							
										
										
									<?endforeach?>
								

				<?endif?>
			</div>
			<?endforeach?>
				
				
				
								</p>
							</div>
						<?endforeach?>
					</div>
				
			
			
			
			<div class="ess">
						
			
			
			<?foreach ($cats as $cat):?>
				<?require "optionlist.php";?>
			<?endforeach?>			
			
			
			</div>
		
			<?$regions = ORM::factory('region')->find_all()?>
				<?if (intval($_GET['sale_type'])==0):?>
			                                <div class="form-group" style="display:none">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
		
		<!--select name="region" class="form-control"  style="width:250px">
			<option value="0" selected>Выберите регион</option>
			<?foreach ($regions as $s):?>
				<option value="<?=$s->id?>" <?if ($s->id==$data->region):?>selected<?endif?>><?=$s->name?></option>
			<?endforeach?>
		</select-->
                                    </div>
                                </div>
				<?endif?>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" style="padding-top:0px"><?if (intval($_GET['sale_type'])==0):?>Тема<?else:?>Тема<?endif?> <span>*</span>
									<br/><small>(макс. длина поля - 40 символов)</small>
									</label>
                                    <div class="col-md-8">
                                        		<input type="hidden"  class="fld" name="sale_type"  value="<?=intval($_GET['sale_type'])?>">
		<input type="text" autocomplete="off" class="form-control req" maxlength="40" name="title"  value="<?if (count($errors)>0) :?><?=$_POST['title']?><?else:?><?=$data['title']?><?endif?>">

                                    </div>
                                </div>			
								
				<div class="form-group">
                                    <label class="col-md-4 control-label"><?if (intval($_GET['sale_type'])==0):?>Описание задачи<?else:?>Вопрос<?endif?> <span>*</span></label>
                                    <div class="col-md-8">
				<textarea id="theme" name='description' class="ckeditor <?if (intval($_GET['sale_type'])==0):?>form-control<?else:?>form-control<?endif?>"><?=trim($data['description'])?></textarea>
                                    </div>
                                </div>
				<input type="hidden" value="0" name="pub"/>
				<?if (intval($_GET['sale_type'])==1):?>
					<div class="form-group">
                         <label class="col-md-4 control-label">Опубликовать вопрос на Форуме?</label>
                                    <div class="col-md-8">
				<input type="checkbox" name="pub" checked value="1"/>
                                    </div>
                                </div>
				<?endif?>
				
								
				<div class="form-group" <?if (intval($_GET['sale_type'])==1):?>style="display:none"<?endif?>>
						<label class="col-md-4 control-label"></label>
						<div class="col-md-8">
								
								Добавьте к описанию заявки дополнительную информацию, которая поможет потенциальному исполнителю более детально разобраться в поставленной задаче
							</div>	
				</div>
								
				<div class="form-group" <?if (intval($_GET['sale_type'])==1):?>style="display:none"<?endif?>>
						<label class="col-md-4 control-label"></label>
						<div class="col-md-8">
							<div id="files" class="m-t-10">								
															
							</div>	
								
							</div>	
				</div>
			
								
					<div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
									<input class="btn btn-primary" onclick="return controlform('#jq138')" type="submit" value="<?if (intval($_GET['sale_type'])==0):?>Найти провайдера<?else:?>Задать вопрос<?endif?>" />
                                    </div>
                                </div>

</form>

	<?endif?>					
							
							<div class="clearfix"></div>	
							
</div>
						
						
	</div>	


	

	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards-validation.demo.js"></script>
	
	
	<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.js"></script>
	<script src="/assets/js/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
		
	<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/assets/js/form-wysiwyg.demo.js"></script>
	
	<?if ($status!=1):?>
	<script>
		$(document).ready(function() {
			
			addFile1();
			FormWysihtml5.init();
			
			FormWizardValidation.init();			
			//CKEDITOR.replace( 'theme' );
		});
	</script>
	<?endif?>
</div></div>