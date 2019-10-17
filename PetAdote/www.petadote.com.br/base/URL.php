<?php
class URL {

  private static $rotas = [];
  private static $rotaspaginas = [];
  private static $rota = 'home';
  private static $pagina = 'home';
  private static $vars = [];


  public static function init_routes() {
    if (!empty($_GET['urlroute'])) {
      $urlist = explode("/", $_GET['urlroute']);
      for ($i=0; $i < count($urlist); $i++) {
        if ($i == 0) {
          self::$rota = $urlist[$i];
        } else {
          self::$vars[] = $urlist[$i];
        }
      }
    }
  }

  public static function rotas($x) {
    self::$rotas = $x;
  }

  public static function rotaspaginas($x) {
    self::$rotaspaginas = $x;
  }

  private static function rota() {
    if (isset(self::$rotas[self::$rota])) {
      return self::$rotas[self::$rota];
    }
    return false;
  }

  public static function atualizar_rotas_pagina() {
    if (self::rota()) {
      self::$pagina = self::rota()['pagina'];
    }
    return false;
  }

  private static function app_controller() {
    if (self::rota()) {
      return self::rota()['app'];
    }
    return false;
  }

  private static function app() {
    if (self::rota()) {
      if (!self::is_mobile())
        return self::rota()['app'];
      // return self::rota()['app']."_mobile";
      return self::rota()['app'];

    }
    return false;
  }


  public static function acao() {
    if (self::rota() && self::rota()['acao'] !== false)
      return DIRETORIO_CONTROLLER.self::app_controller().'/'.self::rota()['acao'].'.php';
    return false;
  }

  public static function pagina($x=null) {
    if ($x!==null){ self::$pagina = $x; }
    if (self::rota() && self::$pagina !== false) {
      return DIRETORIO_WEB.self::app()."/pagina/".self::$rotaspaginas[self::$pagina]['pagina'].'.php';
    } elseif (self::$pagina === false) {
      return false;
    } else {
      return DIRETORIO_RAIZ.'404.php';
    }

  }

  public static function vars() {
    return self::$vars;
  }

  public static function var($index=null) {
    if ($index===null)
      if (isset(self::$vars[$index]))
        return self::$vars[$index];
    if (isset(self::$vars[0]))
      return self::$vars[0];
  }

  public static function head() {
    if (self::rota())
      return DIRETORIO_WEB.self::app().'/head.php';
    return false;
  }

  public static function header() {
    if (self::rota())
      return DIRETORIO_WEB.self::app().'/header.php';
    return false;
  }

  public static function footer($x=null) {
    if (self::rota())
      return DIRETORIO_WEB.self::app().'/footer.php';
    return false;
  }

  public static function css() {
    if (self::rota())
      if (self::rota()['pagina'] !== false)
        return self::$rotaspaginas[self::$pagina]['css'];
    return false;
  }

  public static function js() {
    if (self::rota())
      if (self::rota()['pagina'] !== false)
        return self::$rotaspaginas[self::$pagina]['js'];
    return false;
  }

  public static function webapp() {
    if (self::rota())
      return CONTEINER_WEB.self::app()."/";
    return false;
  }

  public static function is_mobile(){
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian)
      return  true ;
    return  false;
  }

}
