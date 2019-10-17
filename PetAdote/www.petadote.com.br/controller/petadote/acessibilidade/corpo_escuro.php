<?php
$_SESSION['acessibilidade_cor_corpo'] = "escuro";
try {
  if (SessaoUsuario::logado()) {
    $config_usuario = ['cor_corpo'=>$_SESSION['acessibilidade_cor_corpo']];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::update('config', $config_usuario, 'usuario_id = ?', [$usuario_id]);
  }
} catch (Exception $e) {}
