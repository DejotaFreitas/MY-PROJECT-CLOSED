<img src="<?php echo URL::webapp(); ?>img/pesquisar_perdidos.svg" id="pesquisapet" class="pesquisapet"  alt="Adicionar Pet">

<header class="cabecalho">
  <h1>Perdidos</h1>
  <h2>Veja os pets que se perderam do seu guardião.</h2>
</header>


<!-- ===========PESQUISA PET=========== -->
<form id="formulario" class="formulario" action="perdidos" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <label for="pais">País</label><br>
    <select id="pais" name="pais" value="1"></select><br><br>

    <label for="estado">Estado</label><br>
    <?php $estado_id = SS::sss('_ss_sppp_', 'estado') ?? "0"; ?>
    <select id="estado" name="estado" value="<?php echo $estado_id; ?>"></select><br><br>

    <label for="cidade">Cidade</label><br>
    <?php $cidade_id = SS::sss('_ss_sppp_', 'cidade') ?? "0"; ?>
    <select id="cidade" name="cidade" value="<?php echo $cidade_id; ?>"></select><br><br>

    <label for="especie">Espécie</label><br>
    <select id="especie" name="especie">
      <?php
        $options = ['Todos'=>'','Cachorro'=>'Cachorro','Gato'=>'Gato'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'especie'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

  </div>


  <div class="form-section">

    <label for="genero">Gênero</label><br>
    <select id="genero" name="genero">
      <?php
        $options = ['Todos'=>'','Macho'=>'Macho','Fêmea'=>'Fêmea'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'genero'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="idade">Idade</label><br>
    <select id="idade" name="idade">
      <?php
        $options = ['Todos'=>'','Filhote'=>'Filhote','Adulto'=>'Adulto'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'idade'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="porte">Porte</label><br>
    <select id="porte" name="porte">
      <?php
        $options = ['Todos'=>'','Pequeno'=>'Pequeno','Médio'=>'Médio','Grande'=>'Grande'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'porte'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="castrado">Castrado</label><br>
    <select id="castrado" name="castrado">
      <?php
        $options = ['Todos'=>'','Não'=>'Não','Sim'=>'Sim'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'castrado'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

  </div>


  <div class="form-section">

    <label for="vacinado">Vacinado</label><br>
    <select id="vacinado" name="vacinado">
      <?php
        $options = ['Todos'=>'','Não'=>'Não','Sim'=>'Sim'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_sppp_', 'vacinado'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="nome">Nome</label><br>
    <input type="text" name="nome" id="nome" maxlength="20" value="<?php echo SS::sss('_ss_sppp_', 'nome'); ?>" placeholder="..." ><br><br>

    <label for="descricao">Descrição</label><br>
    <input type="text" name="descricao" id="descricao" maxlength="600"  value="<?php echo SS::sss('_ss_sppp_', 'descricao'); ?>" placeholder="..."><br><br>

    <div class="form-section-button">
      <button type="submit" id="buttomsubmit" name="pesquisar" class="submit" >Pesquisar</button>
    </div>

  </div>

</form>

<!-- ===========SHOW PET============== -->
<div class="show-pet-fundo" id="show_pet_fundo"></div>
<div class="show-pet" id="show_pet_conteiner">

  <div class="show-pet-option">
    <button type="button" name="button" class="add-lista-adocao"  onclick="add_lista_adocao()" title="Criar um vínculo com intuito que o guardião saiba que encontrou o pet dele.">Criar Vínculo</button>
    <button type="button" name="button" class="show-pet-denuncie" onclick="denunciar()" title="Isso não é um pet!">Denúncie</button>
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
        <button type="button" name="button" class="add-lista-adocao"  onclick="add_lista_adocao()" title="Criar um vínculo com intuito que o guardião saiba que encontrou o pet dele.">Criar Vínculo</button>
        <button type="button" name="button" class="show-pet-denuncie" onclick="denunciar()" title="Isso não é um pet!">Denúncie</button>
        <button type="button" name="button" class="show-pet-close" onclick="invisible_pet()">Fechar</button>
      </div>
    <?php endif; ?>
  </div>


<!-- =======PETS========= -->
<div class="pets-conteiner">
<?php if (empty($pets)): ?>
  <?php echo 'Nenhuma pet encontrado.'; ?>
<?php else: ?>
  <?php foreach ($pets as $value): ?>
    <div class="pet-box perdido" onclick="show_pet(<?php echo $value['id']; ?>, this)">
      <div class="img-box">
        <img src="<?php echo $value['foto_facial']; ?>" alt="<?php echo $value['nome']; ?>">
      </div>
      <p><?php echo $value['nome']; ?></p>
    </div>
  <?php endforeach; ?>
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

<!-- PAGINACAO -->
<?php $num_pets = count($pets);
if ($urlpage > 0 || $num_pets>=$limit): ?>
  <div class="paginacao">
    <?php if ($urlpage > 0): $voltar = $urlpage - 1; ?>
      <a href="<?php echo "perdidos/".$voltar; ?>"  class="botao-pag voltar">Voltar</a>
    <?php endif; ?>
    <?php if ($num_pets>=$limit): $mais_pets = $urlpage + 1; ?>
      <a href="<?php echo "perdidos/".$mais_pets; ?>" class="botao-pag mais-pets">Mais Pets</a>
    <?php endif; ?>
  </div>
<?php endif; ?>
