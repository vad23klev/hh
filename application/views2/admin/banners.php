<?if ($type!=1):?>
<h1>Баннеры</h1>
<table><tr><td>
<?foreach ($prods as $prod) :?>
<div style="float:left;display:block;width:140px;height:170px;margin:10px;margin-bottom:15px;">
<div style="height:20px;overflow:hidden;text-align:center">
<?=$prod->name?>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td colspan="2" style="background:#e2e2e2;height:130px;">
	<a href="/admin/banners?id=<?=$prod->id?>&type=1">
	<div style="width:140px;height:150px;overflow:hidden">
	<img src="<?=URL::site()?>img/banners/<?=$prod->filename?>" width="140px" border="0"/>
	</div>
	</a>
</td></tr><tr>
<td style="padding-left:10px;background:#e2e2e2">
	<a href="/admin/banners?id=<?=$prod->id?>&type=1">изменить</a> &nbsp;
	</td><td width="26px" style="background:#e2e2e2">
	<a href="/admin/banners/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')">удалить</a>&nbsp;
</td></tr></table>
	
</div>
<?endforeach?>

</td></tr><tr><td>
<div>
<br/>
<a href="<?=URL::site()?>admin/banners?type=1" style="color:#aeee00;font-size:19px">Добавить баннер</a><br/>
</div>
</td></tr></table>
<?endif?>
<?if ($type==1):?>
<h1><a href="/admin/banners" style="font-size:19px;color: #008ED7;">Баннеры</a> / <?=$page1->name?></h1>

<?php


        echo form::open(URL::site()."admin/banners",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
        print "<table  cellpadding='4' cellspacing='0'>";
        print "<tr><td width='500'>";
		
        print "<table width='500' cellpadding='4' cellspacing='0'>";
        print "<tr><td width='200'>";
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>описание:</b>";
        print "</td><td>";
        print form::input('description', $page1->description);
        print "</td></tr>";

		        print "<tr><td width='200' valign='top'>";
        print "<b>Файл:</b><br/><small>маленький баннер : ширина 221xN<br/>
большой баннер 300х181</small>";
        print "</td><td>";
		
		print "<img src='/img/banners/".$page1->filename."' ><br/><br/>";
        print form::file('banner');
		print "</td></tr>";
		
        print "<tr><td width='200'>";
        print "<b>Порядок:</b>";
        print "</td><td>";
        print form::input('sort', $page1->sort);
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Ссылка:</b>";
        print "</td><td>";
		print form::input('link', $page1->link);
		print "</td></tr>";
		
		$types = array("1"=>"Сверху","2"=>"Справа сверху","3"=>"Справа снизу");
        print "<tr><td width='200'>";
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

		
		
        print "<tr><td width='200'>";
        print "<b>показывать баннер:</b>";
        print "</td><td>";
		print form::hidden('enabled', '0');
		?>
		<input type="checkbox" name="enabled" value="1" <?if($page1->enabled==1):?>checked<?endif?>/>

        <?

        print "</td></tr>";

        print "</table><br/>";
        echo "<input type='submit' value='Изменить данные' />";
        //print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";
		
		print "</tr></table>";
			
?>
<?endif?>