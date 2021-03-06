// validar elmentos
var formulario = document.getElementById('formulario');
var email = document.getElementById('email');
var msg_error_email = document.getElementById('error-email');

// validar formulario
var email_ok = false;
var submit = true;
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
					email_ok = false;
        } else {
          msg_error_email.innerHTML = "";
					email_ok = true;
        }
			}
		}
		ajax.open("POST", "ajax_email_valida", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'x':email.value}));
	} catch (e) {	}
}

function vemail() {
	email_existe();
}

email.onblur = function() {
	vemail();
}

formulario.addEventListener("submit", function(event){
	vemail();
	if (email_ok && submit) {
		submit = false;
	} else {
		event.preventDefault();
	}
});
