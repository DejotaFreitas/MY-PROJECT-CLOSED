<?php
importcore("CSRF");
importcore("SS");
?>

<header class="cabecalho">
  <h1>Cadastro de Pet</h1>
</header>

<!-- DIV FLUTUANTE PARA RECORTAR A IMAGEM -->
<div id="selecao_imagem_1" class="selecao_imagem">
  <div id="area-imagem_1" class="area-imagem"><img src="" alt="avatar" id="imagem_1" class="imagem"></div>
  <div id="selecao_1" class="selecao"></div>
  <div class="menu">
    <div class="botao-menu" id="ok_1"> <img src="<?php echo URL::webapp(); ?>img/cadastro/ok.svg" alt="ok"> </div>
    <div class="botao-menu" id="zoommais_1"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommais.svg" alt="zoommais"></div>
    <div class="botao-menu" id="zoommenos_1"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommenos.svg" alt="zoommenos"></div>
    <div class="botao-menu" id="girardireita_1"><img src="<?php echo URL::webapp(); ?>img/cadastro/girardireita.svg" alt="girardireita"></div>
    <div class="botao-menu" id="giraresquerda_1"><img src="<?php echo URL::webapp(); ?>img/cadastro/giraresquerda.svg" alt="giraresquerda"></div>
    <div class="botao-menu" id="cancela_1"><img src="<?php echo URL::webapp(); ?>img/cadastro/cancela.svg" alt="cancela"></div>
  </div>
</div>


<!-- DIV FLUTUANTE PARA RECORTAR A IMAGEM -->
<div id="selecao_imagem_2" class="selecao_imagem">
  <div id="area-imagem_2" class="area-imagem"><img src="" alt="avatar" id="imagem_2" class="imagem"></div>
  <div id="selecao_2" class="selecao"></div>
  <div class="menu">
    <div class="botao-menu" id="ok_2"> <img src="<?php echo URL::webapp(); ?>img/cadastro/ok.svg" alt="ok"> </div>
    <div class="botao-menu" id="zoommais_2"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommais.svg" alt="zoommais"></div>
    <div class="botao-menu" id="zoommenos_2"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommenos.svg" alt="zoommenos"></div>
    <div class="botao-menu" id="girardireita_2"><img src="<?php echo URL::webapp(); ?>img/cadastro/girardireita.svg" alt="girardireita"></div>
    <div class="botao-menu" id="giraresquerda_2"><img src="<?php echo URL::webapp(); ?>img/cadastro/giraresquerda.svg" alt="giraresquerda"></div>
    <div class="botao-menu" id="cancela_2"><img src="<?php echo URL::webapp(); ?>img/cadastro/cancela.svg" alt="cancela"></div>
  </div>
</div>


<!-- DIV FLUTUANTE PARA RECORTAR A IMAGEM -->
<div id="selecao_imagem_3" class="selecao_imagem">
  <div id="area-imagem_3" class="area-imagem"><img src="" alt="avatar" id="imagem_3" class="imagem"></div>
  <div id="selecao_3" class="selecao"></div>
  <div class="menu">
    <div class="botao-menu" id="ok_3"> <img src="<?php echo URL::webapp(); ?>img/cadastro/ok.svg" alt="ok"> </div>
    <div class="botao-menu" id="zoommais_3"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommais.svg" alt="zoommais"></div>
    <div class="botao-menu" id="zoommenos_3"><img src="<?php echo URL::webapp(); ?>img/cadastro/zoommenos.svg" alt="zoommenos"></div>
    <div class="botao-menu" id="girardireita_3"><img src="<?php echo URL::webapp(); ?>img/cadastro/girardireita.svg" alt="girardireita"></div>
    <div class="botao-menu" id="giraresquerda_3"><img src="<?php echo URL::webapp(); ?>img/cadastro/giraresquerda.svg" alt="giraresquerda"></div>
    <div class="botao-menu" id="cancela_3"><img src="<?php echo URL::webapp(); ?>img/cadastro/cancela.svg" alt="cancela"></div>
  </div>
</div>


<form id="formulario" class="formulario" action="cadastrar-pet" method="post" enctype="multipart/form-data">

  <?php CSRF::inserir_formulario(); ?>


  <div class="form-section form-section-foto">
    <label>Foto Facial<span class="msg-error"><?php echo SS::s('_ss_vcp_', 'foto'); ?></span></label>
    <div class="conteiner-foto">
      <input type="file" accept="image/*" name="avatar_1" id="input-avatar_1" class="input-avatar"  value="" required>
      <div id="foto-label_1" class="foto-label">
        <label for="input-avatar_1" >
            <img src="<?php echo URL::webapp(); ?>img/cadastro/avatar.svg" alt="foto" id="foto_1" class="foto">
        </label>
      </div>
    </div>
    <input type="hidden" name="avatar_largura_1" id="avatar_largura_1" value="">
    <input type="hidden" name="avatar_altura_1"  id="avatar_altura_1" value="">
    <input type="hidden" name="avatar_x_1"  id="avatar_x_1" value="">
    <input type="hidden" name="avatar_y_1"  id="avatar_y_1" value="">
    <input type="hidden" name="selecao_tamanho_1"  id="selecao_tamanho_1" value="">
    <input type="hidden" name="rotacao_1"  id="rotacao_1" value="">
  </div>


  <div class="form-section form-section-foto">
    <label>Foto Lateral<span class="msg-error"><?php echo SS::s('_ss_vcp_', 'foto'); ?></span></label>
    <div class="conteiner-foto">
      <input type="file" accept="image/*" name="avatar_2" id="input-avatar_2" class="input-avatar"  value="" required>
      <div id="foto-label_2" class="foto-label">
        <label for="input-avatar_2" >
            <img src="<?php echo URL::webapp(); ?>img/cadastro/avatar.svg" alt="foto" id="foto_2" class="foto">
        </label>
      </div>
    </div>
    <input type="hidden" name="avatar_largura_2" id="avatar_largura_2" value="">
    <input type="hidden" name="avatar_altura_2"  id="avatar_altura_2" value="">
    <input type="hidden" name="avatar_x_2"  id="avatar_x_2" value="">
    <input type="hidden" name="avatar_y_2"  id="avatar_y_2" value="">
    <input type="hidden" name="selecao_tamanho_2"  id="selecao_tamanho_2" value="">
    <input type="hidden" name="rotacao_2"  id="rotacao_2" value="">
  </div>

  <div class="form-section form-section-foto">
    <label>Foto Superior <span class="msg-error"><?php echo SS::s('_ss_vcp_', 'foto'); ?></span></label>
    <div class="conteiner-foto">
      <input type="file" accept="image/*" name="avatar_3" id="input-avatar_3" class="input-avatar"  value="" required>
      <div id="foto-label_3" class="foto-label">
        <label for="input-avatar_3" >
            <img src="<?php echo URL::webapp(); ?>img/cadastro/avatar.svg" alt="foto" id="foto_3" class="foto">
        </label>
      </div>
    </div>
    <input type="hidden" name="avatar_largura_3" id="avatar_largura_3" value="">
    <input type="hidden" name="avatar_altura_3"  id="avatar_altura_3" value="">
    <input type="hidden" name="avatar_x_3"  id="avatar_x_3" value="">
    <input type="hidden" name="avatar_y_3"  id="avatar_y_3" value="">
    <input type="hidden" name="selecao_tamanho_3"  id="selecao_tamanho_3" value="">
    <input type="hidden" name="rotacao_3"  id="rotacao_3" value="">
  </div>


  <div class="form-section">

    <label for="relacao">Situação</label><br>
    <select id="relacao" name="cdp_relacao" required>
      <option value="Doação">Doação</option>
      <option value="Perdido">Perdido</option>
      <option value="Encontrado">Encontrado</option>
    </select><br><br>

    <label for="especie">Espécie</label><br>
    <select id="especie" name="cdp_especie" required>
      <option value="Cachorro">Cachorro</option>
      <option value="Gato">Gato</option>
    </select><br><br>

    <label for="genero">Gênero</label><br>
    <select id="genero" name="cdp_genero" required>
      <option value="Macho">Macho</option>
      <option value="Fêmea">Fêmea</option>
    </select><br><br>

  </div>


  <div class="form-section">

    <label for="idade">Idade</label><br>
    <select id="idade" name="cdp_idade" required>
      <option value="Filhote">Filhote</option>
      <option value="Adulto">Adulto</option>
    </select><br><br>

    <label for="porte">Porte</label><br>
    <select id="porte" name="cdp_porte" required>
      <option value="Pequeno">Pequeno</option>
      <option value="Médio">Médio</option>
      <option value="Grande">Grande</option>
    </select><br><br>

    <label for="castrado">Castrado</label><br>
    <select id="castrado" name="cdp_castrado" required>
      <option value="Não">Não</option>
      <option value="Sim">Sim</option>
    </select><br><br>

  </div>


  <div class="form-section">

    <label for="vacinado">Vacinado</label><br>
    <select id="vacinado" name="cdp_vacinado" required>
      <option value="Não">Não</option>
      <option value="Sim">Sim</option>
    </select><br><br>

    <label for="nome">Nome</label><br>
    <input type="text" name="cdp_nome" id="nome" maxlength="20" value="" placeholder="Thor" required><br><br>

    <label for="descricao">Descrição (opcional)</label><br>
    <input type="text" name="cdp_descricao" id="descricao" maxlength="600"  value="" placeholder="Descrição do pet, local que foi encontrado ou perdido."><br><br>

  </div>


 <div class="form-section-button">

   <label for="buttomsubmit"><span id="error-cadastrar" class="msg-error"></span></label>
   <button type="submit" id="buttomsubmit" name="cadastrar" class="submit">Cadastrar</button>
   <a href="meuspets"><button type="button" class="cancela" name="cancelar">Cancelar</button></a>

 </div>


</form>
