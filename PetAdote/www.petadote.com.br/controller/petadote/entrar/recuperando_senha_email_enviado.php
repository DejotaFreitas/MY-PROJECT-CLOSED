<?php
if (SessaoUsuario::logado())
  URL::pagina('home');
else
if ($_SERVER['REQUEST_METHOD']=='POST') {
  try {

    importcore("Valida");
    importcore("SS");

    $email = $_POST['email'];

    try {
      $email = Valida::limpar($email);
      $email = Valida::email($email);
      $dados_usuario = CRUD::select('usuario', 'id', 'email = ?', [$email]);
      if (empty($dados_usuario)){
        throw new Exception("e-mail não cadastrado");
      }
      $dados_usuario = $dados_usuario[0];
    } catch (Exception $e) { SS::s('_ss_vers_', "email", $e->getMessage());  }

    if (!SS::empty('_ss_vers_')) {
      SS::s('_ss_sers_', "email", $email);
      URL::pagina("recuperando-senha");
    } else {

      importcore('PHPMailer');

      $nome_destinatario = "Usuário do PetAdote";
      $destinatario = $email;

      $nome_remetente = "PetAdote";
      $remetente = "petadote@petadote.com.br";
      $email_alternativo_para_receber_respostas = "petadoteprojeto@gmail.com";

      $host_servidor_smtp = "send.one.com";
      $usuario_email_servidor_smtp = "petadote@petadote.com.br";
      $senha_email_servidor_smtp = "Socorro88**";
      $porta_servidor_smtp = "465";
      $smtp_secure = "ssl";

      $mail = new PHPMailer();
      $mail->Port = $porta_servidor_smtp;
      $mail->SMTPSecure = $smtp_secure;
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = $host_servidor_smtp;
      $mail->Username = $usuario_email_servidor_smtp;
      $mail->Password = $senha_email_servidor_smtp;
      $mail->addReplyTo($email_alternativo_para_receber_respostas, $nome_remetente);
      $mail->SetFrom($remetente, htmlentities($nome_remetente));
      $mail->AddAddress($destinatario, $nome_destinatario);
      $mail->IsHTML(true);
      $mail->WordWrap = 50;
      $mail->Subject = htmlentities("Recuperar senha do PetAdote");

      $_SESSION['rash_recuperar_senha_email'] = $email;
      $_SESSION['rash_recuperar_senha'] = hash('sha512', rand(100,1000));
      $rash = $_SESSION['rash_recuperar_senha'];

      $mensagem = 'Acesse esse link para alerar sua senha: ' .DOMINIO.'alterando-senha/'.$rash;

      $mail->Body = htmlentities($mensagem);
      $mail->AltBody = htmlentities($mensagem);

      if(!$mail->Send()){
        $resultado =  "Não foi possível enviar a mensagem para o seu e-mail, tente novamente.";
        URL::pagina("recuperando-senha");
      }

    }

  } catch (Exception $e) {
    URL::pagina("recuperando-senha");
  }

}  else {
    URL::pagina("recuperando-senha");
}
