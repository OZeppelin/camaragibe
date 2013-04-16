<?php
$inicio = microtime(true);

error_reporting(E_ALL & ~ E_NOTICE);
setlocale(LC_ALL, 'pt_BR', 'ptb', 'PT_BR.UTF8');
date_default_timezone_set('America/Recife');

/*if ($_SERVER['SERVER_NAME'] != "192.168.1.88")
	$raiz = $_SERVER['DOCUMENT_ROOT'] . "/criacao/boa_vista/novo/cms/classes/";
else*/	
	$raiz = $_SERVER['DOCUMENT_ROOT'] . "/gracaalbuquerque.com/";
	
$include_path  = ini_get('include_path'); 
incluir($raiz);
ini_set('include_path', $include_path);

session_start();

// Fun��es para facilitar a inclus�o de classes
function incluir($path) {
  global $include_path;

  if (is_dir($path)) {
    $dir = opendir($path);
    $caminho = "";
    while ($arq = readdir($dir)) {
      if ($arq == "." || $arq == ".." ||
          $arq == "images" || $arq == "css" || $arq == "docs") {
        continue;
      }
      if (is_dir($path . $arq)) {
        // ; no windows : no linux
        $include_path .= ";"."$path$arq" ;
        incluir("$path$arq/"); 
      }
    }
  }
}

function __autoload($nome) {
  require_once "$nome.php";
}

?>