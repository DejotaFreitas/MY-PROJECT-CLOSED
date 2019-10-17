<?php
class SessaoUsuario {

  private static $sessao_usuario = "___sessao_usuario___";

  public function __construct() {  }

  public static function usuario() {
    return $_SESSION[self::$sessao_usuario];
  }

  public static function logado() {
    return !empty($_SESSION[self::$sessao_usuario]);
  }

  public static function logar($dados_usuario) {
    self::deslogar();
    $_SESSION[self::$sessao_usuario] = $dados_usuario;
  }

  public static function deslogar() {
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);
  }


}
