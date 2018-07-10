<script type="text/javascript">    
	var count_courses=1;    
    function addColor(){
		pl=document.getElementById("cat"+(count_courses-1)).innerHTML;
		newdiv=document.createElement("div");
		plcont=document.getElementById("cat");
		plcont.appendChild(newdiv);
		re=/\'cat[0-9]*\'+/g;		
		pl=pl.replace(re,"'cat"+count_courses+"'");
		newdiv.innerHTML=pl;
		newdiv.setAttribute("id","cat"+count_courses);
		count_courses++;
	}

	function removeColor(id){
		par=document.getElementById('cat');
		par.removeChild(document.getElementById(id));
		count_courses--;
	}
	
</script>	
<table><tr>
<td width="250px" valign="top">		
<table>
<?foreach ($prods as $prod) :?>
<tr><td>
	
</td>
<td>
	<a href="<?=URL::site()?>admin/shops?id=<?=$prod->id?>"><?=$prod->name?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/shops/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
</td>
</tr>
<?endforeach?>
<tr><td colspan="4"  valign="top">
<br/><br/>
<a href="<?=URL::site()?>admin/shops">Добавить магазин</a><br/>

</td>
</tr>


</table>

</td><td valign="top">
<?php


        echo form::open(URL::site()."admin/shops",array('method'=>'POST','enctype' => 'multipart/form-data'));

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
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";
	
	        print "<tr><td width='200'>";
        print "<b>Телефон:</b>";
        print "</td><td>";
        print form::input('phone', $page1->phone);
        print "</td></tr>";

	        print "<tr><td width='200'>";
        print "<b>Адрес:</b>";
        print "</td><td>";
        print form::input('addr', $page1->addr);
        print "</td></tr>";
		print "<tr><td width='200'>";
        print "<b>карта:</b>";
        print "</td><td>";
        print form::textarea('map', $page1->map);
        print "</td></tr>";


		print "<tr><td width='200'>";
        print "<b>Порядок:</b>";
        print "</td><td>";
        print form::input('pos', $page1->pos);
        print "</td></tr>";
        //print form::input('rgb', $page1->rgb);
?>
<tr><td><b>Список брендов</b></td><td>
<table cellspacing="2">
<?foreach ($brands as $brand) :?>
<tr><td>
<?=$brand->name?>
</td><td>
<a href='<?=URL::site()?>admin/shops?mid=<?=$brand->id?>&id=<?=$page1->id?>&dm=1'>Удалить</a>
</td>
<?endforeach?>
</tr></table>
</td></tr>
<tr>
<td><b>Управление брендами</b></td>
<td>

<div id="cat">
<div id="cat0">
<select name="brandlist[]">
<option value="0">-</option>
<?foreach ($brandlist as $color):?>
	<option value="<?=$color->id?>"><?=$color->name?></option>
<?endforeach?>
</select>

<br/><a href="javascript:removeColor('cat1');">Удалить бренд</a><br/>
</div> 
</div>
<a href="javascript:addColor();">Добавить бренд</a>


</td>


</tr>

<?
		print "<tr><td width='200'>";
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";
?>




<?
		print "</tr></table>";
			
?>
<?if ($page1->id !=0):?>
<a href="/admin/shopimgs?cid=<?=$page1->id?>">Фото магазина</a>
<?endif?>

<?//=str_replace("admin","admin/sizes",$pagination)?>
</td></tr></table>


