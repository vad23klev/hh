	
	function liFormat (row, i, num) {
	/*var result = row[0] + '<p class=qnt>' + row[1] + ' тыс.чел.</p>';*/
	//return '<a href="javascript:void(0)" onclick="javascript:this.form.submit()">' + row[0] + '</a>';
	return row[0];
}
function selectItem(li) {
	if( li == null ) var sValue = 'А ничего не выбрано!';
	if( !!li.extra ) var sValue = li.extra[2];
	else var sValue = li.selectValue;
	
	document.getElementById("keyword").value=li.selectValue;
	document.forms['search'].submit();
}
	

function CalcBasket(flag,act,id,color,size,mat,price,n,stock,brand) {
    //Get the A tag
	
	if (n>stock) {
		alert('Количество заказанного товара превышает количество товара на складе');
		n=0;
	}

	
//	alert(id+price);
    $.ajax({
        type: "GET",
        url: "/basket/?flag=" + flag + "&act=" + act + "&id=" + id + "&price=" + price + "&n=" + n + "&color=" + color + "&size=" + size + "&mat=" + mat + "&brand=" + brand,
        dataType: "html",
        timeout: 10000,
        success: modalAJAHsuccess,
        error: modalAJAHerror
    });

	$("#overlay").show();
	

    $.ajax({
        type: "GET",
        url: "/basket/showa?flag=" + flag + "&act=" + act + "&id=" + id + "&price=" + price + "&n=" + n + "&color=" + color + "&size=" + size + "&mat=" + mat + "&brand=" + brand,
        dataType: "html",
        timeout: 10000,
        success: modalAJAHBsuccess,
        error: modalAJAHBerror
    });	
$("#bskt").show('fast');
	//$("#bskt").fadeOut(5000);
}

function DelBasket(name,act,id) {
    //Get the A tag
	if (confirm("Вы действительно хотите удалить " + name + " из корзины?")) {
		//alert(121);
		$.ajax({
			type: "GET",
			url: "/basket/?upd=" + act + "&delete[]=" + id,
			dataType: "html",
			timeout: 10000,
			success: modalAJAHsuccess,
			error: modalAJAHerror
		});
	} 
}



function modalAJAHsuccess (data,textStatus)
{
    $("#basket").html(data);

}

function modalAJAHerror (XMLHttpRequest, textStatus, errorThrown)
{
    var errstr={
        "error": "Ошибка сервера!",
        "timeout": "Ошибка сервера: превышен лимит ожидания!"
    };

    var data='<span class="warning">' + errstr[textStatus] + '</span>';

    $("#basket").html(data);
}	

function modalAJAHBsuccess (data,textStatus)
{
    $("#bskt").html(data);

}

function modalAJAHBerror (XMLHttpRequest, textStatus, errorThrown)
{
    var errstr={
        "error": "Ошибка сервера!",
        "timeout": "Ошибка сервера: превышен лимит ожидания!"
    };

    var data='<span class="warning">' + errstr[textStatus] + '</span>';

    $("#bskt").html(data);
}	

function CloseAll() {
	$("#overlay").hide('fast');
	$("#bskt").hide('fast');
}


	
function ShowAdd(elem) {
	$("#"+elem).fadeIn();
	$("#"+elem).fadeOut(2000);
}



