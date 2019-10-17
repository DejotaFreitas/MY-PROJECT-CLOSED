<?php
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json; charset=utf-8');


$estado_id = json_decode($_POST['json'], true);
$estado_id = $estado_id['estado_id'];

$consulta = CRUD::select('cidade', 'id, descricao', 'estado_id = ? ORDER BY descricao', [$estado_id]);

echo json_encode($consulta);
