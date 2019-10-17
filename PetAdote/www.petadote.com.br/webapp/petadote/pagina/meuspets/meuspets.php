<?php
importcore('SS');

function filtrar(){
  $where_nome = !SS::empty('_ss_smp_', 'nome');
  $where_especie = !SS::empty('_ss_smp_', 'especie');
  $where_genero = !SS::empty('_ss_smp_', 'genero');
  $where_idade = !SS::empty('_ss_smp_', 'idade');
  $where_porte = !SS::empty('_ss_smp_', 'porte');
  $where_castrado = !SS::empty('_ss_smp_', 'castrado');
  $where_vacinado = !SS::empty('_ss_smp_', 'vacinado');
  $where_descricao = !SS::empty('_ss_smp_', 'descricao');
  $where_relacao = !SS::empty('_ss_smp_', 'relacao');

  $where_campos = "";
  $where_campos .= $where_nome ? " AND p.nome LIKE ? " : "";
  $where_campos .= $where_especie ? " AND p.especie = ? " : "";
  $where_campos .= $where_genero ? " AND p.genero = ? ": "";
  $where_campos .= $where_idade ? " AND p.idade = ? ": "";
  $where_campos .= $where_porte ? " AND p.porte = ? " : "";
  $where_campos .= $where_castrado ? " AND p.castrado = ? " : "";
  $where_campos .= $where_vacinado ? " AND p.vacinado = ? " : "";
  $where_campos .= $where_descricao ? " AND p.descricao LIKE ? " : "";
  $where_campos .= $where_relacao ? " AND r.relacao = ? " : "";

  $where_valores = [];
  if ($where_nome) { $where_valores[] = "%".SS::sss('_ss_smp_', 'nome')."%";  }
  if ($where_especie) { $where_valores[] = SS::sss('_ss_smp_', 'especie');  }
  if ($where_genero) { $where_valores[] = SS::sss('_ss_smp_', 'genero');  }
  if ($where_idade) { $where_valores[] = SS::sss('_ss_smp_', 'idade');  }
  if ($where_porte) { $where_valores[] = SS::sss('_ss_smp_', 'porte');  }
  if ($where_castrado) { $where_valores[] = SS::sss('_ss_smp_', 'castrado');  }
  if ($where_vacinado) { $where_valores[] = SS::sss('_ss_smp_', 'vacinado');  }
  if ($where_descricao) { $where_valores[] = "%".SS::sss('_ss_smp_', 'descricao')."%";  }
  if ($where_relacao) { $where_valores[] = SS::sss('_ss_smp_', 'relacao');  }

  $_SESSION['meus_pet_where_campos'] = $where_campos;
  $_SESSION['meus_pet_where_valores'] = $where_valores;
}

if (empty($_SESSION['meus_pet_where_campos']) || empty($_SESSION['meus_pet_where_valores'])) {
  $_SESSION['meus_pet_where_campos'] = "";
  $_SESSION['meus_pet_where_valores'] = [];
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['pesquisar'])) {
  SS::sss('_ss_smp_', 'nome', $_POST['nome']);
  SS::sss('_ss_smp_', 'especie', $_POST['especie']);
  SS::sss('_ss_smp_', 'genero', $_POST['genero']);
  SS::sss('_ss_smp_', 'idade', $_POST['idade']);
  SS::sss('_ss_smp_', 'porte', $_POST['porte']);
  SS::sss('_ss_smp_', 'castrado', $_POST['castrado']);
  SS::sss('_ss_smp_', 'vacinado', $_POST['vacinado']);
  SS::sss('_ss_smp_', 'descricao', $_POST['descricao']);
  SS::sss('_ss_smp_', 'relacao', $_POST['relacao']);
  filtrar();
}


if (SessaoUsuario::logado()) {

  $id_dono = SessaoUsuario::usuario()['id'];
  $valores = array_merge([$id_dono,'Doação','Perdido','Encontrado'], $_SESSION['meus_pet_where_valores']);
  $meuspets = CRUD::selectQuery("
    SELECT p.id, p.foto_facial, p.nome, r.relacao
    FROM pet p INNER JOIN relacao r ON p.id = r.pet_id
    WHERE r.usuario_id=? AND (r.relacao=? OR r.relacao=? OR r.relacao=?)  ".$_SESSION['meus_pet_where_campos'],  $valores);
}
?>



<a href="cadastrando-pet" class="addpet"> <img src="<?php echo URL::webapp(); ?>img/add.svg"    alt="Cadastrar Pet" title="Cadastrar Pet"> </a>

<img src="<?php echo URL::webapp(); ?>img/pesquisar_meuspets.svg" id="pesquisapet" class="pesquisapet"  alt="Pesquisar Pet" title="Pesquisar Pet" >

<header class="cabecalho">
  <h1>Meus Pets</h1>
  <h2>Cadastre pets para adoção, perdidos ou encontrados.</h2>
</header>


<!-- ===========PESQUISA PET=========== -->
<form id="formulario" class="formulario" action="meuspets" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <label for="relacao">Situação</label><br>
    <select id="relacao" name="relacao">
      <?php
        $options = ['Todos'=>'','Doação'=>'Doação','Perdido'=>'Perdido','Encontrado'=>'Encontrado'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_smp_', 'relacao'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="especie">Espécie</label><br>
    <select id="especie" name="especie">
      <?php
        $options = ['Todos'=>'','Cachorro'=>'Cachorro','Gato'=>'Gato'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_smp_', 'especie'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="genero">Gênero</label><br>
    <select id="genero" name="genero">
      <?php
        $options = ['Todos'=>'','Macho'=>'Macho','Fêmea'=>'Fêmea'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_smp_', 'genero'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

  </div>


  <div class="form-section">

    <label for="idade">Idade</label><br>
    <select id="idade" name="idade">
      <?php
        $options = ['Todos'=>'','Filhote'=>'Filhote','Adulto'=>'Adulto'];
        foreach ($options as $key => $value)
          if ($value == SS::sss('_ss_smp_', 'idade'))
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
          if ($value == SS::sss('_ss_smp_', 'porte'))
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
          if ($value == SS::sss('_ss_smp_', 'castrado'))
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
          if ($value == SS::sss('_ss_smp_', 'vacinado'))
            echo '<option selected value="'.$value.'">'.$key.'</option>';
          else
            echo '<option value="'.$value.'">'.$key.'</option>';
      ?>
    </select><br><br>

    <label for="nome">Nome</label><br>
    <input type="text" name="nome" id="nome" maxlength="20" value="<?php echo SS::sss('_ss_smp_', 'nome'); ?>" placeholder="..." ><br><br>

    <label for="descricao">Descrição</label><br>
    <input type="text" name="descricao" id="descricao" maxlength="600"  value="<?php echo SS::sss('_ss_smp_', 'descricao'); ?>" placeholder="..."><br><br>

  </div>

  <div class="form-section-button">
    <button type="submit" id="buttomsubmit" name="pesquisar" class="submit" >Pesquisar</button>
  </div>

</form>


<!-- ===========SHOW PET============== -->
<div class="show-pet-fundo" id="show_pet_fundo"></div>
<div class="show-pet" id="show_pet_conteiner">

  <div class="show-pet-option">
    <button type="button" name="button" class="meu-pet-excluir"  onclick="excluir_meu_pet()" title="Apagar pet.">Excluir</button>
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


  <?php if (URL::is_mobile()): ?>
    <div class="show-pet-option">
      <button type="button" name="button" class="meu-pet-excluir"  onclick="excluir_meu_pet()" title="Apagar pet.">Excluir</button>
      <button type="button" name="button" class="show-pet-close" onclick="invisible_pet()">Fechar</button>
    </div>
  <?php endif; ?>

</div>

<!-- =======PETS========= -->
<div class="pets-conteiner">
<?php if (empty($meuspets)): ?>
  <?php echo 'Nenhum pet encontrado.'; ?>
<?php else: ?>
  <?php foreach ($meuspets as $value): ?>
    <div class="pet-box <?php echo $value['relacao']; ?>" onclick="show_pet(<?php echo $value['id']; ?>, this)">
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
