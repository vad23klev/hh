<?php

		$link = mysql_connect('mysql5.peterlink.ru','vitanovawww','DLPAA6XA') or die ('DB error 1');
		mysql_select_db('vitanovawww') or die ('DB error 2');
		mysql_query("set names 'cp1251'");

		
		
		$result = mysql_query("SELECT id,lastname,name,surname,mail FROM user WHERE  mail<>'' AND subscribe=1") or die(mysql_error());
		
		$i=0;
		
		$filename = "base.php";
		$fp = fopen($filename,"w");

//n_zab@rbcmail.ru|67080|29.09.2011|14:55:55|81.222.237.18|Николай||||
		fwrite($fp,"<?die;?>");
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
			
			echo $i % 50 ."<br/>";
			//
			fwrite($fp,$line["mail"]."|".sprintf("%05d", $line["id"])."||||".$line["lastname"]." ".$line["name"]." ".$line["surname"]."||||\n");

			$i++;
			
			//
		}
		
		fclose($fp);
		mysql_free_result($result);
		mysql_close($link);

?>