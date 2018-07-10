<a href="/admin/goods?<?=$cstr?>&id=<?=$cid->id?>"><?=$cid->name?></a>
<br/><br/>
	<?php
        print form::open(URL::site()."/admin/imgs/?".$cstr."&cid=".$cid,array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("good",1);
        print form::hidden("cat",$cid->id);
        print form::hidden("add","1");

        print "<table width='700' border='1' cellpadding='4' cellspacing='0'>\n";
        print "<tr>\n";
        print "<td>\n";
        print "<b>Позиция</b>\n";
        print form::input('pos', '');
        print "</td>";

        print "</tr><tr>";
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
        print form::open(URL::site()."/admin/imgs/?".$cstr."&cid=".$cid,array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("cat",$cid);
        print form::hidden("prod",$good->id);        
        print form::hidden("edit","1");

        print "<table width='700' border='1' cellpadding='4' cellspacing='0'>";
        print "<tr>";
        print "<td>";
        print "<b>".$good->id."</b>";
        print "<br>Позиция:<br>";
        print form::input('pos', $good->pos);
        print "</td>";
        print "</tr><tr>";
        print "<td>";
        //.$good->id
        //javascript:OutFoto(this.files[0].getAsDataURL()
        $attributes = array('name' => 'foto');
        echo form::file("foto");
        print "<div id='newfoto".$good->id."2'>";

        print "</div><br>";
        print "<img id='newfoto".$good->id."' vspace='4'>";
        //print "</div>";
        print "<br>текущее фото:<br>";
        print "<img src='".URL::site()."img/photos/".$good->name."' width='100px'><br/>";
		
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


