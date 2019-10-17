<?php
importcore("CSRF");
importcore("SS");
?>

<header class="cabecalho">
  <h1>Cadastro de Pessoas</h1>
  <!-- <h2>Cadastre-se e ultilize nossos recursos</h2> -->
</header>

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


<form id="formulario" class="formulario" action="cadastrar-pessoa" method="post" enctype="multipart/form-data">

  <?php CSRF::inserir_formulario(); ?>

  <div class="form-section form-section-foto">

    <label>Foto <span class="msg-error"><?php echo SS::s('_ss_vcp_', 'foto'); ?></span></label>
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

    <label for="pais">País</label><br>
    <?php $pais_id = SS::s('_ss_scp_', 'pais_id') ?? "1"; ?>
    <select id="pais" name="pais" value="<?php echo $pais_id; ?>" required></select><br><br>

    <label for="estado">Estado</label><br>
    <?php $estado_id = SS::s('_ss_scp_', 'estado_id') ?? "1"; ?>
    <select id="estado" name="estado" value="<?php echo $estado_id; ?>" required> </select><br><br>

    <label for="cidade">Cidade <span class="msg-error"><?php echo SS::s('_ss_vcp_', 'cidade'); ?></span></label><br>
    <?php $cidade_id = SS::s('_ss_scp_', 'cidade_id') ?? "1"; ?>
    <select id="cidade" name="cidade" value="<?php echo $cidade_id; ?>" required> </select><br><br>

  </div>

  <div class="form-section">

    <label for="nome">Nome <span class="msg-error"><?php echo SS::s('_ss_vcp_', 'nome'); ?></span></label><br>
    <input type="text" name="nome" id="nome" maxlength="20"   value="<?php echo SS::s('_ss_scp_', 'nome'); ?>" placeholder="Maria Jose" required><br><br>

    <label for="telefone">Telefone/Whatsapp <span id="error-telefone" class="msg-error"><?php echo SS::s('_ss_vcp_', 'telefone'); ?></span></label><br>
    <input type="text" name="telefone" id="telefone" maxlength="20"  value="<?php echo SS::s('_ss_scp_', 'telefone'); ?>" placeholder="(xx) xxxxx-xxxx" required><br><br>

    <label for="emial">E-mail <span id="error-email" class="msg-error"><?php echo SS::s('_ss_vcp_', 'email'); ?></span></label><br>
    <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SS::s('_ss_scp_', 'email'); ?>" placeholder="mariajose@email.com" required><br><br>

    <label for="senha">Senha <span id="error-senha" class="msg-error"><?php echo SS::s('_ss_vcp_', 'senha'); ?></span></label><br>
    <input type="password" name="senha" id="senha" maxlength="20"  value="<?php echo SS::s('_ss_scp_', 'senha'); ?>" placeholder="********" required><br><br>

  </div>

  <!-- <div class="form-section-termo">
    <input type="checkbox" name="termousuario" id="termousuario" class="termousuario" value="" required>
    <label for="termousuario">Aceito o termo a seguir.</span></label>
    <label for="termousuario"><p class="texto-termousuario">Os dados do usuário ficaram expostas ao público.</p></label>
  </div> -->

 <div class="form-section-button">
   <label for="buttomsubmit"><span id="error-cadastrar" class="msg-error"></span></label>
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit">Cadastrar</button>
   <a href="cadastro"><button type="button" class="cancela" name="cancelar">Cancelar</button></a>
 </div>


</form>
