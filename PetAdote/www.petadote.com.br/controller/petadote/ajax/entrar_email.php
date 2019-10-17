<?php
$x = json_decode($_POST['json'], true);
$x = $x['x'];

try {

  if (empty($x)) {
     throw new Exception("e-mail é obrigatório");
  }

  importcore("Valida");
  $x = Valida::limpar($x);
  $x = Valida::email($x);
    $existe = CRUD::select('usuario', 'id', 'email = ?', [$x]);
  if (empty($existe)) {
     throw new Exception("e-mail não cadastrado");
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
