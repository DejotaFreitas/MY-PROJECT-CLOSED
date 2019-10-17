<?php

if (SessaoUsuario::logado()) {
  try {

    $json = json_decode($_POST['json'], true);
    $id_pet = $json['id_pet'];
    $interessado_id = $json['id_usuario'];
    $relacao = $json['relacao'];


    switch ($relacao) {
      case 'Doação': $relacao_recusado = 'Recusado';  break;
      case 'Perdido': $relacao_recusado = 'Recusado_Perdido';  break;
      case 'Encontrado': $relacao_recusado = 'Recusado_Encontrado';  break;
      default: break;
    }

    CRUD::beginTransaction();

    $dado_recusado = ['relacao'=>$relacao_recusado, 'time'=>time()];
    CRUD::update('relacao', $dado_recusado, 'pet_id=? AND usuario_id=?', [$id_pet, $interessado_id]);

    CRUD::commit();
    echo "ok";

  } catch (Exception $e) {
    CRUD::rollBack();
    echo "erro: ".$e->getMessage();
  }
}
