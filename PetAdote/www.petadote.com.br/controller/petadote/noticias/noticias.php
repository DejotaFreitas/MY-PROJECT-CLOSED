<?php

importcore('SS');

function filtrar(){
  $where_titulo = !SS::empty('_ss_snt_', 'titulo');
  $where_descricao = !SS::empty('_ss_snt_', 'descricao');
  $where_nome = !SS::empty('_ss_snt_', 'nome');
  $where_estado = (!SS::empty('_ss_snt_', 'estado') && SS::sss('_ss_snt_', 'estado') != "0");
  $where_cidade = (!SS::empty('_ss_snt_', 'cidade') && SS::sss('_ss_snt_', 'cidade') != "0");

  $where_campos = "";
  $where_campos .= $where_titulo ? " AND n.titulo LIKE ? " : "";
  $where_campos .= $where_descricao ? " AND n.descricao LIKE ? " : "";
  $where_campos .= $where_nome ? " AND u.nome LIKE ? " : "";
  $where_campos .= $where_estado ? " AND e.id = ? " : "";
  $where_campos .= $where_cidade ? " AND c.id = ? ": "";

  $where_valores = [];
  if ($where_titulo) { $where_valores[] = "%".SS::sss('_ss_snt_', 'titulo')."%";  }
  if ($where_descricao) { $where_valores[] = "%".SS::sss('_ss_snt_', 'descricao')."%";  }
  if ($where_nome) { $where_valores[] = "%".SS::sss('_ss_snt_', 'nome')."%";  }
  if ($where_estado) { $where_valores[] =  SS::sss('_ss_snt_', 'estado');  }
  if ($where_cidade)  { $where_valores[] =  SS::sss('_ss_snt_', 'cidade');  }

  $_SESSION['noticias_where_campos'] = $where_campos;
  $_SESSION['noticias_where_valores'] = $where_valores;
}

if (!isset($_SESSION['noticias_where_campos']) || !isset($_SESSION['noticias_where_valores'])) {
  $_SESSION['noticias_where_campos'] = "";
  $_SESSION['noticias_where_valores'] = [];
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
  SS::sss('_ss_snt_', 'titulo', $_POST['titulo']);
  SS::sss('_ss_snt_', 'descricao', $_POST['descricao']);
  SS::sss('_ss_snt_', 'nome', $_POST['nome']);
  SS::sss('_ss_snt_', 'estado', $_POST['estado']);
  SS::sss('_ss_snt_', 'cidade',$_POST['cidade']);
  filtrar();
}


if (SessaoUsuario::logado()) {
  if (SS::empty('_ss_snt_', 'cidade') && SS::empty('_ss_snt_', 'estado')) {
    SS::sss('_ss_snt_', 'cidade', SessaoUsuario::usuario()['cidade_id']);
    SS::sss('_ss_snt_', 'estado', SessaoUsuario::usuario()['estado_id']);
    filtrar();
  }
}


$limit = 30;
$urlpage = is_numeric(URL::var()) ? intval(URL::var()) : 0;
$offset = $urlpage*$limit;

$valores = array_merge(['i'], $_SESSION['noticias_where_valores']);
$noticias = CRUD::selectQuery("
  SELECT n.titulo, n.descricao, n.time, u.nome, u.id
  FROM noticias n
  INNER JOIN usuario u ON u.id = n.usuario_id
  INNER JOIN cidade c ON c.id = u.cidade_id
  INNER JOIN estado e ON e.id = c.estado_id
  WHERE u.tipo = ? ".
  $_SESSION['noticias_where_campos'].
  " ORDER BY n.time DESC LIMIT $limit OFFSET $offset;",
  $valores );
