<?php
if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i'){

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

      importcore("CSRF");
      CSRF::inicio_submit_formulario();

      $nome = $_POST['nome'];
      $cnpj = $_POST['cnpj'];
      $endereco = $_POST['endereco'];
      $email = $_POST['email'];
      $telefone = $_POST['telefone'];
      $site = $_POST['site'];

      $avatar_largura = $_POST['avatar_largura'];
      $avatar_altura = $_POST['avatar_altura'];
      $avatar_x = $_POST['avatar_x'];
      $avatar_y = $_POST['avatar_y'];
      $selecao_tamanho = $_POST['selecao_tamanho'];
      $rotacao = $_POST['rotacao'];

      import("ParceiroValidar");
      importcore("SS");

      try {
        $img_src = ParceiroValidar::foto('avatar',CONTEINER_WEB.'/uploadimg/parceiros', $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao);
        SS::clean('_ss_vcip_', "foto");
      } catch (Exception $e) { SS::s('_ss_vcip_', "foto", $e->getMessage()); }

      try {
        $nome = ParceiroValidar::nome($nome);
      } catch (Exception $e) { SS::s('_ss_vcip_', "nome", $e->getMessage());  }

      try {
        $cnpj = ParceiroValidar::cnpj($cnpj);
      } catch (Exception $e) { SS::s('_ss_vcip_', "cnpj", $e->getMessage());  }

      if (!empty($endereco))
      try {
        $endereco = ParceiroValidar::endereco($endereco);
      } catch (Exception $e) { SS::s('_ss_vcip_', "endereco", $e->getMessage());  }

      if (!empty($email))
        try {
          $email = ParceiroValidar::email($email);
        } catch (Exception $e) { SS::s('_ss_vcip_', "email", $e->getMessage());  }

      if (!empty($telefone))
        try {
          $telefone = ParceiroValidar::telefone($telefone);
        } catch (Exception $e) { SS::s('_ss_vcip_', "telefone", $e->getMessage());  }

      if (!empty($site))
        try {
          $site = ParceiroValidar::site($site);
        } catch (Exception $e) { SS::s('_ss_vcip_', "site", $e->getMessage());  }


      if (SS::empty('_ss_vcip_')) {

        $dados_parceiro = ["foto"=>$img_src, "nome"=>$nome , "cnpj"=>$cnpj, 'usuario_id'=>SessaoUsuario::usuario()['id']];

        if (!empty($email)) { $dados_parceiro['email'] = $email; }
        if (!empty($endereco)) { $dados_parceiro['endereco'] = $endereco; }
        if (!empty($telefone)) { $dados_parceiro['telefone'] = $telefone; }
        if (!empty($site)) { $dados_parceiro['site'] = $site; }

        try {
          CRUD::beginTransaction();
          $dados_usuario['id'] = CRUD::insert('parceiros', $dados_parceiro);
          CRUD::commit();
          CSRF::apos_cadastro_sucesso();

        } catch (Exception $e) {
          CRUD::rollBack();
          throw new Exception("Error ao salvar no banco");
        }

      } else {
        SS::s('_ss_scip_', "nome", $nome);
        SS::s('_ss_scip_', "cnpj", $cnpj);
        SS::s('_ss_scip_', "endereco", $endereco);
        SS::s('_ss_scip_', "email", $email);
        SS::s('_ss_scip_', "telefone", $telefone);
        SS::s('_ss_scip_', "site", $site);
        URL::pagina("cadastrando-parceiro");
        if (isset($img_src) && file_exists(DIRETORIO_RAIZ.$img_src))
          unlink(DIRETORIO_RAIZ.$img_src);
      }

    } catch (Exception $e) {
      if (isset($img_src) && file_exists(DIRETORIO_RAIZ.$img_src))
        unlink(DIRETORIO_RAIZ.$img_src);
      URL::pagina("cadastrando-parceiro");
    }

  }



} else {
  URL::pagina('home');
}
