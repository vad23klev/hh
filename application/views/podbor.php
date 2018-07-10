<table width='100%' border='0' cellpadding='4' cellspacing='0'>
<?foreach ($options as $i=>$option):?>
<tr>
<td width="250px">
<?=$option['name']?>
</td>
<td>
от <input type="text" name="option_min[<?=$option['id']?>]" style="width:50px" />
до <input type="text" name="option_max[<?=$option['id']?>]" style="width:50px" />
</td>
</tr>
<?endforeach?>


<?foreach ($list_options as $i=>$option):?>
<tr>
<td width="250px" valign="top">
<?=$option['name']?>
</td>
<td>
<select name="opt_list[<?=$option['id']?>][]">
<?foreach ($option['vals'] as $val):?>
<option value="<?=$val->id?>"><?=$val->name?></option> 
<?endforeach?>
</select>

</td>
</tr>
<?endforeach?>
</table>