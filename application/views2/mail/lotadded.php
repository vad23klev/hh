<?if ($state==2):?>
Здравствуйте, пользователь N <?=sprintf('%06d',$prod->user_id)?>.<br />
<br />
Вы успешно добавили лот N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; на торги.<br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта BID-BID.<br />
Добавлен лот <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; пользователя N <?=sprintf('%06d',$prod->user_id)?><br />
<br />
<?endif?>


*************<br />
<strong>Наименование:</strong> <?=$prod->name?><br/>
<strong>Описание:</strong> <?=$prod->description?><br/>
<strong>Состояние:</strong> <?=$prod->photo_description?><br/>
<strong>Провенанс:</strong> <?=$prod->opts?><br/>
<strong>Доставка:</strong> <?=$prod->del?><br/>
<strong>Местонахождение:</strong> <?=$prod->title?><br/>
<strong>Дата начала торгов:</strong> <?=date("d.m.Y H:i:s",$prod->begin_date)?><br/>
<strong>Дата окончания торгов:</strong> <?=date("d.m.Y H:i:s",$prod->end_date)?><br/>
*************<br />
<?if ($state==2):?>
<br />
Посмотреть  всю  историю ставок по лоту N <?=sprintf('%06d',$prod->id)?> Вы можете по ссылке <a href="http://<?=$_SERVER['HTTP_HOST']?><?=$prod->parent_chpu?>/<?=$prod->alias?>.html"><?=$prod->name?></a> или в личном кабинете в разделе &quot;Мои<br />
лоты-Открытые&quot;.<br />
<?endif?>
<br />
Удачных торгов :)

