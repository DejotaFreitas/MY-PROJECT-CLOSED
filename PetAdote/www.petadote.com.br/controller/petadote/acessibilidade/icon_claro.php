<?php
$_SESSION['acessibilidade_icon'] = "iconclaro";
try {
  if (SessaoUsuario::logado()) {
    $config_usuario = ['estilo_icone'=>$_SESSION['acessibilidade_icon']];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::update('config', $config_usuario, 'usuario_id = ?', [$usuario_id]);
  }
} catch (Exception $e) {}
