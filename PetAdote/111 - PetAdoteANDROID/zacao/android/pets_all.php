<?php
try {

  $limit = 30;
  $offset = $url->var(0)*$limit;

  $dados = $crud->select('pet p INNER JOIN relacao r ON p.id = r.pet_id INNER JOIN usuario u ON u.id = r.usuario_id INNER JOIN cidade c ON c.id = u.cidade_id INNER JOIN estado e ON e.id = c.estado_id',

 'p.id, p.nome, p.descricao, p.foto, p.tipo, p.genero, p.faixa_etaria, p.tamanho, p.castrado, p.time, r.usuario_id AS dono_id, c.descricao AS cidade, e.descricao AS estado',

 "r.relacao=? LIMIT $limit OFFSET $offset", ['Dono']);


  echo json_encode(["response"=>"ok", "dados"=>$dados]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
