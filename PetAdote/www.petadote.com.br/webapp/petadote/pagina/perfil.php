<?php
importcore("SS");
?>

<header class="cabecalho">
  <h1>Perfil</h1>
  <h2>Atualize seus dados.</h2>
</header>

<div class="perfil-conteiner">

  <div class="perfil-section perfil-section-foto">
    <form action="perfil-alterar-geral-foto" id="alterar_foto" class="formulario" method="post" enctype="multipart/form-data">
        <label class="rotulo">Foto <span class="msg-error"><?php echo SS::s('_ss_vp_', 'foto'); ?></span></label>
        <div class="conteiner-foto">
          <input type="file" accept="image/*" name="avatar" id="input-avatar" class="input-avatar"  value="" required>
          <div id="foto-label" class="foto-label">
            <label for="input-avatar" >
                <img src="<?php echo SessaoUsuario::usuario()['foto']; ?>" alt="foto" id="foto" class="foto">
          </label>
        </div>
      </div>
      <input type="hidden" name="avatar_largura" id="avatar_largura" value="">
      <input type="hidden" name="avatar_altura"  id="avatar_altura" value="">
      <input type="hidden" name="avatar_x"  id="avatar_x" value="">
      <input type="hidden" name="avatar_y"  id="avatar_y" value="">
      <input type="hidden" name="selecao_tamanho"  id="selecao_tamanho" value="">
      <input type="hidden" name="rotacao"  id="rotacao" value="">

      <div class="perfil-section-buton perfil-section-buton-foto">
          <button type="submit" name="button" >Salvar Alteração</button>
      </div>
    </form>
  </div>


  <div class="perfil-section">
    <label for="pais" class="rotulo">País</label><br>
    <select id="pais" name="pais" value="<?php echo SessaoUsuario::usuario()['pais_id'] ?? "1"; ?>" required></select>

    <label for="estado" class="rotulo">Estado</label><br>
    <select id="estado" name="estado" value="<?php echo SessaoUsuario::usuario()['estado_id'] ?? "1"; ?>" required> </select>

    <label for="cidade" class="rotulo">Cidade</label><br>
    <select id="cidade" name="cidade" value="<?php echo SessaoUsuario::usuario()['cidade_id'] ?? "1"; ?>" required> </select>

    <div class="perfil-section-buton">
        <button type="button" id="alterar_geral_pais_estado_cidade" name="button" id="alterar_cidade" >Salvar Alteração</button>
    </div>
  </div>


  <div class="perfil-section">
    <label for="nome" class="rotulo">Nome</label><br>
    <input type="text" name="nome" id="nome" maxlength="20"   value="<?php echo SessaoUsuario::usuario()['nome']; ?>" placeholder="Maria Jose" required>

    <label for="emial" class="rotulo">E-mail <span id="email_msg_error" class="msg-error"></span></label><br>
    <input type="email" name="email" id="email" maxlength="100"  value="<?php echo SessaoUsuario::usuario()['email']; ?>" placeholder="mariajose@email.com" required>

    <label for="senha" class="rotulo">Senha</label><br>
    <input type="password" name="senha" id="senha" maxlength="20"  value="" placeholder="********">

    <div class="perfil-section-buton">
        <button type="button" name="button" id="alterar_geral_nome_email_senha">Salvar Alteração</button>
    </div>
  </div>


  <div class="perfil-section">

    <label for="telefone" class="rotulo">Telefone/Whatsapp</label><br>
    <input type="text" name="telefone" id="telefone" maxlength="20"  value="<?php echo SessaoUsuario::usuario()['telefone']; ?>" placeholder="(xx) xxxxx-xxxx" required>

    <?php if (SessaoUsuario::usuario()['tipo'] == 'i'): ?>

      <label for="cnpj" class="rotulo">CNPJ <span id="cnpj_msg_error" class="msg-error"></span></label><br>
      <input type="text" name="cnpj" id="cnpj" maxlength="18"  value="<?php echo SessaoUsuario::usuario()['cnpj']; ?>"  required>

      <label for="endereco" class="rotulo">Rua, número, bairro e etc</label><br>
      <input type="text" name="endereco" id="endereco" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['endereco']; ?>" placeholder="Rua jose paulo, Nº 175, bairro pitombeira" required>

    <?php endif; ?>

    <div class="perfil-section-buton">
        <button type="button" name="button" id="alterar_gi_telefone_cnpj_endereco" >Salvar Alteração</button>
    </div>

  </div>

  <?php if (SessaoUsuario::usuario()['tipo'] == 'i'): ?>

    <div class="perfil-section">
      <label for="facebook" class="facebook">Facebook</label><br>
      <input type="text" name="facebook" id="facebook" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['facebook'] ?? ""; ?>" placeholder="www.facebook.com/petadote" required>

      <label for="instagram" class="instagram">Instagram</label><br>
      <input type="text" name="instagram" id="instagram" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['instagram'] ?? ""; ?>" placeholder="www.instagram.com/petadote" required>

      <label for="youtube" class="youtube">Youtube</label><br>
      <input type="text" name="youtube" id="youtube" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['youtube'] ?? ""; ?>" placeholder="www.youtube.com/channel/UCawdQwVp" required>

      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_facebook_instagram_youtube">Salvar Alteração</button>
      </div>
    </div>



    <div class="perfil-section">
      <label for="twitter" class="facebook">Twitter</label><br>
      <input type="text" name="twitter" id="twitter" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['twitter'] ?? ""; ?>" placeholder="twitter.com/petadote" required>

      <label for="googleplus" class="google+">Google+</label><br>
      <input type="text" name="googleplus" id="googleplus" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['googleplus'] ?? ""; ?>" placeholder="plus.google.com/0123456789" required>

      <label for="site" class="site">Site</label><br>
      <input type="text" name="site" id="site" maxlength="200"   value="<?php echo SessaoUsuario::usuario()['site'] ?? ""; ?>" placeholder="www.petadote.com.br" required>

      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_twitter_googleplus_site">Salvar Alteração</button>
      </div>
    </div>


    <div class="perfil-section perfil-section-large">
      <label for="nome" class="rotulo">História da instituição</label><br>
      <textarea name="historia" id="historia" rows="10" maxlength="60000" placeholder="História da instituição..."><?php echo SessaoUsuario::usuario()['historia'] ?? ""; ?></textarea>
      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_historia">Salvar Alteração</button>
      </div>
    </div>


    <div class="perfil-section perfil-section-large">
      <label for="como_receber_ajuda" class="rotulo">Como receber ajuda</label><br>
      <textarea name="como_receber_ajuda" id="como_receber_ajuda" rows="10" maxlength="60000" placeholder="Informe as formas e os dados necessários para que sua instituiçao possa receber doações..."><?php echo SessaoUsuario::usuario()['como_receber_ajuda'] ?? ""; ?></textarea>
      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_como_receber_ajuda">Salvar Alteração</button>
      </div>
    </div>

    <div class="perfil-section perfil-section-large">
      <label for="processo_adocao" class="rotulo">Sobre o processo de adoção</span></label><br>
      <textarea name="processo_adocao" id="processo_adocao" rows="10" maxlength="60000" placeholder="Descreva como funciona o processo de adoção na sua instituicão..."><?php echo SessaoUsuario::usuario()['processo_adocao'] ?? ""; ?></textarea>
      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_processo_adocao">Salvar Alteração</button>
      </div>
    </div>

    <div class="perfil-section perfil-section-large">
      <label for="conteudo_educativo" class="rotulo">Conteúdo educativo</label><br>
      <textarea name="conteudo_educativo" id="conteudo_educativo" rows="10" maxlength="60000" placeholder="Conteúdo sobre pets, informando os cuidados que deve-se ter, curiosidades, leis que protegem os animais e etc..."><?php echo SessaoUsuario::usuario()['conteudo_educativo'] ?? ""; ?></textarea>
      <div class="perfil-section-buton">
          <button type="button" name="button" id="alterar_instituicao_conteudo_educativo">Salvar Alteração</button>
      </div>
    </div>


  <?php endif; ?>

</div>








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
