<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PetAdote</title>
    <!-- Usar o dominio do site na base das ancoras html -->
    <base href="<?php echo DOMINIO; ?>">
    <!-- Mostra da mesma escala em dispositovos mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- definir icon da aba, se nao, o chrome fica fazendo uma requisicao a mais procurando favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!-- facilitar os motores de busca encontrarem a nossa página  -->
    <meta name="description" content="PetAdote, site adoção e doação de animais domésticos">
    <!-- palavras chaves para facilitar a busca -->
    <meta name="keywords" content="PetAdote, Pet, Adoção, Doação">
    <!-- Autor da Página -->
    <meta name="author" content="Dejota Freitas">

    <!-- CSS -->
    <style type="text/css">
            @import "css/style.css";
            @import "css/style.css";
    </style>
    <!-- FIM CSS -->

  </head>
  <body ondragstart='return false'> <!-- impede de arrastar as imagens da pagina -->

  <!-- CABECALHO -->
  <!-- FIM CABECALHO -->

  <!-- CORPO SITE -->
  <div>
    <?php require_once($url->pagina()); ?>
  </div>
  <!-- FIM CORPO SITE -->

  <!-- FOOTER -->
  <!-- FIM FOOTER -->


  </body>
</html>

<!-- CSS DO RESTO DO SITE -->
<style type="text/css">
        @import "css/style.css";
        @import "css/style.css";
</style>
<!-- FIM CSS DO RESTO DO SITE -->

<!-- JAVASCRIPT -->

<!-- FIM JAVASCRIPT -->
