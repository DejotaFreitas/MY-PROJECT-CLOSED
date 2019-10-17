<?php
try {


  $id_adotante = $url->var(0);
  $id_pet = $url->var(1);

  $crud->beginTransaction();

  $crud->update("relacao", ["relacao"=>"Aceito"],"usuario_id=? AND pet_id=?", [$id_adotante, $id_pet]);

  $crud->update("relacao", ["relacao"=>"Doador"],"relacao=? AND pet_id=?", ['Dono', $id_pet]);

  $crud->update("relacao", ["relacao"=>"Recusado"],"relacao=? AND pet_id=?", ['Aguardando', $id_pet]);

  $crud->commit();
  echo json_encode(["response"=>"ok"]);

} catch (Exception $e) {
  $crud->rollBack();
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
