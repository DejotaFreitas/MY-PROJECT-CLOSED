<?php
if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i'){

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

      importcore("CSRF");
      CSRF::inicio_submit_formulario();

      $titulo = $_POST['titulo'];
      $descricao = $_POST['descricao'];

      import("NoticiaValidar");
      importcore("SS");


      try {
        $titulo = NoticiaValidar::titulo($titulo);
      } catch (Exception $e) { SS::s('_ss_vcnt_', "titulo", $e->getMessage());  }

      try {
        $descricao = NoticiaValidar::descricao($descricao);
      } catch (Exception $e) { SS::s('_ss_vcnt_', "descricao", $e->getMessage());  }

      if (SS::empty('_ss_vcnt_')) {

        $dados_noticia = ["titulo"=>$titulo, "descricao"=>$descricao , "time"=>time(), 'usuario_id'=>SessaoUsuario::usuario()['id']];

        CRUD::insert('noticias', $dados_noticia);
        CSRF::apos_cadastro_sucesso();

      } else {
        SS::s('_ss_scnt_', "titulo", $titulo);
        SS::s('_ss_scnt_', "descricao", $descricao);
      }

    } catch (Exception $e) {
      URL::pagina("cadastrando-noticias");
    }

  }


} else {
  URL::pagina('home');
}
