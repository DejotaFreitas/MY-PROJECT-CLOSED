<?php
if (SessaoUsuario::logado()) {

  $x = json_decode($_POST['json'], true);

  import("UsuarioValidar");

  try {

    $dados_update = [];
    if (!empty($x['telefone']) && $x['telefone'] != SessaoUsuario::usuario()['telefone']) {
      $dados_update['telefone'] = UsuarioValidar::telefone($x['telefone']);
    }
    if (isset($x['cnpj']) && !empty($x['cnpj']) && $x['cnpj'] != SessaoUsuario::usuario()['cnpj']) {
      $dados_update['cnpj'] = UsuarioValidar::cnpj($x['cnpj']);
    }
    if (isset($x['endereco'])  && !empty($x['endereco']) && $x['endereco'] != SessaoUsuario::usuario()['endereco']) {
      $dados_update['endereco'] = UsuarioValidar::endereco($x['endereco']);
    }

    if (!empty($dados_update)) {
      CRUD::update('usuario', $dados_update, 'id=?', [SessaoUsuario::usuario()['id']]);
    }

    if (isset($dados_update['telefone'])) { SessaoUsuario::set('telefone', $dados_update['telefone']); }
    if (isset($dados_update['cnpj'])) { SessaoUsuario::set('cnpj', $dados_update['cnpj']); }
    if (isset($dados_update['endereco'])) { SessaoUsuario::set('endereco', $dados_update['endereco']); }

    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
