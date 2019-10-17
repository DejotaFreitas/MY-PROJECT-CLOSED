<?php

class CSRF {

  public static function inserir_formulario(){
    $_SESSION['CSRF'] = $_SESSION['CSRF'] ?? hash('sha512', rand(100,1000));
    echo '<input type="hidden" name="csrf_valida" value="'.$_SESSION['CSRF'].'">';
  }

  public static function inicio_submit_formulario(){
    if ($_POST['csrf_valida'] != $_SESSION['CSRF']) {
      throw new Exception("aparetemente você está tentando sobrecarregar o site, caso não seja proposital, feche e abra o navegador de internet.");
    }
  }

  public static function apos_cadastro_sucesso(){
    $_SESSION['CSRF'] = hash('sha512', rand(100,1000));
  }

}
