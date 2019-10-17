<?php
if (SessaoUsuario::logado()) {
    URL::pagina('home');
} else {

  if (URL::var() != null && !empty($_SESSION['rash_recuperar_senha'])) {

    if (URL::var() != $_SESSION['rash_recuperar_senha']) {
      $resultado =  "Tentativa de alterar a senha falhou, tente novamente.";
      URL::pagina("recuperando-senha");
    } else {
      unset($_SESSION['rash_recuperar_senha']);      
    }

  } else {
    $resultado =  "Não foi possível alterar sua senha, tente novamente.";
    URL::pagina("recuperando-senha");
  }

}
