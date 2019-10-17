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

function alterar(id_elemento, url, jsons) {
   var x = document.getElementById(id_elemento);
  x.onclick = function (){
     x.innerHTML = "Salvando...";
  	try {
  		var ajax = Ajax();
  		ajax.onreadystatechange = function(){
  			if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          var resposta = this.responseText;
          if (resposta == "ok") {
            x.innerHTML = "Sucesso!!!"
            x.style.backgroundColor = "#24A059";
            setTimeout(function() {
              x.innerHTML = "Salvor Alteração";
              x.style.backgroundColor = "#0089AD";
          }, 2000);
          } else {
            x.innerHTML = "Erro!!!"
            x.style.backgroundColor = "#A0352A";
            setTimeout(function() {
              x.innerHTML = "Salvor Alteração";
              x.style.backgroundColor = "#0089AD";
            }, 2000);
          }
  			}
  		}
  		ajax.open("POST", url, true);
  		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      for (var key in jsons) {  jsons[key] = document.getElementById(key).value; }
  		ajax.send("json="+JSON.stringify(jsons));
  	} catch (e) { console.log("ERRO: "+ e.message);	}
  }
}


// =========================ALTERAR===============================
alterar('alterar_geral_pais_estado_cidade', "perfil-alterar-geral-pais-estado-cidade",
{ 'cidade':"", 'estado':"", 'pais':"" } );


alterar('alterar_geral_nome_email_senha', "perfil-alterar-geral-nome-email-senha",
{ 'nome':"", 'email':"", 'senha':"" } );


alterar_fce = { 'telefone':"" };
if (document.getElementById("cnpj") != null) { alterar_fce['cnpj'] = ""; }
if (document.getElementById("endereco") != null) { alterar_fce['endereco'] = ""; }
alterar('alterar_gi_telefone_cnpj_endereco', "perfil-alterar-gi-telefone-cnpj-endereco",
alterar_fce);


if (document.getElementById("facebook") != null && document.getElementById("instagram") != null && document.getElementById("youtube") != null) {
	alterar('alterar_instituicao_facebook_instagram_youtube', "perfil-alterar-instituicao-facebook-instagram-youtube",
	{ 'facebook':"", 'instagram':"", 'youtube':"" } );
}


if (document.getElementById("facebook") != null && document.getElementById("googleplus") != null && document.getElementById("site") != null) {
	alterar('alterar_instituicao_twitter_googleplus_site', 'perfil-alterar-instituicao-twitter-googleplus-site',
	{ 'twitter':"", 'googleplus':"", 'site':"" } );
}


if (document.getElementById("historia") != null) {
	alterar('alterar_instituicao_historia', 'perfil-alterar-instituicao-historia',
	{ 'historia':"" } );
}

if (document.getElementById("alterar_instituicao_como_receber_ajuda") != null) {
	alterar('alterar_instituicao_como_receber_ajuda', 'perfil-alterar-instituicao-como-receber-ajuda',
	{ 'como_receber_ajuda':"" } );
}

if (document.getElementById("alterar_instituicao_processo_adocao") != null) {
	alterar('alterar_instituicao_processo_adocao', 'perfil-alterar-instituicao-processo-adocao',
	{ 'processo_adocao':"" } );
}


if (document.getElementById("alterar_instituicao_conteudo_educativo") != null) {
	alterar('alterar_instituicao_conteudo_educativo', 'perfil-alterar-instituicao-conteudo-educativo',
	{ 'conteudo_educativo':"" } );
}


// ============================VALIDANDO============================

email_existe();
function email_existe() {
	var email = document.getElementById('email');
	var email_msg_error = document.getElementById('email_msg_error');
	 email.onblur = function(){
		try {
			var ajax = Ajax();
			ajax.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200) {
					var resposta = this.responseText;
					email_msg_error.innerHTML = resposta;
				}
			}
			ajax.open("POST", "perfil-email-valida", true);
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send("json="+JSON.stringify({'x':email.value}));
		} catch (e) {	}
	}
}






// ========================================================
//  var alterar_geral_pais_estado_cidade = document.getElementById('alterar_geral_pais_estado_cidade');
// alterar_geral_pais_estado_cidade.onclick = function (){
//    alterar_geral_pais_estado_cidade.innerHTML = "Salvando...";
// 	try {
// 		var ajax = Ajax();
// 		ajax.onreadystatechange = function(){
// 			if(this.readyState == 4 && this.status == 200) {
//         console.log(this.responseText);
//         var resposta = this.responseText;
//         if (resposta == "ok") {
//           alterar_geral_pais_estado_cidade.innerHTML = "Sucesso!!!"
//           alterar_geral_pais_estado_cidade.style.backgroundColor = "#24A059";
//           setTimeout(function() {
//             alterar_geral_pais_estado_cidade.innerHTML = "Salvor Alteração";
//             alterar_geral_pais_estado_cidade.style.backgroundColor = "#0089AD";
//         }, 2000);
//         } else {
//           alterar_geral_pais_estado_cidade.innerHTML = "Erro!!!"
//           alterar_geral_pais_estado_cidade.style.backgroundColor = "#A0352A";
//           setTimeout(function() {
//             alterar_geral_pais_estado_cidade.innerHTML = "Salvor Alteração";
//             alterar_geral_pais_estado_cidade.style.backgroundColor = "#0089AD";
//           }, 2000);
//         }
// 			}
// 		}
// 		ajax.open("POST", "perfil-alterar-geral-pais-estado-cidade", true);
// 		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 		ajax.send("json="+JSON.stringify({
//       'cidade_id':document.getElementById('cidade').value,
//       'estado_id':document.getElementById('estado').value,
//       'pais_id':document.getElementById('pais').value
//     }));
// 	} catch (e) { console.log("ERRO: "+ e.message);	}
// }
