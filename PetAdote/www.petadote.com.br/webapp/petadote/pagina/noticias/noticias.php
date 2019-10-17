<?php importcore('SS'); ?>

<?php if (SessaoUsuario::logado() && SessaoUsuario::usuario()['tipo'] == 'i'): ?>
  <a href="cadastrando-noticia" class="addpet"> <img src="<?php echo URL::webapp(); ?>img/add.svg"    alt="Cadastrar Notícia" title="Cadastrar Notícia"> </a>
<?php endif; ?>


<img src="<?php echo URL::webapp(); ?>img/pesquisar_meuspets.svg" id="pesquisa_noticia" class="pesquisapet"  alt="Pesquisar Notícias" title="Pesquisar Notícias">

<header class="cabecalho">
  <h1>Notícias</h1>
  <h2>Veja as ultimas notícias divulgadas pelas as instituições.</h2>
</header>


<!-- ===========PESQUISA=========== -->
<form action="noticias"  id="formulario" class="formulario" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <label for="pais">País</label><br>
    <select id="pais" name="pais" value="1"></select><br><br>

    <label for="estado">Estado</label><br>
    <?php $estado_id = SS::sss('_ss_snt_', 'estado') ?? "0"; ?>
    <select id="estado" name="estado" value="<?php echo $estado_id; ?>"></select><br><br>

    <label for="cidade">Cidade</label><br>
    <?php $cidade_id = SS::sss('_ss_snt_', 'cidade') ?? "0"; ?>
    <select id="cidade" name="cidade" value="<?php echo $cidade_id; ?>"></select><br><br>

  </div>


  <div class="form-section">

    <label for="titulo">Título</label><br>
    <input type="text" name="titulo" id="titulo" maxlength="100" value="<?php echo SS::sss('_ss_snt_', 'titulo'); ?>" placeholder="PetAdote anúncia projeto de ...." ><br><br>

    <label for="descricao">Descrição</label><br>
    <input type="text" name="descricao" id="descricao" maxlength="100" value="<?php echo SS::sss('_ss_snt_', 'descricao'); ?>" placeholder="Esse novo projeto promete ...." ><br><br>

    <label for="nome">Nome da Instituição</label><br>
    <input type="text" name="nome" id="nome" maxlength="20" value="<?php echo SS::sss('_ss_snt_', 'nome'); ?>" placeholder="PetAdote ..." ><br><br>

  </div>

    <div class="form-section-button">
      <button type="submit" id="buttomsubmit" name="pesquisar" class="submit">Pesquisar</button>
    </div>


</form>


<!-- NOTICIAS -->
<?php if (!empty($noticias)): ?>
  <?php foreach ($noticias as $value): ?>
    <div class="noticia">
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
  <div class="noticia-nenhumn-pet-encontrado">
    <p>Nenhuma notícia encontrada.</p>
  </div>
<?php endif; ?>






<!-- PAGINACAO -->
<?php $num_pets = count($noticias);
if ($urlpage > 0 || $num_pets>=$limit): ?>
  <div class="paginacao">
    <?php if ($urlpage > 0): $voltar = $urlpage - 1; ?>
      <a href="<?php echo "noticias/".$voltar; ?>"  class="botao-pag voltar">Voltar</a>
    <?php endif; ?>
    <?php if ($num_pets>=$limit): $mais_pets = $urlpage + 1; ?>
      <a href="<?php echo "noticias/".$mais_pets; ?>" class="botao-pag mais-pets">Mais Notícias</a>
    <?php endif; ?>
  </div>
<?php endif; ?>
