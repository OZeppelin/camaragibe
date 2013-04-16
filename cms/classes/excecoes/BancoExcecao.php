<?php
/**
 * Arquivo de declaração da classe BancoExcecao.
 * 
 * Classe responsável pelo Tratamento das exceções do Banco de dados
 * @package classes
 * @subpackage excecao
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0	
 * @since Janeiro/2011
 */
Class BancoExcecao extends Exception
{
	
	public function __construct($msg,$txtSql,$arquivo,$classe,$metodo,$linha)
	{
		
		parent::__construct("Ocorreu um erro ao executar a ação. Um e-mail foi enviado para o analista reponsável.");
		echo Util::trataErroDB($msg,$txtSql,$arquivo,$classe,$metodo,$linha);
		
	}

}

?>