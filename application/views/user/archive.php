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
						<td style="width:153px">Последнее сообщение</td>
						<td style="width:83px">Статус</td>
						<td style="width:83px">Удалить</td>
					</tr>
					</table>
					<table width="99%" id="lotlist" cellpadding="0" cellspacing="0" style="margin-left:4px">
					<?$i=0?>
					<?foreach ($data as $prod):?>
						<tr class="theader">
						<td  style="width:60px;text-align:left"><?=sprintf("%06d",intval($prod['id']))?></td>
						<td  style="text-align:left"><?=$prod['username']?></td>
						<td style="text-align:left">
						<!--javascript:openTicket(<?=$prod['id']?>)-->
							<?if (!isset($_GET['na'])):?>
								<a href="javascript:void(0)" onclick="javascript:openTicket(<?=$prod['id']?>);" <?if ($prod['cfeeds']>0) :?>class="boldy"<?endif?>><?=$prod['cat']->name?></a>
							<?else:?>
								<?=$prod['cat']->name?>
							<?endif?>
						</td>
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
						<td style="width:80px">
								<a href="<?=URL::site()?>user/openlots?del&uid=<?=$prod['id']?>" onclick="javascript:return confirm('Вы уверены?')"><img alt="Удалить" src="/img/del.gif" border="0"></a>
						</td>
						</tr>
						<tr>
						<td colspan="5" id="tlist<?=$prod['id']?>" class="tl" style="display:none">
						<div class="green rounded padded">
							<!--h4>Категория: <?=$prod['cat']->name?></h4-->										
							<?=$prod['name']?>
						</div>
						<div style="padding:5px;text-align:left">
							Вы <?=$prod['cts']?>
						</div>
<h4>Ответы:</h4>

<?foreach ($prod['experts'] as $exp) :?>
	<?=$exp['shortname']?> <a href="/user/choose/?uid=<?=$prod['id']?>&expert=<?=$exp['user_id']?>">Выбрать компанию</a>
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
			<div style="padding:5px;text-align:right">
				Эксперт <?=$feed['shortname']?> <?=$feed['cts']?> 
			
				<div style="margin-top:-25px">
					<?if ($feed['pre']!=0):?>
					<input name="my_input" value="<?=$feed['rating']?>" id="rating_simple<?=$feed['id']?>" type="hidden">
					<?endif?>
				</div>	
			</div>
			<hr/>
		<?endif?>
	<?endforeach?>
<?endforeach?>	

<?if ($current == $prod['id']) :?>
	<?foreach ($errors as $error) :?>
	<?=$error?><br/>
	<?endforeach?>
<?endif?>	
<?if ($prod['status']!=2):?>
	
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