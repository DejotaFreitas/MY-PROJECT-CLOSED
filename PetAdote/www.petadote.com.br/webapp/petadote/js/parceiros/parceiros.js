function excluir_parceiro() {
  var titulo = "Excluir parceiro ?";
  var msg = "tem certeeza que deseja excluir esse parceiro ?";
  option_box_action(titulo, msg, function() {
    ajax_excluir_parceiro(parceiro_cnpj);
    invisible_parceiro();
    option_box_hidden();
  });
}

show_parceiro_fundo = document.getElementById('show_parceiro_fundo');
show_parceiro_conteiner = document.getElementById('show_parceiro_conteiner');

foto = document.getElementById('foto');
parceiro_nome = document.getElementById('parceiro_nome');
parceiro_cnpj_innerHTML = document.getElementById('parceiro_cnpj');
parceiro_telefone = document.getElementById('parceiro_telefone');
parceiro_email = document.getElementById('parceiro_email');
parceiro_site = document.getElementById('parceiro_site');
parceiro_endereco = document.getElementById('parceiro_endereco');


var parceiro_cnpj = null;
var elemento = null;
show_parceiro_conteiner.style.display = "none";

function show_parceiro(cnpj_parceiro, e) {
  elemento = e;
  parceiro_cnpj = cnpj_parceiro;
  get_parceiro(cnpj_parceiro);
}

function peencher_show_parceiro(parceiro) {

  foto.src = parceiro['foto'];
  parceiro_nome.innerHTML = parceiro['nome'];
  parceiro_cnpj_innerHTML.innerHTML = parceiro['cnpj'];

  if (parceiro['telefone']) {
    parceiro_telefone.firstChild.innerHTML = parceiro['telefone'];
    parceiro_telefone.href = "tel:"+parceiro['telefone'];
    parceiro_telefone.parentNode.style.display = "block";
  } else {
    parceiro_telefone.parentNode.style.display = "none";
  }

  if (parceiro['email']) {
    parceiro_email.firstChild.innerHTML = parceiro['email'];
    parceiro_email.href = "mailto:"+parceiro['email'];
    parceiro_email.parentNode.style.display = "block";
  } else {
    parceiro_email.parentNode.style.display = "none";
  }

  if (parceiro['site']) {
    parceiro_site.innerHTML = parceiro['site'];
    parceiro_site.parentNode.style.display = "block";
  } else {
    parceiro_site.parentNode.style.display = "none";
  }

  if (parceiro['endereco']) {
    parceiro_endereco.innerHTML = parceiro['endereco'];
    parceiro_endereco.parentNode.style.display = "block";
  } else {
    parceiro_endereco.parentNode.style.display = "none";
  }

  visible_parceiro();
}

function visible_parceiro() {
  show_parceiro_fundo.style.display = "block";
  show_parceiro_conteiner.style.display = "block";
  show_parceiro_conteiner.scrollTo(0, 0);
  document.body.style.overflowY = "hidden";
  document.getElementById("corpo").style.overflowY = "hidden";
}

function invisible_parceiro() {
  show_parceiro_fundo.style.display = "none";
  show_parceiro_conteiner.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
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

function get_parceiro(cnpj_parceiro){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = JSON.parse(this.responseText);
				peencher_show_parceiro(resposta);
			}
		}
		ajax.open("POST", "ajax_get_parceiro", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'cnpj_parceiro':cnpj_parceiro}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}

function ajax_excluir_parceiro(cnpj_parceiro){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = this.responseText;
        if (resposta == "deletado") {
          elemento.remove();
        }
          invisible_parceiro();
			}
		}
		ajax.open("POST", "ajax_excluir_parceiro", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'cnpj_parceiro':cnpj_parceiro}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}


// OPTION BOX
function option_box_action(titulo, msg, funcao) {
  document.getElementById('opition_box_titulo').innerHTML = titulo;
  document.getElementById('opition_box_msg').innerHTML = msg;
  document.getElementById('option_box_button_sim').onclick = funcao;
  option_box_show();
}
function option_box_show() {
  document.getElementById('opition_box').style.display = "block";
  document.getElementById('opition_box_fundo').style.display = "block";
}
function option_box_hidden() {
  document.getElementById('opition_box').style.display = "none";
  document.getElementById('opition_box_fundo').style.display = "none";
}
