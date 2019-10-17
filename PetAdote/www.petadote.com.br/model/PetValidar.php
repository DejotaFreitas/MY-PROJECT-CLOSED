<?php

importcore("Valida");
importcore("UploadImagem");

class PetValidar {

  public static function foto($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao) {
    if (empty($avatar_largura) || empty($avatar_altura) || empty($avatar_x) || empty($avatar_y) || empty($selecao_tamanho) || !isset($rotacao))
      throw new Exception("problemas na edição da foto.");
    $img = new UploadImagem($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $selecao_tamanho, $rotacao, null, null, null);
    return $img->src();
  }

  public static function nome($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x,20);
  }

  public static function relacao($x) {
    $x = Valida::limpar($x);
    if ($x == "Doação" || $x == "Perdido"|| $x == "Encontrado") { return $x; }
    throw new Exception("situacao inválido");
  }

  public static function especie($x) {
    $x = Valida::limpar($x);
    if ($x == "Cachorro" || $x == "Gato") { return $x; }
    throw new Exception("especie inválido");
  }

  public static function genero($x) {
    $x = Valida::limpar($x);
    if ($x == "Macho" || $x == "Fêmea") { return $x; }
    throw new Exception("genero inválido");
  }

  public static function idade($x) {
    $x = Valida::limpar($x);
    if ($x == "Filhote" || $x == "Adulto") { return $x; }
    throw new Exception("faixa_etaria inválido");
  }

  public static function porte($x) {
    $x = Valida::limpar($x);
    if ($x == "Pequeno" || $x == "Médio" | $x == "Grande") { return $x; }
    throw new Exception("porte inválido");
  }

  public static function castrado($x) {
    $x = Valida::limpar($x);
    if ($x == "Não" || $x == "Sim") { return $x; }
    throw new Exception("castrado inválido");
  }

  public static function vacinado($x) {
    $x = Valida::limpar($x);
    if ($x == "Não" || $x == "Sim") { return $x; }
    throw new Exception("vacinado inválido");
  }

  public static function descricao($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 600, 0, false);
  }

}
