<?php
$x = json_decode($_POST['json'], true);
$x = $x['x'];

try {
  if (empty($x)) {
     throw new Exception("cnpj é obrigatório");
  }
  import("UsuarioValidar");
  $x = UsuarioValidar::cnpj($x);
  $existe = CRUD::select('usuario', 'id', 'cnpj = ?', [$x]);
  if (!empty($existe)) {
     throw new Exception("cnpj já está sendo usado");
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
