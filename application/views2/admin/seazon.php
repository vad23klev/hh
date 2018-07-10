<h1>Сезоны</h1>
<table>
<tr>
<td valign="top">
<table>
<tr><td colspan="4" >
<a href="<?=URL::site()?>admin/seazons">Добавить сезон</a><br/>
</td>
</tr>
<?foreach ($prods as $prod) :?>
<tr><!--td>
	<img src="<?=URL::site()?>img/brand/<?=$prod->picture?>" width="100px" />
</td-->
<td nowrap>
	<a href="<?=URL::site()?>admin/seazons?id=<?=$prod->id?>"><?=$prod->name?></a><br/>
</td>
<td>
	
</td>
<td>
<a href="<?=URL::site()?>admin/seazons/?del=1&page=<?=$page?>&id=<?=$prod->id?>" onclick="javascript:return confirm('Вы уверены?')"><img src="/img/del.gif" border="0"/></a>
</td>
</tr>
<?endforeach?>

</table>

</td><td valign="top">


<?php


        echo form::open(URL::site()."admin/seazons",array('method'=>'POST','enctype' => 'multipart/form-data'));

        print form::hidden("prod",$page1->id);

        if ($page1->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }
?>
<div style='display:none'>
<?        print "<textarea cols=\"80\" id=\"html\" name=\"descr\" rows=\"10\">".$page1->descr."</textarea>";print form::file('banner');?>
</div>
<?	
        //echo form::();
        print "<table width='90%' border='0' cellpadding='4'>";
        print "<tr><td>";
		
        print "<table width='90%' border='0' cellpadding='4'>";
        print "<tr><td width='200'>";
        print "<b>Имя:</b>";
        print "</td><td>";
        print form::input('name', $page1->name);
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Лига:</b>";
        print "</td><td>";
        $leags = ORM::factory('league')->find_all();
	//print form::input('name', $page1->name);
	?>
	<select name="league_id">
		<?foreach ($leags as $leag):?>
			<option value="<?=$leag->id?>" <?if ($leag->id==$page1->league_id):?>selected<?endif?>><?=$leag->name?></option>
		<?endforeach?>
	</select>
	<?
        print "</td></tr>";
		
		
		print "<tr><td width='200'>";
        print form::submit('submit', 'Сохранить изменения');
        echo form::close();
		print "</td><td valign='top'>";
//		print "<img src='/img/banners/".$page1->picture."'>";
		print "</tr></table>";
			
?>
</td></tr></table>
        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('descr');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

</script>
