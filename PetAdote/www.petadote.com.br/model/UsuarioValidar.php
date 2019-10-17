<?php

importcore("Valida");
importcore("UploadImagem");

class UsuarioValidar {

  public static function foto($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao) {
    if (empty($avatar_largura) || empty($avatar_altura) || empty($avatar_x) || empty($avatar_y) || empty($selecao_tamanho))
      throw new Exception("problemas ao enviar foto.");
    $img = new UploadImagem($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $selecao_tamanho, $rotacao, null, null, null);
    return $img->src();
  }

  public static function nome($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 20);
  }

  public static function email($x) {
    $x = Valida::limpar($x);
    $email = Valida::email($x);
    $email_existe = CRUD::select('usuario', 'id', 'email = ?', [$email]);
    if (!empty($email_existe))
      throw new Exception("e-mail já está sendo usado");
    return $email;
  }

  public static function senha($x) {
    return Valida::texto($x, 20);
  }

  public static function cidade($x) {
    $x = Valida::limpar($x);
    return Valida::numero($x);
  }

  public static function cnpj($x) {
    $x = Valida::limpar($x);
    $cnpj = Valida::cnpj($x);
    $cnpj_existe = CRUD::select('usuario', 'id', 'cnpj = ?', [$cnpj]);
    if (!empty($cnpj_existe))
      throw new Exception("cnpj já está sendo usado");
    return $cnpj;
  }

  public static function endereco($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 200);
  }

  public static function telefone($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 20);
  }

  public static function rede_sociais($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 200, 0, false);
  }

  public static function instituicao_info($x) {
    return Valida::limpar($x);
  }

}
