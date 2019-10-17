<?php
if (!SessaoUsuario::logado())
  URL::pagina('home');
else
if ($_SERVER['REQUEST_METHOD']=='POST') {

  $avatar_largura = $_POST['avatar_largura'];
  $avatar_altura = $_POST['avatar_altura'];
  $avatar_x = $_POST['avatar_x'];
  $avatar_y = $_POST['avatar_y'];
  $selecao_tamanho = $_POST['selecao_tamanho'];
  $rotacao = $_POST['rotacao'];

  import("UsuarioValidar");
  importcore("SS");

  try {
    $img_src = UsuarioValidar::foto('avatar', CONTEINER_WEB.'uploadimg/usuarios', $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao);
    $foto_antiga = SessaoUsuario::usuario()['foto'];
    $id_usuario = SessaoUsuario::usuario()['id'];
    $dados_update = ['foto'=>$img_src];
    CRUD::update('usuario', $dados_update, 'id=?', [$id_usuario]);
    if (file_exists(DIRETORIO_RAIZ.$foto_antiga)){
      unlink(DIRETORIO_RAIZ.$foto_antiga);
    }
    SessaoUsuario::set('foto', $img_src);
  } catch (Exception $e) { SS::s('_ss_vp_', "foto", $e->getMessage()); }

}
