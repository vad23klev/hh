<a href="/admin/goods?<?=$cstr?>&id=<?=$cid->id?>"><?=$cid->name?></a>
<br/><br/>
	<?php
        print form::open(URL::site()."/admin/imgs?".$cstr."&cid=".$cid,array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("good",1);
        print form::hidden("cat",$cid->id);
        print form::hidden("add","1");

        print "<table width='700' border='1' cellpadding='4' cellspacing='0'>\n<tr>";
        print "<td>";
//        print "<br>Описание:<br>";
//        print form::textarea('description', '');
        print "</td>";
        print "</tr><tr>\n";		
        print "<td>";
        //.$good->id
        //javascript:OutFoto(this.files[0].getAsDataURL()
        $attributes = array('name' => 'foto');
        echo form::file("foto");
        print "<br>Загрузить фото:<br>";
        //print "<img src='".$url."/prod_pics/".$good->id."-m.jpg'>";
        print "</td>";

        print "</tr>";


        print "</table>";        

        print form::submit('submit', 'Изменить данные');
        echo form::close();
?>

<?foreach ($goods as $good) :?>
	    <?php
        print form::open(URL::site()."/admin/imgs?".$cstr."&cid=".$cid,array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("cat",$cid);
        print form::hidden("prod",$good->id);        
        print form::hidden("edit","1");

        print "<table width='700' border='1' cellpadding='4' cellspacing='0'>";
        print "<tr>";
        print "<td>";
/*        print "<b>".$good->id."</b>";
        print "<br>Позиция:<br>";
        print form::input('pos', $good->pos);
        print "</td>";
        print "</tr><tr>";
        print "<td>";
        print "<br>Описание:<br>";
        print form::textarea('description', $good->description);
        print "</td>";
        print "</tr><tr>";
        print "</tr><tr>\n";
        print "<td>\n";
        print "<b>Ширина</b>\n";
        print form::input('width', $good->width);
        print "</td>";
        print "</tr><tr>";

        print "</tr><tr>\n";
        print "<td>\n";
        print "<b>Высота</b>\n";
        print form::input('height', $good->height);*/
        print "</td>";
        print "</tr><tr>";


        print "<td>";
        //.$good->id
        //javascript:OutFoto(this.files[0].getAsDataURL()
        $attributes = array('name' => 'foto');
        echo form::file("foto");
        print "<div id='newfoto".$good->id."2'>";

        print "</div><br>";
		print "<a href='/img/photos/".$good->name."'>".$good->name."</a><br>";
        //print "</div>";
		
		print "<a href='".URL::site()."admin/imgs/?".$cstr."&cid=".$cid."&del&id=".$good->id."'>Удалить фото</a>";
        print "</td>";

        print "</tr>";


        print "</table>";
    ?>    
    <?php
    print form::submit('submit', 'Сохранить изменения');
    echo form::close();?>
    <br>
<?endforeach?>	


