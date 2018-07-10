<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>

<h1><a href="/admin/anews" style="font-size:19px;color: #008ED7;">Новости</a> / <?=$page->name?>


<!--a href="<?=URL::site()?>admin/news">Добавить новость</a-->
<br/><br/>

<!--strong><a href="<?=URL::site()?>admin/categories?id=<?//=$cat->id?>"><?//=$cat->name?></a></strong><br/><br/-->

<?php
//        include 'ckeditor/ckeditor.php';
//        $CKEditor = new CKEditor();
//        $CKEditor->basePath = $url."ckeditor/";
    
        echo form::open(URL::site()."admin/news?page=".$page,array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("id",$page->id);
        if ($page->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }
		print form::hidden("id",$page->id);
        print "<table width='100%' border='0' cellpadding='4'>\n";
        print "<tr><td width='200'>\n";
        print "<b>Анонс: </b>\n";
        print "</td><td>\n";
        print form::input('name', $page->name);
        print "</td></tr>\n";

		print "<tr><td width='200'>\n";
        print "<b>Дата:</b>\n";
        print "</td><td>\n";
		echo "<input type='text' value='".$page->date."' id='date' name='date'/>";
?>
<img id="f_trigger_a"
			onmouseout="this.style.background=''"
			onmouseover="this.style.background='red';"
			title="Выбрать дату" style="border: 1px solid red; cursor: pointer;"
			src="<?=URL::site()?>public/js/calendar/img.gif"/>

		<script type="text/javascript">
			Calendar.setup({
			inputField : "date", // id of the input field
			ifFormat : "%Y-%m-%d", // format of the input field
			button : "f_trigger_a", // trigger for the calendar (button ID)
			//align : "Tl", // alignment (defaults to "Bl")
			singleClick : true
		});
		</script>
				

<?php		
		
		
        print "</td></tr>\n";
?>		
	<tr><td>
	Категория новости
</td><td>	
	<select name="cat">
	<!--option value="0" >-</option-->
	<?foreach ($cats as $i=>$cat) :?>	
		<option value="<?=$cat->id?>" <?if ($cat->id == $page->category_id):?>selected<?endif?>><?=$cat->name?></option>
	<?endforeach?>
	</select>
</td></tr>
		
<?		

		print "<tr><td width='200'>\n";
        print "<b>Анонс новости:</b>\n";
        print "</td><td>\n";
        print "<textarea cols=\"80\" id=\"announce\" name=\"announce\" rows=\"10\">".$page->announce."</textarea>\n";
//        echo $CKEditor->editor("html", $cats->html);
        print "</td></tr>";


		print "<tr><td width='200'>\n";
        print "<b>Текст новости:</b>\n";
        print "</td><td>\n";
        print "<textarea cols=\"80\" id=\"text\" name=\"text\" rows=\"10\">".$page->text."</textarea>\n";
//        echo $CKEditor->editor("html", $cats->html);
        print "</td></tr>";

		
		print "<tr><td width='200' valign='top'>";
        print "<b>Превью:</b><br/><small>размер загружайемой картинки 150х100</small>";
        print "</td><td>";

		if (file_exists("img/news/".$page->picture)) {
			echo "<img src='/img/news/".$page->picture."' width='150px;'/><br/><br/>";
		}
		
		if (strlen($page->picture)>0) {
			print "<a href='".URL::site()."admin/news?cid=".$cat->id."&id=".$page->id."&di=1'>Удалить</a><br/>";
		}

		

        print form::file('foto');
        //print form::input('description', $cats->description,'size="50"');
        print "</td></tr>";
		
        print "<tr><td width='200'>";
        print "<b>Отображать новость на сайте:</b>";
        print "</td><td>";
		echo "<input type='hidden' name='enabled' value='0'>"; 
		echo "<input type='checkbox' name='enabled' value='1'"; 
		if ($page->enabled == 1) {
			echo "checked";
		}
		echo "/>";
		
        //print form::input('description', $cats->description,'size="50"');
        print "</td></tr>";

		
		
		print "</table>";
		
		print form::submit('submit', 'Сохранить изменения');
        print "<br><br>";
        echo form::close();
		
		
?>


<script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('text');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

var ckeditor2 = CKEDITOR.replace('announce');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor2, path: '/AjexFileManager/'});



</script>