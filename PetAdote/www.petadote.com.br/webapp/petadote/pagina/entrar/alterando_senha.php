<?php importcore("SS"); ?>

<header class="cabecalho">
  <h1>Altere Senha</h1>
  <h2>Crie uma nova senha.</h2>
</header>

<form  action="alterar-senha" id="formulario" class="formulario" method="post" enctype="multipart/form-data">


  <div class="form-section">

    <label for="senha">Nova Senha <span id="error-senha" class="msg-error"><?php echo SS::s('_ss_veas_', 'senha'); ?></span></label><br>
    <input type="password" name="senha" id="senha" maxlength="20"  value="<?php echo SS::s('_ss_seas_', 'senha'); ?>" placeholder="********" required><br><br>

  </div>

 <div class="form-section-button">
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit" >Alterar Senha</button>
 </div>


</form>
