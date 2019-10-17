<?php importcore("SS"); ?>

<header class="cabecalho">
  <h1>Entrar</h1>
  <h2>Acesse a sua conta para ultilizar de todos os nosso recursos.</h2>
</header>

<form id="formulario" class="formulario" action="entrar_logar" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <label for="emial">E-mail <span id="error-email" class="msg-error"><?php echo SS::s('_ss_vel_', 'email'); ?></span></label><br>
    <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SS::s('_ss_sel_', 'email'); ?>" placeholder="petadote@email.com" required><br><br>

    <label for="senha">Senha <span id="error-senha" class="msg-error"><?php echo SS::s('_ss_vel_', 'senha'); ?></span></label><br>
    <input type="password" name="senha" id="senha" maxlength="20"  value="<?php echo SS::s('_ss_sel_', 'senha'); ?>" placeholder="********" required><br><br>

  </div>

 <div class="form-section-button">
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit" >Entrar</button>
 </div>

 <div class="form-section">
       <a href="cadastro" class="cadastrese"><p>Cadastre-se</p></a>
       <a href="recuperando-senha" class="esqueceusenha"><p>Esqueceu sua senha ?</p></a>
 </div>


</form>
