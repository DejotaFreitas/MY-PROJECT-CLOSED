<?php

try {
  $id_adotante = $url->var(0);
  $id_pet = $url->var(1);
  $time = time();

  $dados = ["usuario_id"=>$id_adotante, "pet_id"=>$id_pet, "relacao"=>"Aguardando", "time"=>$time];
  $crud->insert('relacao', $dados);

  echo json_encode(["response"=>"ok"]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
