<?php
$x = json_decode($_POST['json'], true);
$cnpj_parceiro = $x['cnpj_parceiro'];
try {
  $id_usuario = SessaoUsuario::usuario()['id'];
  CRUD::delete('parceiros', 'cnpj = ? AND usuario_id=?', [$cnpj_parceiro, $id_usuario]);
  echo "deletado";
} catch (Exception $e) {}
