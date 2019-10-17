<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {


  try {
    importcore("UploadImagem");
    import("ValidaPet");

    $nome = ValidaPet::nome($_POST['nome']);
    $descricao = ValidaPet::descricao($_POST['descricao']);
    $tipo = ValidaPet::tipo($_POST['tipo']);
    $genero = ValidaPet::genero($_POST['genero']);
    $faixa_etaria = ValidaPet::faixa_etaria($_POST['faixa_etaria']);
    $tamanho = ValidaPet::tamanho($_POST['tamanho']);
    $castrado = ValidaPet::castrado($_POST['castrado']);
    $usuario_id = $_POST['usuario_id'];
    $time = time();
    
    $img = new UploadImagem('foto', DIRETORIO_IMG_PET);
    $img_src = $img->src();

    $dados = ['nome'=>$nome, 'descricao'=>$descricao, 'tipo'=>$tipo,  'genero'=>$genero, 'faixa_etaria'=>$faixa_etaria, 'tamanho'=>$tamanho, 'castrado'=>$castrado, 'foto'=>$img_src, 'time'=>$time];

    try {
      $crud->beginTransaction();
      $crud->insert('pet', $dados);
      $id_pet = $crud->last_id();
      $relacao = ['usuario_id'=>$usuario_id, 'pet_id'=>$id_pet, 'relacao'=>'Dono',  'time'=>$time];
      $crud->insert('relacao', $relacao);
      $crud->commit();
      echo json_encode(["response"=>"ok", "id"=>$id_pet, "foto"=>$img_src]);
    } catch (Exception $e) {
      $crud->rollBack();
      echo json_encode(["response"=>"Erro ao cadstrar pet"]);
    }
  } catch (Exception $e) {
    echo json_encode(["response"=>$e->getMessage()]);
  }

}
