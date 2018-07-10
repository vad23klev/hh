<link href="<?=URL::site()?>public/js/dt/demo_table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="/public/js/dt/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
		
$(document).ready(function() {


					var dtable = $('#userlist').dataTable({"columns": [{ "width": "" },
							{ "width": "120px" },
							{ "width": "120px" },
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

			});
</script>

						<table id="userlist" cellpadding="0" cellspacing="0">
						<thead>
						<tr >
							<th style="">ФИО</th>						
							<th >E-mail</th>
							<th >Телефон</th>
							<th >Действия</th>
						</tr>
						</thead>
						<tbody>
						<?foreach($data as $i=>$v):?>
							<tr>
							<td><?=$v['fio']?></td>
							<td><?=$v['email']?></td>
							<td><?=$v['phone']?></td>
							<td><a href="/user/client?user_id=<?=$v['user_id']?>">Редактировать</a></td>
							</tr>
						<?endforeach?>
						</tbody>
						</table>


<a href="/user/client">Добавить пользователя</a>