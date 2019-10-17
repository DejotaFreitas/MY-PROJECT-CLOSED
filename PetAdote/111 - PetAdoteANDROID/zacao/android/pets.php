<?php
try {
  $id_dono = $url->var(0);
  $limit = 30;
  $offset = $url->var(1)*$limit;

  $dados = $crud->selectQuery("
    SELECT

    s1.id, s1.nome, s1.descricao, s1.foto, s1.tipo, s1.genero, s1.faixa_etaria, s1.tamanho, s1.castrado, s1.time, s1.dono_id, s1.cidade, s1.estado

    FROM

    (SELECT p.id, p.nome, p.descricao, p.foto, p.tipo, p.genero, p.faixa_etaria, p.tamanho, p.castrado, p.time, r.usuario_id AS dono_id, c.descricao AS cidade, e.descricao AS estado
    FROM pet p INNER JOIN relacao r ON p.id = r.pet_id INNER JOIN usuario u ON u.id = r.usuario_id INNER JOIN cidade c ON c.id = u.cidade_id INNER JOIN estado e ON e.id = c.estado_id
    WHERE r.relacao=? AND r.usuario_id<> ?) AS s1

    LEFT JOIN

    (SELECT p.id AS id2 FROM pet p INNER JOIN relacao r ON p.id = r.pet_id WHERE r.relacao=? AND r.usuario_id=?) AS s2

    ON s1.id = s2.id2 WHERE s2.id2 IS NULL LIMIT $limit OFFSET $offset",

    ['Dono', $id_dono, 'Aguardando', $id_dono]);


  echo json_encode(["response"=>"ok", "dados"=>$dados]);

} catch (Exception $e) {
  echo json_encode(["response"=>"Erro: ".$e->getMessage()]);
}
