<?php
importcore('SS');

function filtrar(){
  $where_nome = !SS::empty('_ss_sppp_', 'nome');
  $where_especie = !SS::empty('_ss_sppp_', 'especie');
  $where_genero = !SS::empty('_ss_sppp_', 'genero');
  $where_idade = !SS::empty('_ss_sppp_', 'idade');
  $where_porte = !SS::empty('_ss_sppp_', 'porte');
  $where_castrado = !SS::empty('_ss_sppp_', 'castrado');
  $where_vacinado = !SS::empty('_ss_sppp_', 'vacinado');
  $where_descricao = !SS::empty('_ss_sppp_', 'descricao');
  $where_estado = (!SS::empty('_ss_sppp_', 'estado') && SS::sss('_ss_sppp_', 'estado') != "0");
  $where_cidade = (!SS::empty('_ss_sppp_', 'cidade') && SS::sss('_ss_sppp_', 'cidade') != "0");

  $where_campos = "";
  $where_campos .= $where_nome ? " AND p.nome LIKE ? " : "";
  $where_campos .= $where_especie ? " AND p.especie = ? " : "";
  $where_campos .= $where_genero ? " AND p.genero = ? ": "";
  $where_campos .= $where_idade ? " AND p.idade = ? ": "";
  $where_campos .= $where_porte ? " AND p.porte = ? " : "";
  $where_campos .= $where_castrado ? " AND p.castrado = ? " : "";
  $where_campos .= $where_vacinado ? " AND p.vacinado = ? " : "";
  $where_campos .= $where_descricao ? " AND p.descricao LIKE ? " : "";
  $where_campos .= $where_estado ? " AND e.id = ? " : "";
  $where_campos .= $where_cidade ? " AND c.id = ? ": "";

  $where_valores = [];
  if ($where_nome) { $where_valores[] = "%".SS::sss('_ss_sppp_', 'nome')."%";  }
  if ($where_especie) { $where_valores[] = SS::sss('_ss_sppp_', 'especie');  }
  if ($where_genero) { $where_valores[] = SS::sss('_ss_sppp_', 'genero');  }
  if ($where_idade) { $where_valores[] = SS::sss('_ss_sppp_', 'idade');  }
  if ($where_porte) { $where_valores[] = SS::sss('_ss_sppp_', 'porte');  }
  if ($where_castrado) { $where_valores[] = SS::sss('_ss_sppp_', 'castrado');  }
  if ($where_vacinado) { $where_valores[] = SS::sss('_ss_sppp_', 'vacinado');  }
  if ($where_descricao) { $where_valores[] = "%".SS::sss('_ss_sppp_', 'descricao')."%";  }
  if ($where_estado) { $where_valores[] =  SS::sss('_ss_sppp_', 'estado');  }
  if ($where_cidade)  { $where_valores[] =  SS::sss('_ss_sppp_', 'cidade');  }

  $_SESSION['pet_where_campos_perdidos'] = $where_campos;
  $_SESSION['pet_where_valores_perdidos'] = $where_valores;
}

if (empty($_SESSION['pet_where_campos_perdidos']) || empty($_SESSION['pet_where_valores_perdidos'])) {
  $_SESSION['pet_where_campos_perdidos'] = "";
  $_SESSION['pet_where_valores_perdidos'] = [];
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
  SS::sss('_ss_sppp_', 'nome', $_POST['nome']);
  SS::sss('_ss_sppp_', 'especie', $_POST['especie']);
  SS::sss('_ss_sppp_', 'genero', $_POST['genero']);
  SS::sss('_ss_sppp_', 'idade', $_POST['idade']);
  SS::sss('_ss_sppp_', 'porte', $_POST['porte']);
  SS::sss('_ss_sppp_', 'castrado', $_POST['castrado']);
  SS::sss('_ss_sppp_', 'vacinado', $_POST['vacinado']);
  SS::sss('_ss_sppp_', 'descricao', $_POST['descricao']);
  SS::sss('_ss_sppp_', 'estado', $_POST['estado']);
  SS::sss('_ss_sppp_', 'cidade',$_POST['cidade']);
  filtrar();
}



$limit = 60;
$urlpage = is_numeric(URL::var()) ? intval(URL::var()) : 0;
$offset = $urlpage*$limit;

if (SessaoUsuario::logado()) {

  if (SS::empty('_ss_sppp_', 'cidade') && SS::empty('_ss_sppp_', 'estado')) {
    SS::sss('_ss_sppp_', 'cidade', SessaoUsuario::usuario()['cidade_id']);
    SS::sss('_ss_sppp_', 'estado', SessaoUsuario::usuario()['estado_id']);
    filtrar();
  }

  $id_dono = SessaoUsuario::usuario()['id'];
  $valores = array_merge(['Perdido', $id_dono], $_SESSION['pet_where_valores_perdidos'], [$id_dono, 'Aguardando_Perdido', 'Recusado_Perdido']);
  $pets = CRUD::selectQuery("
    SELECT s1.id, s1.foto_facial, s1.nome
    FROM  (SELECT p.id, p.foto_facial, p.nome
    FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
    INNER JOIN usuario u ON u.id = r.usuario_id
    INNER JOIN cidade c ON c.id = u.cidade_id
    INNER JOIN estado e ON e.id = c.estado_id
    WHERE r.relacao=? AND r.usuario_id<> ? ".$_SESSION['pet_where_campos_perdidos'].") AS s1
    LEFT JOIN
    (SELECT p.id AS id2 FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
    WHERE r.usuario_id=? AND (r.relacao=? OR r.relacao=?)) AS s2
    ON s1.id = s2.id2 WHERE s2.id2 IS NULL LIMIT $limit OFFSET $offset",
    $valores);

} else {

  $valores = array_merge(['Perdido'], $_SESSION['pet_where_valores_perdidos']);
  $pets = CRUD::selectQuery("
    SELECT p.id, p.foto_facial, p.nome
    FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
    INNER JOIN usuario u ON u.id = r.usuario_id
    INNER JOIN cidade c ON c.id = u.cidade_id
    INNER JOIN estado e ON e.id = c.estado_id
    WHERE r.relacao = ? ".
    $_SESSION['pet_where_campos_perdidos'].
    " ORDER BY p.time DESC LIMIT $limit OFFSET $offset;",
    $valores );

 }

?>
