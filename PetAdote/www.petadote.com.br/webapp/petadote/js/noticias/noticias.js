var formulario = document.getElementById('formulario');
var pesquisa_noticia = document.getElementById('pesquisa_noticia');

pesquisa_noticia.onclick = function() {
  if (formulario.style.display == 'block') {
    formulario.style.display = 'none'
  } else {
    formulario.style.display = 'block'
  }
}
