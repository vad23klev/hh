<script type="text/javascript">    
<?foreach ($list_options as $i=>$list):?>
	var count_courses<?=$i?>=1;    
    function addDiv<?=$i?>(){
		pl=document.getElementById("cat<?=$i?>"+(count_courses<?=$i?>-1)).innerHTML;
		newdiv=document.createElement("div");
		plcont=document.getElementById("cat<?=$i?>");
		plcont.appendChild(newdiv);
		re=/\'cat[0-9]*\'+/g;		
		pl=pl.replace(re,"'cat<?=$i?>"+count_courses<?=$i?>+"'");
		newdiv.innerHTML=pl;
		newdiv.setAttribute("id","cat<?=$i?>"+count_courses<?=$i?>);
		count_courses<?=$i?>++;
	}

	function removeDiv<?=$i?>(id){
		par=document.getElementById('cat<?=$i?>');
		par.removeChild(document.getElementById(id));
		count_courses<?=$i?>--;
	}
<?endforeach?>
    
</script>

<script type="text/javascript">
	function getcity() {
		//alert(document.getElementById("country").value);

		 $.ajax({
			type: "GET",
			url: '/search/co_goods?val=' + document.getElementById("searchname").value,
			dataType: "html",
			timeout: 10000,
			success: modalAJAXsuccess,
			error: modalAJAXerror
		});
	}
	
	function modalAJAXsuccess (data,textStatus)
	{

		$("#cg").html(data);
	}

	function modalAJAXerror (XMLHttpRequest, textStatus, errorThrown)
	{
		//alert(textStatus);
	}
</script>

<strong><a href="<?=URL::site()?>admin/agoods?<?=$cstr?>">К списку заявок</a></strong><br/><br/>
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
<?
function draw_menu($menu)
{
$res = "<ul>";
	foreach ($menu as $lm)
	{

		$res .= "<tr class='grey'><td><img src='".URL::site()."/img/papka.gif'></td><td><a title='редактировать товары группы' href=\"".URL::site()."admin/agoods?c_id=".$lm['id']."\">".$lm['name']."</a></td><td></td><td></td><td></td><td></td><td></td><td ><a title='редактировать описание группы' href=\"".URL::site()."admin/categories?type=1&id=".$lm['id']."\" ><img  src='/img/imgedit.gif' border='0' /></a> <a href=\"".URL::site()."admin/agoods?cdel=1&id=".$lm['id']."\" onclick=\"javascript:return confirm('Вы уверены?')\"><font color=\"#bd0016\"><img src='/img/del.gif' border='0' /></font></a></td>";
		
		/*if (count($lm['children'])>0)
		{
			$res .= draw_menu($lm['children']);
		}*/
				
		$res .= "</li>";
	}
$res .= "</ul>";

return $res;
}
?>

<h1><?=$good->title?></h1>


<a href="/admin/categories?type=1">Добавить подгруппу</a> &nbsp; <a href="<?=URL::site()?>admin/goods?page=<?=$page?>&q=<?=$q?>&c_id=<?=$c_id?>">Добавить заявку</a> &nbsp; <a href="/admin/agoods?c_id=0">заявки без группы</a>
<br/><br/>
Путь: <a class="way" href="<?=URL::site()?>admin/agoods?<?=$cstr?>">Начало</a> / 
<?foreach ($way as $i=>$w):?>
<a <?if ($i<count($way)-1):?>class="way"<?endif?> href="<?=URL::site()?>admin/agoods?<?=$cstr?>&c_id=<?=$w->id?>"><?=$w->title?></a> / 
<?endforeach?>

<br/><br/>


<div id="tabs">
<ul style="padding-bottom:22px;">
<li><a href="#section-1">Свойства заявки</a></li>
<li><a href="#section-3">Свойства заявки</a></li>

</ul>


<div id="section-1">	
<table cellpadding="4" width="100%" id="goodtable">
<td valign="top">

	    <?php
        print form::open(URL::site().$type."?page=".$page."&c_id=".$c_id."&id=".$good->id."#section-1",array('method'=>'POST','enctype' => 'multipart/form-data'));


		if (strlen($good->id)>0) {
			print form::hidden("good",$good->id);		
			print form::hidden("edit","1");
		} else {
			print form::hidden("good",1);		
			print form::hidden("add","1");		
		}

        print "<br/><table width='100%' border='1' cellpadding='4' cellspacing='0'>";
		
		        print "<tr>\n";
        print "<td width='200px'>\n";
        print "<b>Группа</b></td><td>\n";
?>        
	<select name="cat">	
	<?if (strlen($good->id)>0):?>
		<?=draw_cats($cats1,$good->category_id)?>
	<?else:?>
		<?=draw_cats($cats1,$c_id)?>
	<?endif?>
	</select>
		
<?		
        print "</td>";
        print "</tr>\n";

        print "<tr>";
        print "<td>";
        print "Тема:<br></td><td>";
        print form::input('title', $good->title,array('style'=>'width:600px'));
        print "</td>";
        print "</tr>\n";
		
        print "<tr>";
        print "<td>";
        print "Вопрос:<br></td><td>";
        print form::textarea('name', $good->name,array('id'=>'name1'));
        print "</td>";
        print "</tr>\n";

		/*print "<tr>";
        print "<td  colspan='2'>";
        print "Ответ:<br>";
        print "<textarea cols=\"40\" id=\"description\" name=\"description\" rows=\"10\">".$good->description."</textarea>\n";
        print "</td></tr>";

		print "<tr>";
        print "<td  colspan='2'>";
        print "Доп. материалы:<br>";
        print "<textarea cols=\"40\" id=\"photo_description\" name=\"photo_description\" rows=\"10\">".$good->photo_description."</textarea>\n";
        print "</td></tr>";
		
        print "</tr>";*/
        print "<tr><td>";
        print "<b>Отображать заявку на сайте: </b></td><td>";
?>
        <input type="hidden" name="enabled" value="0"/>
        <input type="checkbox" name="enabled" value="1" <?if($good->enabled==1):?>checked<?endif?>/>
<?
        print "</td>";
        print "</tr>";


        print "<tr style='display:none'>";
        print "<td>";
        print "Слова для поиска:</td><td>";
        print "<textarea style=\"width:500px\" id=\"addwords\" name=\"addwords\" rows=\"10\">".$good->addwords."</textarea>\n";
        print "</td></tr>";		
		
		
        print "<tr style='display:none'>";
        print "<td>";
        print "Позиция: </td><td>";
        print form::input('sort', $good->sort);

        print "</td>";
print "</tr>";
?>
<tr>
<td>
Ответов
</td>
<td>
<?$feeds = ORM::factory('feed')->where('product_id','=',$good->id)->find_all()?>

<a href="/admin/feeds?uid=<?=$good->id?>"><?=$feeds->count()?></a>
</td>
</tr>
<tr>
<td>
Файлов
</td>
<td>

<?$imgs = ORM::factory('img')->where('product_id','=',$good->id)->find_all()?>

<a href="/admin/imgs?cid=<?=$good->id?>"><?=$imgs->count()?></a>


</td>
</tr>
    
<?
        print "<tr><td>";
        print "Состояние: </td><td>";
		$stocktype = array('0' =>'На модерации', '2' => 'Открыта', '3' => 'Закрыта', '5' => 'Ведутся переговоры', '6' => 'В работе', '4' => 'Выполнена');
?>

<select name="stock_type">
<?foreach ($stocktype as $i=>$s):?>
	<option value="<?=$i?>" <?if ($i==$good->stock_type):?>selected<?endif?>><?=$s?></option>
<?endforeach?>
</select>


<?
        print "</td>";
print "</tr>
<tr><td>";
        print "Состояние: </td><td>";
		$saletype = array('0' =>'Заявка', '1' => 'Вопрос');
?>

<select name="sale_type">
<?foreach ($saletype as $i=>$s):?>
	<option value="<?=$i?>" <?if ($i==$good->sale_type):?>selected<?endif?>><?=$s?></option>
<?endforeach?>
</select>


<?
        print "</td>";
print "</tr>
<tr><td colspan='2'>";
if ($role == 2){
    print form::submit('submit', 'Сохранить изменения');
}
    echo form::close();?>
    <br>
</td></tr>
</table>
</div></div>

        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('name1');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '<?=URL::site()?>/AjexFileManager/'});

var ckeditor2 = CKEDITOR.replace('photo_description');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor2, path: '<?=URL::site()?>/AjexFileManager/'});


</script>

