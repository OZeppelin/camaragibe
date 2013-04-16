<?php
if(!session_id())
{
	
	@session_start();
	
}
error_reporting(E_ALL | E_STRICT);

//Definindo a localidade;
date_default_timezone_set( "America/Recife" );

//Setando o include_path;
	$raiz = $_SERVER['DOCUMENT_ROOT'] . "/camaragibe/cms/classes/";

$include_path  = ini_get('include_path'); 

//Incluindo a pasta raiz do projeto;
$ic_path = incluir($raiz,$include_path);
ini_set('include_path', $ic_path);

//Funçao para colocar no include path todos os diretórios do projeto;
function incluir($path,$include_path) 
{
	if (is_dir($path)) 
	{
		$dir 		= opendir($path);
		$caminho	= "";
		while ($arq = readdir($dir)) 
		{
		  if ($arq == "backup" || $arq == "." || $arq == ".." || $arq == ".cache" || $arq == ".settings" || $arq == "anti-bot") 
		  {
			continue;
		  }
		  if (is_dir($path . $arq)) 
		  {
			// ; no windows : no linux
			$include_path .= ":$path$arq" ;
			$include_path = incluir("$path$arq/",$include_path); 
		  }

		}
		return $include_path;
	}
}

//Função autoLoad;
function __autoload($nomeClasse) 
{

  require_once ($nomeClasse.".php");

}
?>
