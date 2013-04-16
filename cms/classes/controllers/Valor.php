<?php
/**
 * Valor declaration file.
 * @author <author>
 */

/**
 * Class Valor.
 */
class Valor {
	/**
	 * id of Valor
	 * @var <type>
	 */
	private $id;

	/**
	 * usuario of Valor
	 * @var <type>
	 */
	private $usuario;

	/**
	 * valor of Valor
	 * @var <type>
	 */
	private $valor;

	/**
	 * dtCadas of Valor
	 * @var <type>
	 */
	private $dtCadas;


	/**
	 * Constructor of Valor.
	 * @param <type> $id
	 * @param <type> $usuario
	 * @param <type> $valor
	 * @param <type> $dtCadas
	 */
	public function __construct($id="", $usuario="", $valor="", $dtCadas="") {
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setValor($valor);
		$this->setDtCadas($dtCadas);
	}
	
	/**
	 * Método que irá inserir um objeto Edicao no SGBD
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		FabricaDAO::getValorDAO()->inserir($this);
		
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
		
		return FabricaDAO::getValorDAO()->ultimoId();
		
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
		
		return FabricaDAO::getValorDAO()->contador($condicao, $parametros);
		
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
		
		return FabricaDAO::getValorDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getValorDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getValorDAO()->editar($this);
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
			return FabricaDAO::getValorDAO()->buscar($idInst);
		
	}
	
	
	/**
	 * Getter method of id
	 * @return <type>
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 * Setter method of id
	 * @param <type> $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	/**
	 * Getter method of usuario
	 * @return <type>
	 */
	public function getUsuario() {
		return $this->usuario;
	}
	/**
	 * Setter method of usuario
	 * @param <type> $usuario
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	/**
	 * Getter method of valor
	 * @return <type>
	 */
	public function getValor() {
		return $this->valor;
	}
	/**
	 * Setter method of valor
	 * @param <type> $valor
	 */
	public function setValor($valor) {
		$this->valor = $valor;
	}
	/**
	 * Getter method of dtCadas
	 * @return <type>
	 */
	public function getDtCadas() {
		return $this->dtCadas;
	}
	/**
	 * Setter method of dtCadas
	 * @param <type> $dtCadas
	 */
	public function setDtCadas($dtCadas) {
		$this->dtCadas = $dtCadas;
	}
}
?>