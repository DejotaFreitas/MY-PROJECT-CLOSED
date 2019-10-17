<?php

importcore("Valida");

class EmailValidar {

  public static function nome($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 20);
  }

  public static function email($x) {
    $x = Valida::limpar($x);
    return Valida::email($x);
  }

  public static function assunto($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 100);
  }

  public static function mensagem($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 1000);
  }




}
