<?php
$x = json_decode($_POST['json'], true);
$cnpj_parceiro = $x['cnpj_parceiro'];
try {

  $id_usuario = SessaoUsuario::usuario()['id'];
  $parceiro = [];
  $parceiro = CRUD::selectQuery(" SELECT * FROM parceiros WHERE cnpj=? AND usuario_id=?", [$cnpj_parceiro, $id_usuario]);

  if (!empty($parceiro)) {
    $parceiro = $parceiro[0];
    echo json_encode($parceiro);
  }

} catch (Exception $e) {}
