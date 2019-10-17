<?php
if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i') {

  $x = json_decode($_POST['json'], true);
  $facebook = $x['facebook'];
  $instagram = $x['instagram'];
  $youtube = $x['youtube'];

  import("UsuarioValidar");

  try {

    $dados_update = [];
    $dados_update['facebook'] = UsuarioValidar::rede_sociais($facebook);
    $dados_update['instagram'] = UsuarioValidar::rede_sociais($instagram);
    $dados_update['youtube'] = UsuarioValidar::rede_sociais($youtube);

    $dados_instituicao = CRUD::select('instituicao', 'usuario_id', 'usuario_id=?', [SessaoUsuario::usuario()['id']]);

    if(!empty($dados_instituicao)) {
      CRUD::update('instituicao', $dados_update, 'usuario_id=?', [SessaoUsuario::usuario()['id']]);
    } else {
      $dados_update['usuario_id'] = SessaoUsuario::usuario()['id'];
      CRUD::insert('instituicao', $dados_update);
    }

    SessaoUsuario::set('facebook', $facebook);
    SessaoUsuario::set('instagram', $instagram);
    SessaoUsuario::set('youtube', $youtube);

    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
