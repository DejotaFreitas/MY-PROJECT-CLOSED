function add_lista_adocao() {
  var titulo = "Vincular pet perdido ?";
  var msg = "Se encontrou esse pet perdido em algum lugar, vincule-se a ele, para que o guardião do qual o pet se perdeu, saiba que você tem alguma informação ou está de posse do pet dele, lembrando também que esse pet ficará salvo no menu vínculos.";
  option_box_action(titulo, msg, function() {
    ajax_add_lista_adocao(pet_id);
    invisible_pet();
    option_box_hidden();
  });
}

function denunciar() {
  var titulo = "Denunciar pet ?";
  var msg = "Se os dados disponibilizado nesse elemento não são de um pet, denuncie para que ele seja analisado e removido.";
  option_box_action(titulo, msg, function() {
    denuncie(pet_id);
    invisible_pet();
    option_box_hidden();
  });
}


show_pet_fundo = document.getElementById('show_pet_fundo');
show_pet_conteiner = document.getElementById('show_pet_conteiner');
foto_facial = document.getElementById('foto_facial');
foto_lateral = document.getElementById('foto_lateral');
foto_superior = document.getElementById('foto_superior');
foto_dono = document.getElementById('foto_dono');
pet_nome = document.getElementById('pet_nome');
pet_situacao = document.getElementById('pet_situacao');
pet_especie = document.getElementById('pet_especie');
pet_genero = document.getElementById('pet_genero');
pet_idade = document.getElementById('pet_idade');
pet_porte = document.getElementById('pet_porte');
pet_castrado = document.getElementById('pet_castrado');
pet_vacinado = document.getElementById('pet_vacinado');
pet_descricao = document.getElementById('pet_descricao');

dono_tipo = document.getElementById('dono_tipo');
dono_cnpj = document.getElementById('dono_cnpj');
dono_nome = document.getElementById('dono_nome');
dono_telefone = document.getElementById('dono_telefone');
dono_email = document.getElementById('dono_email');
dono_endereco = document.getElementById('dono_endereco');
dono_cidade = document.getElementById('dono_cidade');
dono_estado = document.getElementById('dono_estado');
dono_pais = document.getElementById('dono_pais');

var pet_id = null;
var elemento = null;
show_pet_conteiner.style.display = "none";



function show_pet(id_pet, e) {
  elemento = e;
  get_pet(id_pet);
}

function peencher_show_pet(pet) {

  pet_id = pet['id'];
  foto_facial.src = pet['foto_facial'];
  foto_lateral.src = pet['foto_lateral'];
  foto_superior.src = pet['foto_superior'];
  pet_nome.innerHTML = pet['nome'];
  pet_situacao.innerHTML = "Perdido";
  pet_especie.innerHTML = pet['especie'];
  pet_genero.innerHTML = pet['genero'];
  pet_idade.innerHTML = pet['idade'];
  pet_porte.innerHTML = pet['porte'];
  pet_castrado.innerHTML = pet['castrado'];
  pet_vacinado.innerHTML = pet['vacinado'];

  if (pet['descricao']) {
    pet_descricao.innerHTML = pet['descricao'];
    pet_descricao.parentNode.style.display = "block";
  } else {
    pet_descricao.parentNode.style.display = "none";
  }


  foto_dono.src = pet['dono_foto'];
  if (pet['dono_tipo'] == 'p') {
    dono_tipo.innerHTML = "Pessoa";
  } else if (pet['dono_tipo'] == 'i') {
    dono_tipo.innerHTML = "Instituição";
  } else {
    dono_tipo.innerHTML = "Desconhecido";
  }
  if (pet['dono_tipo']  == 'i') {
    dono_cnpj.innerHTML = pet['dono_cnpj'];
    dono_endereco.innerHTML = pet['dono_endereco'];
    dono_cnpj.parentNode.style.display = "block";
    dono_endereco.parentNode.style.display = "block";
  } else {
    dono_cnpj.parentNode.style.display = "none";
    dono_endereco.parentNode.style.display = "none";
  }

  dono_nome.innerHTML = pet['dono_nome'];

  dono_telefone.firstChild.innerHTML = pet['dono_telefone'];
  dono_telefone.href = "tel:"+pet['dono_telefone'];
  dono_email.firstChild.innerHTML = pet['dono_email'];
  dono_email.href = "mailto:"+pet['dono_email'];

  dono_cidade.innerHTML = pet['dono_cidade'];
  dono_estado.innerHTML = pet['dono_estado'];
  dono_pais.innerHTML = pet['dono_pais'];
  visible_pet();
}

function visible_pet() {
  show_pet_fundo.style.display = "block";
  show_pet_conteiner.style.display = "block";
  show_pet_conteiner.scrollTo(0, 0);
  document.body.style.overflowY = "hidden";
  document.getElementById("corpo").style.overflowY = "hidden";
}

function invisible_pet() {
  show_pet_fundo.style.display = "none";
  show_pet_conteiner.style.display = "none";
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

function get_pet(id_pet){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = JSON.parse(this.responseText);
				peencher_show_pet(resposta);
			}
		}
		ajax.open("POST", "ajax_get_pet", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}

function ajax_add_lista_adocao(id_pet){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = this.responseText;
        if (resposta == "ok") {
          elemento.remove();
          invisible_pet();
        } else if (resposta == "deslogado") {
          window.location.assign("/entrar");
        }
			}
		}
		ajax.open("POST", "ajax_dono_perdido", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}


function denuncie(id_pet){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = this.responseText;
        if (resposta == "deletado") {
          elemento.remove();
        }
        invisible_pet();
			}
		}
		ajax.open("POST", "ajax_denucie_pet", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}



// OPTION BOX
function option_box_action(titulo, msg, funcao) {
  option_box_show();
  document.getElementById('opition_box_titulo').innerHTML = titulo;
  document.getElementById('opition_box_msg').innerHTML = msg;
  document.getElementById('option_box_button_sim').onclick = funcao;
}
function option_box_show() {
  document.getElementById('opition_box').style.display = "block";
  document.getElementById('opition_box_fundo').style.display = "block";
}
function option_box_hidden() {
  document.getElementById('opition_box').style.display = "none";
  document.getElementById('opition_box_fundo').style.display = "none";
}
