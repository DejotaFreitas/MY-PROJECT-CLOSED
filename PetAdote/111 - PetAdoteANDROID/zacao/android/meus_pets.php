<?php

try {
  $id_dono = $url->var(0);

  $dados = $crud->select("pet p INNER JOIN relacao r ON p.id = r.pet_id",
  "p.id, p.nome, p.descricao, p.foto, p.tipo, p.genero, p.faixa_etaria, p.tamanho, p.castrado, p.time", "r.relacao=? AND r.usuario_id=?", ['Dono', $id_dono]);


  foreach ($dados as $key => $value) {
      $adotantes = $crud->select("usuario u INNER JOIN relacao r ON u.id = r.usuario_id INNER JOIN cidade c ON c.id = u.cidade_id INNER JOIN estado e ON e.id = c.estado_id",

      "u.id, u.nome, u.foto, c.descricao AS cidade, e.descricao AS estado, u.time",
      "r.relacao=? AND r.pet_id=?",

      ['Aguardando', $value["id"]]);
      $dados[$key]["adotantes"] = $adotantes;
  }


  echo json_encode(["response"=>"ok", "dados"=>$dados]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
