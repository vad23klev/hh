        <div class="content" data-scrollview="true" style="margin-top:0px">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-12">

	<div class="row"><div class="col-md-12 m-b-15">
		<ol class="breadcrumb pull-right">
			<li><a class="btn btn-primary btn-sm" style="padding:3px 12px" href="/companies/list/<?=$role?>/<?=$page?>?step=<?=$_GET['step']?>&country=<?=$_GET['country']?>&search=<?=$_GET['search']?>">Вернуться к результатам поиска</a></li>
		</ol>	

		<table><tr><td style="vertical-align:middle;height:29px"><h5 style="font-weight:normal;margin:0px">
		<?if ($expert['role']==5):?>Рекомендовать консультанта:<?else:?>Рекомендовать компанию:<?endif?></h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table>
</div></div>

<style>
	.header.navbar .navbar-nav > li > a {
		opacity: 0;
	}
	.header.navbar .navbar-nav > li:last-child > a {
		opacity: 1;
	}
	.section-title:before {
	    
	    width: 967px;
	    margin-left: 0;
	}
</style>

<div class="panel panel-primary" style="border: none;">
	<div class="panel-body" style="color:black">
<div class="row p-b-20" style="margin-bottom: 20px;">
	<div class="col-md-3">
	
	<div style="margin-bottom:20px; margin-top: 10px; border:1px solid gray;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;width:200px;overflow:hidden;height:110px; text-align: center;">
	<div style="display: inline-block;">
	<div style="display: table-cell; height: 100px;  vertical-align: middle;">
	<?if ($expert['role']==5):?>
			<?if ($expert['photo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$expert['photo'])):?>
				<img src="/img/uimgs/<?=$expert['photo']?>" style="max-height: 120px;" />
			<?else:?>
				<img src="/img/catalog/nophoto.jpg" style="width:150px;" />	
			<?endif?>
	<?else:?>
			<?if ($expert['logo'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logos/'.$expert['logo'])):?>
				<img src="/img/logos/<?=$expert['logo']?>" style="max-height: 120px;" />
			<?else:?>
				<img src="/img/catalog/nophoto.jpg" style="width:150px;" />
			<?endif?>
	<?endif?>
	</div></div>
	</div>
	
		
	<?$u2cs = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>

	</div>
	<div class="col-md-9 noh5b" style="padding-left:15px">
		<div style="">
		<span style="font-size:16px;text-transform:uppercase;color:#348FE2">
		<?if ($expert['role']==5):?>
			<?=$expert['fio']?> <?=$expert['lastname']?> <?=$expert['surname']?>
		<?else:?>
			<?=$expert['shortname']?>
		<?endif?>
		</span>
		
		<p><?=str_replace("\n","</p><p>",$expert['opisanie2'])?></p>
		
		
		<div style="clear:both"></div>
		</div>

	
	
	</div>
		
	</div>
	
	
<h4 class="section-title" style="padding-top: 0; margin: -13px 0 0 -6px;"></h4>
		
<div class="row p-t-5 p-b-10">
	<div class="col-md-12 noh5b" style="margin-bottom: 20px;     margin-bottom: 20px;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;" >




	
				

			<table><tr>
	<?foreach ($u2cs as $i=>$v):?>				
		<?if ($v->cat->category_id == 355):?>
			<?$u2cs1 = ORM::factory('u2c')->where('user_id','=',$expert['id'])->find_all();?>
			<?$step = ORM::factory('step')->where('id','=',$v->cat->step_id)->find();?>
			<td valign="top">
			
			<h5 style="margin-bottom:5px"><strong>Компетенции</strong></h5><p style="padding-left: 5px;">Продвижение продукции (разработка, перевод и адаптация маркетинговых материалов, реклама, PR, продвижение через Интернет)</p>
			
			<h5 style="margin-bottom:5px;margin-top:0px"><strong>Страна специализации</strong></h5> 
<?$landa = explode(';',$expert['lands'])?>
<?$landnames = ORM::factory('country')->where('id','in',$landa)->find_all()?>
<p style="padding-left: 5px;">		
<?foreach($landnames as $l):?>
<?=$l->name?>
<?endforeach?>
</p>


			<?if ($u2cs1[0]->id != $v->id):?>	
				<h5 style="margin-bottom:5px"><strong>Специализация</strong></h5><ul>
				<?foreach ($u2cs1 as $i1=>$v1):?>		
					
					<?if ($v1->cat->category_id == $v->cat->id):?>
						<li><?=$v1->cat->name?></li>		
					<?endif?>					
				<?endforeach?>					
				</ul></td>
				
			<?endif?>			
		<?endif?>		
		</tr>
	<?endforeach?>		
		</table>				

<?if ($expert['lang'] != '' && $expert['role']!=5):?>
		
<!-- <h5 style="margin-bottom:5px">Язык компании</h5> <p><?=substr(str_replace(";",", ",$expert['lang']),0,strlen($expert['lang']))?></p> -->
<?endif?>


	<strong style="font-size: 14px;">Товарная специализация</strong><br/> <p style="padding-left: 5px;">Группа 34. Мыло, поверхностно-активные органические вещества, моющие средства, смазочные материалы, искусственные и готовые воски, составы для чистки или полировки, свечи и аналогичные изделия, пасты для лепки, пластилин, "зубоврачебный воск" и зубоврачебные составы на основе гипса</p>



<strong style="font-size: 14px;">Членство в деловых и профессиональных ассоциациях:</strong><br/><p style="padding-left: 5px;">
•	ТПП РФ<br/>
•	РСПП<br/>
•	Деловая Россия<br/>
•	Опора России
</p>

</div>
<h4 style=" height: 55px; margin-bottom: -30px; padding: 20px 0; text-align: center; position: relative; top: -32px;"><span style="font-size: 15px; background: #FFF; display: inline-block; padding: 0 10px;">КОНТАКТЫ</span></h4>


		
		
<?if ($expert['role']==5):?>

<div class="row" style=" padding-bottom: 10px;">

<div class="col-md-6">



<table class="table" style="margin-bottom:0px">
	<tr><td><strong>Страна нахождения:</strong> Россия</td></tr>
	<tr><td><strong>Регион:</strong> Москва</td></tr>
	<tr><td><strong>Место работы:</strong> ООО "Работа"</td></tr>	
	<tr><td><strong>Должность:</strong> менеджер</td></tr>	
	<tr><td><strong>E-mail:</strong> test@test.test</td></tr>	
</table>

<!-- •	Иванов Иван Иванович<br/>
•	Должность: менеджер по экспорту<br/>
•	E-mail: info@export.ru<br/>
•	Телефон: + 7 (499) 123 45 85 <br/>
•	Мобильный: +7 (926) 123 45 67<br/>
•	Skype: ExportSkypeAddress<br/> -->
	<!-- <table class="table" style="margin-bottom:0px">		
		<?$fio = $expert['fio']." ".$expert['lastname']." ".$expert['surname']?>
		<?if ($expert['role']!=5):?>		
			<?if (strlen($fio)>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px;vertical-align:middle" class="nopl">Представитель</td><td style="vertical-align:middle">
			<span class="navbar-user" >
				<img style="float:none;position:relative;top:3px" src="/imnew.php?type=uimgs&amp;image=224.jpeg&amp;width=150&amp;height=150" alt="">
			</span>

			<?=$fio?></td>
			</tr>
			<?endif?>
		<?endif?>	
		<?if (strlen($expert['phone'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Мобильный</td><td><?=$expert['landcode']?> <?=$expert['citycode']?> <?=$expert['phone']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['phone1'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Телефон </td><td><?=$expert['landcode1']?> <?=$expert['citycode1']?> <?=$expert['phone1']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['email'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">E-mail</td><td><?=$expert['email']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['web'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Web</td><td><?=$expert['web']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['skype'])>0) :?>		
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Skype</td><td><?=$expert['skype']?></td>
		</tr>
		<?endif?>
		<?if ($expert['role']==5):?>
			<?if (strlen($expert['fb'])>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px" class="nopl">Facebook</td><td><?=$expert['fb']?></td>
			</tr>
			<?endif?>
			<?if (strlen($expert['vk'])>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px" class="nopl">LinkedIn</td><td><?=$expert['vk']?></td>
			</tr>
			<?endif?>
		<?endif?>	
		</table> --></div>


<div class="col-md-6">

	<!-- <table class="table" style="margin-bottom:0px">		
		<?$fio = $expert['fio']." ".$expert['lastname']." ".$expert['surname']?>
		<?if ($expert['role']!=5):?>		
			<?if (strlen($fio)>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px;vertical-align:middle" class="nopl">Представитель</td><td style="vertical-align:middle">
			<span class="navbar-user" >
				<img style="float:none;position:relative;top:3px" src="/imnew.php?type=uimgs&amp;image=224.jpeg&amp;width=150&amp;height=150" alt="">
			</span>

			<?=$fio?></td>
			</tr>
			<?endif?>
		<?endif?>	
		<?if (strlen($expert['phone'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Мобильный</td><td><?=$expert['landcode']?> <?=$expert['citycode']?> <?=$expert['phone']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['phone1'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Телефон </td><td><?=$expert['landcode1']?> <?=$expert['citycode1']?> <?=$expert['phone1']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['email'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">E-mail</td><td><?=$expert['email']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['web'])>0) :?>
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Web</td><td><?=$expert['web']?></td>
		</tr>
		<?endif?>
		<?if (strlen($expert['skype'])>0) :?>		
		<tr>
		<td style="width:100px;padding-left:0px" class="nopl">Skype</td><td><?=$expert['skype']?></td>
		</tr>
		<?endif?>
		<?if ($expert['role']==5):?>
			<?if (strlen($expert['fb'])>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px" class="nopl">Facebook</td><td><?=$expert['fb']?></td>
			</tr>
			<?endif?>
			<?if (strlen($expert['vk'])>0) :?>		
			<tr>
			<td style="width:100px;padding-left:0px" class="nopl">LinkedIn</td><td><?=$expert['vk']?></td>
			</tr>
			<?endif?>
		<?endif?>	
		</table> -->
<!-- •	Страна нахождения: Россия<br/>
•	Регион: Москва<br/>
•	Web- сайт: www.russiagoingglobal.com<br/>
•	E-mail (из поля «корпоративный e-mail)<br/>
•	Телефон (из поля «корпоративный телефон) -->
			<table class="table" style="margin-bottom:0px">	
				<tr><td><strong>Телефон:</strong> 828282828282</td></tr>	
				<tr><td><strong>Мобильный:</strong> 828282828282</td></tr>				
				<tr><td><strong>Skype:</strong> ExportSkypeAddress</td></tr>	
				<tr><td><strong>Facebook:</strong> ExportSkypeAddress</td></tr>	
				<tr><td><strong>LinkedLn:</strong> ExportSkypeAddress</td></tr>	
			</table>
		</div>

		</div>

<?endif?>

<?if ($expert['role']==4):?>

<div class="row" style=" padding-bottom: 10px;">

	<div class="col-md-6">

		<h5 style="margin-bottom:15px; margin-top:0px;text-align: center;">Корпоративные</h5>

		<table class="table" style="margin-bottom:0px">
			<tr><td><strong>Страна нахождения:</strong> Россия</td></tr>	
			<tr><td><strong>Регион нахождения:</strong> Москва</td></tr>
			<tr><td><strong>Web-сайт:</strong> www.russiagoingglobal.com</td></tr>
			<tr><td><strong>E-mail:</strong> test@test.test</td></tr>
			<tr><td><strong>Телефон:</strong> 828282828282</td></tr>				
		</table>
	</div>


	<div class="col-md-6">
		<h5 style="margin-bottom:15px;margin-top:0px;text-align: center;">Персональные</h5>

		<table class="table" style="margin-bottom:0px">
			<tr><td><strong>Представитель:</strong> Иванов Иван Иванович</td></tr>
			<tr><td><strong>Должность:</strong> менеджер по экспорту</td></tr>
			<tr><td><strong>E-mail:</strong> test@test.test</td></tr>
			<tr><td><strong>Телефон:</strong> 828282828282</td></tr>	
			<tr><td><strong>Мобильный:</strong> 828282828282</td></tr>	
			<tr><td><strong>Skype:</strong> ExportSkypeAddress</td></tr>	
		</table>
	</div>
</div>

<?endif?>


<?if ($expert['role']==4):?>


	
	<?if ($expert['svid'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/svid/'.$expert['svid']) 
		|| $expert['ust'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/ust/'.$expert['ust'])
		|| $expert['egr'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/egr/'.$expert['egr'])
		|| $expert['dov'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/dov/'.$expert['dov'])):?>
	
<h4 style="" class="section-title"><span>ПРЕЗЕНТАЦИЯ</span></h4>
<div class="section-container" style="margin-bottom:15px">
	
	 <div id="gallery" class="gallery">

					<?if ($expert['svid'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/svid/'.$expert['svid'])):?>
					<div class="image gallery-group-1">
						<div class="image-inner">
							<a href="/img/svid/<?=$expert['svid']?>" data-lightbox="gallery-group-5" title="стр. 1">
								<img src="/img/svid/<?=$expert['svid']?>?rand=<?=rand()?>" />
							</a>
							<p class="image-caption">
								#1
							</p>
						</div>
                    </div>
					<?endif?>
					
					<?if ($expert['ust'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/ust/'.$expert['ust'])):?>
					<div class="image gallery-group-1">
                    <div class="image-inner">
						<a href="/img/ust/<?=$expert['ust']?>" data-lightbox="gallery-group-5" title="стр. 2">
						<img src="/img/ust/<?=$expert['ust']?>?rand=<?=rand()?>" />
						</a>
                        <p class="image-caption">
                            #2
                        </p>
                    </div></div>
                    <?endif?>

					<?if ($expert['egr'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/egr/'.$expert['egr'])):?>
					<div class="image gallery-group-1">
                    <div class="image-inner">
						<a href="/img/egr/<?=$expert['egr']?>" data-lightbox="gallery-group-5" title="стр. 3">
						<img src="/img/egr/<?=$expert['egr']?>?rand=<?=rand()?>" />
						</a>
                        <p class="image-caption">
                            #3
                        </p>
                    </div></div>
                    <?endif?>

					<?if ($expert['dov'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/dov/'.$expert['dov'])):?>
					<div class="image gallery-group-1">
                    <div class="image-inner">
						<a href="/img/dov/<?=$expert['dov']?>" data-lightbox="gallery-group-5" title="стр. 4">
						<img src="/img/dov/<?=$expert['dov']?>?rand=<?=rand()?>" />
						</a>
                        <p class="image-caption">
                            #4
                        </p>
                    </div></div>
                    <?endif?>
	</div>
</div>
	<?endif?>
	
<?endif?>	


<?if ($recoms->count()):?>
<div class="section-container" style="margin-bottom:0px">
                        <h4 class="section-title" style="margin-bottom:0px"><span>Отзывы (<?=$recoms->count()?>)</span></h4>
                        <!-- begin comment-list -->
                        <ul class="comment-list" style="margin-bottom:0px">
							<?foreach ($recoms as $recom):?>
                            <li>
								<?$owner = $recom->owner?>
                                <!-- begin comment-avatar -->
                                <div class="comment-avatar">
									<?if ($owner->photo != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/uimgs/'.$owner->photo)) :?>
									
									<img src="/imnew.php?type=uimgs&image=<?=$owner->photo?>&width=150&height=150" alt="">
										<!--img src="/img/uimgs/<?=$owner->photo?>" alt=""-->
									<?endif?>
                                </div>
                                <!-- end comment-avatar -->
                                <!-- begin comment-container -->
                                <div class="comment-container">
                                    <div class="comment-author">										
                                        <?if ($owner->fio !='') :?><?=$owner->fio?> <?=$owner->lastname?> <?=$owner->surname?><?endif?> <span class="comment-date">размещен <span class="underline"><?=date('d.m.Y',$recom->cts)?></span> в <span class="underline"><?=date('H:i',$recom->cts)?></span>
                                        </span>
                                    </div>
                                    <div class="comment-content">
										<?if (strlen($recom->text) > 400) :?>
											<?$an = substr($recom->text,0,400)?>
											<?$an_arr = explode(" ",$an)?>
											<?unset($an_arr[count($an_arr)-1])?>
											<?$anstr = implode(" ",$an_arr)?>
											<?=$anstr?> 
											<div class="spoiler" style="display:none">
												<?=str_replace($anstr,"",$recom->text)?>
											</div>
											<p><a href="javascript:;;" onclick="var $spoiler = $(this).parent().parent().find('.spoiler');$spoiler.toggle();if($spoiler.css('display') == 'block') {$(this).text('Скрыть')} else {$(this).text('Подробнее ...')}">Подробнее ... </a></p>
										<?else:?>
											<?=$recom->text?>
										<?endif?>
                                        
										
										
										<?if($recom->rating>0):?><div class="m-t-5"><span class="comment-date" style="margin-left:0px">Оценка <?if ($expert['role']==5):?>консультанта<?else:?>компании<?endif?>: <?=str_repeat("<img src='/img/st1.jpg' height='12px' style='margin-top:-2px'>", $recom->rating)?><?=str_repeat("<img src='/img/st2.jpg'  height='12px' style='margin-top:-2px'>", 5 - $recom->rating)?></span></div><?endif?>
										
                                    </div>
                                </div>
								
                                <!-- end comment-container -->
                            </li>
							<?endforeach?>
                        </ul>
                        <!-- end comment-list -->
                    </div>
				
<?endif?>
				
<div class="section-container" id="recom">
                        <h4 class="section-title m-b-20"><span>Добавить отзыв</span></h4>
						<?if ($login['name'] == -1):?>
							<div class="alert alert-warning f-s-12">
								Отзывы могут оставить только зарегистрированные пользователи. Пожалуйста <a href="#modal-login" data-toggle="modal">авторизуйтесь</a> или <a href="/user/register">зарегистрируйтесь</a>.
							</div>
						<?else:?>
							<form class="form-horizontal" action="" method="POST">
								
								<div class="form-group">
									<label class="control-label f-s-12 col-md-2">Текст отзыва <span class="text-danger">*</span></label>
									<div class="col-md-10">
										<textarea name="text" style="resize:vertical" class="form-control req" rows="10"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label f-s-12 col-md-2">Оценка<br/><small>(1 – плохо, 5 – отлично)</small></label>
									<div class="col-md-10">
										<table><tr>
										<td style="padding:3px 5px"><input type="radio" name="rating" value="1" /></td><td style="padding:3px 5px"> 1 </td>
										<td style="padding:3px 5px"><input type="radio" name="rating" value="2" /></td><td style="padding:3px 5px"> 2 </td>
										<td style="padding:3px 5px"><input type="radio" name="rating" value="3" /></td><td style="padding:3px 5px"> 3 </td>
										<td style="padding:3px 5px"><input type="radio" name="rating" value="4" /></td><td style="padding:3px 5px"> 4 </td>
										<td style="padding:3px 5px"><input type="radio" name="rating" value="5" /></td><td style="padding:3px 5px"> 5 </td>
										</tr></table>
									</div>
								</div>								
								
								<div class="form-group">
									<div class="col-md-10 col-md-offset-2">
										<button type="submit" onclick="return controlform('#recom')" style="padding:3px 12px" class="btn btn-inverse btn-lg">Добавить отзыв</button>
									</div>
								</div>
							</form> 
						<?endif?>
                    </div>	
	
	
	
</div>
</div>


<div class="row"><div class="col-md-12 m-b-15">
		<a class="btn btn-primary btn-sm pull-right" style="padding:3px 12px" href="/companies/list/<?=$role?>/<?=$page?>?step=<?=$_GET['step']?>&country=<?=$_GET['country']?>&search=<?=$_GET['search']?>">Вернуться к результатам поиска</a>
		
		<table><tr><td style="vertical-align:middle;height:29px"><h5 style="font-weight:normal;margin:0px">
		<?if ($expert['role']==5):?>Рекомендовать консультанта:<?else:?>Рекомендовать компанию:<?endif?></h5></td><td>
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
		</td></tr></table>
</div></div>


</div>		
		
<script>
	function controlform(id) {
		var err = 0;
		$(id + ' textarea').removeClass('parsley-error');
		
		$(id + ' .req').each(
			function () {
				if ($(this).val() == '') {
					$(this).addClass('parsley-error');
					$(this).attr('placeholder','Поле необходимо заполнить');
					err = 1;
				}
			}		
		);
		
		if (err == 1) {
			return false;
		} else {
			return true;
		}
	
	}
</script>							
							

<?if (intval($success) > 0):?>	
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				setTimeout("$('#change').modal('show')",500);
				/*$.gritter.add({
					text: '',
					<?if ($data->complete == 1) :?>
						title: 'Ваши данные были успешно изменены.',
					<?else:?>	
						title: 'Ваши данные переданы администраторам сайта для проверки и дальнейшей авторизации',
					<?endif?>	
					image: '',
					sticky: true,
					time: 5000,
					class_name: 'my-sticky-class'
				});*/
			}, 1000);									
		});
	</script>
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

<div class="modal fade" id="modal-slides">			
			<div class="modal-dialog" style="width:800px">
	
	</div></div>
