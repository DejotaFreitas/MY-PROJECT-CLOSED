<header class="cabecalho">
  <h1>Instituição</h1>
  <h2>Veja todas as informações da instituição.</h1>
</header>



<?php
$id = is_numeric(URL::var()) ? intval(URL::var()) : 0;
$usuario = CRUD::select(
  'usuario u INNER JOIN cidade c ON c.id = u.cidade_id INNER JOIN estado e ON e.id = c.estado_id INNER JOIN pais i ON i.id = e.pais_id',
  'u.*, c.descricao AS cidade, e.descricao AS estado, i.descricao AS pais', 'u.id=?', [$id]);
if (!empty($usuario)) { $usuario = $usuario[0]; }
?>
<?php if (empty($usuario) || $usuario['tipo']!='i'): ?>
  <p>Instituição não pode ser encontrada.</p>
<?php else: ?>


  <div class="intituicao-section instituicao-pequeno instituicao-imagem">
    <img src="<?php echo $usuario['foto']; ?>" alt="<?php echo $usuario['nome']; ?>">
  </div>

  <div class="intituicao-section instituicao-pequeno">
    <h1>Dados</h1>
    <p>NOME: <span><?php echo $usuario['nome']; ?></span> </p>
    <p>CNPJ: <span><?php echo $usuario['cnpj']; ?></span> </p>

    <p>E-MAIL: <a href="mailto:<?php echo $usuario['email']; ?>"><span><?php echo $usuario['email']; ?></span> <img src="<?php echo URL::webapp(); ?>img/email.svg" style="height:15px"></a></p>

    <p>FONE: <a href="tel:<?php echo $usuario['telefone']; ?>"><span ><?php echo $usuario['telefone']; ?></span> <img src="<?php echo URL::webapp(); ?>img/fone.svg" style="height:15px"></a></p>


    <p>ENDEREÇO: <span><?php echo $usuario['endereco']; ?></span> </p>
    <p>PAÍS: <span><?php echo $usuario['pais']; ?></span> </p>
    <p>ESTADO: <span><?php echo $usuario['estado']; ?></span> </p>
    <p>CIDADE: <span><?php echo $usuario['cidade']; ?></span> </p>
  </div>

  <?php
  $instituicao = CRUD::select('instituicao', '*', 'usuario_id=?', [$id]);
  if (!empty($instituicao)):
    $instituicao = $instituicao[0];
  ?>

    <?php if (!empty($instituicao['facebook']) || !empty($instituicao['instagram']) || !empty($instituicao['youtube']) || !empty($instituicao['twitter']) || !empty($instituicao['googleplus']) || !empty($instituicao['site'])): ?>

    <div class="intituicao-section  instituicao-pequeno">
      <h1>Páginas</h1>

      <?php if (!empty($instituicao['facebook'])): ?>
        <p>FACEBOOK: <a href="//<?php echo $instituicao['facebook']; ?>" target="_blank"><span><?php echo $instituicao['facebook']; ?></span></a></p>
      <?php endif; ?>

      <?php if (!empty($instituicao['instagram'])): ?>
        <p>INSTAGRAM: <a href="//<?php echo $instituicao['instagram']; ?>" target="_blank"><span><?php echo $instituicao['instagram']; ?></span></a></p>
      <?php endif; ?>

      <?php if (!empty($instituicao['youtube'])): ?>
        <p>YOUTUBE: <a href="//<?php echo $instituicao['youtube']; ?>" target="_blank"><span><?php echo $instituicao['youtube']; ?></span></a></p>
      <?php endif; ?>

      <?php if (!empty($instituicao['twitter'])): ?>
        <p>TWITTER: <a href="//<?php echo $instituicao['twitter']; ?>" target="_blank"><span><?php echo $instituicao['twitter']; ?></span></a></p>
      <?php endif; ?>

      <?php if (!empty($instituicao['googleplus'])): ?>
        <p>GOOGLE+: <a href="//<?php echo $instituicao['googleplus']; ?>" target="_blank"><span><?php echo $instituicao['googleplus']; ?></span></a></p>
      <?php endif; ?>

      <?php if (!empty($instituicao['site'])): ?>
        <p>SITE: <a href="//<?php echo $instituicao['site']; ?>" target="_blank"><span><?php echo $instituicao['site']; ?></span></a></p>
      <?php endif; ?>

    </div>
    <?php endif; ?>


    <?php if (!empty($instituicao['historia'])): ?>
      <div class="intituicao-section intituicao-largo">
        <h1>História</h1>
        <?php $paragrafo = explode("\n", $instituicao['historia']); ?>
        <?php foreach ($paragrafo as $p): ?>
          <p><?php echo $p; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <?php if (!empty($instituicao['como_receber_ajuda'])): ?>
      <div class="intituicao-section intituicao-largo">
        <h1>Como ajudar</h1>
        <?php $paragrafo = explode("\n", $instituicao['como_receber_ajuda']); ?>
        <?php foreach ($paragrafo as $p): ?>
          <p><?php echo $p; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <?php if (!empty($instituicao['processo_adocao'])): ?>
      <div class="intituicao-section intituicao-largo">
        <h1>Processo de adoção</h1>
        <?php $paragrafo = explode("\n", $instituicao['processo_adocao']); ?>
        <?php foreach ($paragrafo as $p): ?>
          <p><?php echo $p; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <?php if (!empty($instituicao['conteudo_educativo'])): ?>
      <div class="intituicao-section intituicao-largo">
        <h1>Conteúdo educativo</h1>
        <?php $paragrafo = explode("\n", $instituicao['conteudo_educativo']); ?>
        <?php foreach ($paragrafo as $p): ?>
          <p><?php echo $p; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <?php endif; ?>


    <?php
    $parceiros = CRUD::select('parceiros', 'cnpj, foto, nome', 'usuario_id=? ORDER BY nome ASC', [$id]);
    if (!empty($parceiros)):
    ?>
    <div class="intituicao-section intituicao-largo">
      <h1>Parceiros</h1>
      <div class="pets-conteiner">
        <?php foreach ($parceiros as $value): ?>
          <div class="pet-box " onclick="show_parceiro('<?php echo $value['cnpj']; ?>', this)">
            <div class="img-box">
              <img src="<?php echo $value['foto']; ?>" alt="<?php echo $value['nome']; ?>">
            </div>
            <p><?php echo $value['nome']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- ===========SHOW PET============== -->
    <div class="show-pet-fundo" id="show_parceiro_fundo"></div>
    <div class="show-pet" id="show_parceiro_conteiner">
      <div class="show-pet-option">
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
    <?php endif; ?>



<?php endif; ?>
