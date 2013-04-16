<?php 
/**
 * Arquivo de declaração da classe Conexao.
 * 
 * Classe responsável pela instancia das classes controladoras do sistema usando o método singleton.
 * @package classes
 * @subpackage basicas
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0
 * @since Janeiro/2011
 */
Class Conexao
{
	
	/**
	 * Conexão
	 *
	 * @access private
	 * @var resource
	 */
	private $conexao;
	
	/**
	 * Instancia da conexão
	 *
	 * @static
	 * @access private
	 * @var resource
	 */
	private static $instancia;
	

	/**
	 * Método construtor da classe de conexão.
	 * 
	 * Conexão feita através do PHP Data Object (PDO).
	 * @access public
	 * @throws PDOException
	 */
	public function __construct()
	{
		
		try
		{
			$this->conexao	= new PDO('mysql:host=localhost;dbname=EstudantesCamaragibe', 'root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));	
				
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		}
		catch(PDOException $ex)
		{
			die($ex->getMessage());
		}
	
	}
	
	/**
	 * Método estático para instanciar a classe de conexão utilizando o padrão singleton.
	 *
	 * @access public
	 * @static
	 * @return PDO
	 */
	public static function getInstancia()
	{

		if(!isset(self::$instancia))
		{

			self::$instancia	= new Conexao();
			
		}
		return self::$instancia;
				
	}
	
	/**
	 * Retorna o valor de <var>$this->conexao</var>
	 *
	 * @access public
	 * @return $conexao
	 */
	public function getConexao()
	{
		
		return $this->conexao;
		
	}
	
	
}

?>