<?//if ($cats->enabled!=0):?>

<?
function draw_menu($menu)
{
$res = "<table cellpadding=\"8\" width=\"800px\" id=\"agoods\" border=\"1\" cellspacing=\"0\" style=\"margin-top:10px;\">";
	foreach ($menu as $lm)
	{

		$res .= "<tr class='grey'><td  width='20px'><img src='".URL::site()."/img/papka.gif'></td><td><a href=\"".URL::site()."admin/categories?id=".$lm['id']."\">".$lm['name']."</a></td><td width='16px'><a href=\"".URL::site()."admin/categories?del=1&id=".$lm['id']."\" onclick=\"javascript:return confirm('Вы уверены?')\"><img src='/img/del.gif' /></a></tr>";
		
		/*if (count($lm['children'])>0)
		{
			$res .= draw_menu($lm['children']);
		}*/
				
	}
$res .= "</table>";

return $res;
}

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

<?//exit?>

<?echo form::open(URL::site()."admin/categories?type=".$type1."&id=".$cats->id."#section-1",array('method'=>'POST','enctype' => 'multipart/form-data'));?>
<?
        print form::hidden("cat","$cats->id");
        if ($cats->id !=0){
            print form::hidden("edit","1");
        } else {
            print form::hidden("add","1");
        }
?>


<table>
<tr><td>
<h3>Редактировать страницу:</h3>
<?if ($role == 2):?>
<a href="/admin/categories">Добавить страницу</a>
<?endif?>
        
</td></tr></table>
        <?$selection = array('catalog' => 'Рубрика заявок','text' =>'Текст', 'news' => 'Новости','gallery' => 'Галерея','feeds'=>'обратная связь','articles'=>'Блок для главной','companies'=>'Каталог компаний');?>
<div id="tabs">
<ul style="padding-bottom:22px;">
<li><a href="#section-1">Свойства раздела</a></li>
<li><a href="#section-2">SEO - атрибуты раздела</a></li>
</ul>
<div id="section-1">	
<?
print "<table width='800px' border='0' cellpadding='4' style='margin:15px'>";

        print "<tr><td width='200'>";
        print "<b>Название категории: </b>";
        print "</td><td>";
        print "<input type='text' style='width:350px' name='name'value='".$cats->name."'>";
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Порядок сортировки:</b>";
        print "</td><td>";
        print form::hidden("many_prices","0");

        print "<input type='text' style='width:350px' name='sort' value='".$cats->sort."'>";
        //print "<input type='text' style='width:350px' name='description' value='".$cats->description."'>";
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Ссылка на таблицу размеров:</b>";
        print "</td><td>";

        print "<input type='text' style='width:350px' name='sizetable' value='".$cats->sizetable."'>";
        //print "<input type='text' style='width:350px' name='description', $cats->description);
        print "</td></tr>";
		print "<tr><td width='200'>";
        print "<b>Стартовый раздел:</b>";
        print "</td><td>";
?>
		<input type="hidden" name="main" value="0"/>
        <input type='checkbox' name='main' value='1' <?if ($cats->main==1):?>checked<?endif?>>
<?		
        //print "<input type='text' style='width:350px' name='description', $cats->description);
        print "</td></tr>";


        print "<tr><td width='200'>";
        print "<b>Отображать раздел на сайте:</b>";
        print "</td><td>";
		?>
        <input type="hidden" name="enabled" value="0"/>
        <input type="checkbox" name="enabled" value="1" <?if($cats->enabled==1):?>checked<?endif?>/>
		<?//print "<input type='text' style='width:350px' name='description', $cats->description);
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Раздел-родитель:</b>";
        print "</td><td>";
		
        //$selection = array('1' =>'Обычная', '2' => 'Без описания (калькулятор)', '3' => 'Несколько типов товара','4'=>'Предварительная заявка');
                ?>

        <select id="page_id" name="page_id" style="width:700px">
				<option value="0">Нет родительской страницы</option>
				<?if ($cats->id==0) :?>
					<?=draw_cats($lmenu,$c_id)?>
				<?else:?>
					<?=draw_cats($lmenu,$cats->category_id)?>
				<?endif?>
				
        </select>
        
        <?
        print "</td></tr>";
        print "<tr><td width='200'>";
        print "<b>Тип содержимого:</b>";
        print "</td><td>";
                ?>

        <select id="page_type_id" name="type">
                <?foreach ($selection as $i=>$v) :?>
                        <option <?if ($cats->type==$i):?>selected="selected"<?endif?>value="<?=$i?>" ><?=$v?></option>
                <?endforeach?>
        </select>
        
        <?
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Этапы работ:</b>";
        print "</td><td>";
                ?>

        <select id="step_id" name="step_id">
                <?foreach ($steps as $i=>$v) :?>
                        <option <?if ($cats->step_id==$v->id):?>selected="selected"<?endif?>value="<?=$v->id?>" ><?=$v->name?></option>
                <?endforeach?>
        </select>
        
        <?
        print "</td></tr>";
		
		print "<tr><td width='200'>";
        print "<b>Тип навигации:</b>";
        print "</td><td>";

        $selection = array('0' => 'Не показывать в меню','1' =>'Верхняя','2' =>'Нижняя');
        print form::select('nav_type',$selection,$cats->nav_type);



        //print form::checkbox('many_prices', '',$cats-> thr_priced);

        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Шаблон:</b>";
        print "</td><td>";

        $selection = array('0' => 'Обычный','1' =>'Плитка');
        print form::select('has_acc',$selection,$cats->has_acc);



        //print form::checkbox('many_prices', '',$cats-> thr_priced);

        print "</td></tr>";
		
		
        print "<tr><td width='200'>";
        print "<b>Текст страницы:</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" id=\"html\" name=\"html\" rows=\"10\">".$cats->html."</textarea></tr>";
        print "<tr><td width='200'>";
        print "<b>Слова для поиска:</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" id=\"addwords\" name=\"addwords\" rows=\"10\">".$cats->addwords."</textarea></tr>";
		
        print "<tr><td width='200'>";
        print "<b>Фото:</b>";
        print "</td><td>";
        print form::file('picture');
print "</td></tr>";
		if (strlen($cats->picture)>0) {
        print "<tr><td width='200'>";
        print "<b>Фото:</b>";
        print "</td><td>";

        
        print "<img src='".URL::site()."img/pages/".$cats->picture."' width='200px;'><br/>";

			print "<a href='".URL::site()."admin/categories?di=1&type=".$type1."&id=".$cats->id."'>Удалить</a>";


        print "</td></tr>";
		}

        print "<tr><td width='200'>";
        print "<b>Бэкграунд:</b>";
        print "</td><td>";
        print form::file('background');
print "</td></tr>";
		if (strlen($cats->background)>0) {
        print "<tr><td width='200'>";
        print "<b>Бэкграунд:</b>";
        print "</td><td>";

        
        print "<img src='".URL::site()."img/backs/".$cats->background."' width='200px;'><br/>";

			print "<a href='".URL::site()."admin/categories?db=1&type=".$type1."&id=".$cats->id."'>Удалить</a>";


        print "</td></tr>";
		}
		
		
		
		
        print "</td></tr>";
		print "<tr><td colspan='2'>";?>
<?if ($cats->type == "gallery") :?>
	<a href="/admin/shopimgs?cid=<?=$cats->id?>">Фото галереи</a>
<?endif?>	
<?
		print "</td></tr>";
        print "</table>";



?>

</div>
<div id="section-2">	

<?print "<table width='90%' border='0' cellpadding='4' style='margin:10px'>";?>
<?

        print "<tr><td width='200'>";
        print "<b>Заголовок браузера:</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" rows=\"10\" name='title'>".$cats->title."</textarea>";
        print "</td></tr>";

		print "<tr><td width='200'>";
        print "<b>Псевдоним:</b>";
        print "</td><td>";
        print "<input type='text' style='width:350px' name='alias' value='".$cats->alias."'><br/>";
		print " /".$cats->parent_chpu."/".$cats->alias;
        print "</td></tr>";

		
        print "<tr><td width='200'>";
        print "<b>Ключевые слова (через ,):</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" rows=\"10\"  name='keywords'>".$cats->keywords."</textarea>";
        print "</td></tr>";

        print "<tr><td width='200'>";
        print "<b>Описание:</b>";
        print "</td><td>";
        print "<textarea cols=\"80\" rows=\"10\"  name='description'>".$cats->description."</textarea>";
        print "</td></tr>";


		print "<tr><td colspan='2'>";
?>

<?		
		print "</td></tr>";
        print "</table>";
?>		

</div>
<div id="section-3">	
</div>

</div>

<br/>
<?if ($role == 2):?>
<?print form::submit('submit', 'Сохранить изменения',array('class'=>'submit'));?>
<?endif?>
<?echo form::close();?>

        <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('html');

AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor1, path: '/AjexFileManager/'});

</script>


