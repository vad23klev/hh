<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				//$('.dt').dataTable({"aaSorting": [[0, "desc" ]]});
			} );
		</script>
		
				<?if (count($data)>0):?>			
				<div class="row padded">
					<table width="100%" id="head">					
					<tr >
						<td style="width:60px">№</td>
						<td style="text-align:left;padding-left:5px">Тема</td>
						<td style="width:153px">От</td>
						<td style="width:153px">Последнее сообщение</td>						
						<td style="width:83px">Статус</td>
					</tr>
					</table>
					<table width="99%" id="lotlist" cellpadding="0" cellspacing="0" style="margin-left:4px">
					<?$i=0?>
					<?foreach ($data as $prod):?>
						<tr class="theader">
						<td  style="width:60px;text-align:left"><?=sprintf("%06d",intval($prod['id']))?> </td>
						<td style="text-align:left">
						<!--javascript:openTicket(<?=$prod['id']?>)-->
							<?if (!isset($_GET['na'])):?>
								<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['cat']->name?></a>
							<?else:?>
								<?=$prod['cat']->name?>
							<?endif?>
						</td>
						<td style="width:150px;text-align:center" nowrap><?=$prod['company']?></td>
						<td style="width:150px;text-align:center" nowrap><?if ($prod['lastfeed']>0):?><?=$prod['lastfeed']?><?endif?></td>						
						<td style="width:80px">
							<div id="cfeeds<?=$prod['id']?>">
								<?if ($prod['cfeeds']>0) :?>
									<img src="/img/mail1.gif" />
								<?else:?>
									<img src="/img/mail2.gif" />
								<?endif?>
							</div>	
						
						</td>
						</tr>
						<tr>
						<td colspan="5" id="tlist<?=$prod['id']?>" class="tl" style="display:none">
						<div class="green rounded padded">
							<!--h4>Категория: <?=$prod['cat']->name?></h4-->										
							<?=$prod['name']?>
						</div>
						<div style="padding:5px;text-align:left">
							<?=$prod['fio']?>  <?=$prod['cts']?>
						</div>
<h4>Ответы:</h4>

<?if ($current == $prod['id']) :?>
	<?if ($status==1):?>
		<h2>Дополнительный вопрос успешно добавлен</h2>
	<?endif?>
<?endif?>


	<?foreach ($prod['feeds'] as $feed) :?>
			<?if ($feed['user_id'] == $user):?>
			<div class="blue rounded padded">
			<?=$feed['text']?> <?=$feed['file']?>
				<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
					<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
				<?endif?>
			
			</div>
			<div style="padding:5px;text-align:left">
				Вы <?=$feed['cts']?> 			
			</div>
			<hr/>
		<?else:?>
			<div class="green rounded padded">
			<?=$feed['text']?> <?=$feed['file']?>
				<?if ($feed['file'] != '' && file_exists($_SERVER['DOCUMENT_ROOT'].'/img/feeds/'.$feed['file'])):?>
					<br/><a href="/img/feeds/<?=$feed['file']?>">Скачать файл</a>
				<?endif?>

			</div>
			<div style="padding:5px;text-align:right">
				Пользователь <?=$feed['shortname']?>  <?=$feed['cts']?> 
			</div>
			<hr/>
		<?endif?>
	<?endforeach?>


<script>
	function rateOut(id)
	{
			jQuery.ajax({
				url      : '/answer/rate?uid=' + id + '&val=' + document.getElementById('rating_simple'+id).value,
				type     : 'GET',
				data     : '',
				success  : function(data) {
					document.getElementById('rating_simple'+id).value = data;
				}, 
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					document.getElementById('rating_simple'+id).innerHTML = textStatus;
				}
			});
	}
</script>

<?if ($current == $prod['id']) :?>
	<?foreach ($errors as $error) :?>
	<?=$error?><br/>
	<?endforeach?>
<?endif?>	

<?if ($prod['disabled'] == 0):?>
	<form method="POST" class="form-horizontal" id="jq138<?=$prod['id']?>" id="altForm" action="/user/answers" enctype="multipart/form-data">

	<div class="cont_form_name">Комментарий <span>*</span></div>
	<input type="hidden" name="uid" value="<?=$prod['id']?>">
		<div class="txtar"><textarea name='ticket'><?=trim($data['ticket'])?></textarea></div>
<div class="ti"><input type="file" name="filename" value=""></div>
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq138<?=$prod['id']?>').submit();"><div>Добавить вопрос</div></a>
		<div style="clear:both"></div><p>&nbsp;</p>
	</form>
	
	<form method="POST" class="form-horizontal" id="jq139<?=$prod['id']?>" id="altForm" action="/user/openanswers" enctype="multipart/form-data">

	<input type="hidden" name="uid" value="<?=$prod['id']?>">
	
	<input type="hidden" name="user" value="<?=$user?>">	
		<input type="hidden" name="reject" value="1"/>
		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq139<?=$prod['id']?>').submit();"><div>Отказаться</div></a>
		<div style="clear:both"></div><p>&nbsp;</p>
	</form>
<?else:?>	
<strong>
	К сожалению заказчик выбрал другую компанию
	<p></p>
</strong>
<?endif?>	


						</td>						
						</tr>
					<?endforeach?>
					</table>
				</div>
			<?else:?>	
			
					<div class="row padded">
						<table width="100%" id="head">					
						<tr >
							<td style="width:60px">№</td>
							<td style="text-align:left;padding-left:5px">Тема</td>
							<td style="width:150px">Последнее сообщение</td>
							<td style="width:80px">Статус</td>
							<td style="width:80px">Удалить</td>
						</tr>
						</table>
					</div>
			<?endif?>	



<script>

function openTl()
{
	$('#tlist<?=$current?>').show();
}
openTl();

function openTicket(id) {
	$('#cfeeds'+id).html('<img src="/img/mail2.gif" />');
	$('.tl').hide();
	$('#tlist'+id).show();
	$(this).removeClass('boldy');
	/*jQuery.ajax({
		url      : '/answer/looklot?uid=' + id,
		type     : 'GET',
		data     : ''
	});*/
}
</script>