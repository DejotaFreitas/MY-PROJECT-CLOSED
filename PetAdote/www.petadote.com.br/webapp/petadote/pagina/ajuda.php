
<header class="cabecalho">
  <h1>Ajuda</h1>
  <h2>Tire dúvidas ou reporte algum problema.</h2>
</header>

<?php if (isset($resultado)): ?>
  <header class="cabecalho">
    <h2><?php echo $resultado; ?></h2>
  </header>
<?php endif; ?>


<form action="ajuda" id="formulario" class="formulario" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <?php if (!SessaoUsuario::logado()): ?>

      <label for="nome">Nome <span class="msg-error"><?php echo SS::s('_ss_vae_', 'nome'); ?></span></label><br>
      <input type="text" name="nome" id="nome" maxlength="20"  value="<?php echo SS::s('_ss_sae_', 'nome'); ?>" placeholder="Maria Jose" required><br><br>

      <label for="emial">E-mail <span class="msg-error"><?php echo SS::s('_ss_vae_', 'email'); ?></span></label><br>
      <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SS::s('_ss_sae_', 'email'); ?>" placeholder="mariajose@email.com" required><br><br>

    <?php endif; ?>

    <label for="assunto">Assunto <span class="msg-error"><?php echo SS::s('_ss_vae_', 'assunto'); ?></span></label><br>
    <input type="text" name="assunto" id="assunto" maxlength="100"  value="<?php echo SS::s('_ss_sae_', 'assunto'); ?>" placeholder="Assunto..." required><br><br>

    <label for="mensagem">Mensagem <span class="msg-error"><?php echo SS::s('_ss_vae_', 'mensagem'); ?></span></label><br>
    <textarea rows="8" cols="80" name="mensagem" id="mensagem" maxlength="1000" placeholder="Mensagem..." required><?php echo SS::s('_ss_sae_', 'mensagem'); ?></textarea><br><br>


  </div>

 <div class="form-section-button">
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit" >Enviar Mensagem</button>
 </div>


</form>
