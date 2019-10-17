<?php

try {
  $id_adotante = $url->var(0);
  $id_pet = $url->var(1);

  $crud->delete('relacao', 'usuario_id=? AND pet_id=? AND relacao=?',[$id_adotante, $id_pet, "Aguardando"]);

  echo json_encode(["response"=>"ok"]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
