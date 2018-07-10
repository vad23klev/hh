<table><tr>
<td width="250px" valign="top">		
<table>
<tr><td colspan="4">
<a href="<?=URL::site()?>admin/materials">Добавить материал</a><br/>
</td>
</tr>
<?foreach ($prods as $prod) :?>
<tr><td>
<img src="<?=URL::site()?>img/material/<?=$prod->picture?>" width="100px" />
</td>
<td>
	<a href="<?=URL::site()?>admin/materials?id=<?=$prod->id?>"><?=$prod->name?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/materials/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
</td>
</tr>
<?endforeach?>

</table>
<?=$pagination?>




</td><td>
<?php


        echo form::open(URL::site()."admin/materials",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
        print "<table width='100%' border='0' cellpadding='4'>";
        print "<tr><td>";
		
        print "<table width='100%' border='0' cellpadding='4'>";
        print "<tr><td width='200'>";
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>описание:</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" id=\"html\" name=\"descr\" rows=\"10\">".$page1->descr."</textarea>";
        print "</td></tr>";

		        print "<tr><td width='200'>";
        print "<b>Файл:</b>";
        print "</td><td>";
        print form::file('banner');
		print "</td></tr>";
		
		print "<tr><td width='200'>";
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";
		print "</tr></table>";
			
?>
<table>
</td></tr></table>


        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('descr');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

</script>
