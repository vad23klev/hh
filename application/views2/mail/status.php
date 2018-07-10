<?if ($state==2):?>
Здравствуйте, пользователь N <?=sprintf('%06d',$prod->user_id)?>.<br />
<br />
<?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot;. Статус Вашей заявки изменен на '<?=$status?>'<br />
<br />
<?=$message?>
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта <br />
Статус заявки <?=sprintf('%06d',$prod->id)?> изменен на '<?=$status?>'<br />
<br />
<?=$message?>
<?endif?>
<br />
<?if (strlen($prod->admin)>0):?>
	<?=$prod->admin?>
<?endif?>
