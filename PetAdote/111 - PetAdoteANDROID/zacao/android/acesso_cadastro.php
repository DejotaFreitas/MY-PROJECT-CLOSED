<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {

  try {
    import("ValidaUsuario");
    $nome = ValidaUsuario::nome($_POST['nome']);
    $email = ValidaUsuario::email($_POST['email']);
    $senha = ValidaUsuario::senha($_POST['senha']);
    $senha = password_hash($senha, PASSWORD_BCRYPT);
    $cidade_id = $_POST['cidade_id'];

    $email_existe = $crud->select('usuario', '*', 'email = ?', [$email]);
    if (empty($email_existe)) {
      importcore("UploadImagem");
      $img = new UploadImagem('foto', DIRETORIO_IMG_USUARIO);
      $img_src = $img->src();
      $time = time();
      $dados = ['nome'=>$nome, 'email'=>$email, 'senha'=>$senha, 'foto'=>$img_src, 'cidade_id'=>$cidade_id, 'time'=>$time];
      $crud->insert('usuario', $dados);
      $id = $crud->last_id();
      echo json_encode(["response"=>"ok", "id"=>$id, "foto"=>$img_src, 'senha'=>$senha, 'time'=>$time]);
    } else {
      echo json_encode(["response"=>"Esse e-mail já está sendo usado."]);
    }

  } catch (Exception $e) {
    echo json_encode(["response"=>$e->getMessage()]);
  }

}
