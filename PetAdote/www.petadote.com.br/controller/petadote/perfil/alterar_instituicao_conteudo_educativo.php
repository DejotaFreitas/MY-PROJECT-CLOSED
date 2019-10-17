<?php
if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i') {

  $x = json_decode($_POST['json'], true);
  $tag = 'conteudo_educativo';
  $var = $x[$tag];

  import("UsuarioValidar");

  try {

    $dados_update = [];
    $dados_update[$tag] = UsuarioValidar::instituicao_info($x[$tag]);

    $dados_instituicao = CRUD::select('instituicao', 'usuario_id', 'usuario_id=?', [SessaoUsuario::usuario()['id']]);

    if(!empty($dados_instituicao)) {
      CRUD::update('instituicao', $dados_update, 'usuario_id=?', [SessaoUsuario::usuario()['id']]);
    } else {
      $dados_update['usuario_id'] = SessaoUsuario::usuario()['id'];
      CRUD::insert('instituicao', $dados_update);
    }

    SessaoUsuario::set($tag, $x[$tag]);

    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
