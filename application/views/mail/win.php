<?if ($state==2):?>
<p>BID-BID: завершены торги по лоту N <?=sprintf('%06d',$prod->id)?>, победителя - нет<br />
  <br />
  Торги по Вашему лоту N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; - завершены.<br />
Последняя ставка <?=$bet['summa']?> руб. по Вашему лоту  - победила!<br />
<?endif?>

<?if ($state==0):?>
Здравствуйте, Администратор сайта BID-BID.<br />
Торги по лоту N <?=sprintf('%06d',$prod->id)?> &quot;<?=$prod->name?>&quot; - завершены.<br />
Последняя ставка <?=$bet['summa']?> руб. по лоту  - победила!<br />
<br />
<?endif?>


*************<br />
<table cellpadding="4">
<tr><td width="400px">лот:</td><td>N <?=sprintf('%06d',$prod->id)?></td></tr>
<tr><td>время и дата ставки:</td><td><?=$bet['timestamp']?></td></tr>
<tr><td>окончание торгов:</td><td><?=$enddate?></td></tr>
<tr><td>размер новой ставки:</td><td><?=$bet['summa']?> руб.</td></tr>
<tr><td>прирост ставки:</td><td><?=$diff?> руб.</td></tr>
<tr><td>ставку сделал пользователь:</td><td>N <?=sprintf('%06d',$bet['user_id'])?></td></tr>
<tr><td>резервная цена:</td><td><?if ($prod->price2>0):?><?=$prod->price2?> руб.<?else:?>нет<?endif?></td></tr>
<tr><td>выкупная цена (блиц-цена):</td><td><?if ($prod->price4>0):?><?=$prod->price4?> руб.<?else:?>нет<?endif?></td></tr>
<tr><td>стартовая цена:</td><td><?if ($prod->Price>0):?><?=$prod->Price?> руб.<?else:?>нет<?endif?></td></tr>
</tr>
</table>
*************<br />
<br />
<?if ($state==2):?>
<br />
Посмотреть  всю  историю ставок по лоту N <?=sprintf('%06d',$prod->id)?> Вы можете по ссылке <a href="http://<?=$_SERVER['HTTP_HOST']?>/<?=$prod->parent_chpu?>/<?=$prod->alias?>.html"><?=$prod->name?></a> или в личном кабинете в разделе &quot;Мои<br />
лоты-Завершенные&quot;.<br />
<br />
<?endif?>
Поздравляем с успешной продажей!<br />
<br />
Удачных торгов :)</p>
<p>С уважением<br />
Администрация аукциона BID-BID</p>