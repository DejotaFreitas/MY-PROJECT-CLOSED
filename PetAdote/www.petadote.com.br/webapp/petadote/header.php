
<?php if (!URL::is_mobile()): ?>


  <nav id="menu-top">

    <nav class="menu-logo">
      <?php if (empty($_SESSION['acessibilidade_cor_tema']) || $_SESSION['acessibilidade_cor_tema'] == "escuro"): ?>
        <a href="" class="logo"><img src="<?php echo URL::webapp(); ?>img/logo/logo_borda_claro.svg" alt="logo"></a>
      <?php elseif ($_SESSION['acessibilidade_cor_tema'] == "claro"): ?>
        <a href="" class="logo"><img src="<?php echo URL::webapp(); ?>img/logo/logo_borda_escuro.svg" alt="logo"></a>
      <?php endif; ?>
    </nav>

    <nav class="menu-global">

      <?php if (!SessaoUsuario::logado()): ?>

        <a href="entrar" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/entrar.svg" alt="Entrar">
          <p>Entrar</p>
        </a>

        <a href="cadastro" class="item">
            <img  src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/cadastro.svg" alt="Cadastro">
            <p>Cadastro</p>
        </a>

        <a href="acessibilidade" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/acessibilidade.svg" alt="Acessibilidade">
          <p>Acessibilidade</p>
        </a>

        <a href="ajuda" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/ajuda.svg" alt="Ajuda">
          <p>Ajuda</p>
        </a>

      <?php else: ?>

        <a href="meuspets" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/meuspets.svg" alt="Meus Pets">
          <p>Meus Pets</p>
        </a>

        <a href="vinculos" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/adocao.svg" alt="Vínculos">
          <p>Vínculos</p>
        </a>

        <a href="interessados" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/adotante.svg" alt="Interessados">
          <p>Interessados</p>
        </a>

        <?php if (SessaoUsuario::usuario()['tipo'] == 'i'): ?>
          <a href="parceiros" class="item">
            <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/parceiros.svg" alt="Parceiros">
            <p>Parceiros</p>
          </a>
        <?php endif; ?>

        <a href="perfil" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/perfil.svg" alt="Perfil">
          <p>Perfil</p>
        </a>

        <a href="acessibilidade" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/acessibilidade.svg" alt="Acessibilidade">
          <p>Acessibilidade</p>
        </a>

        <a href="ajuda" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/ajuda.svg" alt="Ajuda">
          <p>Ajuda</p>
        </a>

        <a href="sair" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/sair.svg" alt="Sair">
          <p>Sair</p>
        </a>

        <?php endif; ?>

    </nav>

  </nav>


  <!-- MENU LATERAL -->
  <nav id="menu-lateral">

    <a href="pets" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/pets.svg" alt="Pets">
      <p>Adoção</p>
    </a>

    <a href="perdidos" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/perdido.svg" alt="Perdidos">
      <p>Perdidos</p>
    </a>

    <a href="encontrados" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/encontrado.svg" alt="Encontrados">
      <p>Encontrados</p>
    </a>

    <a href="noticias" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/noticias.svg" alt="Notícias">
      <p>Notícias</p>
    </a>

    <a href="instituicoes" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/instituicoes.svg" alt="instituições">
      <p>Instituições</p>
    </a>

  </nav>


<!-- ====================================================== -->
<?php else: ?> <!-- SE FOR MOBILE -->
<!-- ====================================================== -->



  <nav id="menu-top">

      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/menu_mobile.svg" id="menu_mobile_letf" class="menu_mobile" alt="botao menu">

    <?php if (empty($_SESSION['acessibilidade_cor_tema']) || $_SESSION['acessibilidade_cor_tema'] == "escuro"): ?>
      <a href="" class="logo"><img src="<?php echo URL::webapp(); ?>img/logo/logo_borda_claro.svg" alt="logo"></a>
    <?php elseif ($_SESSION['acessibilidade_cor_tema'] == "claro"): ?>
      <a href="" class="logo"><img src="<?php echo URL::webapp(); ?>img/logo/logo_borda_escuro.svg" alt="logo"></a>
    <?php endif; ?>

    <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/menu_mobile.svg" id="menu_mobile_right" class="menu_mobile" alt="botao menu">

  </nav>

  <nav id="menu-flutuante">

  <div class="fechar_menu_mobile">
    <div id="fechar_menu_mobile">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/fechar.svg"  alt="fechar_menu_mobile">
      <p>Fechar Menu</p>
    </div>
  </div>

  <nav class="menu-lateral">

    <a href="pets" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/pets.svg" alt="Pets">
      <p>Adoção</p>
    </a>

    <a href="perdidos" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/perdido.svg" alt="Perdidos">
      <p>Perdidos</p>
    </a>

    <a href="encontrados" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/encontrado.svg" alt="Encontrados">
      <p>Encontrados</p>
    </a>

    <a href="instituicoes" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/instituicoes.svg" alt="instituições">
      <p>Instituições</p>
    </a>

    <a href="noticias" class="item">
      <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/noticias.svg" alt="Notícias">
      <p>Notícias</p>
    </a>


    <?php if (SessaoUsuario::logado()): ?>
      <a href="ajuda" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/ajuda.svg" alt="Ajuda">
        <p>Ajuda</p>
      </a>
    <?php endif; ?>

  </nav>

  <nav class="menu-global">

    <?php if (!SessaoUsuario::logado()): ?>

      <a href="entrar" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/entrar.svg" alt="Entrar">
        <p>Entrar</p>
      </a>

      <a href="cadastro" class="item">
          <img  src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/cadastro.svg" alt="Cadastro">
          <p>Cadastro</p>
      </a>

      <a href="acessibilidade" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/acessibilidade.svg" alt="Acessibilidade">
        <p>Acessibilidade</p>
      </a>

      <a href="ajuda" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/ajuda.svg" alt="Ajuda">
        <p>Ajuda</p>
      </a>

    <?php else: ?>

      <a href="meuspets" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/meuspets.svg" alt="Meus Pets">
        <p>Meus Pets</p>
      </a>

      <a href="vinculos" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/adocao.svg" alt="Vínculos">
        <p>Vínculos</p>
      </a>

      <a href="interessados" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/adotante.svg" alt="Interessados">
        <p>Interessados</p>
      </a>

      <?php if (SessaoUsuario::usuario()['tipo'] == 'i'): ?>
        <a href="parceiros" class="item">
          <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/parceiros.svg" alt="Parceiros">
          <p>Parceiros</p>
        </a>
      <?php endif; ?>

      <a href="perfil" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/perfil.svg" alt="Perfil">
        <p>Perfil</p>
      </a>

      <a href="acessibilidade" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/acessibilidade.svg" alt="Acessibilidade">
        <p>Acessibilidade</p>
      </a>

      <a href="sair" class="item">
        <img src="<?php echo URL::webapp(); ?>img/<?php echo $iconcor; ?>/sair.svg" alt="Sair">
        <p>Sair</p>
      </a>

    <?php endif; ?>

  </nav>


</nav>

<!-- ====================================================== -->
<?php endif; ?>
<!-- ====================================================== -->


<section id="corpo">
  <section id="conteudo">
