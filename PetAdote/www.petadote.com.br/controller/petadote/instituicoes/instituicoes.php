<?php

importcore('SS');

function filtrar(){
  $where_nome = !SS::empty('_ss_sii_', 'nome');
  $where_cnpj = !SS::empty('_ss_sii_', 'cnpj');
  $where_email = !SS::empty('_ss_sii_', 'email');
  $where_estado = (!SS::empty('_ss_sii_', 'estado') && SS::sss('_ss_sii_', 'estado') != "0");
  $where_cidade = (!SS::empty('_ss_sii_', 'cidade') && SS::sss('_ss_sii_', 'cidade') != "0");

  $where_campos = "";
  $where_campos .= $where_nome ? " AND u.nome LIKE ? " : "";
  $where_campos .= $where_cnpj ? " AND u.cnpj LIKE ? " : "";
  $where_campos .= $where_email ? " AND u.email LIKE ? " : "";
  $where_campos .= $where_estado ? " AND e.id = ? " : "";
  $where_campos .= $where_cidade ? " AND c.id = ? ": "";

  $where_valores = [];
  if ($where_nome) { $where_valores[] = "%".SS::sss('_ss_sii_', 'nome')."%";  }
  if ($where_cnpj) { $where_valores[] = "%".SS::sss('_ss_sii_', 'cnpj')."%";  }
  if ($where_email) { $where_valores[] = "%".SS::sss('_ss_sii_', 'email')."%";  }
  if ($where_estado) { $where_valores[] =  SS::sss('_ss_sii_', 'estado');  }
  if ($where_cidade)  { $where_valores[] =  SS::sss('_ss_sii_', 'cidade');  }

  $_SESSION['instituicoes_where_campos'] = $where_campos;
  $_SESSION['instituicoes_where_valores'] = $where_valores;
}

if (!isset($_SESSION['instituicoes_where_campos']) || !isset($_SESSION['instituicoes_where_valores'])) {
  $_SESSION['instituicoes_where_campos'] = "";
  $_SESSION['instituicoes_where_valores'] = [];
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
  SS::sss('_ss_sii_', 'nome', $_POST['nome']);
  SS::sss('_ss_sii_', 'cnpj', $_POST['cnpj']);
  SS::sss('_ss_sii_', 'email', $_POST['email']);
  SS::sss('_ss_sii_', 'estado', $_POST['estado']);
  SS::sss('_ss_sii_', 'cidade',$_POST['cidade']);
  filtrar();
}


if (SessaoUsuario::logado()) {
  if (SS::empty('_ss_sii_', 'cidade') && SS::empty('_ss_sii_', 'estado')) {
    SS::sss('_ss_sii_', 'cidade', SessaoUsuario::usuario()['cidade_id']);
    SS::sss('_ss_sii_', 'estado', SessaoUsuario::usuario()['estado_id']);
    filtrar();
  }
}


$limit = 60;
$urlpage = is_numeric(URL::var()) ? intval(URL::var()) : 0;
$offset = $urlpage*$limit;

$valores = array_merge(['i'], $_SESSION['instituicoes_where_valores']);
$instuticoes = CRUD::selectQuery("
  SELECT u.id, u.nome, u.foto
  FROM usuario u
  INNER JOIN cidade c ON c.id = u.cidade_id
  INNER JOIN estado e ON e.id = c.estado_id
  WHERE u.tipo = ? ".
  $_SESSION['instituicoes_where_campos'].
  " ORDER BY u.time DESC LIMIT $limit OFFSET $offset;",
  $valores );
