<?php
        include 'ckeditor/ckeditor.php';
        $CKEditor = new CKEditor();
	$CKEditor->basePath = $url."ckeditor/";

        echo form::open($url."index.php/".$type,array('method'=>'POST'));

        print form::hidden("prod","$page->id");
        if ($page->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
        print "<table width='500' border='0' cellpadding='4'>";
        print "<tr><td width='200'>";
        print "<b>Название страницы: </b>";
        print "</td><td>";
        print form::input('name', $page->name,'size="50"');
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Псевдоним:</b>";
        print "</td><td>";
        print form::input('alias', $page->alias,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Порядок:</b>";
        print "</td><td>";
        print form::input('sort', $page->sort,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Заголовок браузера:</b>";
        print "</td><td>";
        print form::input('title', $page->title,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Заголовок страницы:</b>";
        print "</td><td>";
        print form::input('h1', $page->h1,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Ключевые слова:</b>";
        print "</td><td>";
        print form::input('keywords', $page->keywords,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Описание:</b>";
        print "</td><td>";
        print form::input('description', $page->description,'size="50"');
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Отображать страницу:</b>";
        print "</td><td>";
        print form::checkbox('enabled', '1',$page->enabled);
        print "</td></tr>";

        print "</table>";

        echo $CKEditor->editor("html", $page->html);
        
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
?>