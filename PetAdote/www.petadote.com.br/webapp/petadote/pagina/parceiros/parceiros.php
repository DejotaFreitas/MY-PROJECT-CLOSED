<?php
$parceiros = CRUD::select('parceiros', 'cnpj, foto, nome', 'usuario_id=? ORDER BY nome ASC', [SessaoUsuario::usuario()['id']]);
?>

<a href="cadastrando-parceiro" class="addpet"> <img src="<?php echo URL::webapp(); ?>img/add.svg"    alt="Cadastrar Pet" title="Cadastrar Pet"> </a>

<header class="cabecalho">
  <h1>Parceiros</h1>
  <h2>Gerencie os parceiros que contribuem para a sua causa.</h2>
</header>



<!-- =======PETS========= -->
<div class="pets-conteiner">
<?php if (empty($parceiros)): ?>
  <?php echo 'Nenhum parceiro cadastrado.'; ?>
<?php else: ?>
  <?php foreach ($parceiros as $value): ?>
    <div class="pet-box " onclick="show_parceiro('<?php echo $value['cnpj']; ?>', this)">
      <div class="img-box">
        <img src="<?php echo $value['foto']; ?>" alt="<?php echo $value['nome']; ?>">
      </div>
      <p><?php echo $value['nome']; ?></p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>


<!-- =======================  -->
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



<!-- ===========SHOW PET============== -->
<div class="show-pet-fundo" id="show_parceiro_fundo"></div>
<div class="show-pet" id="show_parceiro_conteiner">

  <div class="show-pet-option">
    <button type="button" name="button" class="meu-pet-excluir"  onclick="excluir_parceiro()" title="Excluir parceiro.">Excluir</button>
    <button type="button" name="button" class="show-pet-close" onclick="invisible_parceiro()">Fechar</button>
  </div>

  <div class="show-pet-img">
    <img src="" id="foto" alt="foto">
  </div>

  <div class="show-pet-info">
    <h5 class="titulo">PARCEIRO</h5>
    <p>NOME: <span id="parceiro_nome"></span></p>
    <p>CNPJ: <span id="parceiro_cnpj"></span></p>
    <p>FONE: <a href="" id="parceiro_telefone"><span ></span> <img src="<?php echo URL::webapp(); ?>img/fone.svg" style="height:15px"></a></p>
    <p>E-MAIL: <a href="" id="parceiro_email"><span></span> <img src="<?php echo URL::webapp(); ?>img/email.svg" style="height:15px"></a></p>
    <p>SITE: <span id="parceiro_site"></span></p>
    <p>ENDEREÇO: <span id="parceiro_endereco"></span></p>
  </div>


</div>
