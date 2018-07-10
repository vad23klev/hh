<? // WR-Subscribe v 1.2 // 28.10.10 г. // Miha-ingener@yandex.ru

include ("config.php");

function shablon($msg,$title) { print"<html><title>$title</title><HEAD<META content='text/html; charset=windows-1251' http-equiv=Content-Type><STYLE> BODY {FONT-FAMILY: Verdana} TD {FONT-SIZE: 13px} </STYLE></HEAD><body><table width=100% height=100% align=center bgcolor=000000><tr><td align=center bgcolor=#DFDFDF><font color=000080>$msg</font><BR><BR><a href='' onClick='self.close()'><b>Закрыть окно</b></a></td></tr></table></body></html>"; return true; }

function replacer ($text) { // ФУНКЦИЯ очистки кода
$text=str_replace("&#032;",' ',$text);
$text=str_replace("&",'&amp;',$text); // закоментируйте эту строку если вы используете языки: Украинский, Татарский, Башкирский и т.д.
$text=str_replace(">",'&gt;',$text);
$text=str_replace("<",'&lt;',$text);
$text=str_replace("\"",'&quot;',$text);
$text=preg_replace("/\n\n/",'<p>',$text);
$text=preg_replace("/\n/",'<br>',$text);
$text=preg_replace("/\\\$/",'&#036;',$text);
$text=preg_replace("/\r/",'',$text);
$text=preg_replace("/\\\/",'&#092;',$text);
$text=str_replace("\r\n","<br> ",$text);
$text=str_replace("\n\n",'<p>',$text);
$text=str_replace("\n",'<br> ',$text);
$text=str_replace("\t",'',$text);
$text=str_replace("\r",'',$text);
$text=str_replace('   ',' ',$text);
return $text; }

// Блок ОТПИСКИ от РАССЫЛКИ
if (isset($_GET['unsubscribe'])) { $kod=replacer($_GET['unsubscribe']);

if (!ctype_digit($kod) or strlen($kod)>20) exit("<B>$back. Попытка взлома. Хакерам здесь не место.</B>");

$lines=file("$basefile"); $count=count($lines);
for ($b=1; $b<$count; $b++) {$dt=explode("|",$lines[$b]); if ($dt[1]==$kod) {$ok=$b;}}

if (!isset($ok)) {shablon("Ошибка! <BR>Подписчика с таким кодом<B> в базе нет</B> !","Ошибка!"); exit;}

$file=file("database.php"); $i=count($file); // удаляем юзера из БД
$fp=fopen("database.php","w");
flock ($fp,LOCK_EX);
for ($i=0;$i< sizeof($file);$i++) { if ($i==$ok) {unset($file[$i]);} }
fputs($fp, implode("",$file));
flock ($fp,LOCK_UN);
fclose($fp);
shablon("<B>Вы успешно отписаны</B> от рассылки!","Вы отписаны!"); exit;
}


if ($status!="1") {shablon("Рассылка <B>временно приостановлена</B> администратором","ОТКАЗАНО!"); exit;}

else {  // Если ПОДПИСКА РАЗРЕШЕНА В КОНФИГЕ


if (!isset($_GET['email'])) {shablon("Ошибка - Вы не ввели email!","Ошибка!"); exit;} else $email=replacer($_GET['email']);
if (!isset($_GET['name'])) {shablon("Ошибка - Вы не ввели Имя!","Ошибка!"); exit;} else $name=replacer($_GET['name']);
// Преобразовываем емайл: в нижний регистр, чикаем html-тэги, вырезаем слэши
$email=strtolower($email);
$email=str_replace("|","I",$email);
$name=str_replace("|","I",$name);
if(!preg_match("/^[a-z0-9\.\-_]+@[a-z0-9\-_]+\.([a-z0-9\-_]+\.)*?[a-z]+$/is", $email) or $email=="" or strlen($email)>35) {shablon("Ошибка!<BR> <B>$email</B> - такого emailа в природе не существует!","Ошибка!"); exit;}

$lines=file("$basefile");
$count=count($lines);
for ($b=1; $b<$count; $b++) { list($mailsinbase)=explode("|",$lines[$b]); if ($email == "$mailsinbase") {shablon("Ошибка!<BR> <B>$email</B> - такой email уже есть в базе!","Ошибка!"); exit;} }

// "КОЛДУЕМ" рандомный (случайный) КОД подписчика
$i=1; do {$randkey=mt_rand(10000,99999); if (strlen($randkey)==5) {$i++;} } while ($i<=1);
$ip=$_SERVER['REMOTE_ADDR']; // определяем IP юзера

$fp=fopen("$basefile","a");
fputs ($fp,"$email|$randkey|$date|$time|$ip|$name||||\r\n");
fclose ($fp);
shablon("<B>Вы успешно подписаны</B> на рассылку!","Вы подписаны!"); exit;
}

?>
