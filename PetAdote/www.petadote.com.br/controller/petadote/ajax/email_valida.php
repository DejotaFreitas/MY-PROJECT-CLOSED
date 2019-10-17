<?php
$x = json_decode($_POST['json'], true);
$x = $x['x'];

try {

  if (empty($x)) {
     throw new Exception("e-mail é obrigatório");
  }

  import("UsuarioValidar");
  UsuarioValidar::email($x);
  $existe = CRUD::select('usuario', 'id', 'email = ?', [$x]);
  if (!empty($existe)) {
     throw new Exception("e-mail já está sendo usado");
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
