<div class="white">
<?foreach ($brands as $brand) :?>
<div style="float:left;height:150px;">
<table>
	<tr>
	<td valign="top" align="center" width="35px">
	<?//print_r($brand)?>
	<span class="bigblue"><?=$brand['nm']?>
	</td><td valign="top" style="padding-left:10px;padding-top:5px" nowrap>
	<?foreach ($brand['brands'] as $i=>$v):?>		
		<?if ($prods[$v->id]>0) :?>
			<div class="brend"><a href="<?=URL::site()."podbor/brand?brand=".$v->id?>"><?=$v->name?></a></div>
		<?else:?>
			<div class="brend"><?=$v->name?></div>
		<?endif?>
		
		<?if ($i%6==5) :?>
			</td><td valign="top" style="padding-left:10px;padding-top:5px" nowrap>
		<?endif?>
		
	<?endforeach?>
	</td>
	</tr>
</table>
</div>
<?endforeach?>

</div>