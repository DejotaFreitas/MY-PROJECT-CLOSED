// CARREGAR IMAGEM
var foto_1 = document.getElementById('foto_1');
var fotlbl_1 = document.getElementById('foto-label_1');
var input_file_1 = document.getElementById('input-avatar_1');

// =================================================================

var largura_input_1 = document.getElementById('avatar_largura_1');
var altura_input_1 = document.getElementById('avatar_altura_1');
var y_input_1 = document.getElementById('avatar_y_1');
var x_input_1 = document.getElementById('avatar_x_1');
var tamanho_input_1 = document.getElementById('selecao_tamanho_1');
var rotacao_input_1 = document.getElementById('rotacao_1');

// =================================================================

var sel_img_1 = document.getElementById('selecao_imagem_1');
var area_img_1 = document.getElementById('area-imagem_1');
var avatar_1 = document.getElementById('imagem_1');
var selecao_1 = document.getElementById('selecao_1');

// =================================================================

var ok_1 = document.getElementById('ok_1')
var girardireita_1 = document.getElementById('girardireita_1')
var giraresquerda_1 = document.getElementById('giraresquerda_1')
var cancela_1 = document.getElementById('cancela_1')
var zoommais_1 = document.getElementById('zoommais_1')
var zoommenos_1 = document.getElementById('zoommenos_1')

// =================================================================

input_file_1.value = "";
var img_padrao_1 = foto_1.src;

function resetar_avatar_1() {
  foto_1.setAttribute("style", "-webkit-transform: rotate("+0+"deg); -ms-transform: rotate("+0+"deg); transform: rotate("+0+"deg);  -moz-transform: rotate("+0+"deg);");
  input_file_1.value = "";
  foto_1.src = img_padrao_1;
  foto_1.style.width = "100%";
  foto_1.style.height = "auto";
  foto_1.style.marginLeft = "0px";
  foto_1.style.marginTop = "0px";
}

// =================================================================

// MOVER IMAGEM
var pode_arrastar_1 = false;
var mouse_x_1 = 0;
var mouse_y_1 = 0;
var atual_top_1 = 0;
var atual_left_1 = 0;
var avatar_width_1 = 0;
var avatar_height_1 = 0;

// DADOS FINAIS
var area_selecao_1 = 200;
var rotacao_1 = 0;
var pos_left_1 = 0;
var pos_top_1 = 0;
var foto_src_1 = "";

function center_img_1() {
  if (rotacao_1 == 90 || rotacao_1 == -90 || rotacao_1 == 270 || rotacao_1 == -270) {
    var rec_selimg = sel_img_1.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_1.getBoundingClientRect();
    avatar_width_1 = rec_ava.right - rec_ava.left;
    avatar_height_1 = rec_ava.bottom - rec_ava.top;
    pos_left_1 = selimg_width/2 - avatar_height_1/2;
    pos_top_1 = selimg_height/2 - avatar_width_1/2;
    area_img_1.setAttribute("style", "top: "+pos_top_1+"px; left: "+pos_left_1+"px; width:"+0+"px; height: "+0+"px;");
} else {
    var rec_selimg = sel_img_1.getBoundingClientRect();
    selimg_width = rec_selimg.right - rec_selimg.left;
    selimg_height = rec_selimg.bottom - rec_selimg.top;
    var rec_ava = avatar_1.getBoundingClientRect();
    avatar_width_1 = rec_ava.right - rec_ava.left;
    avatar_height_1 = rec_ava.bottom - rec_ava.top;
    pos_left_1 = selimg_width/2 - avatar_width_1/2;
    pos_top_1 = selimg_height/2 - avatar_height_1/2;
    area_img_1.setAttribute("style", "top: "+pos_top_1+"px; left: "+pos_left_1+"px; width:"+0+"px; height: "+0+"px;");
  }
}
avatar_1.onload = function() {
  rotacao_1 = 0;
  avatar_1.setAttribute("style", "-webkit-transform: rotate("+rotacao_1+"deg); -ms-transform: rotate("+rotacao_1+"deg); transform: rotate("+rotacao_1+"deg);  -moz-transform: rotate("+rotacao_1+"deg);");
  avatar_1.style.height ="80vh";
  avatar_1.style.width = "auto";
  center_img_1();
}

input_file_1.onclick = function() {
  resetar_avatar_1();
}

input_file_1.onchange = function(event) {
  var selectedFile = event.target.files[0];
  if (selectedFile) {
    var reader = new FileReader();
    reader.onload = function(event) {
      foto_src_1 = event.target.result;
      avatar_1.src = foto_src_1;
      sel_img_1.style.display = "block";
      document.body.style.overflowY = "hidden";
      document.getElementById("corpo").style.overflowY = "hidden";
    };
    reader.readAsDataURL(selectedFile);
  } else {
    resetar_avatar_1();
  }
}

sel_img_1.onmouseup = function(e) {
  pode_arrastar_1 = false;
}

sel_img_1.onmousedown = function(e) {
  pode_arrastar_1 = true;
  mouse_x_1 = e.clientX;
  mouse_y_1 = e.clientY;
  var rec_areaimg = area_img_1.getBoundingClientRect();
  atual_top_1 = rec_areaimg.top;
  atual_left_1 = rec_areaimg.left;
  var rec_ava = avatar_1.getBoundingClientRect();
  avatar_width_1 = rec_ava.right - rec_ava.left;
  avatar_height_1 = rec_ava.bottom - rec_ava.top;
}

sel_img_1.onmousemove = function(e) {
  if (pode_arrastar_1) {
    pos_left_1 = atual_left_1 + (e.clientX - mouse_x_1);
    pos_top_1 = atual_top_1 + (e.clientY - mouse_y_1);
    area_img_1.setAttribute("style", "top: "+pos_top_1+"px; left: "+pos_left_1+"px; width:"+0+"px; height: "+0+"px;");
  }
}

sel_img_1.addEventListener('touchstart', touchStart_1);
sel_img_1.addEventListener('touchmove', touchMove_1);

function touchStart_1(e) {
  var touch = e.touches[0];
  mouse_x_1 = touch.pageX;
  mouse_y_1 = touch.pageY;
  var rec_areaimg = area_img_1.getBoundingClientRect();
  atual_top_1 = rec_areaimg.top;
  atual_left_1 = rec_areaimg.left;
  var rec_ava = avatar_1.getBoundingClientRect();
  avatar_width_1 = rec_ava.right - rec_ava.left;
  avatar_height_1 = rec_ava.bottom - rec_ava.top;
}

function touchMove_1(e) {
  var touch = e.touches[0];
  pos_left_1 = atual_left_1 + (touch.pageX - mouse_x_1);
  pos_top_1 = atual_top_1 + (touch.pageY - mouse_y_1);
  area_img_1.setAttribute("style", "top: "+pos_top_1+"px; left: "+pos_left_1+"px; width:"+0+"px; height: "+0+"px;");
  e.preventDefault();
}

// MENU SELETOR

ok_1.onclick = function() {

  var rec_selec = selecao_1.getBoundingClientRect();
  var rec_ava = avatar_1.getBoundingClientRect();

  if (rec_selec.top <= rec_ava.top || rec_selec.left <= rec_ava.left || rec_selec.bottom >= rec_ava.bottom || rec_selec.right >= rec_ava.right) {
    alert("Mantenha a imagem preechendo toda a seleção.");
  } else {

    var rec_foto_label = fotlbl_1.getBoundingClientRect();
    var foto_label_width = rec_foto_label.right - rec_foto_label.left;
    var foto_label_height = rec_foto_label.bottom - rec_foto_label.top;
    var fator_wx = (foto_label_width  / area_selecao_1);
    var fator_hx = (foto_label_height / area_selecao_1);

    avatar_width_1 = rec_ava.right - rec_ava.left;
    avatar_height_1 = rec_ava.bottom - rec_ava.top;

    pos_left_1 = rec_ava.left - rec_selec.left;
    pos_top_1 = rec_ava.top - rec_selec.top;

    var width_red = (avatar_width_1 * fator_wx);
    var height_red = (avatar_height_1 * fator_hx);
    var x_red = (pos_left_1 * fator_wx);
    var y_red = (pos_top_1 * fator_hx);

    foto_1.src = foto_src_1;
    foto_1.setAttribute("style", "-webkit-transform: rotate("+rotacao_1+"deg); -ms-transform: rotate("+rotacao_1+"deg); transform: rotate("+rotacao_1+"deg);  -moz-transform: rotate("+rotacao_1+"deg);");

    if (rotacao_1 == 90 || rotacao_1 == -90 || rotacao_1 == 270 || rotacao_1 == -270) {

      x_red = x_red - (height_red - width_red)/2;
      y_red = y_red - (width_red - height_red)/2;

      foto_1.style.width = height_red +"px";
      foto_1.style.height = width_red  +"px";
      foto_1.style.marginLeft = x_red +"px";
      foto_1.style.marginTop = y_red +"px";
    } else {
      foto_1.style.width = width_red+"px";
      foto_1.style.height = height_red+"px";
      foto_1.style.marginLeft = x_red+"px";
      foto_1.style.marginTop = y_red+"px";
  }

  if (rotacao_1 == 90 || rotacao_1 == -90 || rotacao_1 == 270 || rotacao_1 == -270) {
    largura_input_1.value = avatar_height_1;
    altura_input_1.value = avatar_width_1;
  } else {
    largura_input_1.value = avatar_width_1;
    altura_input_1.value = avatar_height_1;
  }

  x_input_1.value = rec_selec.left - rec_ava.left;
  y_input_1.value = rec_selec.top - rec_ava.top;
  tamanho_input_1.value = area_selecao_1;
  if (rotacao_1 == 90) {
    rotacao_input_1.value = 270;
  } else if (rotacao_1 == -90) {
    rotacao_input_1.value = -270;
  }  else if (rotacao_1 == 270) {
    rotacao_input_1.value = 90;
  }  else if (rotacao_1 == -270) {
    rotacao_input_1.value = -270;
  } else {
    rotacao_input_1.value = rotacao_1;
  }
  sel_img_1.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  }
}

girardireita_1.onclick = function() {
  rotacao_1 += 90;
  if (rotacao_1 > 270) { rotacao_1 = 0; }
  avatar_1.setAttribute("style", "-webkit-transform: rotate("+rotacao_1+"deg); -ms-transform: rotate("+rotacao_1+"deg); transform: rotate("+rotacao_1+"deg);  -moz-transform: rotate("+rotacao_1+"deg);");
  center_img_1();
}

giraresquerda_1.onclick = function() {
  rotacao_1 -= 90;
  if (rotacao_1 < -270) { rotacao_1 = 0; }
  avatar_1.setAttribute("style", "-webkit-transform: rotate("+rotacao_1+"deg); -ms-transform: rotate("+rotacao_1+"deg); transform: rotate("+rotacao_1+"deg);  -moz-transform: rotate("+rotacao_1+"deg);");
   center_img_1();
}

cancela_1.onclick = function() {
  sel_img_1.style.display = "none";
  document.body.style.overflowY = "scroll";
  document.getElementById("corpo").style.overflowY = "auto";
  resetar_avatar_1();
}

zoommais_1.onclick = function() {
  zoommaiss_1(); zoommaiss_1(); zoommaiss_1(); zoommaiss_1();
}

zoommenos_1.onclick = function() {
  zoommenoss_1(); zoommenoss_1(); zoommenoss_1(); zoommenoss_1();
}

function zoommenoss_1() {
  var rec_img = avatar_1.getBoundingClientRect();
  var width_zoommenos = (rec_img.right - rec_img.left) * 0.95;
  var height_zoommenos = (rec_img.bottom - rec_img.top) * 0.95;
  avatar_1.style.width = width_zoommenos+"px";
  avatar_1.style.height = height_zoommenos+"px";
  var rec_areaimg = area_img_1.getBoundingClientRect();
  var zoom_left_1 = rec_areaimg.left + ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_1 = rec_areaimg.top + ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_1.setAttribute("style", "top: "+zoom_top_1+"px; left: "+zoom_left_1+"px; width:"+0+"px; height: "+0+"px;");
}

function zoommaiss_1() {
  var rec_img = avatar_1.getBoundingClientRect();
  var width_zoommais = (rec_img.right - rec_img.left) * 1.05;
  var height_zoommais = (rec_img.bottom - rec_img.top) * 1.05;
  avatar_1.style.width = width_zoommais+"px";
  avatar_1.style.height = height_zoommais+"px";
  var rec_areaimg = area_img_1.getBoundingClientRect();
  var zoom_left_1 = rec_areaimg.left - ((rec_img.right - rec_img.left) * 0.05)/2;
  var zoom_top_1 = rec_areaimg.top - ((rec_img.bottom - rec_img.top) * 0.05)/2;
  area_img_1.setAttribute("style", "top: "+zoom_top_1+"px; left: "+zoom_left_1+"px; width:"+0+"px; height: "+0+"px;");
}


// For Chrome
sel_img_1.addEventListener('mousewheel', mouseWheelEvent);
// For Firefox
sel_img_1.addEventListener('DOMMouseScroll', mouseWheelEvent);
function mouseWheelEvent(e) {
    var delta = e.wheelDelta ? e.wheelDelta : -e.detail;
    if (delta == 120 || delta == 3) { zoommaiss_1(); zoommaiss_1();  }
    if (delta == -120 || delta == -3) { zoommenoss_1(); zoommenoss_1();  }
}
