<?php
importcore("CSRF");
importcore("SS");
?>

<header class="cabecalho">
  <h1>Cadastro de Parceiro</h1>
</header>


<form action="cadastrar-parceiro" id="formulario" class="formulario" method="post" enctype="multipart/form-data">

  <?php CSRF::inserir_formulario(); ?>

  <div class="form-section form-section-foto">

    <label>Logo <span class="msg-error"><?php echo SS::s('_ss_vcip_', 'foto'); ?></span></label>
    <div class="conteiner-foto">
      <input type="file" accept="image/*" name="avatar" id="input-avatar" class="input-avatar"  value="" required>
      <div id="foto-label" class="foto-label">
        <label for="input-avatar" >
            <img src="<?php echo URL::webapp(); ?>img/cadastro/avatar.svg" alt="foto" id="foto" class="foto">
        </label>
      </div>
    </div>

    <input type="hidden" name="avatar_largura" id="avatar_largura" value="">
    <input type="hidden" name="avatar_altura"  id="avatar_altura" value="">
    <input type="hidden" name="avatar_x"  id="avatar_x" value="">
    <input type="hidden" name="avatar_y"  id="avatar_y" value="">
    <input type="hidden" name="selecao_tamanho"  id="selecao_tamanho" value="">
    <input type="hidden" name="rotacao"  id="rotacao" value="">

  </div>



  <div class="form-section">

    <label for="nome">Nome <span class="msg-error"><?php echo SS::s('_ss_vcip_', 'nome'); ?></span></label><br>
    <input type="text" name="nome" id="nome" maxlength="100"   value="<?php echo SS::s('_ss_scip_', 'nome'); ?>" placeholder="PetAdote" required><br><br>

    <label for="cnpj">CNPJ <span id="error-cnpj" class="msg-error"><?php echo SS::s('_ss_vcip_', 'cnpj'); ?></span></label><br>
    <input type="text" name="cnpj" id="cnpj" maxlength="18"  value="<?php echo SS::s('_ss_scip_', 'cnpj'); ?>"  required><br><br>

    <label for="endereco">Endereço (opcional) <span class="msg-error"><?php echo SS::s('_ss_vcip_', 'endereco'); ?></span></label><br>
    <input type="text" name="endereco" id="endereco" maxlength="200"   value="<?php echo SS::s('_ss_scip_', 'endereco'); ?>" placeholder="pais, estado, cidade, rua, nº, bairro"><br><br>

  </div>

  <div class="form-section">

    <label for="emial">E-mail (opcional) <span id="error-email" class="msg-error"><?php echo SS::s('_ss_vcip_', 'email'); ?></span></label><br>
    <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SS::s('_ss_scip_', 'email'); ?>" placeholder="petadote@email.com"><br><br>

    <label for="telefone">Telefone (opcional) <span id="error-telefone" class="msg-error"><?php echo SS::s('_ss_vcip_', 'telefone'); ?></span></label><br>
    <input type="text" name="telefone" id="telefone" maxlength="20"  value="<?php echo SS::s('_ss_scip_', 'telefone'); ?>" placeholder="(xx) xxxxx-xxxx"><br><br>

    <label for="nome">Site ou Rede Social (opcional) <span class="msg-error"><?php echo SS::s('_ss_vcip_', 'site'); ?></span></label><br>
    <input type="text" name="site" id="site" maxlength="100"   value="<?php echo SS::s('_ss_scip_', 'site'); ?>" placeholder="www.petadote.com.br"><br><br>

  </div>

  <div class="form-section-button">
    <label for="buttomsubmit"><span id="error-cadastrar" class="msg-error"></span></label>
    <button type="submit" id="buttomsubmit" name="cadastrar" class="submit">Cadastrar</button>
      <a href="parceiros"><button type="button" class="cancela" name="cancelar">Cancelar</button></a>
  </div>


</form>



<!-- DIV FLUTUANTE PARA RECORTAR A IMAGEM -->
<div id="selecao_imagem" class="selecao_imagem">
  <div id="area-imagem" class="area-imagem"><img src="" alt="avatar" id="imagem" class="imagem"></div>
  <div id="selecao" class="selecao"></div>
  <div class="menu">
    <div class="botao-menu" id="ok"> <img src="<?php echo URL::webapp(); ?>img/cadastro/ok.svg" alt="ok"> </div>
    <div class="botao-menu" id="zoommais"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommais.svg" alt="zoommais"></div>
    <div class="botao-menu" id="zoommenos"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommenos.svg" alt="zoommenos"></div>
    <div class="botao-menu" id="girardireita"><img src="<?php echo URL::webapp(); ?>img/cadastro/girardireita.svg" alt="girardireita"></div>
    <div class="botao-menu" id="giraresquerda"><img src="<?php echo URL::webapp(); ?>img/cadastro/giraresquerda.svg" alt="giraresquerda"></div>
    <div class="botao-menu" id="cancela"><img src="<?php echo URL::webapp(); ?>img/cadastro/cancela.svg" alt="cancela"></div>
  </div>
</div>
