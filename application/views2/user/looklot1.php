<br/>
<h4>Категория: <?=$cat?></h4>
				
<div class="row padded">			
	<?=$prod['description']?>
</div>	

<h4>Тикеты:</h4>

<?if ($status==1):?>
	<h2>Тикет успешно добавлен</h2>
<?endif?>

<?foreach ($feeds as $feed) :?>
<h4>Оставлен <?=date('d.m.Y H:i',$feed['cts'])?> <?=$feed['fio']?></h4>
<?=$feed['text']?>

<input name="my_input" value="<?=$feed['rating']?>" id="rating_simple<?=$feed['id']?>" type="hidden"><br><br>

<script>
            $(function() {
                $("#rating_simple<?=$feed['id']?>").webwidget_rating_simple({
                    rating_star_length: '5',
                    rating_initial_value: '<?=$feed['rating']?>',
                    rating_function_name: 'rateOut(<?=$feed['id']?>)',//this is function name for click
                    directory: '/public/js'
                });
            });
</script>


<hr/>
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

<?foreach ($errors as $error) :?>
<?=$error?><br/>
<?endforeach?>
<?if ($prod['status']!=2):?>
	<form method="POST" class="form-horizontal" id="jq138" id="altForm" action="/user/looklot?uid=<?=$prod['id']?>" enctype="multipart/form-data">

	<div class="cont_form_name">Тикет <span>*</span></div>
		<div class="txtar"><textarea name='ticket'><?=trim($data['ticket'])?></textarea></div>

		<a class="cont_form_send_butt1" href="javascript:void(0);" onclick="javascript:$('#jq138').submit();"><div>Добавить тикет</div></a>
		<div style="clear:both"></div><p>&nbsp;</p>
	</form>
<?endif?>	

