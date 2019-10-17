<?php
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json; charset=utf-8');

$paises = CRUD::select('pais ORDER BY descricao', 'id, descricao');

echo json_encode($paises);
