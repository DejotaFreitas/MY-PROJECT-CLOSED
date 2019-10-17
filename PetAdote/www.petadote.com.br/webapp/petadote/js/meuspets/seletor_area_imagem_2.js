// CARREGAR IMAGEM
var foto_2 = document.getElementById('foto_2');
var fotlbl_2 = document.getElementById('foto-label_2');
var input_file_2 = document.getElementById('input-avatar_2');

// =================================================================

var largura_input_2 = document.getElementById('avatar_largura_2');
var altura_input_2 = document.getElementById('avatar_altura_2');
var y_input_2 = document.getElementById('avatar_y_2');
var x_input_2 = document.getElementById('avatar_x_2');
var tamanho_input_2 = document.getElementById('selecao_tamanho_2');
var rotacao_input_2 = document.getElementById('rotacao_2');

// =================================================================

var sel_img_2 = document.getElementById('selecao_imagem_2');
var area_img_2 = document.getElementById('area-imagem_2');
var avatar_2 = document.getElementById('imagem_2');
var selecao_2 = document.getElementById('selecao_2');

// =================================================================

var ok_2 = document.getElementById('ok_2')
var girardireita_2 = document.getElementById('girardireita_2')
var giraresquerda_2 = document.getElementById('giraresquerda_2')
var cancela_2 = document.getElementById('cancela_2')
var zoommais_2 = document.getElementById('zoommais_2')
var zoommenos_2 = document.getElementById('zoommenos_2')

// =================================================================

input_file_2.value = "";
var img_padrao = foto_2.src;

function resetar_avatar_2() {
  foto_2.setAttribute("style", "-webkit-transform: rotate("+0+"deg); -ms-transform: rotate("+0+"deg); transform: rotate("+0+"deg);  -moz-transform: rotate("+0+"deg);");
  input_file_2.value = "";
  foto_2.src = img_padrao;
  foto_2.style.width = "100%";
  foto_2.style.height = "auto";
  foto_2.style.marginLeft = "0px";
  foto_2.style.marginTop = "0px";
}

// =================================================================

// MOVER IMAGEM
var pode_arrastar_2 = false;
var mouse_x_2 = 0;
var mouse_y_2 = 0;
var atual_top_2 = 0;
var atual_left_2 = 0;
var avatar_width_2 = 0;
var avatar_height_2 = 0;

// DADOS FINAIS
var area_selecao_2 = 200;
var rotacao_2 = 0;
var pos_left_2 = 0;
var pos_top_2 = 0;
var foto_src_2 = "";

function center_img_2() {
  if (rotacao_2 == 90 || rotacao_2 == -90 || rotacao_2 == 270 || rotacao_2 == -270) {
    var rec_selimg = sel_img_2.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_2.getBoundingClientRect();
    avatar_width_2 = rec_ava.right - rec_ava.left;
    avatar_height_2 = rec_ava.bottom - rec_ava.top;
    pos_left_2 = selimg_width/2 - avatar_height_2/2;
    pos_top_2 = selimg_height/2 - avatar_width_2/2;
    area_img_2.setAttribute("style", "top: "+pos_top_2+"px; left: "+pos_left_2+"px; width:"+0+"px; height: "+0+"px;");
} else {
    var rec_selimg = sel_img_2.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_2.getBoundingClientRect();
    avatar_width_2 = rec_ava.right - rec_ava.left;
    avatar_height_2 = rec_ava.bottom - rec_ava.top;
    pos_left_2 = selimg_width/2 - avatar_width_2/2;
    pos_top_2 = selimg_height/2 - avatar_height_2/2;
    area_img_2.setAttribute("style", "top: "+pos_top_2+"px; left: "+pos_left_2+"px; width:"+0+"px; height: "+0+"px;");
  }
}
avatar_2.onload = function() {
  rotacao_2 = 0;
  avatar_2.setAttribute("style", "-webkit-transform: rotate("+rotacao_2+"deg); -ms-transform: rotate("+rotacao_2+"deg); transform: rotate("+rotacao_2+"deg);  -moz-transform: rotate("+rotacao_2+"deg);");
  avatar_2.style.height ="80vh";
  avatar_2.style.width = "auto";
  center_img_2();
}
input_file_2.onclick = function() {
  resetar_avatar_2();
}

input_file_2.onchange = function(event) {
  var selectedFile = event.target.files[0];
  if (selectedFile) {
    var reader = new FileReader();
    reader.onload = function(event) {
      foto_src_2 = event.target.result;
      avatar_2.src = foto_src_2;
      sel_img_2.style.display = "block";
      document.body.style.overflowY = "hidden";
      document.getElementById("corpo").style.overflowY = "hidden";
    };
    reader.readAsDataURL(selectedFile);
  } else {
    resetar_avatar_2();
  }
}

sel_img_2.onmouseup = function(e) {
  pode_arrastar_2 = false;
}

sel_img_2.onmousedown = function(e) {
  pode_arrastar_2 = true;
  mouse_x_2 = e.clientX;
  mouse_y_2 = e.clientY;
  var rec_areaimg = area_img_2.getBoundingClientRect();
  atual_top_2 = rec_areaimg.top;
  atual_left_2 = rec_areaimg.left;
  var rec_ava = avatar_2.getBoundingClientRect();
  avatar_width_2 = rec_ava.right - rec_ava.left;
  avatar_height_2 = rec_ava.bottom - rec_ava.top;
}

sel_img_2.onmousemove = function(e) {
  if (pode_arrastar_2) {
    pos_left_2 = atual_left_2 + (e.clientX - mouse_x_2);
    pos_top_2 = atual_top_2 + (e.clientY - mouse_y_2);
    area_img_2.setAttribute("style", "top: "+pos_top_2+"px; left: "+pos_left_2+"px; width:"+0+"px; height: "+0+"px;");
  }
}

sel_img_2.addEventListener('touchstart', touchStart_2);
sel_img_2.addEventListener('touchmove', touchMove_2);

function touchStart_2(e) {
  var touch = e.touches[0];
  mouse_x_2 = touch.pageX;
  mouse_y_2 = touch.pageY;
  var rec_areaimg = area_img_2.getBoundingClientRect();
  atual_top_2 = rec_areaimg.top;
  atual_left_2 = rec_areaimg.left;
  var rec_ava = avatar_2.getBoundingClientRect();
  avatar_width_2 = rec_ava.right - rec_ava.left;
  avatar_height_2 = rec_ava.bottom - rec_ava.top;
}

function touchMove_2(e) {
  var touch = e.touches[0];
  pos_left_2 = atual_left_2 + (touch.pageX - mouse_x_2);
  pos_top_2 = atual_top_2 + (touch.pageY - mouse_y_2);
  area_img_2.setAttribute("style", "top: "+pos_top_2+"px; left: "+pos_left_2+"px; width:"+0+"px; height: "+0+"px;");
  e.preventDefault();
}

// MENU SELETOR

ok_2.onclick = function() {

  var rec_selec = selecao_2.getBoundingClientRect();
  var rec_ava = avatar_2.getBoundingClientRect();

  if (rec_selec.top <= rec_ava.top || rec_selec.left <= rec_ava.left || rec_selec.bottom >= rec_ava.bottom || rec_selec.right >= rec_ava.right) {
    alert("Mantenha a imagem preechendo toda a seleção.");
  } else {

    var rec_foto_label = fotlbl_2.getBoundingClientRect();
    var foto_label_width = rec_foto_label.right - rec_foto_label.left;
    var foto_label_height = rec_foto_label.bottom - rec_foto_label.top;
    var fator_wx = (foto_label_width  / area_selecao_2);
    var fator_hx = (foto_label_height / area_selecao_2);

    avatar_width_2 = rec_ava.right - rec_ava.left;
    avatar_height_2 = rec_ava.bottom - rec_ava.top;

    pos_left_2 = rec_ava.left - rec_selec.left;
    pos_top_2 = rec_ava.top - rec_selec.top;

    var width_red = (avatar_width_2 * fator_wx);
    var height_red = (avatar_height_2 * fator_hx);
    var x_red = (pos_left_2 * fator_wx);
    var y_red = (pos_top_2 * fator_hx);

    foto_2.src = foto_src_2;
    foto_2.setAttribute("style", "-webkit-transform: rotate("+rotacao_2+"deg); -ms-transform: rotate("+rotacao_2+"deg); transform: rotate("+rotacao_2+"deg);  -moz-transform: rotate("+rotacao_2+"deg);");

    if (rotacao_2 == 90 || rotacao_2 == -90 || rotacao_2 == 270 || rotacao_2 == -270) {

      x_red = x_red - (height_red - width_red)/2;
      y_red = y_red - (width_red - height_red)/2;

      foto_2.style.width = height_red +"px";
      foto_2.style.height = width_red  +"px";
      foto_2.style.marginLeft = x_red +"px";
      foto_2.style.marginTop = y_red +"px";
    } else {
      foto_2.style.width = width_red+"px";
      foto_2.style.height = height_red+"px";
      foto_2.style.marginLeft = x_red+"px";
      foto_2.style.marginTop = y_red+"px";
  }

  if (rotacao_2 == 90 || rotacao_2 == -90 || rotacao_2 == 270 || rotacao_2 == -270) {
    largura_input_2.value = avatar_height_2;
    altura_input_2.value = avatar_width_2;
  } else {
    largura_input_2.value = avatar_width_2;
    altura_input_2.value = avatar_height_2;
  }

  x_input_2.value = rec_selec.left - rec_ava.left;
  y_input_2.value = rec_selec.top - rec_ava.top;
  tamanho_input_2.value = area_selecao_2;
  if (rotacao_2 == 90) {
    rotacao_input_2.value = 270;
  } else if (rotacao_2 == -90) {
    rotacao_input_2.value = -270;
  }  else if (rotacao_2 == 270) {
    rotacao_input_2.value = 90;
  }  else if (rotacao_2 == -270) {
    rotacao_input_2.value = -270;
  } else {
    rotacao_input_2.value = rotacao_2;
  }
  sel_img_2.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  }
}

girardireita_2.onclick = function() {
  rotacao_2 += 90;
  if (rotacao_2 > 270) { rotacao_2 = 0; }
  avatar_2.setAttribute("style", "-webkit-transform: rotate("+rotacao_2+"deg); -ms-transform: rotate("+rotacao_2+"deg); transform: rotate("+rotacao_2+"deg);  -moz-transform: rotate("+rotacao_2+"deg);");
  center_img_2();
}

giraresquerda_2.onclick = function() {
  rotacao_2 -= 90;
  if (rotacao_2 < -270) { rotacao_2 = 0; }
  avatar_2.setAttribute("style", "-webkit-transform: rotate("+rotacao_2+"deg); -ms-transform: rotate("+rotacao_2+"deg); transform: rotate("+rotacao_2+"deg);  -moz-transform: rotate("+rotacao_2+"deg);");
   center_img_2();
}

cancela_2.onclick = function() {
  sel_img_2.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  resetar_avatar_2();
}

zoommais_2.onclick = function() {
  zoommaiss_2(); zoommaiss_2(); zoommaiss_2(); zoommaiss_2();
}

zoommenos_2.onclick = function() {
  zoommenoss_2(); zoommenoss_2(); zoommenoss_2(); zoommenoss_2();
}

function zoommenoss_2() {
  var rec_img = avatar_2.getBoundingClientRect();
  var width_zoommenos = (rec_img.right - rec_img.left) * 0.95;
  var height_zoommenos = (rec_img.bottom - rec_img.top) * 0.95;
  avatar_2.style.width = width_zoommenos+"px";
  avatar_2.style.height = height_zoommenos+"px";
  var rec_areaimg = area_img_2.getBoundingClientRect();
  var zoom_left_2 = rec_areaimg.left + ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_2 = rec_areaimg.top + ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_2.setAttribute("style", "top: "+zoom_top_2+"px; left: "+zoom_left_2+"px; width:"+0+"px; height: "+0+"px;");
}

function zoommaiss_2() {
  var rec_img = avatar_2.getBoundingClientRect();
  var width_zoommais = (rec_img.right - rec_img.left) * 1.05;
  var height_zoommais = (rec_img.bottom - rec_img.top) * 1.05;
  avatar_2.style.width = width_zoommais+"px";
  avatar_2.style.height = height_zoommais+"px";
  var rec_areaimg = area_img_2.getBoundingClientRect();
  var zoom_left_2 = rec_areaimg.left - ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_2 = rec_areaimg.top - ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_2.setAttribute("style", "top: "+zoom_top_2+"px; left: "+zoom_left_2+"px; width:"+0+"px; height: "+0+"px;");
}


// For Chrome
sel_img_2.addEventListener('mousewheel', mouseWheelEvent);
// For Firefox
sel_img_2.addEventListener('DOMMouseScroll', mouseWheelEvent);
function mouseWheelEvent(e) {
    var delta = e.wheelDelta ? e.wheelDelta : -e.detail;
    if (delta == 120 || delta == 3) { zoommaiss_2(); zoommaiss_2();  }
    if (delta == -120 || delta == -3) { zoommenoss_2(); zoommenoss_2();  }
}
