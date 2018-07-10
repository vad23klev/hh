<?if ($type!=1):?>
<h1>Продукты</h1>
<table>
<tr><td valign="top">

<?foreach ($prods as $prod) :?>
<div style="float:left;display:block;width:140px;height:170px;margin:10px;">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>

<td colspan="2" style="background:#e2e2e2;text-align:center">
<?=$prod->name?>
</td>
</tr><tr>
<td colspan="2" style="background:#e2e2e2;height:130px;text-align:center">
	<a href="/admin/services?id=<?=$prod->id?>&type=1">
	<img src="<?=URL::site()?>img/service/<?=$prod->filename?>" height="130px" border="0"/>
	</a>
</td></tr><tr>
<td style="padding-left:10px;background:#e2e2e2">
	<a href="/admin/services?id=<?=$prod->id?>&type=1">изменить</a> &nbsp;
	</td><td width="26px" style="background:#e2e2e2">
	<a href="/admin/services/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')">удалить</a>&nbsp;
</td></tr></table>
	
</div>
<?endforeach?>

<div style="clear:both">
</div>

<a href="<?=URL::site()?>admin/services?type=1" style="color:#aeee00;font-size:19px">Добавить продукт</a><br/>
<?endif?>
<?if ($type==1):?>
<h1><a href="/admin/services" style="font-size:19px;color: #008ED7;">Продукты</a> / <?=$page1->name?></h1>
<?php


        echo form::open(URL::site()."admin/services",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
		
        print "<table border='0' cellpadding='4' >";
        print "<tr><td width='150'>";
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";

        print "<tr><td width='150' valign='top'>";
        print "<b>Описание:</b>";
        print "</td><td>";
		print "<textarea cols=\"80\" id=\"description\" name=\"description\" rows=\"20\">".$page1->description."</textarea>";
        print "</td></tr>";
		print "<div style='display:none'>";
		print "<textarea cols=\"80\" id=\"long_description\" name=\"long_description\" rows=\"10\">".$page1->long_description."</textarea>";
		print "</div>";
		        print "<tr><td width='150' valign='top'>";
        print "<b>Файл:</b><br/><small>маленький 122х122<br/>большой 220 × 462</small>";
        print "</td><td>";
		print "<img src='/img/service/".$page1->filename."' width='100px'><br/><br/>";
        print form::file('banner');
		print "</td></tr>";
		print "<div style='display:none'>";
        print form::hidden('link', $page1->link);
		print form::input('sort', $page1->sort);
		print "</div>";
		
		$types = array("1"=>"Наверху","2"=>"Внизу");
        print "<tr><td width='150'>";
        print "<b>Положение:</b>";
        print "</td><td>";
		
		echo "<select name='type'>";
		foreach ($types as $i=>$v)
		{
			echo "<option value='".$i."'";
			if ($i==$page1->type)
				echo "selected";
			echo ">".$v."</option>";
		}
		echo "</select>";
		print "</td></tr>";

		
		
        print "<tr><td width='150'>";
        print "<b>показывать баннер:</b>";
        print "</td><td>";
  		print form::hidden('enabled', '0');
		?>
		<input type="checkbox" name="enabled" value="1" <?if($page1->enabled==1):?>checked<?endif?>/>

        <?

		
		print "</td></tr><tr><td></td><td valign='top'>";
		
        print "</tr>";

        print "</table>";
        
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();

			
?>
<?=$pagination?>

</td></tr></table>
        <script type="text/javascript">
//var ckeditor1 = CKEDITOR.replace('description');

//AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

//var ckeditor2 = CKEDITOR.replace('long_description');

//AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor2, path: '/AjexFileManager/'});
</script>
<?endif?>
