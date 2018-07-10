    $(function(){

        var field = new Array("fio","phone");//поля обязательные
               
        $("#formorder").submit(function() {// обрабатываем отправку формы   
            var error=0; // индекс ошибки
			var email = '';
            $("#formorder").find(":input").each(function() {// проверяем каждое поле в форме
                for(var i=0;i<field.length;i++){ // если поле присутствует в списке обязательных
                    if($(this).attr("name")==field[i]){ //проверяем поле формы на пустоту
                       if ($(this).attr("name") == "email")
					   {
							email = $(this).val();
					   }
                        if(!$(this).val()){// если в поле пустое
                            $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                            error=1;// определяем индекс ошибки      
							
							
                                                       
                        }
                        else{
                            //$(this).css('border', 'gray 1px solid');// устанавливаем рамку обычного цвета
                        }

                    }              
                }
           })

		   if(email!='' && !isValidEmailAddress(email)){
				//$(this).css('border', 'red 1px solid');
				error=2;
			}

		   
		   
            if(error==0){ // если ошибок нет то отправляем данные
                return true;
            }
            else{
            if(error==1) {var err_text = "Не все обязательные поля заполнены!";}
			if(error==2) {var err_text = "Неверный E-mail!";}
				alert(err_text);
				$("#messenger").fadeIn("slow");
				return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
            }
           
           
               
        })
    });



function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }