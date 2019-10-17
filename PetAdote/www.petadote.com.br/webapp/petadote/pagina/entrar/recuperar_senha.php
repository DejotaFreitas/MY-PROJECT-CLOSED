<?php importcore("SS"); ?>

<header class="cabecalho">
  <h1>Recuperando senha</h1>
  <h2>Insira seu e-mail para da inicio ao processo de recuperação de senha.</h2>
</header>

<?php if (isset($resultado)): ?>
  <h1><?php echo $resultado; ?></h1>
<?php endif; ?>

<form action="recuperando-senha-email-enviado" id="formulario" class="formulario" method="post" enctype="multipart/form-data">


  <div class="form-section">

    <label for="emial">E-mail <span id="error-email" class="msg-error"><?php echo SS::s('_ss_vers_', 'email'); ?></span></label><br>
    <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SS::s('_ss_sers_', 'email'); ?>" placeholder="petadote@email.com" required><br><br>

  </div>

 <div class="form-section-button">
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit" >Enviar e-mail</button>
 </div>


</form>
