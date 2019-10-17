<?php
if ($_SERVER['REQUEST_METHOD']=='POST'):
    
  $admin = CRUD::select('admin', '*', 'login = ? AND senha = ?', [$_POST['login'], $_POST['senha']]);
  if (!empty($admin)) {
    session_unset();
    session_regenerate_id();
    $_SESSION['usuario'] = $admin;
  } else {
    Notificacao::notificar_erro("Login ou senha incorreto.");
    $url->pagina('acesso');
  }
  
endif;
