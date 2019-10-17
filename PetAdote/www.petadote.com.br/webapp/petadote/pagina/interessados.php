<?php

  $id_dono = SessaoUsuario::usuario()['id'];
  $meuspets = CRUD::selectQuery("
    SELECT p.id, p.foto_facial, p.nome, r.relacao
    FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
    WHERE r.usuario_id=? AND (r.relacao=? OR r.relacao=? OR r.relacao=?) ORDER BY r.time ASC",  [$id_dono,'Doação','Perdido','Encontrado']);

    foreach ($meuspets as $key => $value) {
      $interessados = CRUD::selectQuery("
        SELECT
        r.relacao,
        u.id AS dono_id,
        u.foto AS dono_foto,
        u.tipo AS dono_tipo,
        u.nome AS dono_nome,
        u.telefone AS dono_telefone,
        u.email AS dono_email,
        u.cnpj AS dono_cnpj,
        u.endereco AS dono_endereco,
        c.descricao AS dono_cidade,
        e.descricao AS dono_estado,
        i.descricao AS dono_pais

        FROM pet p
        INNER JOIN relacao r ON p.id = r.pet_id
        INNER JOIN usuario u ON u.id = r.usuario_id
        INNER JOIN cidade c ON c.id = u.cidade_id
        INNER JOIN estado e ON e.id = c.estado_id
        INNER JOIN pais i ON i.id = e.pais_id

        WHERE r.pet_id=? AND (r.relacao=? OR r.relacao=? OR r.relacao=?) ORDER BY r.time ASC",
        [$value['id'], 'Aguardando','Aguardando_Perdido','Aguardando_Encontrado']);
        if (empty($interessados)) {
          unset($meuspets[$key]);
        } else {
          $meuspets[$key]['interessados'] = $interessados;
        }
    }
?>


<!-- <img src="<?php echo URL::webapp(); ?>img/historico.svg" id="pesquisapet" class="pesquisapet"  alt="Pesquisar Pet" title="Histórico" > -->

<header class="cabecalho">
  <h1>Interessados</h1>
  <h2>Veja quem está interassado em seus pets.</h2>
</header>




<?php if (empty($meuspets)): ?>
  <div class="nenhum-pet"><p>Ninguém está interessado nos seus pets no momento.</p></div><?php else: ?>
  <?php foreach ($meuspets as $value): ?>
    <div class="pets-conteiner">
      <div class="pet-box <?php echo $value['relacao']; ?>">
        <div class="img-box">
          <img src="<?php echo $value['foto_facial']; ?>" alt="<?php echo $value['nome']; ?>">
        </div>
        <p><?php echo $value['nome']; ?></p>
    </div>

      <?php foreach ($value['interessados'] as $value2): ?>
        <div class="pet-box interessado" onclick="show_pet(<?php echo $value['id']; ?>, <?php echo $value2['dono_id']; ?>, '<?php echo $value['relacao']; ?>', this)" >
          <div class="img-box">
            <img src="<?php echo $value2['dono_foto']; ?>" alt="<?php echo $value2['dono_nome']; ?>">
          </div>
          <p><?php echo $value2['dono_nome']; ?></p>
        </div>
      <?php endforeach; ?>

  </div>
  <?php endforeach; ?>
<?php endif; ?>






<!-- ===========SHOW PET============== -->
<div class="show-pet-fundo" id="show_pet_fundo"></div>
<div class="show-pet" id="show_pet_conteiner">

  <div class="show-pet-option">
    <button type="button" name="button" class="add-lista-adocao"  onclick="aceitar()" title="Aceite o vínculo indica que a pessoa foi escolhida para receber a tutela do pet.">Aceitar Vínculo</button>
    <button type="button" name="button" class="show-pet-denuncie" onclick="recusar()" title="Indica que essa pessoa não pareceu muito indicada para receber a tutela do pet.">Negar Vínculo</button>
    <button type="button" name="button" class="show-pet-close" onclick="invisible_pet()">Fechar</button>
  </div>

    <div class="show-pet-img" >
      <img src="" id="foto_dono" alt="foto_dono">
    </div>
    <div class="show-pet-info">
      <h5 class="titulo">INTERESSADO</h5>
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

    <div class="show-pet-img">
      <img src="" id="foto_facial" alt="foto_facial">
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

    <?php if (URL::is_mobile()): ?>
      <div class="show-pet-option">
        <button type="button" name="button" class="add-lista-adocao"  onclick="aceitar()" title="Aceite o vínculo com intuito de indicar a pessoa que ficará com a tutela do pet.">Aceitar Vínculo</button>
        <button type="button" name="button" class="show-pet-denuncie" onclick="recusar()" title="Indica que essa pessoa foi selecionada para receber a tutela do pet.">Negar Vínculo</button>
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
