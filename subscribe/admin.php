<? // WR-Subscribe v 1.2 // 28.10.10 �. // Miha-ingener@yandex.ru

error_reporting (E_ALL);

include "config.php";

$host=$_SERVER["HTTP_HOST"]; $self=$_SERVER["PHP_SELF"];
$sburl="http://$host$self"; $sburl=str_replace("/admin.php", "/addemail.php", $sburl);

$skey="54781"; // !!! ��������� ����. 
                // ��������� �� ���� � ��� ��� ������� ������� :-)
                // !!! ����� ����� - ������ ������ ���������� ���������!
                // ��� ��������� ������ ������ �������������� ������ � 77
                // �������� ���������� ��� � config.php � ���������� $password

// �����������
$adminname="1"; // ��� ��������������
$adminpass=$password;

// ������ ����� - ������� ����
if(isset($_GET['event'])) { if ($_GET['event']=="clearcooke") { setcookie("scrcookies","",time()-3600); Header("Location: ../subscribe/"); exit; } }

if (isset($_COOKIE['scrcookies'])) { // ������� ���/������ �� ���� � �������� � ������ �����
 $text=$_COOKIE['scrcookies'];
$text=trim($text); // �������� ���������� ������� 
if (strlen($text)>60) {print"������� ������ - ���� ������ �������"; exit;}
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
{sleep(1); setcookie("scrcookies", "0", time()-3600); Header("Location: admin.php"); exit;} // ������� �������� ����!!!

} else { // ���� ���� ���� ����

sleep(1); // ������ ������ �� �����. �������� 2 ������� �� ����� - � ����� �� ������� ����� - ����� �������� �����

if (isset($_POST['name']) & isset($_POST['pass'])) { // ���� ���� ���������� �� ����� ����� ������
$name=str_replace("|","I",$_POST['name']); $pass=str_replace("|","I",$_POST['pass']);
$text="$name|$pass|";
$text=trim($text); // �������� ���������� ������� 
if (strlen($text)<4) {print"$back �� �� ����� ��� ��� ������!"; exit;}
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

//$qq=md5("$pass+$skey"); print"$qq"; exit; // ������������� ��� ��������� MD5 ������ ������!

// ������� �������� ���/������ � �������� � ������ �����
if ($name==$adminname & md5("$pass+$skey")==$adminpass) 
{$tektime=time(); $scrcookies="$adminname|$adminpass|$tektime|";
setcookie("scrcookies", $scrcookies, time()+18000); Header("Location: admin.php"); exit;}
else {print "$back ��� ������ <B>��������</B>!</center>"; exit;}

} else { // ���� ���� ������, �� ������� ����� ����� ������

echo "<html><head><META HTTP-EQUIV='Pragma' CONTENT='no-cache'><META HTTP-EQUIV='Cache-Control' CONTENT='no-cache'><META content='text/html; charset=windows-1251' http-equiv=Content-Type></head><body>
<BR><BR><BR><center>
<form action='admin.php' method=POST name=pswrd>
������� ������: <BR>
<input type=password style='WIDTH: 120px; height:20px;' name=pass><BR>
<input type=hidden size=17 name=name value=\"$adminname\">
<input type=submit style='WIDTH: 120px; height:20px;' value='�����'>
<SCRIPT language=JavaScript>document.pswrd.pass.focus();</SCRIPT><BR><BR><BR>";
print "<BR><BR><center><small>Powered by <a href='http://www.wr-script.ru/'>WR-Subscribe</a> &copy; 1.2</small></body></html>";
exit;}

} // ����������� ��������!

$gbc=$_COOKIE['scrcookies']; $gbc=explode("|", $gbc); $gbname=$gbc[0];$gbpass=$gbc[1];$gbtime=$gbc[2];











// ���� ������������ ��� �������� ���������� ��������
if(isset($_GET['xduser'])) {
if ($_GET['xduser'] =="") {print"��������� ����-�������� :-("; exit;}

$xduser=$_GET['xduser']-1;
$file=file($basefile); $i=count($file);
if ($xduser<"1") {print "$back. 1 ������� �������� ��������! Ÿ <B>������ �������!</B>"; exit;}
if ($i<"3") {print "$back. ���������� �������� ������ <B>������</B> ���������!"; exit;}
// ������� ������ � ����������
$fp=fopen($basefile,"w");
flock ($fp,LOCK_EX);
for ($i=0;$i< sizeof($file);$i++) { if ($i==$xduser) {unset($file[$i]);} }
fputs($fp, implode("",$file));
flock ($fp,LOCK_UN);
fclose($fp);
Header("Location: admin.php?pswrd=$password&event=userwho"); exit; }





$shapka="<html><head>
<title>�������� WR-Subscribe 1.2</title>
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
<a href='admin.php?pswrd=$password&event=makeform'>����� ��� ��������</a> :: 
<a href='admin.php?pswrd=$password&event=config'>������������</a> :: 
<a href='admin.php?pswrd=$password&event=userwho'>����������</a> :: 
<a href='admin.php?pswrd=$password&event=subscribe'>������� ��������</a> :: 
<a href='admin.php?pswrd=$password&event=allsubscribe'>������������ ��������</a> :: 
<a href='admin.php?event=clearcooke'>�����</a>
</td></tr>
<tr><td width=100%>
";


// ������ �� �������
if(!isset($_GET['event'])) { print"$shapka <BR><BR><center><h3>�������� �������� � ������� ����.</h2><BR><BR></TD></TR></TABLE>"; }  // if !isset($event')




// ����� �����, ������� ���������� ���������� ��� �������
else  {
if ($_GET['event'] == "makeform") {

print"$shapka <BR><BR><center>

<form><textarea rows=20 cols=60>
<HTML>
<title>�������� WR-Subscribe 1.2</title>
<HEAD>
<META content='text/html; charset=windows-1251' http-equiv=Content-Type>
<STYLE> BODY {FONT-FAMILY: Verdana} TD {FONT-SIZE: 12px} </STYLE>
</HEAD>
<BODY bgcolor=#F3F3F3><center>



<!-- ��������� ��� ���� � �������� �� ���� ��������� -->


<script language=JavaScript>
<!--
function gosub() {
WRSub=window.open('$sburl','WRSub','width=350,height=150,left=200,top=200');
WRSub.focus();
}
//-->
</script>

<table border=1 cellspacing=1 cellpadding=0 width=230>
<tr height=25><td align=center><font size=3><B>��������</B></font></td></tr>
<tr><td bgcolor=#FFFFFF align=center>
<form action='$sburl' method='get' target='WRSub' name=REPLIER>����������� �� ������� ������ �����! �������� �����������.<BR>
���: &nbsp; <input type=text name=name size=20></font><br>
Email: <input type=text name=email size=20></font>
<input type=image border=0 src=subscribe.gif alt='��������!' onClick='gosub();'>
</form>
</td></tr>
</table>


<!-- ��������� ��� ���� � �������� �� ���� ��������� -->




</BODY>
</HTML>";

print"</textarea><BR><BR><BR></TD></TR></TABLE>";
}




if ($_GET['event']=="clearscribe")  {  // ���� ������� ������ ���������� ��������
$fp=fopen("allsubscribe.php","a");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//������� ���������� �����
fputs($fp,"<?die;?>\r\n");
fflush ($fp);
flock ($fp,LOCK_UN);
fclose($fp);
Header("Location: admin.php?pswrd=$password&event=allsubscribe"); exit; }





if ($_GET['event']=="subscribe")  {  // ��������� ��������� ��� ��������

if (isset($_GET['go']))  {

//$subscrname = "��������: '$sbname' �� $date";
$subscrname = $sbname;
$from="�������� ��������� ������� ����� Sait Project <$adminemail>";
$headers="Content-Type: text/html; charset=windows-1251\n";
$headers.="From: $from\nX-Mailer: WR-Subscribe mailer";

// �������������� � ���������� ������ �� ��������� ���� 1 ���
if (isset($_POST['msg'])) {
$msg=$_POST['msg'];
$file=file("msg.dat"); $i=count($file); // ������� ����� �� ��
$fp=fopen("msg.dat","w");
flock ($fp,LOCK_EX);
fputs($fp,$msg);
flock ($fp,LOCK_UN);
fclose($fp);

// ��������� � ���� ��������� ������������ ��������
$msg = str_replace("\r\n","<br>",$msg);
$ip=$_SERVER['REMOTE_ADDR']; // ���������� IP �����
$text="$subscrname|$msg|$date|$time|$ip|";
$fp=fopen("allsubscribe.php","a+");
flock ($fp,LOCK_EX);
fputs($fp,"$text\r\n");
fflush ($fp);
flock ($fp,LOCK_UN);
fclose($fp);
} // ����� �����: 1 ��� ���������� ������

// ��������� ���������� ����� ��� ��������
$msg=file_get_contents("msg.dat"); // ���������� ����� ��������� � ����������

if (isset($_GET['last'])) {$last=$_GET['last'];} else {$last=1;} $next=$last+$step;
$send_file=file($basefile);
$send_count=count($send_file);
if ($next>$send_count) {$next=$send_count;}

for ($sm=$last; $sm<$next; $sm++)  {
list($to,$kod)=explode("|", $send_file[$sm]);
$mailmsg=$msg; //$mailmsg.="\r\r\r\n � ������, ���� �� ������ ���������� �� �������� �������� ���������� � ������ �������� �� ����� vitanova.ru";
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
<B>�������� ������. ������� ����������: $per%.</B><BR> ����� ��������� ������ ����� ������������� ����������.<BR>
<B><a href='admin.php?pswrd=$password&event=subscribe&go=1&last=$last'>������� �����, ����� ���������� ����� ����� ��������</a></B></td></tr></table></td></tr></table></center></body></html>";
exit; }


print "<script language='Javascript'>function reload() {location = \"admin.php?pswrd=$password&event=allsubscribe\"}; setTimeout('reload()', 2000);</script>
<table width=100% height=80%><tr><td><table border=1 cellpadding=10 cellspacing=0 bordercolor=#224488 align=center valign=center width=60%><tr><td><center>
<B>�������� ��������.</B><BR> ����� ��������� ������ �� ������ ������������� ���������� � ������ ��� ��������� ���������� �� ������������ ��������.<BR>
<B><a href='admin.php?pswrd=$password&event=allsubscribe'>������� �����, ���� �� ������ ������ �����</a></B></td></tr></table></td></tr></table></center></body></html>";
exit; }

$userlines=file($basefile);
$ui=count($userlines)-1;

$mailtext=$top;
$mailtext.="\r\r\r\r\r\n $bottom";
$mailtext=str_replace("<br>","\r\n",$mailtext);

print"$shapka <center><BR><h3>������ �������� - html</h3><B>����� ����������� - <font color=#9B0000>$ui </font>���.</B>
<form action='admin.php?pswrd=$password&event=subscribe&go=1' method=post name=REPLIER>
<textarea name=msg rows=19 cols=90>$mailtext</textarea><br>
<input type=submit value='���������� � ���������'></form>
<table border=0 width=750 align=center><TR><TD><font color=red>��������!</font> �� ����������� ���������� �����. ��� ����������� �������� �������� �������� ����� ����� ���������� ��� �������� �����.
� ��� ��� ��������������� (� � ��������� ������� ��������) ���������� ������.</td></tr></table><BR>
</TD></TR></TABLE>";

// ����� ����� ���������
}




if ($_GET['event']=="allsubscribe")  {  // ��������� ������ �����Ĩ���� ��������
$sublines=file("allsubscribe.php");
$ui=count($sublines); $i=1;

if (isset($_GET['viewhtml']))  { // �������� ���������� �������� � ��� ����, ������� � ����� ���������
$view=$_GET['viewhtml']-1;
$viewdata=str_replace("<br>","\r\n",$sublines[$view]);
$tdt=explode("|",$viewdata);
print"$tdt[1]"; exit;}


if (isset($_GET['viewkod']))  { // �������� ���������� �������� � ���� ����
$view=$_GET['viewkod']-1;
$viewdata=str_replace("<br>","\r\n",$sublines[$view]);
$viewdata=htmlspecialchars($viewdata);
$viewdata=stripslashes($viewdata);
$viewdata=str_replace("\r\n","<br>",$viewdata);
$viewdata=str_replace(' ','&nbsp;',$viewdata);
$tdt=explode("|",$viewdata);

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>���������, ����, �����, IP</B></td>
<td><B>$tdt[0]</B>, &nbsp; $tdt[2], &nbsp; $tdt[3], &nbsp; $tdt[4]</td>
</tr><tr height=25 bgcolor=#FFFFFF>
<td align=center><B>����������</B></td>
<td><textarea readonly style='width:600px;height:600px'>$tdt[1]</textarea></td>
</tr></table> <BR>";
exit;}

$t1="#FFFFFF"; $t2="#EEEEEE";

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>� �/�</B></td>
<td><B>��������� ������ / �������� ����</B></td>
<td><B>�������� ����</B></td>
<td><B>����</B></td>
<td><B>�����</B></td>
<td><B>IP</B></td>
</tr>";

if ($ui>1) { // ���� ��� ���� �������� ��������
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
print "</table><BR> &nbsp;&nbsp; ����� ���������� �������� - <B>$ui</B><BR><BR>
<CENTER><form action='admin.php?pswrd=$password&event=clearscribe' method=POST><input type=submit value='�������� ������'></form>";

} else {print"</table><BR><BR><h3><center>�������� �� �������������</h3>";}  // if $ui>1

print"</td></tr></table>";
}





if ($_GET['event']=="userwho")  {  // �������� ���� �����������
$userlines=file($basefile);
$ui=count($userlines); $i="1";

$t1="#FFFFFF"; $t2="#EEEEEE";

print"$shapka <BR><table border=1 width=98% align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>.X.</B></td>
<td><B>E-mail</B></td>
<td><B>������</B></td>
<td><B>����</B></td>
<td><B>�����</B></td>
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
print "</table><BR>����� ���������������� ����������� - <B>$ui</B><BR><BR>
<CENTER><form action='addemail.php' method=GET target='WRSub'>
������ �����! &nbsp; <input type=text style='FONT-SIZE: 14px; WIDTH: 200px' name=email> &nbsp; 
<input type=submit value=' �������� '></form>
</td></tr></table>";
}






if ($_GET['event'] =="config")   {  // ���������������� - ����� ��������
$top=str_replace("<br>","\r\n","$top");
$bottom=str_replace("<br>","\r\n","$bottom");
if ($status=="1") {$m1="checked"; $m2="";} else {$m2="checked"; $m1="";}
if ($basefile=="debug.php") {$b1="checked"; $b2="";} else {$b2="checked"; $b1="";}
print "$shapka 
<BR><table border=1 width=650 align=center cellpadding=3 cellspacing=0 bordercolor=#DDDDDD class=forumline><tr bgcolor=#BBBBBB height=25 align=center>
<td><B>����������</B></td>
<td><B>��������</B></td></tr>
<form action='admin.php?pswrd=$password&event=confignext' method=post name=REPLIER>
<tr><td>�������� �������� (���� � ������)</td><td><input type=text value='$sbname' name=sbname size=55></td></tr>
<tr><td>��������� ��������</td><td><textarea rows=6 cols=50 name=top>$top</textarea></td></tr>
<tr><td>������� � ��������</td><td><textarea rows=6 cols=50 name=bottom>$bottom</textarea></td></tr>

<tr><td>������� ����������� ���������� ����� �� ����?</td><td><input type=text value='$step' name=step size=10 maxlength=2> ������������� �������� 10-30 ������� / ����</td></tr>

<tr><td>����� �������� �������� </td><td><input type=radio name=basefile value=\"debug.php\"$b1> ����������&nbsp; <input type=radio name=basefile value=\"base.php\"$b2> ������</td></tr>

<tr><td>����� ������</td><td><input type=text value='$adminemail' name=adminemail size=30></tr></td>
<tr><td>������ ������ *</td><td><input name=password type=hidden value='$password'><input type=text value='�����' name=newpassword size=15> (����������) * ����������� ������ ����� �/��� �����!&nbsp;&nbsp;</td></tr>
<tr><td> </td><td><input type=radio name=status value=\"1\"$m1> ����������&nbsp; <input type=radio name=status value=\"0\"$m2> ������</td></tr>

<tr><td colspan=2><BR><center><input type=submit value='��������� ������������'>

</form></td></tr></table><BR></td></tr></table>";
}





// ���������������� ��� 2 - ���������� ������
if ($_GET['event'] =="confignext")  {

$top=str_replace("\r\n","<br>",$_POST['top']);
$bottom=str_replace("\r\n","<br>",$_POST['bottom']);

if (strlen($_POST['newpassword'])<1) {print"$back ����������� ����� ������ ������� 1 ������!";}
if ($_POST['newpassword']!="�����") {$pass=trim($_POST['newpassword']); $_POST['password']=md5("$pass+$skey");}

$configdata="<? // WR-Subscribe v 1.2 // 28.10.10 �. // Miha-ingener@yandex.ru\r\r\n".
"$"."sbname=\"".$_POST['sbname']."\"; // �������� �������� (���� � ������)\r\n".
"$"."top=\"".$top."\"; // ��������� ��������\r\n".
"$"."bottom=\"".$bottom."\"; // ������� � ��������\r\n".
"$"."password=\"".$_POST['password']."\"; // ������ ������\r\n".
"$"."adminemail=\"".$_POST['adminemail']."\"; // ����� ������\r\r\n".

"$"."step=\"".$_POST['step']."\"; // ������� ����������� ���������� ����� �� ����?\r\n".
"$"."status=\"".$_POST['status']."\"; // ���������/������������� �������� �� ��������\r\n".
"$"."date=date(\"d.m.Y\"); // �����.�����.���\r\n".
"$"."time=date(\"H:i:s\"); // ����:������:�������\r\n".
"$"."basefile=\"".$_POST['basefile']."\"; // ��� ����� ���� ������\r\n".
"$"."back=\"<center>��������� <a href='javascript:history.back(1)'><B>�����</B></a>\"; // ������� ������\r\n";


$file=file("config.php");
$fp=fopen("config.php","a+");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//������� ���������� �����
fputs($fp,$configdata);
fflush ($fp);//�������� ��������� ������
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("config.php", 0644);

Header("Location: admin.php?pswrd=$_POST[password]"); exit; }

} // if isset $event




print"<BR><small>������� <b>$date</b></small>";

?>
</td></tr></table></td></tr></table>
<center><font size=-2>Powered by <a href="http://www.wr-script.ru/" target="_blank" class="copyright">WR-Subscribe</a> &copy;<br /></font></center>
</body></html>
