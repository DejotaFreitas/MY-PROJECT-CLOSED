<img src="<?php echo URL::webapp(); ?>img/pesquisar_instituicoes.svg" id="pesquisapet" class="pesquisapet"  alt="Pesquisar Instituição" title="Pesquisar Instituição" >

<header class="cabecalho">
  <h1>Instituições</h1>
  <h2>Veja as instiuições que ultilizam os recursos do projeto PetAdote.</h2>
</header>



<!-- ===========PESQUISA=========== -->
<form action="instituicoes"  id="formulario" class="formulario" method="post" enctype="multipart/form-data">

  <div class="form-section">

    <label for="pais">País</label><br>
    <select id="pais" name="pais" value="1"></select><br><br>

    <label for="estado">Estado</label><br>
    <?php $estado_id = SS::sss('_ss_sii_', 'estado') ?? "0"; ?>
    <select id="estado" name="estado" value="<?php echo $estado_id; ?>"></select><br><br>

    <label for="cidade">Cidade</label><br>
    <?php $cidade_id = SS::sss('_ss_sii_', 'cidade') ?? "0"; ?>
    <select id="cidade" name="cidade" value="<?php echo $cidade_id; ?>"></select><br><br>

  </div>


  <div class="form-section">

    <label for="nome">Nome</label><br>
    <input type="text" name="nome" id="nome" maxlength="20" value="<?php echo SS::sss('_ss_sii_', 'nome'); ?>" placeholder="PetAdote" ><br><br>

    <label for="email">E-Mail</label><br>
    <input type="text" name="email" id="email" maxlength="20" value="<?php echo SS::sss('_ss_sii_', 'email'); ?>" placeholder="petadote@email.com" ><br><br>

    <label for="cnpj">CNPJ</label><br>
    <input type="text" name="cnpj" id="cnpj" maxlength="20" value="<?php echo SS::sss('_ss_sii_', 'cnpj'); ?>" placeholder="..." ><br><br>

  </div>


    <div class="form-section-button">
      <button type="submit" id="buttomsubmit" name="pesquisar" class="submit">Pesquisar</button>
    </div>


</form>


<!-- =======PETS========= -->
<div class="pets-conteiner">
<?php if (empty($instuticoes)): ?>
  <?php echo 'Nenhuma instituição encontrada.'; ?>
<?php else: ?>
  <?php foreach ($instuticoes as $value): ?>
    <a href="instituicao/<?php echo $value['id']; ?>">
      <div class="pet-box doacao">
        <div class="img-box">
          <img src="<?php echo $value['foto']; ?>" alt="<?php echo $value['nome']; ?>">
        </div>
        <p><?php echo $value['nome']; ?></p>
      </div>
    </a>
  <?php endforeach; ?>
<?php endif; ?>
</div>





<!-- PAGINACAO -->
<?php $num_instuticoes = count($instuticoes);
if ($urlpage > 0 || $num_instuticoes>=$limit): ?>
  <div class="paginacao">
    <?php if ($urlpage > 0): $voltar = $urlpage - 1; ?>
      <a href="<?php echo "instituicoes/".$voltar; ?>"  class="botao-pag voltar">Voltar</a>
    <?php endif; ?>
    <?php if ($num_instuticoes>=$limit): $mais_instuticoes = $urlpage + 1; ?>
      <a href="<?php echo "instituicoes/".$mais_instuticoes; ?>" class="botao-pag mais-pets">Mais Instituições</a>
    <?php endif; ?>
  </div>
<?php endif; ?>
