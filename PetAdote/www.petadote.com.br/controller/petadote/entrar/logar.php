<?php
if (SessaoUsuario::logado())
  URL::pagina('home');
else
if ($_SERVER['REQUEST_METHOD']=='POST') {
  try {

    importcore("Valida");
    importcore("SS");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
      $senha = Valida::texto($senha, 20);
    } catch (Exception $e) { SS::s('_ss_vel_', "senha", $e->getMessage());  }

    try {
      $email = Valida::limpar($email);
      $email = Valida::email($email);

      $dados_usuario = CRUD::select('
      usuario u
      INNER JOIN cidade c ON c.id = u.cidade_id
      INNER JOIN estado e ON e.id = c.estado_id
      INNER JOIN pais i ON i.id = e.pais_id',
       'u.*, c.estado_id , e.pais_id',
       'u.email = ?', [$email]);

      if (empty($dados_usuario)){ throw new Exception("e-mail não cadastrado"); }
      $dados_usuario = $dados_usuario[0];
      if (password_verify($senha, $dados_usuario['senha'])) {
        if ( $dados_usuario['tipo'] == 'i') {
          $dados_instituicao = CRUD::select('instituicao', '*',  'usuario_id=?', [$dados_usuario['id']]);
          if (!empty($dados_instituicao)) {
            $dados_usuario = array_merge($dados_usuario, $dados_instituicao[0]);
          }
        }
        SessaoUsuario::logar($dados_usuario);
      } else {
        SS::s('_ss_vel_', "senha", "senha inválida");
      }
    } catch (Exception $e) { SS::s('_ss_vel_', "email", $e->getMessage());  }


    if (!SS::empty('_ss_vel_')) {
      SS::s('_ss_sel_', "email", $email);
      SS::s('_ss_sel_', "senha", $senha);
      URL::pagina("entrar");
    }

  } catch (Exception $e) {
    URL::pagina("entrar");
  }

}
