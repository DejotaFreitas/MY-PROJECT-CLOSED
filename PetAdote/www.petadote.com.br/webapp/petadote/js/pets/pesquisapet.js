var formulario = document.getElementById('formulario');
var pesquisapet = document.getElementById('pesquisapet');
var alterar
pesquisapet.onclick = function() {
  if (formulario.style.display == 'block') {
    formulario.style.display = 'none'
  } else {
    formulario.style.display = 'block'
  }
}
