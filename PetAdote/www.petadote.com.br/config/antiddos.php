<?php
// ANTI DDOS = se um usuario fizer muitas requisiscoes com intervalo menor que 2s entre elas
if(isset($_SESSION['last_session_request']) && $_SESSION['last_session_request'] > (time() - 2)){
  if (isset($_SESSION['last_session_request_count'])) {
    if ($_SESSION['last_session_request_count'] >= 99) {
      $_SESSION['last_session_request'] = time();
      header('HTTP/1.1 503 Servidor sobrecarregado, tente novamente mais tarde.');
      die('Servidor sobrecarregado, tente novamente mais tarde.');
    } else {
      $_SESSION['last_session_request_count'] += 1;
    }
  } else {  $_SESSION['last_session_request_count'] = 1; }
} else { $_SESSION['last_session_request_count'] = 0; }
$_SESSION['last_session_request'] = time();
