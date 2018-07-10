<script src="<?=URL::site()?>public/js/jquery.form.js" language="JavaScript" type="text/javascript">
</script>

<link rel="stylesheet" type="text/css" media="all" href="<?=URL::site()?>public/js/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar.js"></script>

<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/lang/calendar-ru-UTF.js"></script>
<script type="text/javascript" src="<?=URL::site()?>public/js/calendar/calendar-setup.js"></script>


<div class="row">
<div id="getorder">


<h3>Введите ваши данные для доставки заказа</h3>
<div>
<a href="<?=URL::site()?>order/cart" class="borderaa">Изменить заказ</a> <a class="borderaa" href="<?=URL::site()?>">Продолжить шопинг</a>
</div>
<div style="clear:both"></div>
<form method="POST" action="<?=URL::site()?>order/lookdata" id="formorder" name="formorder" onsubmit="javascript:return CheckAnswer();">
    <table border="0" width="450" cellpadding="6" cellspacing="0" id="ordert">
<tr>
    <td colspan="2" align="center">
        <div id="errout">
</div>
    </td>    
</tr>
<tr>
    <td colspan="2" align="left">
<span class="error">*</span> - обязательные поля
    </td>    
</tr>

        <tr>
							<td width="164" align="right" height="20" id="fio">
                                                            Контактное лицо <span class="error">*</span>
                                                        </td>

							<td width="290" height="20">
							<input type="text" class='text' value='<?=$data['fio']?>' name="fio" size="38" ></td>
						</tr>
						<tr>
						  <td align="right" height="2" id="phone" >Телефон <span class="error">*</span></td>
						  <td height="2"><input type="text" class='text' value="<?=$data['phone']?>" name="phone" size="38" /></td>
					  </tr>
						<tr>
						  <td align="right" height="2" id="email">E-Mail</td>

						  <td height="2"><input type="text" class='text' value="<?=$data['email']?>" name="email" size="38" value=" " /></td>
					  </tr>
						<tr>
						  <td width="164" height="-1" align="right" id="city">Город <span class="error">*</span></td>

						  <td height="-1"><input type="text" class='text' value="<?=$data['city']?>" name="city" size="38" value="Санкт-Петербург"  /></td>
					  </tr>
						<tr>
						  <td width="164" height="-1" align="right" id="zip">Индекс</td>

						  <td height="-1"><input type="text" class='text' name="zip" value="<?=$data['zip']?>" size="38" value=" " />
						  
						  <input type="hidden" class='text' readonly id="date" value=" "  name="ddate"  />
						  </td>
					  </tr>


						<tr>
							<td width="164" height="0" align="right" id="address">

                                                        Адрес доставки</td>

							<td width="290" height="0">
							<textarea rows="2" class='text' name="address" cols="30"><?=$data['address']?></textarea></td>
						</tr>
						<tr>
							<td width="164" height="0" align="right">

                                                        Способ оплаты</td>

							<td width="290" height="0">
								<select name="paymode" style="width:250px">
								
								
								<option value="<?=$paymodes[0]->id?>" <?if ($data['paymode']==$paymodes[0]->id):?>selected<?endif?> ><?=$paymodes[0]->pay?></option>
								<?//foreach ($paymodes as $paymode) :?>
									<!--option value="<?//=$paymode->id?>"><?//=$paymode->pay?></option-->
								<?//endforeach?>
								</select>
														
                                                        </td>
						</tr>

						<tr>
							<td width="164" height="0" align="right">

                                                        Способ доставки</td>

							<td width="290" height="0">
								<select name="deliver" style="width:250px">
									<?foreach ($deliver as $d):?>
									<option value="<?=$d->id?>" <?if ($data['deliver']==$d->id):?>selected<?endif?>><?=$d->name?> <?if ($d->cost>0):?>- <?=$d->cost?> руб.<?endif?></option>
									<?endforeach?>
								</select>



                                                        </td>
						</tr>

						<tr>
							<td width="164" height="0" align="right" id="comment">

                                                        Комментарий</td>

							<td width="290" height="0">
							<textarea rows="2" class='text' name="comment" cols="30"><?//=$data['comment']?></textarea>



                                                        </td>
						</tr>



						<tr>
                                                    <td align="center" colspan="2">
					<p></p>
                                        <div align="center" style="padding-left:160px">
										
										<input type="submit" class="borderaa" value="Далее">
										</div>
                                                        
                                                    </td>
						</tr>


    </table>
</form>
</div>
</div>