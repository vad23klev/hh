<?$user=ORM::factory('useratt')->where('user_id','=',$prod->user_id)->find()?>
<?$saletypes = array(0=>'Ваша заявка успешно создана и направлена потенциальным исполнителям.',1=>'Ваш вопрос направлен соответствующим экспертам-консультантам НП "ПРОВЭД".')?>
<?$saletypes1 = array(0=>'Заявка в сфере',1=>'Вопрос в сфере')?>
<?$saletypes2 = array(0=>'Описание задачи',1=>'Вопрос')?>
Здравствуйте, <b><?=$user->fio?> (<?=$user->shortname?>)</b>.<br />
<br />

<?=$saletypes[$prod->sale_type]?><br />

<br />
<b>Дата:</b> ( <?=date('d.m.Y H:i',$prod->cts)?>)<br /> 
<b><?=$saletypes1[$prod->sale_type]?></b>: <?$cat=ORM::factory('categorie')->where('id','=',$prod->category_id)->find()?>
<?=$cat->name?><br/>
<b>Тема:</b> <?=$prod->title?><br/>
<b><?=$saletypes2[$prod->sale_type]?>:</b> <?=$prod->name?>
<br />

<br />
С уважением,<br /> НП «ПРОВЭД

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