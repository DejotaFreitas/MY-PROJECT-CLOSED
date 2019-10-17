<?php
$x = json_decode($_POST['json'], true);
$cnpj_parceiro = $x['cnpj_parceiro'];
try {

  $parceiro = [];
  $parceiro = CRUD::selectQuery(" SELECT * FROM parceiros WHERE cnpj=?", [$cnpj_parceiro]);

  if (!empty($parceiro)) {
    $parceiro = $parceiro[0];
    echo json_encode($parceiro);
  }

} catch (Exception $e) {}
