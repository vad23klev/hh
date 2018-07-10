<?
	//$cat = ORM::factory('categorie')->where('id','=',$good[0]['category_id'])->find();
	$feeds = DB::query(Database::SELECT, 'SELECT ss_feeds.cts,ss_feeds.text,ss_useratts.fio FROM ss_feeds LEFT JOIN ss_useratts ON ss_feeds.user_id = ss_useratts.user_id WHERE product_id='.$prod->id.' ORDER BY ss_feeds.cts DESC')->execute()->as_array();	
?>
<?$user=ORM::factory('useratt')->where('user_id','=',$prod->user_id)->find()?>
Здравствуйте <?=$user->fio?> (<?=$user->shortname?>)!<br />
<?if ($state==2):?>
На Ваше обращение № <?=sprintf('%06d',$prod->id)?>  подготовлен ответ. <br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта НП Провэд.<br />
Был создан новый тикет N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; пользователя N <?=sprintf('%06d',$prod->user_id)?>.<br />
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
<br/><br/>
<img src="http://board.proved-np.org/img/logo.png" />
<br/><br/>
<a href="https://www.facebook.com/provednp">Официальная страница НП ПРОВЭД на Facebook. <br/>
Присоединяйтесь!</a><br/>
 <br/>
<a href="http://www.linkedin.com/company/non-commercial-partnership-for-foreign-trade-proved-?trk=top_nav_home">Follow us! PROVED Partnership Group Page on LinkedIn.<br/>
Learn more about us - PROVED Partnership Official Page on LinkedIn.</a><br/>
 <br/>
<br/>
<p style="font-size:90%">
Данное уведомление сформировано автоматически и не предполагает ответа. Пожалуйста, не отвечайте на него. Связаться со службой поддержки НП “ПРОВЭД” можно по электронной почте info@proved-np.org.
<br/><br/>
© 2015. Некоммерческое партнерство профессионалов и участников внешнеэкономической деятельности "ПРОВЭД"
</p>