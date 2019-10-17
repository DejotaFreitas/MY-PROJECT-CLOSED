<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
  try {

    import("ValidaUsuario");
    $email = ValidaUsuario::email($_POST['email']);
    $senha = ValidaUsuario::senha($_POST['senha']);
    $usuario = $crud->select('usuario', '*', 'email = ?', [$email]);
    if (!empty($usuario)) {
      $usuario = $usuario[0];
      if (password_verify($senha, $usuario['senha'])) {
        echo json_encode(["response"=>"ok", "id"=>$usuario['id'], "nome"=>$usuario['nome'], "email"=>$usuario['email'], "senha"=>$usuario['senha'], "cidade_id"=>$usuario['cidade_id'], "time"=>$usuario['time'], "foto"=>$usuario['foto'] ]);
      } else {
        echo json_encode(["response"=>"Senha incorreta."]);
      }
    } else {
      echo json_encode(["response"=>"E-mail não está cadastrado."]);
    }

  } catch (Exception $e) {
    echo json_encode(["response"=>"Problemas para efetuar o login."]);
  }

}
