<?php
try {

  $id_pet = $url->var(0);

  $crud->beginTransaction();

  $crud->delete("relacao", "pet_id=?", [$id_pet]);

  $crud->delete("pet","pet_id=?", [$id_pet]);

  $crud->commit();
  echo json_encode(["response"=>"ok"]);

} catch (Exception $e) {
  $crud->rollBack();
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
