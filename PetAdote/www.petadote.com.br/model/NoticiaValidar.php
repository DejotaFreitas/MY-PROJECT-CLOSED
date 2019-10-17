<?php

importcore("Valida");

class NoticiaValidar {

  public static function titulo($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 100);
  }

  public static function descricao($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 10000);
  }




}
