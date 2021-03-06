<?php
if (SessaoUsuario::logado())
  URL::pagina('home');
else
if ($_SERVER['REQUEST_METHOD']=='POST') {
  try {

    importcore("CSRF");
    CSRF::inicio_submit_formulario();


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $cidade_id = $_POST['cidade'];
    $estado_id = $_POST['estado'];
    $pais_id = $_POST['pais'];

    $avatar_largura = $_POST['avatar_largura'];
    $avatar_altura = $_POST['avatar_altura'];
    $avatar_x = $_POST['avatar_x'];
    $avatar_y = $_POST['avatar_y'];
    $selecao_tamanho = $_POST['selecao_tamanho'];
    $rotacao = $_POST['rotacao'];

    import("UsuarioValidar");
    importcore("SS");

    try {
      $img_src = UsuarioValidar::foto('avatar',CONTEINER_WEB.'/uploadimg/usuarios', $avatar_largura, $avatar_altura, $avatar_x, $avatar_y, $selecao_tamanho, $rotacao);
      SS::clean('_ss_vci_', "foto");
    } catch (Exception $e) { SS::s('_ss_vci_', "foto", $e->getMessage()); }

    try {
      $nome = UsuarioValidar::nome($nome);
    } catch (Exception $e) { SS::s('_ss_vci_', "nome", $e->getMessage());  }

    try {
      $email = UsuarioValidar::email($email);
    } catch (Exception $e) { SS::s('_ss_vci_', "email", $e->getMessage());  }

    try {
      $senha = UsuarioValidar::senha($senha);
    } catch (Exception $e) { SS::s('_ss_vci_', "senha", $e->getMessage());  }

    try {
      $cnpj = UsuarioValidar::cnpj($cnpj);
    } catch (Exception $e) { SS::s('_ss_vci_', "cnpj", $e->getMessage());  }

    try {
      $endereco = UsuarioValidar::endereco($endereco);
    } catch (Exception $e) { SS::s('_ss_vci_', "endereco", $e->getMessage());  }

    try {
      $telefone = UsuarioValidar::telefone($telefone);
    } catch (Exception $e) { SS::s('_ss_vci_', "telefone", $e->getMessage());  }

    try {
      $cidade_id = UsuarioValidar::cidade($cidade_id);
    } catch (Exception $e) {  SS::s('_ss_vci_', "cidade", "cidade inválida");  }


    if (SS::empty('_ss_vci_')) {
      $senha = password_hash($senha, PASSWORD_BCRYPT);
      $dados_usuario = ["nome"=>$nome , "email"=>$email , "senha"=>$senha , "cnpj"=>$cnpj, "endereco"=>$endereco, "telefone"=>$telefone, "cidade_id"=>$cidade_id , "foto"=>$img_src, "tipo"=>"i", "time"=>time()];
      try {
        CRUD::beginTransaction();
        $dados_usuario['id'] = CRUD::insert('usuario', $dados_usuario);

        $cor_fundo = $_SESSION['acessibilidade_cor'] ?? "";
        $cor_logo = $_SESSION['acessibilidade_cor_tema'] ?? "";
        $cor_corpo = $_SESSION['acessibilidade_cor_corpo'] ?? "";
        $estilo_icone = $_SESSION['acessibilidade_icon'] ?? "";
        $tamnho_fonte = $_SESSION['acessibilidade_fontsize'] ?? "";
        $menu_lateral = $_SESSION['acessibilidade_menu'] ?? "";

        $config_usuario = ['cor_fundo'=>$cor_fundo, 'cor_logo'=>$cor_logo, 'cor_corpo'=>$cor_corpo, 'estilo_icone'=>$estilo_icone, 'tamanho_texto'=>$tamnho_fonte, 'menu_lateral'=>$menu_lateral, 'usuario_id'=>$dados_usuario['id']];
        CRUD::insert('config', $config_usuario);
        CRUD::commit();
        CSRF::apos_cadastro_sucesso();

        $dados_usuario_logar = CRUD::select('
        usuario u
        INNER JOIN cidade c ON c.id = u.cidade_id
        INNER JOIN estado e ON e.id = c.estado_id
        INNER JOIN pais i ON i.id = e.pais_id',
         'u.*, c.estado_id , e.pais_id',
         'u.id = ?', [$dados_usuario['id']]);

        $dados_usuario_logar = $dados_usuario_logar[0];
        SessaoUsuario::logar($dados_usuario_logar);

      } catch (Exception $e) {
        CRUD::rollBack();
        throw new Exception("Error ao salvar no banco");
      }

    } else {
      SS::s('_ss_sci_', "nome", $nome);
      SS::s('_ss_sci_', "email", $email);
      SS::s('_ss_sci_', "senha", $senha);
      SS::s('_ss_sci_', "cnpj", $cnpj);
      SS::s('_ss_sci_', "endereco", $endereco);
      SS::s('_ss_sci_', "telefone", $telefone);
      SS::s('_ss_sci_', "cidade_id", $cidade_id);
      SS::s('_ss_sci_', "estado_id", $estado_id);
      SS::s('_ss_sci_', "pais_id", $pais_id);
      URL::pagina("cadastrando-instituicao");
      if (isset($img_src) && file_exists(DIRETORIO_RAIZ.$img_src))
        unlink(DIRETORIO_RAIZ.$img_src);
    }

  } catch (Exception $e) {
    if (isset($img_src) && file_exists(DIRETORIO_RAIZ.$img_src))
      unlink(DIRETORIO_RAIZ.$img_src);
    URL::pagina("cadastrando-instituicao");
  }

}
