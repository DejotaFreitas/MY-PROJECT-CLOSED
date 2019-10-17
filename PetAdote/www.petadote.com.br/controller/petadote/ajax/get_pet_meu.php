<?php
$id_pet = json_decode($_POST['json'], true);
$id_pet = $id_pet['id_pet'];
$id_dono = SessaoUsuario::usuario()['id'];
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
  r.relacao

  FROM pet p INNER JOIN relacao r ON p.id = r.pet_id

  WHERE p.id = ? AND r.usuario_id = ? AND (r.relacao=? OR r.relacao=? OR r.relacao=?) ORDER BY r.time DESC",

  [$id_pet, $id_dono, 'Doação', 'Perdido', 'Encontrado']);

if (!empty($pets)) {
  $pets = $pets[0];
  echo json_encode($pets);
}
