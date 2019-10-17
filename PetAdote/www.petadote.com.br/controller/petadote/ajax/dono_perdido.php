<?php
if (SessaoUsuario::logado()) {
  try {
    $id_pet = json_decode($_POST['json'], true);
    $id_pet = $id_pet['id_pet'];
    $usuario_id = SessaoUsuario::usuario()['id'];
    $relacao = ['pet_id'=>$id_pet, 'usuario_id'=>$usuario_id, 'relacao'=>'Aguardando_Perdido', 'time'=>time()];
    CRUD::insert('relacao', $relacao);
    echo "ok";
  } catch (Exception $e) {
    echo "erro: ".$e->getMessage();
  }
} else {
  echo "deslogado";
}
