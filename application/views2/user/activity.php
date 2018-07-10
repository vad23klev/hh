<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
		
			$(document).ready(function() {
				
			
				<?foreach ($stocktype as $i=>$st):?>

					var dtable<?=$i?> = $('#lotlist<?=$i?>').dataTable({"columns": [{ "width": "" },
							{ "width": "60px" },
							{ "width": "60px" },
							{ "width": "60px" }
						],"oLanguage": {
							"sProcessing":   "Подождите...",
							"sLengthMenu":   "Показать _MENU_ записей",
							"sZeroRecords":  "Записи отсутствуют.",
							"sInfo":         "Записи с _START_ до _END_ из _TOTAL_ записей",
							"sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
							"sInfoFiltered": "(отфильтровано из _MAX_ записей)",
							"sInfoPostFix":  "",
							"sSearch":       "Поиск:",
							"sUrl":          "",
							"oPaginate": {
								"sFirst": "Первая",
								"sPrevious": "Предыдущая",
								"sNext": "Следующая",
								"sLast": "Последняя"
							}//,"bDestroy": true
						}});

				<?endforeach?>
			});
		</script>
		
		<h2>Последние сообщения</h2>
		
	<?foreach ($data as $i=>$st) :?>
		<?if (count($data[$i]['prods']) > 0) :?>
			<div id="tabs-<?=$i?>">				
					<div class="padded w100" style="width:100%">
						<table id="lotlist<?=$i?>" cellpadding="0" cellspacing="0">
						<thead>
						<tr >
							<th style="">Заявка</th>						
							<th style="width:15px"  >Статус</th>
							<th style="width:15px">Создана</th>
							<th style="width:15px">Действует до</th>
						</tr>
						</thead>
						<tbody>
						<?foreach ($st['prods'] as $prod):?>
							<tr class="theader">
							<td  style="text-align:left">
								<?if (!isset($_GET['na'])):?>
									<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?><br/>(<?=$prod['cat']->name?>)</a>
								<?else:?>
									<?=$prod['title']?><br/>(<?=$prod['cat']->name?>)
								<?endif?>
								
								<?if($prod['feed']->id >0):?>
								<div class="spoiler" data-spoiler-link="<?=$prod['feed']->id?>">Последний ответ </div>
									<div class="spoiler-content" data-spoiler-link="<?=$prod['feed']->id?>">
									
									<strong>От:  <?if ($prod['userdata']->id != $user):?><?=$prod['userdata']->shortname?><?else:?>Вы<?endif?> <?=date('d.m.Y H:i',$prod['feed']->cts)?><br/><?=$prod['feed']->text?> </strong>
									
									</div>
								<?endif?>	
							</td>
							<td style="text-align:center;font-size:90%;">
									<?$stocktype = array('0' =>'На модерации', '2' => 'Ожидает ответа', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');?>
									<?=$stocktype[$prod['stock_type']]?>
							</td>
							<td class="dttd" style="text-align:center;font-size:90%;"><span style="display:none"><?=$prod['cts']?></span><?=date('d.m.Y',$prod['cts'])?></td>
							<td  class="dttd" style="text-align:center;font-size:90%;"><span style="display:none"><?=$prod['exp']?></span><?=date('d.m.Y',$prod['exp'])?></td>
							</tr>
						<?endforeach?>
						</tbody>
						</table>
					</div>
				
				
			</div>
		<?endif?>	
	<?endforeach?>
		
	