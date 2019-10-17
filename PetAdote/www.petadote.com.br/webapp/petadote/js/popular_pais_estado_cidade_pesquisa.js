
ini_popular_pais();
mudanca_pais();
mudanca_estado();

function mudanca_pais() {
  document.getElementById('pais').onchange = function(){
		this.setAttribute('value', this.options[this.selectedIndex].value);
    ini_popular_estado();
  }
}

function mudanca_estado() {
  document.getElementById('estado').onchange = function(){
		this.setAttribute('value', this.options[this.selectedIndex].value);
    ini_popular_cidade();
  }
}

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

function ini_popular_pais(){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
				var resposta = JSON.parse(this.responseText);
				popular_pais(resposta);
        ini_popular_estado();
			}
		}
		ajax.open("POST", "ajax_popular_pais", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("");
	} catch (e) {
		console.log("ERRO: "+ e.message);
	}
}


function ini_popular_estado(){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
				var resposta = JSON.parse(this.responseText);
        if (resposta.length < 1) {
          document.getElementById('estado').setAttribute('value', '');
        } else {
          if (document.getElementById('estado').getAttribute('value')=='') {
            document.getElementById('estado').setAttribute('value', '1');
          }
        }
        popular_estado(resposta);
        ini_popular_cidade();
			}
		}
		var pais = document.getElementById('pais');
		var pais_id = pais.getAttribute('value');
		ajax.open("POST", "ajax_popular_estado", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'pais_id':pais_id}));
	} catch (e) {
		console.log("ERRO: "+ e.message);
	}
}


function ini_popular_cidade(){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
				var resposta = JSON.parse(this.responseText);
				popular_cidade(resposta);
			}
		}
		var estado = document.getElementById('estado');
		var estado_id = estado.getAttribute('value');
		ajax.open("POST", "ajax_popular_cidade", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'estado_id':estado_id}));
	} catch (e) {
		console.log("ERRO: "+ e.message);
	}
}


function popular_pais(array) {
  var pais = document.getElementById('pais');
  pais.innerHTML="";
  for (var i = 0; i < array.length; i++) {
    var option = document.createElement("option");
    option.value = array[i]['id'];
    option.innerHTML = array[i]['descricao'];
    if (pais.getAttribute('value') == array[i]['id']) { option.setAttribute('selected',''); }
    pais.appendChild(option);
  }
}


function popular_estado(array) {
  var estado = document.getElementById('estado');
  estado.innerHTML="";
  var option = document.createElement("option");
  option.value = '';
  option.innerHTML = 'Todos';
  estado.appendChild(option);
  for (var i = 0; i < array.length; i++) {
    var option = document.createElement("option");
    option.value = array[i]['id'];
    option.innerHTML = array[i]['descricao'];
    if (estado.getAttribute('value') == array[i]['id']) { option.setAttribute('selected',''); }
    estado.appendChild(option);
  }
}


function popular_cidade(array) {
  var cidade = document.getElementById('cidade');
	cidade.innerHTML="";
  var option = document.createElement("option");
  option.value = '';
  option.innerHTML = 'Todos';
  cidade.appendChild(option);
  for (var i = 0; i < array.length; i++) {
    var option = document.createElement("option");
    option.value = array[i]['id'];
    option.innerHTML = array[i]['descricao'];
    if (cidade.getAttribute('value') == array[i]['id']) { option.setAttribute('selected',''); }
    cidade.appendChild(option);
  }
}
