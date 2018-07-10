<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
		
			$(document).ready(function() {
			
					var dtable0 = $('#lotlist0').dataTable({"order": [[ 3, "desc" ]],"columns": [{ "width": "15px" },{ "width": "" },							
							{ "width": "65px" },
							{ "width": "65px" },
							{ "width": "90px" }
						],
						"oLanguage": {
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
			
			
				<?foreach ($stocktype as $i=>$st):?>

					var dtable<?=$i?> = $('#lotlist<?=$i?>').dataTable({"order": [[ 3, "desc" ]],"columns": [{ "width": "15px" },{ "width": "" },
							{ "width": "65px" },
							{ "width": "65px" },
							{ "width": "90px" }
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
		
		<h2>Мои заявки</h2>
		
		<div id="tabs">
<ul>
	<li><a href="#tabs-0">Все заявки</a></li>
	<?foreach ($stocktype as $i=>$st):?>
		<?if (count($data[$i]['prods']) > 0) :?>
			<li><a href="#tabs-<?=$i?>"><?=$st?></a></li>
		<?endif?>	
	<?endforeach?>
</ul>

	<div id="tabs-0">
			<form method="POST" action="/user/delete">
			
							<div class="padded w100">
					<a href="javascript:void(0)" style="margin-left:5px">Выбрать все </a> 
							<button class="mright" onclick="return confirm('Вы уверены?')">Удалить</button>							
				</div>

			
					<div class="padded w100" style="width:100%">
						<table id="lotlist0" cellpadding="0" cellspacing="0">
						<thead>
						<tr >
							<th ></th>
							<th style="">Заявка</th>						
							<th >Статус</th>
							<th >Создана</th>
							<th >Действует до</th>
							
						</tr>
						</thead>
						<tbody>

		<?foreach ($data as $i=>$st) :?>
		<?if (count($data[$i]['prods']) > 0) :?>
						<?foreach ($st['prods'] as $prod):?>
							<tr class="theader">
							<td  class="dttd" style="text-align:center;font-size:90%;"><input type="checkbox" name="del[]" value="<?=$prod['id']?>" id="del<?=$prod['id']?>" /><label for="del<?=$prod['id']?>"></label></td>
							<td  style="text-align:left">
								<?if (!isset($_GET['na'])):?>
									<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?><br/>(<?=$prod['cat']->name?>)</a>
								<?else:?>
									<?=$prod['title']?><br/>(<?=$prod['cat']->name?>)
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
		<?endif?>	
	<?endforeach?>
							</tbody>
						</table>
	</div>
	
	
				</form>
	
	</div>



	<?foreach ($data as $i=>$st) :?>
		<?if (count($data[$i]['prods']) > 0) :?>
			<div id="tabs-<?=$i?>">				
				<form method="POST" action="/user/delete">
					<div class="padded w100">
						<a href="javascript:void(0)" style="margin-left:5px">Выбрать все </a>
							<button class="mright" onclick="return confirm('Вы уверены?')">Удалить</button>							
					</div>
					<div class="padded w100" style="width:100%">
						<table id="lotlist<?=$i?>" cellpadding="0" cellspacing="0">
						<thead>
						<tr >
							<th ></th>
							<th style="">Заявка</th>						
							<th style="width:15px"  >Статус</th>
							<th style="width:15px">Создана</th>
							<th style="width:15px">Действует до</th>
							
						</tr>
						</thead>
						<tbody>
						<?foreach ($st['prods'] as $prod):?>
							<tr class="theader">
							<td  class="dttd" style="text-align:center;font-size:90%;"><input type="checkbox" name="del[]" value="<?=$prod['id']?>" id="del<?=$prod['id']?>" /><label for="del<?=$prod['id']?>"></label></td>
							<td  style="text-align:left">
								<?if (!isset($_GET['na'])):?>
									<a href="/<?=$prod['parent_chpu']?>/<?=$prod['alias']?>.html" class="<?if ($prod['cfeeds']>0) :?>boldy<?endif?>"><?=$prod['title']?><br/>(<?=$prod['cat']->name?>)</a>
								<?else:?>
									<?=$prod['title']?><br/>(<?=$prod['cat']->name?>)
								<?endif?>
							
							</td>
							<td style="text-align:center;font-size:90%;">
									<?$stocktype = array('0' =>'На модерации', '2' => 'Ожидает ответа', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');?>
									<?=$stocktype[$prod['stock_type']]?>
							</td>
							<td class="dttd" style="text-align:center;font-size:90%;"><?=date('d.m.Y',$prod['cts'])?></td>
							<td  class="dttd" style="text-align:center;font-size:90%;"><?=date('d.m.Y',$prod['exp'])?></td>
							
							</tr>
						<?endforeach?>
						</tbody>
						</table>

					</div>

				</form>
			</div>
		<?endif?>	
	<?endforeach?>

</div>
		
		
	