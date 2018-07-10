<? // WR-Subscribe v 1.2 // 28.10.10 г. // Miha-ingener@yandex.ru

error_reporting (E_ALL);

include "config.php";

$host=$_SERVER["HTTP_HOST"]; $self=$_SERVER["PHP_SELF"];
$sburl="http://$host$self"; $sburl=str_replace("/admin.php", "/addemail.php", $sburl);

$skey="54781"; // !!! Секретный ключ. 
                // Поменяйте на свой и фиг кто вскроет админку :-)
                // !!! ПОСЛЕ СМЕНЫ - пароль админа становится ошибочным!
                // для получения нового пароля разкоменируйте строку № 77
                // вставьте полученный код в config.php а переменную $password

// Авторизация
$adminname="1"; // имя администратора
$adminpass=$password;

// Выбран ВЫХОД - очищаем куки
if(isset($_GET['event'])) { if ($_GET['event']=="clearcooke") { setcookie("scrcookies","",time()-3600); Header("Location: ../subscribe/"); exit; } }

if (isset($_COOKIE['scrcookies'])) { // Сверяем имя/пароль из КУКИ с заданным в конфиг файле
 $text=$_COOKIE['scrcookies'];
$text=trim($text); // Вырезает ПРОБЕЛьные символы 
if (strlen($text)>60) {print"Попытка взлома - куки сильно большие"; exit;}
$text=preg_replace( "/<script/i",' ',$text);
$text=str_replace( "<!--",'&#60;&#33;--',$text);
$text=str_replace( "-->",'--&#62;',$text);
$text=str_replace( "&#032;",' ',$text);
$text=str_replace( "&",'&amp;',$text);
$text=str_replace( ">",'&gt;',$text);
$text=str_replace( "<",'&lt;',$text);
$text=str_replace( "\"",'&quot;',$text);
$text=preg_replace( "/\n\n/",'<p>',$text);
$text=preg_replace( "/\n/",'<br>',$text);
$text=preg_replace( "/\\\$/",'&#036;',$text);
$text=preg_replace( "/\r/",'',$text);
$text=preg_replace( "/\\\/",'&#092;',$text);
$text=str_replace("\r\n","<br>",$text);
$text=str_replace("\n\n",'<p>',$text);
$text=str_replace("\n",'<br>',$text);
$text=str_replace("\t",'',$text);
$text=str_replace("\r",'',$text);
$text=str_replace('   ',' ',$text);
$exd=explode("|",$text); $name1=$exd[0]; $pass1=$exd[1];
if ($name1!=$adminname or $pass1!=$adminpass) 
{sleep(1); setcookie("scrcookies", "0", time()-3600); Header("Location: admin.php"); exit;} // убаваем НЕВЕРНУЮ КУКУ!!!

} else { // ЕСЛИ ваще нету КУКИ

sleep(1); // мелкая защита от БОТОВ. Человеку 2 секунды не время - а прога по подбору ключа - будет работать долго

if (isset($_POST['name']) & isset($_POST['pass'])) { // Если есть переменные из формы ввода пароля
$name=str_replace("|","I",$_POST['name']); $pass=str_replace("|","I",$_POST['pass']);
$text="$name|$pass|";
$text=trim($text); // Вырезает ПРОБЕЛьные символы 
if (strlen($text)<4) {print"$back Вы не ввели имя или пароль!"; exit;}
$text=preg_replace( "/<script/i",' ',$text);
$text=str_replace( "<!--",'&#60;&#33;--',$text);
$text=str_replace( "-->",'--&#62;',$text);
$text=str_replace( "&#032;",' ',$text);
$text=str_replace( "&",'&amp;',$text);
$text=str_replace( ">",'&gt;',$text);
$text=str_replace( "<",'&lt;',$text);
$text=str_replace( "\"",'&quot;',$text);
$text=preg_replace( "/\n\n/",'<p>',$text);
$text=preg_replace( "/\n/",'<br>',$text);
$text=preg_replace( "/\\\$/",'&#036;',$text);
$text=preg_replace( "/\r/",'',$text);
$text=preg_replace( "/\\\/",'&#092;',$text);
$text=str_replace("\r\n","<br>",$text);
$text=str_replace("\n\n",'<p>',$text);
$text=str_replace("\n",'<br>',$text);
$text=str_replace("\t",'',$text);
$text=str_replace("\r",'',$text);
$text=str_replace('   ',' ',$text);
$exd=explode("|",$text); $name=$exd[0]; $pass=$exd[1];

//$qq=md5("$pass+$skey"); print"$qq"; exit; // РАЗБЛОКИРУЙТЕ для получения MD5 своего пароля!

// Сверяем введённое имя/пароль с заданным в конфиг файле
if ($name==$adminname & md5("$pass+$skey")==$adminpass) 
{$tektime=time(); $scrcookies="$adminname|$adminpass|$tektime|";
setcookie("scrcookies", $scrcookies, time()+18000); Header("Location: admin.php"); exit;}
else {print "$back Ваш данные <B>ОШИБОЧНЫ</B>!</center>"; exit;}

} else { // если нету данных, то выводим ФОРМУ ввода пароля

echo "<html><head><META HTTP-EQUIV='Pragma' CONTENT='no-cache'><META HTTP-EQUIV='Cache-Control' CONTENT='no-cache'><META content='text/html; charset=windows-1251' http-equiv=Content-Type></head><body>
<BR><BR><BR><center>
<form action='admin.php' method=POST name=pswrd>
Введите пароль: <BR>
<input type=password style='WIDTH: 120px; height:20px;' name=pass><BR>
<input type=hidden size=17 name=name value=\"$adminname\">
<input type=submit style='WIDTH: 120px; height:20px;' value='Войти'>
<SCRIPT language=JavaScript>document.pswrd.pass.focus();</SCRIPT><BR><BR><BR>";
print "<BR><BR><center><small>Powered by <a href='http://www.wr-script.ru/'>WR-Subscribe</a> &copy; 1.2</small></body></html>";
exit;}

} // АВТОРИЗАЦИЯ ПРОЙДЕНА!

$gbc=$_COOKIE['scrcookies']; $gbc=explode("|", $gbc); $gbname=$gbc[0];$gbpass=$gbc[1];$gbtime=$gbc[2];











// Блок используется для удаления ПОДПИСЧИКА рассылки
if(isset($_GET['xduser'])) {
if ($_GET['xduser'] =="") {print"произошёл глюк-переглюк :-("; exit;}

$xduser=$_GET['xduser']-1;
$file=file($basefile); $i=count($file);
if ($xduser<"1") {print "$back. 1 строкая является защитной! Её <B>НЕЛЬЗЯ УДАЛЯТЬ!</B>"; exit;}
if ($i<"3") {print "$back. Необходимо оставить хотябы <B>ОДНОГО</B> участника!"; exit;}
// удаляем строку с участником
$fp=fopen($basefile,"w");
flock ($fp,LOCK_EX);
for ($i=0;$i< sizeof($file);$i++) { if ($i==$xduser) {unset($file[$i]);} }
fputs($fp, implode("",$file));
flock ($fp,LOCK_UN);
fclose($fp);
Header("Location: admin.php?pswrd=$password&event=userwho"); exit; }





$shapka="<html><head>
<title>Рассылка WR-Subscribe 1.2</title>
<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">
<META HTTP-EQUIV=\"Cache-Control\" CONTENT=\"no-cache\">
<META content='text/html; charset=windows-1251' http-equiv=Content-Type>
<style>
BODY {FONT-FAMILY: Verdana}

a {text-decoration: underline; color: #000000;}
a:visited {text-decoration: underline; color: #000000;}
a:hover, a:active {text-decoration: underline; color: #FF9C00;}

A.about_menu {TEXT-DECORATION: none}
A.about_menu:hover {COLOR: #996600}
A.pagesLine {COLOR: #006600}
A.menu {COLOR: #666666; TEXT-DECORATION: none}
A.menu:hover {COLOR: #009900; TEXT-DECORATION: none}

.maininput {FONT-SIZE: 12px; WIDTH: 200px; font-size: 10; color: 000000; border: #808080 1 solid;}
.simpleok {WIDTH: 50px; height:18px; background-color: cccccc; font-size: 10; color: 000000; font-weight: bold; border: #808080 1 solid;}
.longok {WIDTH: 100px; height:20px; background-color: cccccc; font-size: 10; color: 000000; border: #808080 1 solid;}

.small {FONT-SIZE: 11px;}
.smallest {FONT-SIZE: 9px;}

TD {FONT-SIZE: 11px}
TD.menu {FONT-SIZE: 11px; FONT-WEIGHT: bold}
TD.big_item_title {FONT-SIZE: 13px; FONT-WEIGHT: bold}
TD.pagesLine {FONT-SIZE: 10px}

#copyright {FONT-SIZE: 10px; font-color: #666666}
</STYLE>
</head>
<body bgcolor=\"#F3F3F3\"><center>

<table width=100% cellpadding=1 cellspacing=0 border=1 bordercolor=#666666>
<TR height=30><TD align=center class=big_item_title>
<b>
<a href='admin.php?pswrd=$password&event=makeform'>Форма для подписки</a> :: 
<a href='admin.php?pswrd=$password&event=config'>Конфигурация</a> :: 
<a href='admin.php?pswrd=$password&event=userwho'>Подписчики</a> :: 
<a href='admin.php?pswrd=$password&event=subscribe'>Создать рассылку</a> :: 
<a href='admin.php?pswrd=$password&event=allsubscribe'>Отправленные рассылки</a> :: 
<a href='admin.php?event=clearcooke'>ВЫХОД</a>
</td></tr>
<tr><td width=100%>
";


// ничего не выбрано
if(!isset($_GET['event'])) { print"$shapka <BR><BR><center><h3>Выберите действие в верхнем меню.</h2><BR><BR></TD></TR></TABLE>"; }  // if !isset($event')




// Вывод формы, которую необходимо установить для пописки
else  {
if ($_GET['event'] == "makeform") {

print"$shapka <BR><BR><center>

<form><textarea rows=20 cols=60>
<HTML>
<title>Рассылка WR-Subscribe 1.2</title>
<HEAD>
<META content='text/html; charset=windows-1251' http-equiv=Content-Type>
<STYLE> BODY {FONT-FAMILY: Verdana} TD {FONT-SIZE: 12px} </STYLE>
</HEAD>
<BODY bgcolor=#F3F3F3><center>



<!-- Скопируте код НИЖЕ и вставьте на вашу страничку -->


<script language=JavaScript>
<!--
function gosub() {
WRSub=window.open('$sburl','WRSub','width=350,height=150,left=200,top=200');
WRSub.focus();
}
//-->
</script>

<table border=1 cellspacing=1 cellpadding=0 width=230>
<tr height=25><td align=center><font size=3><B>Рассылка</B></font></td></tr>
<tr><td bgcolor=#FFFFFF align=center>
<form action='$sburl' method='get' target='WRSub' name=REPLIER>Подпишитесь на новости нашего сайта! Рассылка ежемесячная.<BR>
Имя: &nbsp; <input type=text name=name size=20></font><br>
Email: <input type=text name=email size=20></font>
<input type=image border=0 src=subscribe.gif alt='Попишись!' onClick='gosub();'>
</form>
</td></tr>
</table>


<!-- Скопируте код ВЫШЕ и вставьте на вашу страничку -->




</BODY>
</HTML>";

print"</textarea><BR><BR><BR></TD></TR></TABLE>";
}




if ($_GET['event']=="clearscribe")  {  // Блок ОЧИЩАЕТ СПИСОК проведённых РАССЫЛОК
$fp=fopen("allsubscribe.php","a");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//УДАЛЯЕМ СОДЕРЖИМОЕ ФАЙЛА
fputs($fp,"<?die;?>\r\n");
fflush ($fp);
flock ($fp,LOCK_UN);
fclose($fp);
Header("Location: admin.php?pswrd=$password&event=allsubscribe"); exit; }





if ($_GET['event']=="subscribe")  {  // Формируем сообщение для отправки

if (isset($_GET['go']))  {

//$subscrname = "Рассылка: '$sbname' от $date";
$subscrname = $sbname;
$from="Интернет агентство полного цикла Sait Project <$adminemail>";
$headers="Content-Type: text/html; charset=windows-1251\n";
$headers.="From: $from\nX-Mailer: WR-Subscribe mailer";

// Подготавливаем и записываем данные во временный файл 1 раз
if (isset($_POST['msg'])) {
$msg=$_POST['msg'];
$file=file("msg.dat"); $i=count($file); // удаляем юзера из БД
$fp=fopen("msg.dat","w");
flock ($fp,LOCK_EX);
fputs($fp,$msg);
flock ($fp,LOCK_UN);
fclose($fp);

// сохраняем в файл сообщение отправленной рассылки
$msg = str_replace("\r\n","<br>",$msg);
$ip=$_SERVER['REMOTE_ADDR']; // определяем IP юзера
$text="$subscrname|$msg|$date|$time|$ip|";
$fp=fopen("allsubscribe.php","a+");
flock ($fp,LOCK_EX);
fputs($fp,"$text\r\n");
fflush ($fp);
flock ($fp,LOCK_UN);
fclose($fp);
} // конец блока: 1 раз записываем данные

// Считываем содержимое файла для отправки
$msg=file_get_contents("msg.dat"); // содержимое файла считываем в переменную

if (isset($_GET['last'])) {$last=$_GET['last'];} else {$last=1;} $next=$last+$step;
$send_file=file($basefile);
$send_count=count($send_file);
if ($next>$send_count) {$next=$send_count;}

for ($sm=$last; $sm<$next; $sm++)  {
list($to,$kod)=explode("|", $send_file[$sm]);
$mailmsg=$msg; //$mailmsg.="\r\r\r\n В случае, если Вы хотите отписаться от рассылки измените информацию в личном кабинете на сайте vitanova.ru";
$mailmsg = stripslashes($mailmsg);

//$fp = fopen('check.txt','w');
$res = mail($to,$subscrname,$mailmsg,$headers);
//fwrite($res."-".$to,$fp);
//fclose($fp);
} 
$last=$next;
if (($last)<$send_count) {$per=round(100*$last/$send_count);
print "<script language='Javascript'>function reload() {location = \"admin.php?pswrd=$password&event=subscribe&go=1&last=$last\"}; setTimeout('reload()', 2000);</script>
<table width=100% height=80%><tr><td><table border=1 cellpadding=10 cellspacing=0 bordercolor=#224488 align=center valign=center width=60%><tr><td><center>
<B>Рассылка начата. Успешно отправлено: $per%.</B><BR> Через несколько секунд будет автоматически продолжена.<BR>
<B><a href='admin.php?pswrd=$password&event=subscribe&go=1&last=$last'>Нажмите здесь, чтобы пропустить паузу между пакетами</a></B></td></tr></table></td></tr></table></center></body></html>";
exit; }


print "<script language='Javascript'>function reload() {location = \"admin.php?pswrd=$password&event=allsubscribe\"}; setTimeout('reload()', 2000);</script>
<table width=100% height=80%><tr><td><table border=1 cellpadding=10 cellspacing=0 bordercolor=#224488 align=center valign=center width=60%><tr><td><center>
<B>Рассылка окончена.</B><BR> Через несколько секунд Вы будете автоматически перемещены в раздел для просмотра информации об отправленной рассылке.<BR>
<B><a href='admin.php?pswrd=$password&event=allsubscribe'>Нажмите здесь, если не хотите больше ждать</a></B></td></tr></table></td></tr></table></center></body></html>";
exit; }

$userlines=file($basefile);
$ui=count($userlines)-1;

$mailtext=$top;
$mailtext.="\r\r\r\r\r\n $bottom";
$mailtext=str_replace("<br>","\r\n",$mailtext);

print"$shapka <center><BR><h3>Формат рассылки - html</h3><B>Всего подписчиков - <font color=#9B0000>$ui </font>чел.</B>
<form action='admin.php?pswrd=$password&event=subscribe&go=1' method=post name=REPLIER>
<textarea name=msg rows=19 cols=90>$mailtext</textarea><br>
<input type=submit value='Посмотреть и отправить'></form>
<table border=0 width=750 align=center><TR><TD><font color=red>Внимание!</font> Не увлекайтесь рассылками писем. При определённых условиях массовую рассылку писем можно трактовать как рассылку СПАМа.
А это уже административно (а в некоторых странах уголовно) наказуемое дияние.</td></tr></table><BR>
</TD></TR></TABLE>";

// здесь нужно сохранить
}




if ($_GET['event']=="allsubscribe")  {  // Формируем СПИСОК ПРОВЕДЁННЫХ РАССЫЛОК
$sublines=file("allsubscribe.php");
$ui=count($sublines); $i=1;

if (isset($_GET['viewhtml']))  { // просмотр проведённой рассылки в том виде, котором её видит ПОДПИСЧИК
$view=$_GET['viewhtml']-1;
$viewdata=str_replace("<br>","\r\n",$sublines[$view]);
$tdt=explode("|",$viewdata);
print"$tdt[1]"; exit;}


if (isset($_GET['viewkod']))  { // просмотр проведённой рассылки в виде КОДА
$view=$_GET['viewkod']-1;
$viewdata=str_replace("<br>","\r\n",$sublines[$view]);
$viewdata=htmlspecialchars($viewdata);
$viewdata=stripslashes($viewdata);
$viewdata=str_replace("\r\n","<br>",$viewdata);
$viewdata=str_replace(' ','&nbsp;',$viewdata);
$tdt=explode("|",$viewdata);

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>Заголовок, Дата, Время, IP</B></td>
<td><B>$tdt[0]</B>, &nbsp; $tdt[2], &nbsp; $tdt[3], &nbsp; $tdt[4]</td>
</tr><tr height=25 bgcolor=#FFFFFF>
<td align=center><B>Содержание</B></td>
<td><textarea readonly style='width:600px;height:600px'>$tdt[1]</textarea></td>
</tr></table> <BR>";
exit;}

$t1="#FFFFFF"; $t2="#EEEEEE";

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>№ п/п</B></td>
<td><B>Заголовок письма / Просмотр кода</B></td>
<td><B>Просмотр вида</B></td>
<td><B>Дата</B></td>
<td><B>Время</B></td>
<td><B>IP</B></td>
</tr>";

if ($ui>1) { // Если уже были проведны рассылки
do {$tdt = explode("|", $sublines[$i]); $i++;
$num=$i-1;
print"<tr align=center height=25 bgcolor=$t1>
<td align=center><B>$num</B></td>
<td align=left><a href='admin.php?pswrd=$password&event=allsubscribe&viewkod=$i'>$tdt[0]</a></td>
<td><a href='admin.php?pswrd=$password&event=allsubscribe&viewhtml=$i'>html</a></td>
<td align=center>$tdt[2] &nbsp;</td>
<td>$tdt[3] &nbsp;</td>
<td>$tdt[4] &nbsp;</td>
</tr>";

$t3=$t2; $t2=$t1; $t1=$t3;
} while ($i<$ui);
$ui--;
print "</table><BR> &nbsp;&nbsp; Всего отправлено рассылок - <B>$ui</B><BR><BR>
<CENTER><form action='admin.php?pswrd=$password&event=clearscribe' method=POST><input type=submit value='Очистить список'></form>";

} else {print"</table><BR><BR><h3><center>Рассылки не производились</h3>";}  // if $ui>1

print"</td></tr></table>";
}





if ($_GET['event']=="userwho")  {  // просмотр всех ПОДПИСЧИКОВ
$userlines=file($basefile);
$ui=count($userlines); $i="1";

$t1="#FFFFFF"; $t2="#EEEEEE";

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>.X.</B></td>
<td><B>E-mail</B></td>
<td><B>Пароль</B></td>
<td><B>Дата</B></td>
<td><B>Время</B></td>
<td><B>IP</B></td>
</tr>";

do {$tdt = explode("|", $userlines[$i]); $i++;

print"<tr bgcolor=$t1>
<td align=center><table><tr><td width=10 bgcolor=#FF2244><B><a href='admin.php?pswrd=$password&xduser=$i'>.X.</a></B></td></tr></table></td>
<td><a href=\"mailto:$tdt[0]\">$tdt[0]</a></td>
<td align=center>$tdt[1] &nbsp;</td>
<td>$tdt[2] &nbsp;</td>
<td>$tdt[3] &nbsp;</td>
<td>$tdt[4] &nbsp;</td>
</tr>";

$t3=$t2; $t2=$t1; $t1=$t3;
} while ($i<$ui);
$ui--;
print "</table><BR>Всего зарегистрировано подписчиков - <B>$ui</B><BR><BR>
<CENTER><form action='addemail.php' method=GET target='WRSub'>
Добавь друга! &nbsp; <input type=text style='FONT-SIZE: 14px; WIDTH: 200px' name=email> &nbsp; 
<input type=submit value=' добавить '></form>
</td></tr></table>";
}






if ($_GET['event'] =="config")   {  // КОНФИГУРИРОВАНИЕ - выбор настроек
$top=str_replace("<br>","\r\n","$top");
$bottom=str_replace("<br>","\r\n","$bottom");
if ($status=="1") {$m1="checked"; $m2="";} else {$m2="checked"; $m1="";}
if ($basefile=="debug.php") {$b1="checked"; $b2="";} else {$b2="checked"; $b1="";}
print "$shapka 
<BR><table border=1 width=650 align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>Переменная</B></td>
<td><B>Значение</B></td></tr>
<form action='admin.php?pswrd=$password&event=confignext' method=post name=REPLIER>
<tr><td>Название рассылки (тема в письме)</td><td><input type=text value='$sbname' name=sbname size=55></td></tr>
<tr><td>Заголовок рассылки</td><td><textarea rows=6 cols=50 name=top>$top</textarea></td></tr>
<tr><td>Подпись в рассылке</td><td><textarea rows=6 cols=50 name=bottom>$bottom</textarea></td></tr>

<tr><td>Скольки подписчикам отправлять пиьма за этап?</td><td><input type=text value='$step' name=step size=10 maxlength=2> Рекомендуемое значение 10-30 человек / этап</td></tr>

<tr><td>Режим отправки рассылки </td><td><input type=radio name=basefile value=\"debug.php\"$b1> отладочный&nbsp; <input type=radio name=basefile value=\"base.php\"$b2> полный</td></tr>

<tr><td>Емайл админа</td><td><input type=text value='$adminemail' name=adminemail size=30></tr></td>
<tr><td>Пароль админа *</td><td><input name=password type=hidden value='$password'><input type=text value='скрыт' name=newpassword size=15> (зашифрован) * используйте только буквы и/или цифры!&nbsp;&nbsp;</td></tr>
<tr><td> </td><td><input type=radio name=status value=\"1\"$m1> отладочный&nbsp; <input type=radio name=status value=\"0\"$m2> полный</td></tr>

<tr><td colspan=2><BR><center><input type=submit value='Сохранить конфигурацию'>

</form></td></tr></table><BR></td></tr></table>";
}





// Конфигурирование ШАГ 2 - сохранение данных
if ($_GET['event'] =="confignext")  {

$top=str_replace("\r\n","<br>",$_POST['top']);
$bottom=str_replace("\r\n","<br>",$_POST['bottom']);

if (strlen($_POST['newpassword'])<1) {print"$back разрешается длина пароля МИНИМУМ 1 символ!";}
if ($_POST['newpassword']!="скрыт") {$pass=trim($_POST['newpassword']); $_POST['password']=md5("$pass+$skey");}

$configdata="<? // WR-Subscribe v 1.2 // 28.10.10 г. // Miha-ingener@yandex.ru\r\r\n".
"$"."sbname=\"".$_POST['sbname']."\"; // Название рассылки (тема в письме)\r\n".
"$"."top=\"".$top."\"; // Заголовок рассылки\r\n".
"$"."bottom=\"".$bottom."\"; // Подпись в рассылке\r\n".
"$"."password=\"".$_POST['password']."\"; // Пароль админа\r\n".
"$"."adminemail=\"".$_POST['adminemail']."\"; // Емайл админа\r\r\n".

"$"."step=\"".$_POST['step']."\"; // Скольки подписчикам отправлять пиьма за этап?\r\n".
"$"."status=\"".$_POST['status']."\"; // Разрешить/приостановить подписку на рассылку\r\n".
"$"."date=date(\"d.m.Y\"); // число.месяц.год\r\n".
"$"."time=date(\"H:i:s\"); // часы:минуты:секунды\r\n".
"$"."basefile=\"".$_POST['basefile']."\"; // Имя файла базы данных\r\n".
"$"."back=\"<center>Вернитесь <a href='javascript:history.back(1)'><B>назад</B></a>\"; // Удобная строка\r\n";


$file=file("config.php");
$fp=fopen("config.php","a+");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//УДАЛЯЕМ СОДЕРЖИМОЕ ФАЙЛА
fputs($fp,$configdata);
fflush ($fp);//очищение файлового буфера
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("config.php", 0644);

Header("Location: admin.php?pswrd=$_POST[password]"); exit; }

} // if isset $event




print"<BR><small>Сегодня <b>$date</b></small>";

?>
</td></tr></table></td></tr></table>
<center><font size=-2>Powered by <a href="http://www.wr-script.ru/" target="_blank" class="copyright">WR-Subscribe</a> &copy;<br /></font></center>
</body></html>
