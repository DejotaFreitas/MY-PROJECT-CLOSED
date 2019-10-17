<?php
$_SESSION['acessibilidade_menu'] = "direita";
try {
  if (SessaoUsuario::logado()) {
    $config_usuario = ['menu_lateral'=>$_SESSION['acessibilidade_menu']];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::update('config', $config_usuario, 'usuario_id = ?', [$usuario_id]);
  }
} catch (Exception $e) {}
