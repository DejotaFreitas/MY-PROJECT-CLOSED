<?php
session_start();
error_reporting(0); // E_ALL = mostra todos erros | 0 = não mostra nenhum erro

// ========================================================================================
//VARIAVEIS DE ACESSO GLOBAL
define('DOMINIO',(!empty($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].'/');
define('DIRETORIO_RAIZ', str_replace('\\', '/', __DIR__).'/');
define('DIRETORIO_CORE', DIRETORIO_RAIZ.'base/');
define('DIRETORIO_CONFIG', DIRETORIO_RAIZ.'config/');
define('DIRETORIO_MODEL', DIRETORIO_RAIZ.'model/');
define('DIRETORIO_CONTROLLER', DIRETORIO_RAIZ.'controller/');
define('CONTEINER_WEB', 'webapp/');
define('DIRETORIO_WEB', DIRETORIO_RAIZ.CONTEINER_WEB);

// ========================================================================================
require_once DIRETORIO_CONFIG.'antiddos.php';
require_once DIRETORIO_CONFIG.'session_timeout.php';
require_once DIRETORIO_CONFIG.'timezone_encoding.php';
require_once DIRETORIO_CONFIG.'db.php';

// ========================================================================================
// METODOS DE IMPORTAR CLASSES DA BASE
function importcore($classe) {
  require_once DIRETORIO_CORE.$classe.".php";
}

// METODOS DE IMPORTAR CLASSES DA MODEL
function import($classe) {
  require_once DIRETORIO_MODEL.$classe.".php";
}

// ========================================================================================
// CLASSE QUE CONTROLA A SESSAO DE USUARIO
import("SessaoUsuario");

// OBJETO BANCO DE DADOS
importcore("CRUD");

// ========================================================================================
// OBJETO GERENCIADOR DAS URLS E ROTAS
importcore("URL");
URL::init_routes();
// IMPORTAR AS ROTAS E PAGINAS
require_once DIRETORIO_RAIZ.'rotas/rotas.php';
require_once DIRETORIO_RAIZ.'rotas/rotaspaginas.php';
URL::atualizar_rotas_pagina();

// ========================================================================================
// CHAMA O PROCESSO QUE SERÁ EXECUTADO PELO SITE NA ROTA ATUAL
if (URL::acao() !== false) { require_once URL::acao(); }

// SE ESSA ROTA NAO TIVER PAGINA, MATA A APLICACAO, USADO NAS REQUISIÇOES DE ANDROID STUDIO
if (URL::pagina() === false ) { exit; }
