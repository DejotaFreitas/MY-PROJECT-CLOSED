<?php
importcore('SS');
importcore("CSRF");
$noticias = CRUD::selectQuery("
  SELECT n.titulo, n.descricao, n.time, u.nome
  FROM noticias n
  INNER JOIN usuario u ON u.id = n.usuario_id
  WHERE u.id=? AND u.tipo = ? ORDER BY n.time DESC;",
  [SessaoUsuario::usuario()['id'], 'i']);
?>

<header class="cabecalho">
  <h1>Cadastrando Notícia</h1>
  <h2>Adicione ou remova notícias de eventos da sua instituição.</h2>
</header>

<form action="cadastrar-noticia"  id="formulario" class="formulario" method="post" enctype="multipart/form-data">

<?php CSRF::inserir_formulario(); ?>

  <div class="form-section">

    <label for="titulo">Título  <span class="msg-error"><?php echo SS::s('_ss_vcnt_', 'titulo'); ?></span> </label><br>
    <input type="text" name="titulo" id="titulo" maxlength="100" value="<?php echo SS::sss('_ss_scnt_', 'titulo'); ?>" placeholder="PetAdote anúncia projeto de ...." required><br><br>

    <label for="descricao">Descrição  <span class="msg-error"><?php echo SS::s('_ss_vcnt_', 'descricao'); ?></span> </label><br>
    <textarea rows="8" cols="80" name="descricao" id="descricao" maxlength="10000" value="<?php echo SS::sss('_ss_scnt_', 'descricao'); ?>" placeholder="Esse novo projeto promete ...." required></textarea><br><br>


  </div>


    <div class="form-section-button">
      <button type="submit" id="buttomsubmit" name="pesquisar" class="submit">Cadstrar</button>
      <a href="noticias"><button type="button" class="cancela" name="cancelar">Cancelar</button></a>
    </div>


</form>



<!-- LISTA MINHAS NOTICIAS -->

<!-- NOTICIAS -->
<?php if (!empty($noticias)): ?>
  <?php foreach ($noticias as $value): ?>
    <div class="noticia">
      <a href="apagar-noticia/<?php echo $value['time']; ?>" class="noticia-apagar"> <button type="button" name="button" >Apagar</button> </a>
      <?php if (URL::is_mobile()): ?>
        <h2 class="noticia-titulo"><?php echo $value['titulo']; ?></h2>
      <?php else: ?>
        <h1 class="noticia-titulo"><?php echo $value['titulo']; ?></h1>
      <?php endif; ?>

      <div class="noticia-descricao">
        <?php $paragrafo = explode("\n", $value['descricao']); ?>
        <?php foreach ($paragrafo as $p): ?>
          <p><?php echo $p; ?></p>
        <?php endforeach; ?>
      </div>
      <div class="noticia-rodape">
        <a href="instituicao/<?php echo $value['id']; ?>">
          <?php if (URL::is_mobile()): ?>
            <h5 class="noticia-rodape-rodape"><?php echo $value['nome'].', '.date("d/m/Y", $value['time']); ?></h5>
          <?php else: ?>
            <h2><?php echo $value['nome'].', '.date("d/m/Y", $value['time']); ?></h2>
          <?php endif; ?>
        </a>
      </div>
      <div class="noticia-mostrar"> <button type="button" onclick="mostrar(this);"> Mostrar Mais</button> </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>Nenhuma notícia cadastrada.</p>
<?php endif; ?>
