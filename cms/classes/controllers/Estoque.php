<?php 
/**
 * Arquivo de declara��o da classe Estoque
 * @package classes
 * @subpackage models
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version  1.0
 * @since Fev/2013
 */
Class Estoque
{
	
	/**
	 * Identificador
	 * 
	 * @access private
	 * @var int
	 */
	private $id;
	
	private $usuario;
	
	/**
	 * Título
	 *
	 * @access private
	 * @var string
	 */
	 
	private $qtd;
	
	/**
	 * Data de Criação
	 *
	 * @access private
	 * @var string
	 */
	private $dataCriacao;	
	
	/**
	 * Método construtor da classe.
	 *
	 * @access public
	 */
	public function __construct($id = "", $usuario = "",$qtd = "", $periodo="", $dataCriacao = "")
	{
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setQtd($qtd);
		$this->setPeriodo($periodo);
		$this->setDataCriacao($dataCriacao);
	}
	
	/**
	 * Método que irá inserir um objeto Edicao no SGBD
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		FabricaDAO::getEstoqueDAO()->inserir($this);
		
	}
	
	/**
	 * Método que irá retornar o último id.
	 *
	 * @static 
	 * @access public
	 * @return ultimoId
	 */
	public static function ultimoId()
	{
		
		return FabricaDAO::getEstoqueDAO()->ultimoId();
		
	}
	
	/**
	 * Método que irá retornar a quantidade.
	 *
	 * @static 
	 * @access public
	 * @return int
	 */
	public static function contador($condicao = "", $parametros = null)
	{
		
		return FabricaDAO::getEstoqueDAO()->contador($condicao, $parametros);
		
	}
	
	public static function quantidade($condicao = "", $parametros = null)
	{
		
		return FabricaDAO::getEstoqueDAO()->quantidade($condicao, $parametros);
		
	}
	
	/**
	 * Método que irá retornar todos os objetos.
	 *
	 * @static 
	 * @access public
	 * @return Instituicao[]
	 */
	public static function listar($condicao = "", $parametros = array(), $order = "", $limit = "", $offset = "")
	{
		
		return FabricaDAO::getEstoqueDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getEstoqueDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getEstoqueDAO()->editar($this);
	}
	
	/**
	 * Método para buscar a edicao com o ID informado
	 *
	 * @access public
	 */
	public static function buscar($idInst)
	{
		if ($idInst == "" || !is_numeric($idInst))
			return false;
		else	
			return FabricaDAO::getEstoqueDAO()->buscar($idInst);
		
	}	
	
	#########################
	# Getters and Setters
	#########################
	
	/**
	 * Define o valor de <var>$this->id</var>
	 *
	 * @access public
	 * @param int
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
	
	
	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}
	
	public function getUsuario()
	{
		return $this->usuario;
	}
	/**
	 * Define o valor de <var>$this->numero</var>
	 *
	 * @access public
	 * @param string
	 */
	public function setQtd($qtd)
	{
	
		$this->qtd	= $qtd;
	
	}
	 
	public function getQtd()
	{
	
		return $this->qtd;
	
	}
	
	public function getPeriodo()
	{
		return $this->periodo;
	}
	
	public function setPeriodo($periodo)
	{
		$this->periodo = $periodo;
	}
	
	/**
	 * Define o valor de <var>$this->numero</var>
	 *
	 * @access public
	 * @param string
	 */
	public function setDataCriacao($dataCriacao)
	{
	
		$this->dataCriacao	= $dataCriacao;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->numero</var>
	 *
	 * @access public
	 * @return $numero
	 */
	public function getDataCriacao()
	{
	
		return $this->dataCriacao;
	
	}	
}

?>