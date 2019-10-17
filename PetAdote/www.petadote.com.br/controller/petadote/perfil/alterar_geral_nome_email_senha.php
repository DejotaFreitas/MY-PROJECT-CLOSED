<?php
if (SessaoUsuario::logado()) {

  $x = json_decode($_POST['json'], true);
  $nome = $x['nome'];
  $email = $x['email'];
  $senha = $x['senha'];

  import("UsuarioValidar");

  try {

    $dados_update = [];
    if (!empty($nome) && $nome != SessaoUsuario::usuario()['nome']) {
      $dados_update['nome'] = UsuarioValidar::nome($nome);
    }
    if (!empty($email) && $email != SessaoUsuario::usuario()['email']) {
      $dados_update['email'] = UsuarioValidar::email($email);
    }
    if (!empty($senha)) {
      $senha = UsuarioValidar::cidade($senha);
      $senha = password_hash($senha, PASSWORD_BCRYPT);
      $dados_update['senha'] =  $senha;
    }

    if (!empty($dados_update)) {
      CRUD::update('usuario', $dados_update, 'id=?', [SessaoUsuario::usuario()['id']]);
    }

    if (!empty($nome)) { SessaoUsuario::set('nome', $nome); }
    if (!empty($email)) { SessaoUsuario::set('email', $email); }
    if (!empty($senha)) { SessaoUsuario::set('senha', $senha); }

    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
