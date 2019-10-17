<?php
class SessaoUsuario {

  private static $sessao_usuario = "___sessao_usuario___";

  public function __construct() {  }

  public static function set($idx, $value) {
    return $_SESSION[self::$sessao_usuario][$idx] = $value;
  }

  public static function usuario() {
    return $_SESSION[self::$sessao_usuario];
  }

  public static function logado() {
    return !empty($_SESSION[self::$sessao_usuario]);
  }

  public static function logar($dados_usuario) {
    self::deslogar();
    $_SESSION[self::$sessao_usuario] = $dados_usuario;
    $config = CRUD::select('config', '*', 'usuario_id = ?', [$dados_usuario['id']]);
    if (!empty($config)) {
      $config = $config[0];
      $_SESSION['acessibilidade_cor'] = $config['cor_fundo'];
      $_SESSION['acessibilidade_cor_tema'] = $config['cor_logo'];
      $_SESSION['acessibilidade_cor_corpo'] = $config['cor_corpo'];
      $_SESSION['acessibilidade_icon'] = $config['estilo_icone'];
      $_SESSION['acessibilidade_menu'] = $config['menu_lateral'];
      $_SESSION['acessibilidade_fontsize'] = $config['tamanho_texto'];
    }
  }

  public static function deslogar() {
    session_unset();
    if (isset($_SESSION)) { session_destroy(); }
    session_start();
    session_regenerate_id(true);
  }


}
