<?php 
/**
 * Arquivo de declaração da classe notícia
 * @package classes
 * @subpackage models
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version  1.0
 * @since Jan/2011
 */
Class TipoEstudante
{
	
	/**
	 * Identificador
	 * 
	 * @access private
	 * @var int
	 */
	private $id;
	
	private $usuario;
	
	private $titulo;
	
	
	/**
	 * Método construtor da classe.
	 *
	 * @access public
	 */
	public function __construct($id = "", $usuario = "",$titulo = "")
	{
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setTitulo($titulo);
	}
	
	/**
	 * Método que irá inserir um objeto Edicao no SGBD
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		FabricaDAO::getTipoEstudanteDAO()->inserir($this);
		
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
		
		return FabricaDAO::getTipoEstudanteDAO()->ultimoId();
		
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
		
		return FabricaDAO::getTipoEstudanteDAO()->contador($condicao, $parametros);
		
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
		
		return FabricaDAO::getTipoEstudanteDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getTipoEstudanteDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getTipoEstudanteDAO()->editar($this);
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
			return FabricaDAO::getTipoEstudanteDAO()->buscar($idInst);
		
	}	
	
	/**
	* Método para montar array no formato aceito pelo HtmlHelper
	*
	* @static
	* @return string[]
	*
	**/
	public static function arraySelect()
	{
		$objNo = self::listar("",array(),"");
		$select = array();
		if (!is_null($objNo))
		{
			foreach($objNo as $obj)
			{
				$select[] = array($obj->getId() => $obj->getTitulo());	
			}
		}	
		return $select; 
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
	
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
	}
	
	public function getTitulo()
	{
		return $this->titulo;
	}
	
}

?>