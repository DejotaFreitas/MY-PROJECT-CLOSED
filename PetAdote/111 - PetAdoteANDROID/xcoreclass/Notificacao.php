<?php

class Notificacao {

  public static function notificar_erro($erro){
    $_SESSION['notificacao_erro'][] = $erro;
  }

  public static function notificar_sucesso($sucesso){
    $_SESSION['notificacao_sucesso'][] = $sucesso;
  }

  public static function notificacoes() {

    if (!empty($_SESSION['notificacao_sucesso'])) {
      echo '<div class="row"> <div class="card-panel green white-text">';
      foreach ($_SESSION['notificacao_sucesso'] as $value) {
        echo '<span>'.$value.'</span>';
      }
      echo'</div></div>';
      unset($_SESSION['notificacao_sucesso']);
    }

    if (!empty($_SESSION['notificacao_erro'])) {
      echo '<div class="row"> <div class="card-panel red white-text">';
      foreach ($_SESSION['notificacao_erro'] as $value) {
        echo '<span>'.$value.'</span>';
      }
      echo'</div></div>';
      unset($_SESSION['notificacao_erro']);
    }


  }


}
