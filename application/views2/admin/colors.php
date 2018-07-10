<!--script src="<?=URL::site()?>jp2/js/jquery/jquery.js" type="text/javascript"></script>
	<script src="<?=URL::site()?>jp2/js/jquery/ifx.js" type="text/javascript"></script>
	<script src="<?=URL::site()?>jp2/js/jquery/idrop.js" type="text/javascript"></script>
	<script src="<?=URL::site()?>jp2/js/jquery/idrag.js" type="text/javascript"></script>
	<script src="<?=URL::site()?>jp2/js/jquery/iutil.js" type="text/javascript"></script>
	<script src="<?=URL::site()?>jp2/js/jquery/islider.js" type="text/javascript"></script>

	<script src="<?=URL::site()?>jp2/js/jquery/color_picker/color_picker.js" type="text/javascript"></script>
	<link href="<?=URL::site()?>jp2/js/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css"-->

  <link rel="Stylesheet" type="text/css" href="/public/js/jpicker-1.1.6.min.css" />
  <link rel="Stylesheet" type="text/css" href="/public/js/jPicker.css" />
  <script src="/public/js/jpicker-1.1.6.min.js" type="text/javascript"></script>

	
	


<table><tr>
<td width="250px">		
		<table>
<tr><td colspan="4">
<a href="<?=URL::site()?>admin/colors">Добавить цвет</a><br/>
</td>
</tr>
<?foreach ($prods as $prod) :?>
<tr><td>
	<div style="display:block;width:20px;height:20px;background:#<?=$prod->rgb?>">
</td>
<td>
	<a href="<?=URL::site()?>admin/colors?id=<?=$prod->id?>"><?=$prod->name?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/colors/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><font color='#bd0016'>x</font></a>
</td>
</tr>
<?endforeach?>
<?//=$pagination?>
</table>
</td><td valign="top">		
		
<?php


        echo form::open(URL::site()."admin/colors",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }

        //echo form::();
        print "<table width='100%' border='0' cellpadding='4'>";
        print "<tr><td width='400'>";
		
        print "<table width='100%' border='0' cellpadding='4' >";
        print "<tr><td width='200'>";
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Цвет (RGB 6 цифр):</b>";
        print "</td><td>";
        //print form::input('rgb', $page1->rgb);
?>       
<input type="text" id="myhexcode" name="rgb" <?if (strlen($page1->rgb)>0):?>value="<?=$page1->rgb?>"<?else:?>value="ffffff"<?endif?> readonly/>

					<!--a href="javascript:void(0);" rel="colorpicker&objcode=myhexcode&objshow=myshowcolor&showrgb=1&okfunc=myokfunc" style="text-decoration:none;" ><div id="myshowcolor" style="width:15px;height:15px;border:1px solid black;">&nbsp;</div></a-->


<?	   print "</td></tr>";


		print "<tr><td width='200'>";
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";

		print "</tr></table>";
			
?>


</td></tr></table>



		<script language="Javascript">
  $(document).ready(
    function()
    {
      $('#myhexcode').jPicker();
    });


		</script>