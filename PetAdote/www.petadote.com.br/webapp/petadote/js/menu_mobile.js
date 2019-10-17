var menu_mobile = document.getElementById('menu-flutuante');
var fechar_menu_mobile = document.getElementById('fechar_menu_mobile');
var menu_mobile_letf = document.getElementById('menu_mobile_letf');
var menu_mobile_right = document.getElementById('menu_mobile_right');

function mostra_menu_mobile() {
  menu_mobile.style.display = "block";
}
function ocultar_menu_mobile() {
  menu_mobile.style.display = "none";
}
menu_mobile_letf.onclick = function () {
  mostra_menu_mobile();
}
menu_mobile_right.onclick = function () {
  mostra_menu_mobile();
}
fechar_menu_mobile.onclick = function () {
  ocultar_menu_mobile();
}
