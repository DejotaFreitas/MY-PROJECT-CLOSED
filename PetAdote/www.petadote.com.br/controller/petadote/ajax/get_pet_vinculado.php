<?php
$id_pet = json_decode($_POST['json'], true);
$id_pet = $id_pet['id_pet'];
$id_vinculado = SessaoUsuario::usuario()['id'];
$pets = [];
$pets = CRUD::selectQuery("
SELECT

s1.id, s1.foto_facial, s1.foto_lateral, s1.foto_superior, s1.nome, s1.especie, s1.genero, s1.idade, s1.porte, s1.castrado, s1.vacinado, s1.descricao,

s2.relacao, s2.dono_id, s2.dono_tipo, s2.dono_nome, s2.dono_telefone, s2.dono_email, s2.dono_cnpj, s2.dono_endereco, s2.dono_foto, s2.dono_cidade, s2.dono_estado, s2.dono_pais

FROM

(SELECT
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
  r.time

  FROM pet p
  INNER JOIN relacao r ON p.id = r.pet_id

  WHERE p.id = ? AND r.usuario_id = ? AND (r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=?)) AS s1

  INNER JOIN

  (SELECT
  p.id AS id2,
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

  FROM pet p
  INNER JOIN relacao r ON p.id = r.pet_id
  INNER JOIN usuario u ON u.id = r.usuario_id
  INNER JOIN cidade c ON c.id = u.cidade_id
  INNER JOIN estado e ON e.id = c.estado_id
  INNER JOIN pais i ON i.id = e.pais_id

  WHERE r.pet_id=? AND (r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=?)) AS s2

  ON s1.id = s2.id2

  ORDER BY s1.time DESC",

  [$id_pet, $id_vinculado, 'Aceito','Aceito_Perdido','Aceito_Encontrado', 'Aguardando','Aguardando_Perdido','Aguardando_Encontrado', 'Recusado','Recusado_Perdido','Recusado_Encontrado',
  $id_pet, 'Doação', 'Perdido', 'Encontrado', 'Doador', 'Doador_Perdido', 'Doador_Encontrado']);

if (!empty($pets)) {
  $pets = $pets[0];
  echo json_encode($pets);
}
