					<h1 class="page-header">						
										Мои пользователи			 
					</h1>


		<div style="padding:0px 20px">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-11">
					<div class="email-btn-row hidden-xs">
						<a href="/user/client" class="btn btn-inverse btn-sm ">Добавить пользователя</a>
					
					</div>
						<div class="email-content">

						<table class="table table-email" id="userlist" cellpadding="0" cellspacing="0">
						<thead>
						<tr >
							<th >ФИО</th>						
							<th >E-mail</th>
							<th >Телефон</th>
							<th ></th>
						</tr>
						</thead>
						<tbody>
						<?foreach($data as $i=>$v):?>
							<tr>
							<td><?=$v['fio']?></td>
							<td><?=$v['email']?></td>
							<td><?=$v['phone']?></td>
							<td><a href="/user/client?user_id=<?=$v['user_id']?>">Изменить</td>
							</tr>
						<?endforeach?>
						</tbody>
						</table>
			</div></div></div></div>