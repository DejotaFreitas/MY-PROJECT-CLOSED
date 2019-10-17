<?php

importcore("Valida");
importcore("UploadImagem");

class ParceiroValidar {

  public static function foto($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao) {
    if (empty($avatar_largura) || empty($avatar_altura) || empty($avatar_x) || empty($avatar_y) || empty($selecao_tamanho))
      throw new Exception("problemas ao enviar foto.");
    $img = new UploadImagem($foto_tag, $dir_save, $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $selecao_tamanho, $rotacao, null, null, null);
    return $img->src();
  }

  public static function nome($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 100);
  }

  public static function cnpj($x) {
    $x = Valida::limpar($x);
    $cnpj = Valida::cnpj($x);
    if (SessaoUsuario::logado()) {
      $existe = CRUD::select('parceiros', 'cnpj', 'cnpj=? AND usuario_id=?', [$cnpj, SessaoUsuario::usuario()['id']]);
      if (!empty($existe))
        throw new Exception("cnpj já está sendo usado entre seus parceiros");
    }
    return $cnpj;
  }


  public static function email($x) {
    $x = Valida::limpar($x);
    $email = Valida::email($x, 100, 0, false);
    return $email;
  }

  public static function telefone($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 20, 0, false);
  }

  public static function endereco($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 200, 0, false);
  }

  public static function site($x) {
    $x = Valida::limpar($x);
    return Valida::texto($x, 200, 0, false);
  }


}
