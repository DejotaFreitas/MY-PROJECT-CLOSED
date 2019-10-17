<?php
$_SESSION['acessibilidade_fontsize'] = "pequeno";
try {
  if (SessaoUsuario::logado()) {
    $config_usuario = ['tamanho_texto'=>$_SESSION['acessibilidade_fontsize']];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::update('config', $config_usuario, 'usuario_id = ?', [$usuario_id]);
  }
} catch (Exception $e) {}
