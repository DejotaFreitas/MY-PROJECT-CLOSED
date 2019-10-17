<?php
$x = json_decode($_POST['json'], true);
$email = $x['x'];

try {
  importcore('Valida');
  $email = Valida::limpar($email);

  $email_existe = CRUD::select('usuario', 'id', 'email = ? AND id<>?', [$email, SessaoUsuario::usuario()['id']]);

  if (!empty($email_existe)){  echo"e-mail indisponível";  }

} catch (Exception $e) { }
