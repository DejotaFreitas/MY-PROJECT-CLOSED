<?php
if (SessaoUsuario::logado()) {

  $x = json_decode($_POST['json'], true);
  $cidade_id = $x['cidade'];
  $estado_id = $x['estado'];
  $pais_id = $x['pais'];

  import("UsuarioValidar");

  try {
    $cidade_id = UsuarioValidar::cidade($cidade_id);
    $dados_update = ['cidade_id'=>$cidade_id];
    CRUD::update('usuario', $dados_update, 'id=?', [SessaoUsuario::usuario()['id']]);

    SessaoUsuario::set('cidade_id', $cidade_id);
    SessaoUsuario::set('estado_id', $estado_id);
    SessaoUsuario::set('pais_id', $pais_id);

    // pesquisar avançadas resetas por causa da mudança d elocalização
    importcore("SS");
    SS::clean('_ss_spp_');
    SS::clean('_ss_sppp_');
    SS::clean('_ss_sppe_');
    $_SESSION['pet_where_campos'] = "";
    $_SESSION['pet_where_valores'] = [];
    $_SESSION['pet_where_campos_perdidos'] = "";
    $_SESSION['pet_where_valores_perdidos'] = [];    
    $_SESSION['pet_where_campos_encontrados'] = "";
    $_SESSION['pet_where_valores_encontrados'] = [];


    echo "ok";
  } catch (Exception $e) { echo $e->getMessage(); }

}
