

<h3>Типы доставки:</h3>
<table>
<tr>
<td width="250px" valign="top">

<table>
<tr><td colspan="4"  valign="top">
<a href="<?=URL::site()?>admin/deliver">Добавить тип доставки</a><br/>
</td>
</tr>
<?foreach ($lmenu as $prod) :?>
<tr><td>
	
</td>
<td>
	<a href="<?=URL::site()?>admin/deliver?id=<?=$prod->id?>"><?=$prod->name?> - <?=$prod->cost?> руб.</a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/deliver/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
</td>
</tr>
<?endforeach?>

</table>




</td>
<td valign="top">
<?php
//        include 'ckeditor/ckeditor.php';
//        $CKEditor = new CKEditor();
//        $CKEditor->basePath = $url."ckeditor/";
    
        echo form::open("admin/deliver",array('method'=>'POST'));

        print form::hidden("id",$page->id);
        if ($page->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        print "<table width='100%' border='0' cellpadding='4'>\n";
        print "<tr><td width='200'>\n";
        print "<b>Наименование: </b>\n";
        print "</td><td>\n";
		print "<input type='text' name='name' value='".$page->name."' style='width:300px;'>";
        
        print "</td></tr>\n";

		print "<tr><td width='200'>\n";
        print "<b>Стоимость: (0 - для вывода надписи уточняйте у админов)</b>\n";
        print "</td><td>\n";
		if (!isset($page->cost))
		{
			$page->cost = 0;
		}
		print "<input type='text' name='cost' value='".$page->cost."' style='width:300px;'>";
        //print form::input('cost', $page->cost);



		
		
		print "</table>";
		
		print form::submit('submit', 'Сохранить изменения');
        print "<br><br>";
        echo form::close();
		
		
?>
</td>
</tr>
</table>