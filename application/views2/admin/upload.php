<script src="/public/js/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/public/js/uploadify.css">


	<h1>Загрузка данных</h1>
	
	<p>
Порядок загрузки данных:<br/>
1. Файл	с номенклатурой представляет собой csv файл (сохраняется из Excel) и должен называться out.csv<br/>
2. Образец файла можно скачать здесь <a href="/exch/out_.csv">/exch/out_.csv</a><br/>
3. Процедура импорта не понимает русских имен файлов поэтому просьба переименовывать их латиницей<br/>
	</p>
	
	
	<h1>Нажмите на кнопку для загрузки нужных файлов</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<a href="/admin/csv">Обновить данные</a>
	
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '/public/js/uploadify.swf',
				'uploader' : '/public/js/uploadify.php'
			});
		});
	</script>


