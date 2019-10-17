<?php

if (SessaoUsuario::logado()) {
  try {
    $guardiao_id = SessaoUsuario::usuario()['id'];

    $json = json_decode($_POST['json'], true);
    $id_pet = $json['id_pet'];
    $interessado_id = $json['id_usuario'];
    $relacao = $json['relacao'];

    switch ($relacao) {
      case 'Doação': $relacao_guardiao = 'Doador';  break;
      case 'Perdido': $relacao_guardiao = 'Doador_Perdido';  break;
      case 'Encontrado': $relacao_guardiao = 'Doador_Encontrado';  break;
      default: break;
    }

    switch ($relacao) {
      case 'Doação': $relacao_recusado = 'Recusado';  break;
      case 'Perdido': $relacao_recusado = 'Recusado_Perdido';  break;
      case 'Encontrado': $relacao_recusado = 'Recusado_Encontrado';  break;
      default: break;
    }

    switch ($relacao) {
      case 'Doação': $relacao_interessado = 'Aceito';  break;
      case 'Perdido': $relacao_interessado = 'Aceito_Perdido';  break;
      case 'Encontrado': $relacao_interessado = 'Aceito_Encontrado';  break;
      default: break;
    }

    CRUD::beginTransaction();
    $dado_guardiao = ['relacao'=>$relacao_guardiao, 'time'=>time()];
    CRUD::update('relacao', $dado_guardiao, 'pet_id=? AND usuario_id=?', [$id_pet, $guardiao_id]);

    $dado_recusado = ['relacao'=>$relacao_recusado, 'time'=>time()];
    CRUD::update('relacao', $dado_recusado, 'pet_id=? AND usuario_id<>? AND (relacao=? OR relacao=? OR relacao=?)', [$id_pet, $interessado_id, 'Aguardando', 'Aguardando_Perdido', 'Aguardando_Encontrado']);

    $dado_interessado = ['relacao'=>$relacao_interessado, 'time'=>time()];
    CRUD::update('relacao', $dado_interessado, 'pet_id=? AND usuario_id=?', [$id_pet, $interessado_id]);

    CRUD::commit();
    echo "ok";

  } catch (Exception $e) {
    CRUD::rollBack();
    echo "erro: ".$e->getMessage();
  }
}
