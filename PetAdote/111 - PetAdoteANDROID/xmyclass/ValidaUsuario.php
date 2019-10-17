<?php
importcore("Valida");
class ValidaUsuario {

  public static function nome($x) {
    return Valida::texto($x, "Nome", 20, 2);
  }

  public static function email($x) {
    return Valida::email($x, "E-mail", 100, 5);
  }

  public static function senha($x) {
    return  Valida::texto($x, "Senha", 20, 4);
  }


}
