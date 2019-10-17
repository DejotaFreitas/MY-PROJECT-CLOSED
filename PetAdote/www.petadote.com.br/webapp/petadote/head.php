<meta charset="utf-8">
<title>PetAdote</title>

<!-- Mostra da mesma escala em dispositovos mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1 minimum-scale=1  minimum-scale=1 maximum-scale=1">

<!-- definir icon da aba, se nao, o chrome fica fazendo uma requisicao a mais procurando favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo URL::webapp(); ?>img/favicon/favicon.ico" >
<link rel="icon" type="image/x-icon" href="<?php echo URL::webapp(); ?>img/favicon/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL::webapp(); ?>img/favicon/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL::webapp(); ?>img/favicon/favicon-32x32.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo URL::webapp(); ?>img/favicon/android-chrome-96x96.png">


<!-- facilitar os motores de busca encontrarem a nossa página  -->
<meta name="description" content="PetAdote, todo pet merece um lar.">

<!-- palavras chaves para facilitar a busca -->
<meta name="keywords" content="PetAdote, Pet, Adoção Pet, Doação Pet, Cahcorro, Gato">

<!-- Autor da Página -->
<meta name="author" content="Dejota Freitas">

<style type="text/css">
@font-face {
  font-family: Roboto;
  src: url("<?php echo CONTEINER_WEB; ?>petadote/font/roboto/Roboto-Regular.woff");
}
@font-face {
  font-family: Roboto-Bold;
  src: url("<?php echo CONTEINER_WEB; ?>petadote/font/roboto/Roboto-Bold.woff");
}
@font-face {
  font-family: Roboto-Light;
  src: url("<?php echo CONTEINER_WEB; ?>petadote/font/roboto/Roboto-Light.woff");
}
@font-face {
  font-family: Roboto-Medium;
  src: url("<?php echo CONTEINER_WEB; ?>petadote/font/roboto/Roboto-Medium.woff");
}
@font-face {
  font-family: Roboto-Thin;
  src: url("<?php echo CONTEINER_WEB; ?>petadote/font/roboto/Roboto-Thin.woff");
}
</style>

<style type="text/css">

  @import "<?php echo URL::webapp(); ?>css/init.css";

  <?php if (URL::is_mobile()): ?>
    @import "<?php echo URL::webapp(); ?>css/init-menu-mobile.css";
    @import "<?php echo URL::webapp(); ?>css/init-body-mobile.css";
  <?php else: ?>
    @import "<?php echo URL::webapp(); ?>css/init-menu.css";
    @import "<?php echo URL::webapp(); ?>css/init-body.css";
  <?php endif; ?>




  /* COR DO FUNDO SITE */
  <?php if (empty($_SESSION['acessibilidade_cor']) || $_SESSION['acessibilidade_cor'] == "1"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_1.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "2"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_2.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "3"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_3.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "4"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_4.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "5"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_5.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "6"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_6.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "7"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_7.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "8"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_8.css";
  <?php elseif ($_SESSION['acessibilidade_cor'] == "9"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/cor_9.css";
  <?php endif; ?>


  /* COR DO CORPO SITE */
  <?php if (empty($_SESSION['acessibilidade_cor_corpo']) || $_SESSION['acessibilidade_cor_corpo'] == "muito_claro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_muito_claro.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "claro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_claro.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "medio"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_medio.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "escuro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_escuro.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "muito_escuro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_muito_escuro.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "transparente_claro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_transparente_claro.css";
  <?php elseif ($_SESSION['acessibilidade_cor_corpo'] == "transparente_escuro"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/corpo_transparente_escuro.css";
  <?php endif; ?>


  /* TAMANHO DA FONTE */
  <?php if (empty($_SESSION['acessibilidade_fontsize']) || $_SESSION['acessibilidade_fontsize'] == "pequeno"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/fontsize_pequeno.css";
  <?php elseif ( $_SESSION['acessibilidade_fontsize'] == "medio"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/fontsize_medio.css";
  <?php elseif ($_SESSION['acessibilidade_fontsize'] == "grande"): ?>
    @import "<?php echo URL::webapp(); ?>css/acessibilidade/fontsize_grande.css";
  <?php endif; ?>

  <?php if (!URL::is_mobile()): ?>
    /* MENU LATERAL DIREITA OU ESQUERDA */
    <?php if (empty($_SESSION['acessibilidade_menu']) || $_SESSION['acessibilidade_menu'] == "esquerda"): ?>
      @import "<?php echo URL::webapp(); ?>css/acessibilidade/menu_esquerda.css";
    <?php elseif ($_SESSION['acessibilidade_menu'] == "direita"): ?>
      @import "<?php echo URL::webapp(); ?>css/acessibilidade/menu_direita.css";
    <?php else: ?>
      @import "<?php echo URL::webapp(); ?>css/acessibilidade/menu_esquerda.css";
    <?php endif; ?>
  <?php endif; ?>


  /* TIPO ICONES */
  <?php if (empty($_SESSION['acessibilidade_icon'])) { $iconcor = 'icon';  }
  else { $iconcor = $_SESSION['acessibilidade_icon'];  } ?>

</style>
