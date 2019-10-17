<?php
//TEMPO DA SESSAO ESPIRA EM 3600 = 60 MINUTOS
if (isset($_SESSION['timexpire']) && (time()-$_SESSION['timexpire'])>3600){
  session_unset(); session_destroy(); session_start(); session_regenerate_id(true);
  header("Location: ".(!empty($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].'/');
}
$_SESSION['timexpire'] = time();
