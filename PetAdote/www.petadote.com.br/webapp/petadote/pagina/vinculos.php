<?php

$id_dono = SessaoUsuario::usuario()['id'];

$vinculos = CRUD::selectQuery("
  SELECT p.id, p.foto_facial, p.nome, r.relacao
  FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
  WHERE r.usuario_id=? AND (r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=? OR r.relacao=?) ORDER BY r.time DESC",  [$id_dono,'Aceito','Aceito_Perdido','Aceito_Encontrado', 'Aguardando','Aguardando_Perdido','Aguardando_Encontrado', 'Recusado','Recusado_Perdido','Recusado_Encontrado']);
?>

<header class="cabecalho">
  <h1>Vínculos</h1>
  <h2>Acompanhe a situação dos pets que você está relacionado.</h2>
</header>

<div class="pets-conteiner">
<?php if (empty($vinculos)): ?>
  <?php echo 'Você não está vinculado a menhum pet.'; ?>
<?php else: ?>
  <?php foreach ($vinculos as $value):
    switch ($value['relacao']) {
      case 'Aguardando': $situacao = 'Aguardando';  break;
      case 'Aceito': $situacao = 'Aceito';  break;
      case 'Recusado': $situacao = 'Negado';  break;
      case 'Aguardando_Perdido': $situacao = 'Aguardando';  break;
      case 'Aceito_Perdido': $situacao = 'Aceito';  break;
      case 'Recusado_Perdido': $situacao = 'Negado';  break;
      case 'Aguardando_Encontrado': $situacao = 'Aguardando'; break;
      case 'Aceito_Encontrado': $situacao = 'Aceito';
      case 'Recusado_Encontrado': $situacao = 'Negado'; break;
      default: $situacao = ""; break;
    }
    switch ($value['relacao']) {
      case 'Aguardando': $tipo = 'Doação';  break;
      case 'Aceito': $tipo = 'Doação';  break;
      case 'Recusado': $tipo = 'Doação';  break;
      case 'Aguardando_Perdido': $tipo = 'Perdido';  break;
      case 'Aceito_Perdido': $tipo = 'Perdido';  break;
      case 'Recusado_Perdido': $tipo = 'Perdido';  break;
      case 'Aguardando_Encontrado': $tipo = 'Encontrado'; break;
      case 'Aceito_Encontrado': $tipo = 'Encontrado';
      case 'Recusado_Encontrado': $tipo = 'Encontrado'; break;
      default: $tipo = ""; break;
    }
 ?>
    <div class="pet-box " onclick="show_pet(<?php echo $value['id']; ?>, this)">
      <div class="pet-situacao <?php echo $situacao; ?>"><span><?php echo $situacao; ?></span></div>
      <div class="img-box <?php echo $tipo; ?>">
        <img src="<?php echo $value['foto_facial']; ?>" alt="<?php echo $value['nome']; ?>">
      </div>
      <p class="<?php echo $tipo; ?>"><?php echo $value['nome']; ?></p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>


<!-- ===========SHOW PET============== -->
<div class="show-pet-fundo" id="show_pet_fundo"></div>
<div class="show-pet" id="show_pet_conteiner">

  <div class="show-pet-option">
    <?php if ($situacao!="Aceito"): ?>
        <button type="button" name="button" class="add-lista-adocao"  onclick="add_lista_adocao()" title="Remover sua relação com esse pet." id="desvincular">Remover</button>
    <?php endif; ?>
    <button type="button" name="button" class="show-pet-close" onclick="invisible_pet()">Fechar</button>
  </div>
    <div class="show-pet-img">
      <img src="" id="foto_facial" alt="foto_facial">
    </div>
    <div class="show-pet-img">
      <img src="" id="foto_lateral" alt="foto_lateral">
    </div>
    <div class="show-pet-img">
      <img src="" id="foto_superior" alt="foto_superior">
    </div>
    <div class="show-pet-info">
      <h5 class="titulo">PET</h5>
      <p>NOME: <span id="pet_nome"></span></p>
      <p>SITUAÇÃO: <span id="pet_situacao"></span></p>
      <p>ESPÉCIE: <span id="pet_especie"></span></p>
      <p>GÊNERO: <span id="pet_genero"></span></p>
      <p>IDADE: <span id="pet_idade"></span></p>
      <p>PORTE: <span id="pet_porte"></span></p>
      <p>CASTRADO: <span id="pet_castrado"></span></p>
      <p>VACINADO: <span id="pet_vacinado"></span></p>
      <p>DESCRIÇÃO: <span id="pet_descricao"></span></p>
    </div>
    <div class="show-pet-img" >
      <img src="" id="foto_dono" alt="foto_dono">
    </div>
    <div class="show-pet-info">
      <h5 class="titulo">GUARDIÃO</h5>
      <p>TIPO: <span id="dono_tipo"></span></p>
      <p>CNPJ: <span id="dono_cnpj"></span></p>
      <p>NOME: <span id="dono_nome"></span></p>

      <p>FONE: <a href="" id="dono_telefone"><span ></span> <img src="<?php echo URL::webapp(); ?>img/fone.svg" style="height:15px"></a></p>
      <p>E-MAIL: <a href="" id="dono_email"><span></span> <img src="<?php echo URL::webapp(); ?>img/email.svg" style="height:15px"></a></p>

      <p>PAÍS: <span id="dono_pais"></span></p>
      <p>ESTADO: <span id="dono_estado"></span></p>
      <p>CIDADE: <span id="dono_cidade"></span></p>
      <p>ENDEREÇO: <span id="dono_endereco"></span></p>
    </div>
    <?php if (URL::is_mobile()): ?>
      <div class="show-pet-option">
        <?php if ($situacao!="Aceito"): ?>
            <button type="button" name="button" class="add-lista-adocao"  onclick="add_lista_adocao()" title="Remover sua relação com esse pet." id="desvincular">Remover</button>
        <?php endif; ?>
        <button type="button" name="button" class="show-pet-close" onclick="invisible_pet()">Fechar</button>
      </div>
    <?php endif; ?>
  </div>


  <!-- OPTION BOX START -->
  <div class="opition-box-fundo" id="opition_box_fundo"></div>
  <div class="opition-box" id="opition_box">
    <div class="msg">
      <h5 class="opition_box_titulo" id="opition_box_titulo"></h5>
      <p class="opition_box_msg" id="opition_box_msg"></p>
    </div>
    <div class="opition-button-box">
      <button type="button" name="button" class="opition-button nao" onclick="option_box_hidden()" >Não</button>
      <button type="button" name="button" class="opition-button sim"  id="option_box_button_sim">Sim</button>
    </div>
  </div>
  <!-- OPTION BOX END -->
