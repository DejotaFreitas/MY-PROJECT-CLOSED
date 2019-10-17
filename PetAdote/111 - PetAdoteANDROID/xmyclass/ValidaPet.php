<?php
importcore("Valida");
class ValidaPet {

  public static function nome($x) {
    return Valida::texto($x, "Nome", 20, 2);
  }

  public static function descricao($x) {
    return Valida::texto($x, "Descrição", 600, 0, false);
  }

  public static function tipo($x) {
    $y = Valida::texto($x, "Tipo");
    if($y != "Cachorro" && $y!="Gato"){
      throw new Exception("Tipo: deve ser Cachorro ou Gato.");
    }
    return $y;
  }

  public static function genero($x) {
    $y = Valida::texto($x, "Gênero");
    if($y != "Macho" && $y!="Fêmea"){
      throw new Exception("Gênero: deve ser Macho ou Fêmea.");
    }
    return $y;
  }

  public static function faixa_etaria($x) {
    $y = Valida::texto($x, "Faixa Etária");
    if($y != "Jovem" && $y!="Adulto" && $y!="Velho"){
      throw new Exception("Faixa Etária: deve ser Jovem, Adulto ou Velho.");
    }
    return $y;
  }

  public static function tamanho($x) {
    $y = Valida::texto($x, "Tamanho");
    if($y != "Pequeno" && $y!="Médio" && $y!="Grande"){
      throw new Exception("Tamanho: deve ser Pequeno, Médio ou Grande.");
    }
    return $y;
  }

  public static function castrado($x) {
    $y = Valida::texto($x, "Castrado");
    if($y != "Sim" && $y!="Não"){
      throw new Exception("Castrado: deve ser Sim ou Não.");
    }
    return $y;
  }


}
