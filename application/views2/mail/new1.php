<?
	//$cat = ORM::factory('categorie')->where('id','=',$good[0]['category_id'])->find();
	$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.cts,ss_feeds.text,ss_useratts.fio FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id.' ORDER BY ss_feeds.cts DESC')->execute()->as_array();	
?>
<?$user=ORM::factory('useratt')->where('user_id','=',$prod->user_id)->find()?>

<?if ($state==2):?>
Здравствуйте,  <?=$user->fio?>.<br />
<br />
Ваше обращение № <?=sprintf('%06d',$feeds[0]['id'])?> &quot;<?=$prod->name?>&quot; было успешно зарегистрировано.<br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта НП Провэд.<br />
Был создан новый тикет N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; пользователя N <?=sprintf('%06d',$prod->user_id)?>.<br />
<br />
<?endif?>

************* Тикет *************<br />

<h4>Оставлен <?=date('d.m.Y H:i',$feeds[0]['cts'])?> <?=$feeds[0]['fio']?></h4>
<?=$feeds[0]['text']?>
<hr/>

************************************************************************<br />

<b>Наименование:</b><?=$prod->name?><br/>
<b>Тема:</b> <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?> <?=$cat->name?><br/>
<b>Вопрос:</b> <?=$prod->description?><br/>

************************************************************************<br />
<br />

<?foreach ($feeds as $i=>$feed) :?>
<h4>Ответ эксперта НП ПРОВЭД (<?=date('d.m.Y H:i',$feed['cts'])?>)</h4>
<?=$feed['text']?>
<hr/>
<?endforeach?>

<br />
<br />
С уважением, НП «ПРОВЭД

<?if ($state==2):?>
На Ваше обращение № <?=sprintf('%06d',$feeds[0]['id'])?>  подготовлен ответ. 
<br />
Ваше обращение № <?=sprintf('%06d',$feeds[0]['id'])?> &quot;<?=$prod->name?>&quot; было успешно зарегистрировано.<br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта НП Провэд.<br />
Был создан новый тикет N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; пользователя N <?=sprintf('%06d',$prod->user_id)?>.<br />
<br />
<?endif?>

<br/><br/>
**************************
<br/><br/>
Ваше обращение (07.05.2014 18:04)
Тема: <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?> <?=$cat->name?>
Вопрос: <?=$prod->name?>
<br/><br/>
Ответ эксперта НП ПРОВЭД (<?=date('d.m.Y H:i',$feeds[0]['cts'])?>)
<br/><br/>
<?=$feeds[0]['text']?>
<br/><br/>
**************************
<br />
<br />
С уважением, <br />
НП «ПРОВЭД»