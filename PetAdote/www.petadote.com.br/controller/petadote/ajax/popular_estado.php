<?php
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json; charset=utf-8');


$pais_id = json_decode($_POST['json'], true);
$pais_id = $pais_id['pais_id'];

$consulta = CRUD::select('estado', 'id, descricao', 'pais_id = ? ORDER BY descricao', [$pais_id]);

echo json_encode($consulta);
