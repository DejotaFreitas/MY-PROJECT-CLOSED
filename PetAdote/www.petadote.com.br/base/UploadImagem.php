<?php

class UploadImagem {

  private $src;

  function __construct($nameTag, $destino, $largura_exibida=null, $altura_exibida=null, $corte_x=null, $corte_y=null, $corte_largura=null, $corte_altura=null, $angulo_rotacao=0, $dimensao_max=null, $largura=null, $altura=null){

    if ( isset($_FILES[$nameTag]['name']) && $_FILES[$nameTag]['error'] == 0 ) {

      $tamnhoMaximo = 1024 * 1024 * 5;
      if ($_FILES[ $nameTag ][ 'size' ] <= $tamnhoMaximo) {
          $imagem_path = $_FILES[ $nameTag ][ 'tmp_name' ];
          $nome = $_FILES[ $nameTag ][ 'name' ];
          $extensao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));

          if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {

              $novoNome = $this->novo_nome();
              $this->criar_direotrio($destino);
              $this->src = $destino.'/'.$novoNome.'.'.$extensao;
              $imagem_temp = $this->carregar_imagem($imagem_path, $extensao);
              $extensao = 'jpg';
              $this->criar_arquivo_imagem($imagem_temp, $extensao, $this->src);
              imagedestroy($imagem_temp);
              unlink($imagem_path);

              if ($angulo_rotacao%360 != 0) {
                $novoNome = $this->novo_nome();
                $this->src = $this->rotacionar(DIRETORIO_RAIZ.$this->src, $destino, $novoNome, $extensao, $angulo_rotacao);
              }

              if ($largura_exibida != null && $altura_exibida != null && $corte_x != null && $corte_y != null && $corte_largura != null && $corte_altura != null) {
                $imagem_size = getimagesize(DIRETORIO_RAIZ.$this->src);
                $imagem_largura_original = $imagem_size[0];
                $imagem_altura_original = $imagem_size[1];
                if ($angulo_rotacao == 0 || $angulo_rotacao == 180 || $angulo_rotacao == -180) {
                  $p_x = ($imagem_largura_original * $corte_x) / $largura_exibida;
                  $p_y = ($imagem_altura_original * $corte_y) / $altura_exibida;
                  $p_corte_largura = ($corte_largura * $imagem_largura_original) / $largura_exibida;
                  $p_corte_altura = ($corte_altura * $imagem_altura_original) / $altura_exibida;
                } else {
                  $p_x = ($imagem_largura_original * $corte_x) / $altura_exibida;
                  $p_y = ($imagem_altura_original * $corte_y) / $largura_exibida;
                  $p_corte_largura = ($corte_largura * $imagem_largura_original) / $altura_exibida;
                  $p_corte_altura = ($corte_altura * $imagem_altura_original) / $largura_exibida;
                }

                $novoNome = $this->novo_nome();
                $this->src = $this->cortar(DIRETORIO_RAIZ.$this->src, $destino, $novoNome, $extensao, $p_x, $p_y, $p_corte_largura, $p_corte_altura);
              }

              if ($dimensao_max != null || $largura != null || $altura != null) {
                $this->src = $this->redimensionar(DIRETORIO_RAIZ.$this->src, $destino, $novoNome, $extensao, $dimensao_max, $largura, $altura);
              }

          } else { throw new Exception('Envie imagens nos formatos jpg, jpeg, png ou gif.'); }
      } else { throw new Exception('Imagem é muito grande, envie imagem menor que 20MB.'); }
    } else {
      if ($_FILES[$nameTag]['error'] == 1) { throw new Exception('A imagem estrapolou o tamanho máximo de upload suportado pelo servidor.'); // upload_max_filesize
      } elseif ($_FILES[$nameTag]['error'] == 2) {  throw new Exception('A imagem estrapolou o tamanho máximo de upload suportado pelo formulário .'); // post_max_size
      } else { throw new Exception('Não foi possível enviar a imagem.'); } // erros 3 4 5 6 7 8
    }
  }


  //=====================================================================

  private function novo_nome(){
    return time().md5(uniqid(rand(), true));
  }

  //=====================================================================

  private function criar_direotrio($dir){
    if(!is_dir($dir)):
      mkdir($dir, 0777, true);
    endif;
  }

  //=======================================================================

  private function carregar_imagem($caminho_img, $extensao) {
      switch ($extensao):
        case 'jpg':
                   $imagem_temp = @imagecreatefromjpeg($caminho_img);
                   if (!$imagem_temp)
                     $imagem_temp = imagecreatefromstring(file_get_contents($caminho_img));
                   break;
        case 'jpeg': $imagem_temp = imagecreatefromjpeg($caminho_img);  break;
        case 'png':  $imagem_temp = imagecreatefrompng($caminho_img);   break;
        case 'gif':  $imagem_temp = imagecreatefromgif($caminho_img);   break;
        default: throw new Exception('Use imagens com seguintes formatos: jpg, jpeg, png ou gif.');
      endswitch;
      return $imagem_temp;
    }

  //=======================================================================

  private function criar_arquivo_imagem($imagem, $extensao, $src) {
    switch ($extensao):
      case 'jpg':  imagejpeg($imagem, $src, 100);   break;
      case 'jpeg': imagejpeg($imagem, $src, 100);   break;
      case 'png':  imagepng($imagem, $src);         break;
      case 'gif':  imagegif($imagem, $src);         break;
      default: throw new Exception('Use formatos de imagem: jpg, jpeg, png ou gif');  break;
    endswitch;
    return $imagem;
  }

  //=======================================================================

  private function redimensionar($caminho_img, $diretorio_destino, $nome_aquivo, $extensao, $dimensao_max=null, $largura=null, $altura=null){

    $src = $diretorio_destino.'/'.$nome_aquivo.'.'.$extensao;

    $imagem_temp = $this->carregar_imagem($caminho_img, $extensao);

    $largura_original = imagesx($imagem_temp);
    $altura_original = imagesy($imagem_temp);

    if ($dimensao_max != null) {

      if ($largura_original >= $altura_original) {
        $nova_largura = $dimensao_max;
        $nova_altura = floor(($altura_original*$nova_largura)/$largura_original);
      } else {
        $nova_altura = $dimensao_max;
        $nova_largura = floor(($largura_original*$nova_altura)/$altura_original);
      }

    } elseif ($largura != null && $altura == null) {
      $nova_largura = $largura;
      $nova_altura = floor(($altura_original*$nova_largura)/$largura_original);

    } elseif ($largura == null && $altura != null) {
      $nova_altura = $altura;
      $nova_largura = floor(($largura_original*$nova_altura)/$altura_original);

    } elseif ($largura != null && $altura != null) {
      $nova_largura = $largura;
      $nova_altura = $altura;

    } else {
      $nova_largura = $largura_original;
      $nova_altura = $altura_original;
    }

    $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
    imagecopyresampled($imagem_redimensionada, $imagem_temp, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);

    $this->criar_arquivo_imagem($imagem_redimensionada, $extensao, $src);

    imagedestroy($imagem_temp);
    imagedestroy($imagem_redimensionada);
    unlink($caminho_img);
    return $src;
  }

  //=======================================================================

  private function rotacionar($caminho_img, $diretorio_destino, $novoNome, $extensao, $angulo_rotacao) {

    $src = $diretorio_destino.'/'.$novoNome.'.'.$extensao;

    $imagem_temp = $this->carregar_imagem($caminho_img, $extensao);

    $imagem_rotacionada = imagerotate($imagem_temp, $angulo_rotacao, 0);

    $this->criar_arquivo_imagem($imagem_rotacionada, $extensao, $src);

    imagedestroy($imagem_temp);
    imagedestroy($imagem_rotacionada);
    unlink($caminho_img);
    return $src;
  }

  //=======================================================================


  private function cortar($caminho_img, $diretorio_destino, $nome_aquivo, $extensao, $cx, $cy, $largura, $altura){

    $src = $diretorio_destino.'/'.$nome_aquivo.'.'.$extensao;

    $imagem_temp = $this->carregar_imagem($caminho_img, $extensao);

    $imagem_cortada = imagecreatetruecolor($largura, $altura);
    imagecopyresampled($imagem_cortada, $imagem_temp, 0, 0, $cx, $cy, $largura, $altura, $largura, $altura);

    $this->criar_arquivo_imagem($imagem_cortada, $extensao, $src);

    imagedestroy($imagem_temp);
    imagedestroy($imagem_cortada);
    unlink($caminho_img);
    return $src;
  }

  //=======================================================================

  public function src(){
    return $this->src;
  }

  //=======================================================================

  public function __toString(){
    return $this->src;
  }

}//fim classe
