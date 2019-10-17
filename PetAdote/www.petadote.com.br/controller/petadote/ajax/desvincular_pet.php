<?php
if (SessaoUsuario::logado()) {
  try {
    $id_pet = json_decode($_POST['json'], true);
    $id_pet = $id_pet['id_pet'];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::delete('relacao', 'pet_id=? AND usuario_id=? AND (relacao=? OR relacao=? OR relacao=? OR relacao=? OR relacao=? OR relacao=?)', [$id_pet, $usuario_id, 'Aguardando','Aguardando_Perdido','Aguardando_Encontrado','Recusado','Recusado_Perdido','Recusado_Encontrado']);
    echo "ok";
  } catch (Exception $e) {
    echo "erro: ".$e->getMessage();
  }
}
