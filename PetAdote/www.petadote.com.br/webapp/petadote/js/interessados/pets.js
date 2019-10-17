function aceitar() {
  var titulo = "Confirmar vínculo ?";
  var msg = "É recomendado que o vínculo seja aceito após o pet ter sido entregue ao novo responsável, lembre-se de sempre aceitar o vínculo, se não, o pet continuará disponível e aparecerão novas pessoas em busca de um pet que já foi alocado para outra pessoa.";
  option_box_action(titulo, msg, function() {
    ajax_aceitar(pet_id, usuario_id, relacao);
    invisible_pet();
    option_box_hidden();
  });
}

function recusar() {
  var titulo = "Negar vínculo ?";
  var msg = "Rejeita a tentativa do usuário de torna-se o responsável pelo pet, é recomendado em situações que o interessado é de uma cidade muito distante ou que não pareceu ser o mais indicada para ser o guardião do desse pet.";
  option_box_action(titulo, msg, function() {
    ajax_recusar(pet_id, usuario_id, relacao);
    invisible_pet();
    option_box_hidden();
  });
}

show_pet_fundo = document.getElementById('show_pet_fundo');
show_pet_conteiner = document.getElementById('show_pet_conteiner');

pet_nome = document.getElementById('pet_nome');
pet_situacao = document.getElementById('pet_situacao');
pet_especie = document.getElementById('pet_especie');
pet_genero = document.getElementById('pet_genero');
pet_idade = document.getElementById('pet_idade');
pet_porte = document.getElementById('pet_porte');
pet_castrado = document.getElementById('pet_castrado');
pet_vacinado = document.getElementById('pet_vacinado');
pet_descricao = document.getElementById('pet_descricao');

foto_dono = document.getElementById('foto_dono');
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
var usuario_id = null;
var relacao = null;
var elemento = null;
show_pet_conteiner.style.display = "none";

function show_pet(id_pet, id_usuario, rel, e) {
  elemento = e;
  usuario_id = id_usuario
  relacao = rel
  get_usuario(id_pet, id_usuario);
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

function peencher_show(pet) {

  pet_id = pet['id'];
  foto_facial.src = pet['foto_facial'];
  pet_nome.innerHTML = pet['nome'];
  pet_situacao.innerHTML = "Doação";
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

function get_usuario(id_pet, id_usuario, relacao){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
        var resposta = JSON.parse(this.responseText);
				peencher_show(resposta);
			}
		}
		ajax.open("POST", "ajax_get_usuario_interessado", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet, 'id_usuario':id_usuario, 'relacao':relacao}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}

function ajax_aceitar(id_pet, usuario_id, relacao){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
        var resposta = this.responseText;
        if (resposta == "ok") {
          elemento.parentNode.remove();
          invisible_pet();
        }
			}
		}
		ajax.open("POST", "ajax_vinculo_aceitar", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet, 'id_usuario':usuario_id, 'relacao':relacao}));
	} catch (e) { console.log("ERRO: "+ e.message);	}
}

function ajax_recusar(id_pet, usuario_id, relacao){
	try {
		var ajax = Ajax();
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
        var resposta = this.responseText;
        if (resposta == "ok") {
          elemento.remove();
          invisible_pet();
        }
			}
		}
		ajax.open("POST", "ajax_vinculo_recusar", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("json="+JSON.stringify({'id_pet':id_pet, 'id_usuario':usuario_id, 'relacao':relacao}));
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
