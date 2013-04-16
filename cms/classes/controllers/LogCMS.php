<?php
/**
 * Classe básica dos logs.
 * @author Rafael Cardoso Tavares <rafuszero@gmail.com>
 * @package classes
 * @subpackage basicas
 * @version 1.0
 * @since Março/2008
 */
Class LogCMS
{
	
	/**
	 * Identificador do log
	 *
	 * @access private
	 * @var int
	 */
	private $id;
	
	/**
	 * Objeto Usuário
	 *
	 * @var Usuario
	 */
	private $usuario;
	
	
	/**
	 * Ação do log
	 *
	 * @access private
	 * @var string
	 */
	private $acao;
	
	/**
	 * Ip do usuário
	 *
	 * @access private
	 * @var int
	 */
	private $ip;
	
	/**
	 * Data do log
	 *
	 * @access private
	 * @var timestamp
	 */
	private $data;
	
	/**
	 * Método construtor da classe.
	 *
	 * @param int $id
	 * @param Usuario $usuario
	 * @param string $acao	
	 * @param string $ip
	 * @param string $descricao
	 * @param timestamp $data
	 */
	public function __construct($id = 0, $usuario = null , $acao = "", $ip = "", $data = "")
	{
		
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setAcao($acao);
		$this->setIp($ip);
		$this->setData($data);
		
	}
	
	/**
	 * Método que irá inserir um objeto log no SGBD
	 *
	 * Passará pela classe Fabrica que instanciará a classe LogDAOPGSQL e chamará o método de inserção.
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		
		FabricaDAO::getLogCMSDAO()->inserir($this);
		
	}

	/**
	 * Define o valor de <var>$this->id</var>
	 * 
	 * @access public
	 * @param int $id
	 */
	public function setId($id)
	{
	
		$this->id	= $id;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->id</var>
	 *
	 * @access public
	 * @return $id
	 */
	public function getId()
	{
	
		return $this->id;
	
	}
		
	/**
	 * Define o valor de <var>$this->usuario</var>
	 * 
	 * @access public
	 * @param int $usuario
	 */
	public function setUsuario(Usuario $usuario)
	{
	
		$this->usuario	= $usuario;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->usuario</var>
	 *
	 * @access public
	 * @return $usuario
	 */
	public function getUsuario()
	{
	
		return $this->usuario;
	
	}
		
	/**
	 * Define o valor de <var>$this->acao</var>
	 * 
	 * @access public
	 * @param Acao $acao
	 */
	public function setAcao($acao)
	{
	
		$this->acao	= $acao;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->acao</var>
	 *
	 * @access public
	 * @return $acao
	 */
	public function getAcao()
	{
	
		return $this->acao;
	
	}
		
	/**
	 * Define o valor de <var>$this->ip</var>
	 * 
	 * @access public
	 * @param int $ip
	 */
	public function setIp($ip)
	{
	
		$this->ip	= $ip;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->ip</var>
	 *
	 * @access public
	 * @return $ip
	 */
	public function getIp()
	{
	
		return $this->ip;
	
	}

	/**
	 * Define o valor de <var>$this->data</var>
	 * 
	 * @access public
	 * @param timestamp $data
	 */
	public function setData($data)
	{
	
		$this->data	= $data;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->data</var>
	 *
	 * @access public
	 * @return $data
	 */
	public function getData()
	{
	
		return $this->data;
	
	}		
	
}
?>