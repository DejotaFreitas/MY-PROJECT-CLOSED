<?php
if (!SessaoUsuario::logado())
  URL::pagina('home');
else
if ($_SERVER['REQUEST_METHOD']=='POST') {
  try {

    importcore("CSRF");
    CSRF::inicio_submit_formulario();

    import("PetValidar");
    importcore("SS");

    $nome = PetValidar::nome($_POST['cdp_nome']);
    $situacao = PetValidar::relacao($_POST['cdp_relacao']);
    $especie = PetValidar::especie($_POST['cdp_especie']);
    $genero = PetValidar::genero($_POST['cdp_genero']);
    $idade = PetValidar::idade($_POST['cdp_idade']);
    $porte = PetValidar::porte($_POST['cdp_porte']);
    $castrado = PetValidar::castrado($_POST['cdp_castrado']);
    $vacinado = PetValidar::vacinado($_POST['cdp_vacinado']);
    $descricao = PetValidar::descricao($_POST['cdp_descricao']);

    $avatar_largura_1 = $_POST['avatar_largura_1'];
    $avatar_altura_1 = $_POST['avatar_altura_1'];
    $avatar_x_1 = $_POST['avatar_x_1'];
    $avatar_y_1 = $_POST['avatar_y_1'];
    $selecao_tamanho_1 = $_POST['selecao_tamanho_1'];
    $rotacao_1 = $_POST['rotacao_1'];
    $img_src1 = PetValidar::foto('avatar_1', CONTEINER_WEB.'uploadimg/pets', $avatar_largura_1, $avatar_altura_1, $avatar_x_1, $avatar_y_1, $selecao_tamanho_1, $rotacao_1);

    $avatar_largura_2 = $_POST['avatar_largura_2'];
    $avatar_altura_2 = $_POST['avatar_altura_2'];
    $avatar_x_2 = $_POST['avatar_x_2'];
    $avatar_y_2 = $_POST['avatar_y_2'];
    $selecao_tamanho_2 = $_POST['selecao_tamanho_2'];
    $rotacao_2 = $_POST['rotacao_2'];
    $img_src2 = PetValidar::foto('avatar_2', CONTEINER_WEB.'uploadimg/pets', $avatar_largura_2, $avatar_altura_2, $avatar_x_2, $avatar_y_2, $selecao_tamanho_2, $rotacao_2);

    $avatar_largura_3 = $_POST['avatar_largura_3'];
    $avatar_altura_3 = $_POST['avatar_altura_3'];
    $avatar_x_3 = $_POST['avatar_x_3'];
    $avatar_y_3 = $_POST['avatar_y_3'];
    $selecao_tamanho_3 = $_POST['selecao_tamanho_3'];
    $rotacao_3 = $_POST['rotacao_3'];
    $img_src3 = PetValidar::foto('avatar_3', CONTEINER_WEB.'uploadimg/pets', $avatar_largura_3, $avatar_altura_3, $avatar_x_3, $avatar_y_3, $selecao_tamanho_3, $rotacao_3);


    try {
      $pet = ["nome"=>$nome, "especie"=>$especie, "genero"=>$genero , "idade"=>$idade, "porte"=>$porte, "castrado"=>$castrado, "vacinado"=>$vacinado,  "foto_facial"=>$img_src1, "foto_lateral"=>$img_src2, "foto_superior"=>$img_src3, "time"=>time()];
      if (!empty($descricao)) {
        $pet["descricao"]  = $descricao;
      }

      CRUD::beginTransaction();
      $pet_id = CRUD::insert('pet', $pet);
      $usuario_id = SessaoUsuario::usuario()['id'];

      $relacao = ["relacao"=>$situacao , 'pet_id'=>$pet_id, 'usuario_id'=>$usuario_id, 'time'=>time()];

      CRUD::insert('relacao', $relacao);
      CRUD::commit();
      CSRF::apos_cadastro_sucesso();

    } catch (Exception $e) {
      CRUD::rollBack();
      throw new Exception($e->getMessage());
    }



  } catch (Exception $e) {
    if (isset($img_src1) && file_exists(DIRETORIO_RAIZ.$img_src1))
      unlink(DIRETORIO_RAIZ.$img_src1);
    if (isset($img_src2) && file_exists(DIRETORIO_RAIZ.$img_src2))
      unlink(DIRETORIO_RAIZ.$img_src2);
    if (isset($img_src3) && file_exists(DIRETORIO_RAIZ.$img_src3))
      unlink(DIRETORIO_RAIZ.$img_src3);
  }

}
