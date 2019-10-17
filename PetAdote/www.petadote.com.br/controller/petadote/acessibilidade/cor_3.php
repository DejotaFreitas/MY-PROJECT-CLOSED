<?php
$_SESSION['acessibilidade_cor'] = "3";
$_SESSION['acessibilidade_cor_tema'] = "claro";
try {
  if (SessaoUsuario::logado()) {
    $config_usuario = ['cor_fundo'=>$_SESSION['acessibilidade_cor'], 'cor_logo'=>$_SESSION['acessibilidade_cor_tema']];
    $usuario_id = SessaoUsuario::usuario()['id'];
    CRUD::update('config', $config_usuario, 'usuario_id = ?', [$usuario_id]);
  }
} catch (Exception $e) {}
