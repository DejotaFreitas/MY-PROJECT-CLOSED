<?php
$id_pet = json_decode($_POST['json'], true);
$id_pet = $id_pet['id_pet'];
$pets = [];
$pets = CRUD::selectQuery("
  SELECT
  p.id,
  p.foto_facial,
  p.foto_lateral,
  p.foto_superior,
  p.nome,
  p.especie,
  p.genero,
  p.idade,
  p.porte,
  p.castrado,
  p.vacinado,
  p.descricao,
  p.time,
  r.relacao,
  u.id AS dono_id,
  u.tipo AS dono_tipo,
  u.nome AS dono_nome,
  u.telefone AS dono_telefone,
  u.email AS dono_email,
  u.cnpj AS dono_cnpj,
  u.endereco AS dono_endereco,
  u.foto AS dono_foto,
  c.descricao AS dono_cidade,
  e.descricao AS dono_estado,
  i.descricao AS dono_pais

  FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
  INNER JOIN usuario u ON u.id = r.usuario_id
  INNER JOIN cidade c ON c.id = u.cidade_id
  INNER JOIN estado e ON e.id = c.estado_id
  INNER JOIN pais i ON i.id = e.pais_id

  WHERE p.id = ? AND (r.relacao=? OR r.relacao=? OR r.relacao=?)",

  [$id_pet, 'Doação', 'Perdido', 'Encontrado']);

if (!empty($pets)) {
  $pets = $pets[0];
  echo json_encode($pets);
}
