function carregando() {
  document.getElementById('carregamento_fundo').style.display = "block";
  document.getElementById('carregando_img').style.display = "block";
  setTimeout(function() {
    document.getElementById('carregamento_fundo').style.display = "none";
    document.getElementById('carregando_img').style.display = "none";
    console.log("setTimeout");
  }, 20000);
}

document.getElementById('alterar_foto').addEventListener("submit", function(event) {
   carregando();
 });
