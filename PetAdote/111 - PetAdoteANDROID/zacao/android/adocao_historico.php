<?php

try {
  $id_adotante = $url->var(0);

  // ========================================================== \\
  $dados = $crud->select('pet p INNER JOIN relacao r ON p.id = r.pet_id',

  'p.id, p.nome, p.foto, r.relacao',

  "(r.relacao=? OR r.relacao=?) AND r.usuario_id=?",
  ['Aceito', 'Recusado', $id_adotante]);


  echo json_encode(["response"=>"ok", "dados"=>$dados]);


} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
