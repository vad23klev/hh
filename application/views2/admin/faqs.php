
<table><tr>
<td width="250px" valign="top">		
<table>
<?foreach ($prods as $prod) :?>
<tr><td>
	
</td>
<td>
	<a href="<?=URL::site()?>admin/afaqs?id=<?=$prod->id?>"><?=$prod->question?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/afaqs/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
</td>
</tr>
<?endforeach?>
<tr><td colspan="4"  valign="top">
<br/><br/>
<a href="<?=URL::site()?>admin/afaqs">Добавить вопрос</a><br/>

</td>
</tr>


</table>

</td><td valign="top">
<?php


        echo form::open(URL::site()."admin/afaqs",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
        print "<table width='100%' border='0' cellpadding='4'>";
        print "<tr><td >";
		
        print "<table width='100%' border='0' cellpadding='4'>";
        print "<tr><td width='200'>";
        print "<b>Категория:</b>";
        print "</td><td>";
		?>
		<select name="category_id">
		<?foreach ($cats as $cat):?>
			<option value="<?=$cat->id?>" <?if ($cat->id==$page1->category_id):?>selected<?endif?>><?=$cat->name?></option>
		<?endforeach?>
		</select>
		
		
		<?
//        print form::input('name', $page1->value);
        print "</td></tr>";
	
	        print "<tr><td width='200'>";
        print "<b>Телефон:</b>";
        print "</td><td>";
        print form::textarea('question', $page1->question);
        print "</td></tr>";

	        print "<tr><td width='200'>";
        print "<b>Адрес:</b>";
        print "</td><td>";
        print form::textarea('answer', $page1->answer);
        print "</td></tr>";



/*		print "<tr><td width='200'>";
        print "<b>Порядок:</b>";
        print "</td><td>";
        print form::input('pos', $page1->pos);
        print "</td></tr>";*/
        //print form::input('rgb', $page1->rgb);

		print "<tr><td width='200'>";
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";

		print "</tr></table>";
			
?>
<?//=str_replace("admin","admin/sizes",$pagination)?>
</td></tr></table>
        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('answer');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

</script>

