<?php
if (SessaoUsuario::logado()) {
  URL::pagina('home');
} else {

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

      import("UsuarioValidar");
      importcore("SS");

      $senha = $_POST['senha'];

      try {
        $senha = UsuarioValidar::senha($senha);
      } catch (Exception $e) { SS::s('_ss_veas_', "senha", $e->getMessage());  }

      $senha_cryp = password_hash($senha, PASSWORD_BCRYPT);
      $dados = ['senha'=>$senha_cryp];
      $email = $_SESSION['rash_recuperar_senha_email'];
      CRUD::update('usuario', $dados, 'email=?', [$email]);
      unset($_SESSION['rash_recuperar_senha_email']);

      if (!SS::empty('_ss_veas_')) {
        SS::s('_ss_seas_', "email", $email);
        URL::pagina("alterando-senha");
      }

    } catch (Exception $e) {
      $resultado =  "Não foi possível alterar senha, tente novamente.";
      URL::pagina("recuperando-senha");
    }

  } else {
    $resultado =  "Não foi possível alterar senha, tente novamente.";
    URL::pagina("recuperando-senha");
  }

  
}
