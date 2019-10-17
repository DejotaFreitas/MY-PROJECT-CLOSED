<?php
$x = json_decode($_POST['json'], true);
$email = $x['email'];
$senha = $x['senha'];

try {
  importcore("Valida");
  $senha = Valida::texto($senha, 20);
  $dados_usuario = CRUD::select('usuario', 'senha', 'email = ?', [$email]);
  if (!empty($dados_usuario))
  $dados_usuario = $dados_usuario[0];
    if (!password_verify($senha, $dados_usuario['senha'])) {
      throw new Exception("senha inválida");
    }

} catch (Exception $e) {
  echo $e->getMessage();
}
