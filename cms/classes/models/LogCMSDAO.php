<?php
/**
 * Classe controladora do log
 *
 * @author Rafael Cardoso Tavares <rafuszero@gmail.com>
 * @package classes
 * @subpackage dados
 * @version 1.0
 * @since Março/2008
 */
Class LogCMSDAO
{
	
	/**
	 * Conexao
	 *
	 * @access private
	 * @var PDO
	 */
	private $conexao;
	
	/**
	 * Método construtor da classe
	 *
	 */
	public function __construct()
	{
		
		$this->conexao	= Conexao::getInstancia();
		
	}
	
	/**
	 * Método que irá inserir o log no SGBD
	 *
	 * @access public
	 * @see Log
	 */
	public function inserir(LogCMS $objLog)
	{
		
		$txtSql	= "INSERT INTO cp_log
						(usu_id,
						 log_acao,
						 log_ip)
					VALUES     (:usu_id,
								:acao,
								:ip)";
								
		$user = $objLog->getUsuario()->getId();
		$acao = $objLog->getAcao();
		$ip   = $objLog->getIp();
		try
		{
			
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindParam(":usu_id", $user, PDO::PARAM_INT);
			$sql->bindParam(":acao", $acao, PDO::PARAM_STR);
			$sql->bindParam(":ip", $ip, PDO::PARAM_STR);
			$sql->execute();
			
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$sql->closeCursor();
		
	}
	
}
?>
