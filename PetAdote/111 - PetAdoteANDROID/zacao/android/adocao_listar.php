<?php

try {

  $id_adotante = $url->var(0);

  // ========================================================== \\
  $dados = $crud->selectQuery("
  SELECT
  p.id, p.nome, p.descricao, p.foto, p.tipo, p.genero, p.faixa_etaria, p.tamanho, p.castrado, p.time, r.usuario_id AS dono_id, r.relacao, r.time AS rtime, c.descricao AS cidade, e.descricao AS estado
  FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
  INNER JOIN usuario u ON u.id = r.usuario_id
  INNER JOIN cidade c ON c.id = u.cidade_id
  INNER JOIN estado e ON e.id = c.estado_id
  WHERE r.relacao=? AND r.usuario_id=?;",
  ['Aguardando', $id_adotante]);


  echo json_encode(["response"=>"ok", "dados"=>$dados]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
