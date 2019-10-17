<?php
if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i') {

  $x = json_decode($_POST['json'], true);
  $twitter = $x['twitter'];
  $googleplus = $x['googleplus'];
  $site = $x['site'];

  import("UsuarioValidar");

  try {

    $dados_update = [];
    $dados_update['twitter'] = UsuarioValidar::rede_sociais($twitter);
    $dados_update['googleplus'] = UsuarioValidar::rede_sociais($googleplus);
    $dados_update['site'] = UsuarioValidar::rede_sociais($site);

    $dados_instituicao = CRUD::select('instituicao', 'usuario_id', 'usuario_id=?', [SessaoUsuario::usuario()['id']]);

    if(!empty($dados_instituicao)) {
      CRUD::update('instituicao', $dados_update, 'usuario_id=?', [SessaoUsuario::usuario()['id']]);
    } else {
      $dados_update['usuario_id'] = SessaoUsuario::usuario()['id'];
      CRUD::insert('instituicao', $dados_update);
    }

    SessaoUsuario::set('twitter', $twitter);
    SessaoUsuario::set('googleplus', $googleplus);
    SessaoUsuario::set('site', $site);

    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
