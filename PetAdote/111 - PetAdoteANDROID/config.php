<?php
session_start();
// =================================================================================================

// ANTI DDOS = se um usuario fizer 20 requisiscoes com intervalo menor que 2s entre elas
if(isset($_SESSION['last_session_request']) && $_SESSION['last_session_request'] > (time() - 2)){
  if (isset($_SESSION['last_session_request_count'])) {
    if ($_SESSION['last_session_request_count'] >= 20) {
      $_SESSION['last_session_request'] = time();
      header('HTTP/1.1 503 Servidor sobrecarregado, tente novamente mais tarde.');
      die('Servidor sobrecarregado, tente novamente mais tarde.');
       // a aplicaocao vai morrer aqui, enquanto continuar efetuando requisicoes
       // com intervalo menor que 2s consecutivamente
    } else {
      $_SESSION['last_session_request_count'] += 1;
    }
  } else {  $_SESSION['last_session_request_count'] = 1; }
} else { $_SESSION['last_session_request_count'] = 0; }
$_SESSION['last_session_request'] = time();
// =================================================================================================

error_reporting(E_ALL); // E_ALL = mostra todos erros | 0 = não mostra nenhum erro
date_default_timezone_set("America/Fortaleza"); // FUSO HORARIO
mb_internal_encoding('UTF-8'); // ENCODING
mb_http_output('UTF-8');// ENCODING
// =================================================================================================

//DATABASE
define('HOST', 'localhost');
define('DATABASE', 'smashsystem_com_br');
define('USER', 'smashsystem_com_br');
define('PASS', 'ss0123');

//DATABASE TESTE
define('HOST_TESTE', 'localhost');
define('DATABASE_TESTE', 'petadote');
define('USER_TESTE', 'root');
define('PASS_TESTE', 'root');
// =================================================================================================

//VARIAVEIS DE ACESSO GLOBAL
define('DOMINIO',(!empty($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].'/');
define('DIRETORIO_RAIZ', str_replace('\\', '/', __DIR__).'/');
define('DIRETORIO_CLASSES', DIRETORIO_RAIZ.'xcoreclass/');
define('DIRETORIO_MINHAS_CLASS', DIRETORIO_RAIZ.'xmyclass/');
define('DIRETORIO_ACAO', DIRETORIO_RAIZ.'zacao/');
define('DIRETORIO_PAGINA', DIRETORIO_RAIZ.'zpagina/');

define('DIRETORIO_IMG_PET', 'img/pet');
define('DIRETORIO_IMG_USUARIO', 'img/usuario');
// =================================================================================================

//TEMPO DA SESSAO ESPIRA EM 1800 = 30 MINUTOS
if (isset($_SESSION['time']) && (time()-$_SESSION['time'])>1800){
  session_unset(); session_destroy(); session_start(); session_regenerate_id(true);
  header("Location: ".DOMINIO);
}
$_SESSION['time'] = time();
// =================================================================================================

// METODOS DE IMPORTAR CLASSES DA PASTA XCORECLASS
function importcore($classe) {
  require_once DIRETORIO_CLASSES.$classe.".php";
}

// METODOS DE IMPORTAR CLASSES DA PASTA XMYCLASS
function import($classe) {
  require_once DIRETORIO_MINHAS_CLASS.$classe.".php";
}
// =================================================================================================

// OBJETO GERENCIADOR DAS URLS
importcore("URL");
$url = new URL();
require_once DIRETORIO_RAIZ.'rotas.php';

// OBJETO GERENCIADOR DE BANCO DE DADOS
importcore("CRUD");
$crud = new CRUD();

// OBJETO GERENCIADOR DE USUARIO
importcore("Usuario");
$usuario = new Usuario();

// =================================================================================================

// CHAMA O PROCESSO QUE SERÁ EXECUTADO PELO SITE
if ($url->acao()) { require_once $url->acao(); }

// SE ESSA ROTA NAO TIVER PAGINA, MATA A APLICACAO, USADO NAS REQUISIÇOES DE ANDROID STUDIO
if (!$url->pagina()) { exit; }
