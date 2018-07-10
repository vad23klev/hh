<?
	//$cat = ORM::factory('categorie')->where('id','=',$good[0]['category_id'])->find();
	$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.cts,ss_feeds.text,ss_useratts.fio FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id.' ORDER BY ss_feeds.cts DESC')->execute()->as_array();	
?>
<?$user=ORM::factory('useratt')->where('user_id','=',$prod->user_id)->find()?>
<?$user1=ORM::factory('useratt')->where('user_id','=',$prod->expert_id)->find()?>
Здравствуйте <?=$user->fio?>!<br />
<?if ($state==2):?>
Ваше обращение № <?=sprintf('%06d',$prod->id)?> выбран для консультации поставщик услуг <?=$user1->fio?>. <br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта НП Провэд.<br />
тикет N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; пользователя N <?=sprintf('%06d',$prod->user_id)?> выбран для консультации поставщик услуг <?=$user1->fio?>.<br />
<br />
<?endif?>

<br/><br/>
**************************
<br/><br/>
<b>Ваше обращение</b> (<?=date('d.m.Y H:i',$prod->cts)?>)<br /> 
<b>Тема:</b> <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?> <?=$cat->name?><br /> 
<b>Вопрос:</b> <?=$prod->name?>
<br/><br/>
<b>Ответ эксперта НП ПРОВЭД</b> (<?=date('d.m.Y H:i',$feeds[0]['cts'])?>)
<br/><br/>
<?=$feeds[0]['text']?>
<br/><br/>
**************************
<br />
<br />
С уважением,<br /> 
НП «ПРОВЭД»