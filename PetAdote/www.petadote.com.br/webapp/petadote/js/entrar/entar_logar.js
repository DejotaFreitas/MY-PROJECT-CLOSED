// validar elmentos
var email = document.getElementById('email');
var msg_error_email = document.getElementById('error-email');


// =================================
function Ajax(){
	var ajax;
	try	{
		ajax = new XMLHttpRequest();
	}	catch(e) {
		try		{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}	catch(e) {
				alert("Seu browser nao da suporte o AJAX!");
				return false;
			}
		}
	}
	return ajax;
}

function email_existe(){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
				var resposta = this.responseText;
				if (resposta) {
          msg_error_email.innerHTML = resposta;
        } else {
          msg_error_email.innerHTML = "";
        }
			}
		}
		ajax.open("POST", "ajax_entrar_email", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'x':email.value}));
	} catch (e) {	}
}

email.onblur = function() {
	email_existe();
}
