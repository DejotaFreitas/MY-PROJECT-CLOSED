// CARREGAR IMAGEM
var foto_3 = document.getElementById('foto_3');
var fotlbl_3 = document.getElementById('foto-label_3');
var input_file_3 = document.getElementById('input-avatar_3');

// =================================================================

var largura_input_3 = document.getElementById('avatar_largura_3');
var altura_input_3 = document.getElementById('avatar_altura_3');
var y_input_3 = document.getElementById('avatar_y_3');
var x_input_3 = document.getElementById('avatar_x_3');
var tamanho_input_3 = document.getElementById('selecao_tamanho_3');
var rotacao_input_3 = document.getElementById('rotacao_3');

// =================================================================

var sel_img_3 = document.getElementById('selecao_imagem_3');
var area_img_3 = document.getElementById('area-imagem_3');
var avatar_3 = document.getElementById('imagem_3');
var selecao_3 = document.getElementById('selecao_3');

// =================================================================

var ok_3 = document.getElementById('ok_3')
var girardireita_3 = document.getElementById('girardireita_3')
var giraresquerda_3 = document.getElementById('giraresquerda_3')
var cancela_3 = document.getElementById('cancela_3')
var zoommais_3 = document.getElementById('zoommais_3')
var zoommenos_3 = document.getElementById('zoommenos_3')

// =================================================================

input_file_3.value = "";
var img_padrao = foto_3.src;

function resetar_avatar_3() {
  foto_3.setAttribute("style", "-webkit-transform: rotate("+0+"deg); -ms-transform: rotate("+0+"deg); transform: rotate("+0+"deg);  -moz-transform: rotate("+0+"deg);");
  input_file_3.value = "";
  foto_3.src = img_padrao;
  foto_3.style.width = "100%";
  foto_3.style.height = "auto";
  foto_3.style.marginLeft = "0px";
  foto_3.style.marginTop = "0px";
}

// =================================================================

// MOVER IMAGEM
var pode_arrastar_3 = false;
var mouse_x_3 = 0;
var mouse_y_3 = 0;
var atual_top_3 = 0;
var atual_left_3 = 0;
var avatar_width_3 = 0;
var avatar_height_3 = 0;

// DADOS FINAIS
var area_selecao_3 = 200;
var rotacao_3 = 0;
var pos_left_3 = 0;
var pos_top_3 = 0;
var foto_src_3 = "";

function center_img_3() {
  if (rotacao_3 == 90 || rotacao_3 == -90 || rotacao_3 == 270 || rotacao_3 == -270) {
    var rec_selimg = sel_img_3.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_3.getBoundingClientRect();
    avatar_width_3 = rec_ava.right - rec_ava.left;
    avatar_height_3 = rec_ava.bottom - rec_ava.top;
    pos_left_3 = selimg_width/2 - avatar_height_3/2;
    pos_top_3 = selimg_height/2 - avatar_width_3/2;
    area_img_3.setAttribute("style", "top: "+pos_top_3+"px; left: "+pos_left_3+"px; width:"+0+"px; height: "+0+"px;");
} else {
    var rec_selimg = sel_img_3.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_3.getBoundingClientRect();
    avatar_width_3 = rec_ava.right - rec_ava.left;
    avatar_height_3 = rec_ava.bottom - rec_ava.top;
    pos_left_3 = selimg_width/2 - avatar_width_3/2;
    pos_top_3 = selimg_height/2 - avatar_height_3/2;
    area_img_3.setAttribute("style", "top: "+pos_top_3+"px; left: "+pos_left_3+"px; width:"+0+"px; height: "+0+"px;");
  }
}

avatar_3.onload = function() {
  rotacao_3 = 0;
  avatar_3.setAttribute("style", "-webkit-transform: rotate("+rotacao_3+"deg); -ms-transform: rotate("+rotacao_3+"deg); transform: rotate("+rotacao_3+"deg);  -moz-transform: rotate("+rotacao_3+"deg);");
  avatar_3.style.height ="80vh";
  avatar_3.style.width = "auto";
  center_img_3();
}
input_file_3.onclick = function() {
  resetar_avatar_3();
}

input_file_3.onchange = function(event) {
  var selectedFile = event.target.files[0];
  if (selectedFile) {
    var reader = new FileReader();
    reader.onload = function(event) {
      foto_src_3 = event.target.result;
      avatar_3.src = foto_src_3;
      sel_img_3.style.display = "block";
      document.body.style.overflowY = "hidden";
      document.getElementById("corpo").style.overflowY = "hidden";
    };
    reader.readAsDataURL(selectedFile);
  } else {
    resetar_avatar_3();
  }
}

sel_img_3.onmouseup = function(e) {
  pode_arrastar_3 = false;
}

sel_img_3.onmousedown = function(e) {
  pode_arrastar_3 = true;
  mouse_x_3 = e.clientX;
  mouse_y_3 = e.clientY;
  var rec_areaimg = area_img_3.getBoundingClientRect();
  atual_top_3 = rec_areaimg.top;
  atual_left_3 = rec_areaimg.left;
  var rec_ava = avatar_3.getBoundingClientRect();
  avatar_width_3 = rec_ava.right - rec_ava.left;
  avatar_height_3 = rec_ava.bottom - rec_ava.top;
}

sel_img_3.onmousemove = function(e) {
  if (pode_arrastar_3) {
    pos_left_3 = atual_left_3 + (e.clientX - mouse_x_3);
    pos_top_3 = atual_top_3 + (e.clientY - mouse_y_3);
    area_img_3.setAttribute("style", "top: "+pos_top_3+"px; left: "+pos_left_3+"px; width:"+0+"px; height: "+0+"px;");
  }
}

sel_img_3.addEventListener('touchstart', touchStart_3);
sel_img_3.addEventListener('touchmove', touchMove_3);

function touchStart_3(e) {
  var touch = e.touches[0];
  mouse_x_3 = touch.pageX;
  mouse_y_3 = touch.pageY;
  var rec_areaimg = area_img_3.getBoundingClientRect();
  atual_top_3 = rec_areaimg.top;
  atual_left_3 = rec_areaimg.left;
  var rec_ava = avatar_3.getBoundingClientRect();
  avatar_width_3 = rec_ava.right - rec_ava.left;
  avatar_height_3 = rec_ava.bottom - rec_ava.top;
}

function touchMove_3(e) {
  var touch = e.touches[0];
  pos_left_3 = atual_left_3 + (touch.pageX - mouse_x_3);
  pos_top_3 = atual_top_3 + (touch.pageY - mouse_y_3);
  area_img_3.setAttribute("style", "top: "+pos_top_3+"px; left: "+pos_left_3+"px; width:"+0+"px; height: "+0+"px;");
  e.preventDefault();
}

// MENU SELETOR

ok_3.onclick = function() {

  var rec_selec = selecao_3.getBoundingClientRect();
  var rec_ava = avatar_3.getBoundingClientRect();

  if (rec_selec.top <= rec_ava.top || rec_selec.left <= rec_ava.left || rec_selec.bottom >= rec_ava.bottom || rec_selec.right >= rec_ava.right) {
    alert("Mantenha a imagem preechendo toda a seleção.");
  } else {

    var rec_foto_label = fotlbl_3.getBoundingClientRect();
    var foto_label_width = rec_foto_label.right - rec_foto_label.left;
    var foto_label_height = rec_foto_label.bottom - rec_foto_label.top;
    var fator_wx = (foto_label_width  / area_selecao_3);
    var fator_hx = (foto_label_height / area_selecao_3);

    avatar_width_3 = rec_ava.right - rec_ava.left;
    avatar_height_3 = rec_ava.bottom - rec_ava.top;

    pos_left_3 = rec_ava.left - rec_selec.left;
    pos_top_3 = rec_ava.top - rec_selec.top;

    var width_red = (avatar_width_3 * fator_wx);
    var height_red = (avatar_height_3 * fator_hx);
    var x_red = (pos_left_3 * fator_wx);
    var y_red = (pos_top_3 * fator_hx);

    foto_3.src = foto_src_3;
    foto_3.setAttribute("style", "-webkit-transform: rotate("+rotacao_3+"deg); -ms-transform: rotate("+rotacao_3+"deg); transform: rotate("+rotacao_3+"deg);  -moz-transform: rotate("+rotacao_3+"deg);");

    if (rotacao_3 == 90 || rotacao_3 == -90 || rotacao_3 == 270 || rotacao_3 == -270) {

      x_red = x_red - (height_red - width_red)/2;
      y_red = y_red - (width_red - height_red)/2;

      foto_3.style.width = height_red +"px";
      foto_3.style.height = width_red  +"px";
      foto_3.style.marginLeft = x_red +"px";
      foto_3.style.marginTop = y_red +"px";
    } else {
      foto_3.style.width = width_red+"px";
      foto_3.style.height = height_red+"px";
      foto_3.style.marginLeft = x_red+"px";
      foto_3.style.marginTop = y_red+"px";
  }

  if (rotacao_3 == 90 || rotacao_3 == -90 || rotacao_3 == 270 || rotacao_3 == -270) {
    largura_input_3.value = avatar_height_3;
    altura_input_3.value = avatar_width_3;
  } else {
    largura_input_3.value = avatar_width_3;
    altura_input_3.value = avatar_height_3;
  }

  x_input_3.value = rec_selec.left - rec_ava.left;
  y_input_3.value = rec_selec.top - rec_ava.top;
  tamanho_input_3.value = area_selecao_3;
  if (rotacao_3 == 90) {
    rotacao_input_3.value = 270;
  } else if (rotacao_3 == -90) {
    rotacao_input_3.value = -270;
  }  else if (rotacao_3 == 270) {
    rotacao_input_3.value = 90;
  }  else if (rotacao_3 == -270) {
    rotacao_input_3.value = -270;
  } else {
    rotacao_input_3.value = rotacao_3;
  }
  sel_img_3.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  }
}

girardireita_3.onclick = function() {
  rotacao_3 += 90;
  if (rotacao_3 > 270) { rotacao_3 = 0; }
  avatar_3.setAttribute("style", "-webkit-transform: rotate("+rotacao_3+"deg); -ms-transform: rotate("+rotacao_3+"deg); transform: rotate("+rotacao_3+"deg);  -moz-transform: rotate("+rotacao_3+"deg);");
  center_img_3();
}

giraresquerda_3.onclick = function() {
  rotacao_3 -= 90;
  if (rotacao_3 < -270) { rotacao_3 = 0; }
  avatar_3.setAttribute("style", "-webkit-transform: rotate("+rotacao_3+"deg); -ms-transform: rotate("+rotacao_3+"deg); transform: rotate("+rotacao_3+"deg);  -moz-transform: rotate("+rotacao_3+"deg);");
   center_img_3();
}

cancela_3.onclick = function() {
  sel_img_3.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  resetar_avatar_3();
}

zoommais_3.onclick = function() {
  zoommaiss_3(); zoommaiss_3(); zoommaiss_3(); zoommaiss_3();
}

zoommenos_3.onclick = function() {
  zoommenoss_3(); zoommenoss_3(); zoommenoss_3(); zoommenoss_3();
}

function zoommenoss_3() {
  var rec_img = avatar_3.getBoundingClientRect();
  var width_zoommenos = (rec_img.right - rec_img.left) * 0.95;
  var height_zoommenos = (rec_img.bottom - rec_img.top) * 0.95;
  avatar_3.style.width = width_zoommenos+"px";
  avatar_3.style.height = height_zoommenos+"px";
  var rec_areaimg = area_img_3.getBoundingClientRect();
  var zoom_left_3 = rec_areaimg.left + ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_3 = rec_areaimg.top + ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_3.setAttribute("style", "top: "+zoom_top_3+"px; left: "+zoom_left_3+"px; width:"+0+"px; height: "+0+"px;");
}

function zoommaiss_3() {
  var rec_img = avatar_3.getBoundingClientRect();
  var width_zoommais = (rec_img.right - rec_img.left) * 1.05;
  var height_zoommais = (rec_img.bottom - rec_img.top) * 1.05;
  avatar_3.style.width = width_zoommais+"px";
  avatar_3.style.height = height_zoommais+"px";
  var rec_areaimg = area_img_3.getBoundingClientRect();
  var zoom_left_3 = rec_areaimg.left - ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_3 = rec_areaimg.top - ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_3.setAttribute("style", "top: "+zoom_top_3+"px; left: "+zoom_left_3+"px; width:"+0+"px; height: "+0+"px;");
}

// For Chrome
sel_img_3.addEventListener('mousewheel', mouseWheelEvent);
// For Firefox
sel_img_3.addEventListener('DOMMouseScroll', mouseWheelEvent);
function mouseWheelEvent(e) {
    var delta = e.wheelDelta ? e.wheelDelta : -e.detail;
    if (delta == 120 || delta == 3) { zoommaiss_3(); zoommaiss_3();  }
    if (delta == -120 || delta == -3) { zoommenoss_3(); zoommenoss_3();  }
}
