<?php
importcore("SS");
import("EmailValidar");
if (SessaoUsuario::logado()) {

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

      $assunto = $_POST['assunto'];
      $mensagem = $_POST['mensagem'];

      try {
        $assunto = EmailValidar::assunto($assunto);
      } catch (Exception $e) { SS::s('_ss_vae_', "assunto", $e->getMessage());  }

      try {
        $mensagem = EmailValidar::mensagem($mensagem);
      } catch (Exception $e) { SS::s('_ss_vae_', "mensagem", $e->getMessage());  }

      if (SS::empty('_ss_vae_')) {

          importcore('PHPMailer');

          $nome_destinatario = "PetAdote";
          $destinatario = "petadoteprojeto@gmail.com";

          $nome_remetente = SessaoUsuario::usuario()['nome'];
          $remetente = "petadote@petadote.com.br";
          $email_alternativo_para_receber_respostas = SessaoUsuario::usuario()['email'];

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
          $mail->Subject = htmlentities($assunto);
          $mail->Body = htmlentities($mensagem);
          $mail->AltBody = htmlentities($mensagem);

          if($mail->Send()){
            $resultado =  "Mensagem enviado com sucesso!!!";
          }	else {
            $resultado =  "Não foi possível enviar a mensagem.";
          }

      } else {
        SS::s('_ss_sae_', "nome", $nome);
        SS::s('_ss_sae_', "email", $email);
        SS::s('_ss_sae_', "assunto", $assunto);
        SS::s('_ss_sae_', "mensagem", $mensagem);
      }

    } catch (Exception $e) {}
  }

} else {
  if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $assunto = $_POST['assunto'];
      $mensagem = $_POST['mensagem'];

      try {
        $nome = EmailValidar::nome($nome);
      } catch (Exception $e) { SS::s('_ss_vae_', "nome", $e->getMessage());  }

      try {
        $email = EmailValidar::email($email);
      } catch (Exception $e) { SS::s('_ss_vae_', "email", $e->getMessage());  }

      try {
        $assunto = EmailValidar::assunto($assunto);
      } catch (Exception $e) { SS::s('_ss_vae_', "assunto", $e->getMessage());  }

      try {
        $mensagem = EmailValidar::mensagem($mensagem);
      } catch (Exception $e) { SS::s('_ss_vae_', "mensagem", $e->getMessage());  }

      if (SS::empty('_ss_vae_')) {

          importcore('PHPMailer');

          $nome_destinatario = "PetAdote";
          $destinatario = "petadoteprojeto@gmail.com";
          $remetente = "petadote@petadote.com.br";
          $nome_remetente = $nome;
          $email_alternativo_para_receber_respostas = $email;

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
          $mail->Subject = htmlentities($assunto);
          $mail->Body = htmlentities($mensagem);
          $mail->AltBody = htmlentities($mensagem);

          if($mail->Send()){
            $resultado =  "Mensagem enviado com sucesso!!!";
          }	else {
            $resultado =  "Mensagem não pode ser enviada.";
          }

      } else {
        SS::s('_ss_sae_', "nome", $nome);
        SS::s('_ss_sae_', "email", $email);
        SS::s('_ss_sae_', "assunto", $assunto);
        SS::s('_ss_sae_', "mensagem", $mensagem);
      }

    } catch (Exception $e) {}

  }
}
