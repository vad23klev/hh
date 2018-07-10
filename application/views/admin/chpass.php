<h1>Смена пароля:</h1>

<?php

        echo form::open($url."/admin/chpass",array('method'=>'POST'));
		
		print form::hidden("edit","1");
		
        print "<table width='100%' border='0' cellpadding='4'>";

		print "<tr><td width='200'>";
        print "<b>Новый пароль: </b>";
        print "</td><td>";
        print form::input('pass1', '');
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Подтвердите пароль: </b>";
        print "</td><td>";
        print form::input('pass2','');
        print "</td></tr>";
        
		print "</table>";
		print form::submit('submit', 'Сохранить изменения');
        print "<br><br>";
        echo form::close();



?>