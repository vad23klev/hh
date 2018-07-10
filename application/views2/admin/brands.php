
<?
function draw_cats($cats,$current,$dots = 0)
{
$res = "";
	foreach ($cats as $lm)
	{
		if ($lm['category_id']==0)
		{
			$dots=0;
		}
		$res .= "<option value='".$lm['id']."'";
		
		
		if ($lm['id']==$current)
		{
			$res .= 'selected';
		}
		
		$res .=">".str_repeat("&nbsp;&nbsp;&nbsp;",$dots).$lm['name']."</option>";
		
		if (count($lm['children'])>0)
		{
			$dots++;
			$res .= draw_cats($lm['children'],$current,$dots);
			$dots--;
		}
				
	}
return $res;
}
?>

<a href="<?=URL::site()?>admin/brends"><h1>Добавить бренд</h1></a>
<table>
<tr>
<td width="250px" valign="top">
<table>
<tr><td colspan="4">

</td>
</tr>
<?foreach ($prods as $prod) :?>
<tr><!--td>
	<img src="<?=URL::site()?>img/brand/<?=$prod->picture?>" width="100px" />
</td-->
<td>
	<a href="<?=URL::site()?>admin/brends?id=<?=$prod->id?>"><?=$prod->name?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/brends/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><img src="/img/del.gif" border="0"/></a>
</td>
</tr>
<?endforeach?>

</table>

</td><td valign="top">


<?php


        echo form::open(URL::site()."admin/brends",array('method'=>'POST','enctype' => 'multipart/form-data'));

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
        print "<b>Заголовок:</b>";
        print "</td><td>";
        print form::input('title', $page1->title);
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Ключевые слова:</b>";
        print "</td><td>";
        print form::textarea('keywords', $page1->keywords);
        print "</td></tr>";		
        print "<tr><td width='200'>";
        print "<b>Описание:</b>";
        print "</td><td>";
        print form::textarea('description', $page1->description);
        print "</td></tr>";			
        print "<tr><td width='200'>";
        print "<b>Категория:</b>";
        print "</td><td>";
?>

	<select name="category_id">	
	<?//if (strlen($good->id)>0):?>
		<?foreach ($cats1 as $catt) :?>
			<option value="<?=$catt->id?>" <?if($catt->id==$page1->category_id):?>selected<?endif?>><?=$catt->name?></option>
		<?endforeach?>
		<?//=draw_cats($cats1,$good->category_id)?>
	<?//else:?>
		<?//=draw_cats($cats1,$c_id)?>
	<?//endif?>
	</select>

<?
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
		print "<img src='/img/brand/".$page1->picture."'>";
		print "</tr></table>";
			
?>
</td></tr></table>
        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('descr');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

</script>
