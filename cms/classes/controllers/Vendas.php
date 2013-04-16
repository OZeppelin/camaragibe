<?php 
/**
 * Arquivo de declaração da classe notícia
 * @package classes
 * @subpackage models
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version  1.0
 * @since Jan/2011
 */
Class Vendas
{
	
	/**
	 * Identificador
	 * 
	 * @access private
	 * @var int
	 */
	private $id;
	private $usuario;
	private $boleto;
    private $aluno;
    private $valor;
    private $valorPago;
    private $dtCompra;
    private $dtVendas;	
	
	/**
	 * Método construtor da classe.
	 *
	 * @access public
	 */
	public function __construct($id = "", $usuario = "",$boleto = "",$aluno = "", $valor = "", $valorPago = "",$dtCompra="", $dtVendas = "")
	{
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setBoleto($boleto);
		$this->setAluno($aluno);
		$this->setValor($valor);
		$this->setValorPago($valorPago);
		$this->setDtCompra($dtCompra);
		$this->setDtVendas($dtVendas);
	}
	
	/**
	 * Método que irá inserir um objeto Edicao no SGBD
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		FabricaDAO::getVendasDAO()->inserir($this);
		
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
		
		return FabricaDAO::getVendasDAO()->ultimoId();
		
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
		
		return FabricaDAO::getVendasDAO()->contador($condicao, $parametros);
		
	}
	
	/**
	 * Método que irá retornar todos os objetos.
	 *
	 * @static 
	 * @access public
	 * @return Instituicao[]
	 */
	public static function listar($condicao = "", $parametros = array(), $group = "", $order = "", $limit = "", $offset = "")
	{
		
		return FabricaDAO::getVendasDAO()->listar($condicao, $parametros, $group, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getVendasDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getVendasDAO()->editar($this);
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
			return FabricaDAO::getVendasDAO()->buscar($idInst);
		
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
	public function setBoleto($boleto){
        $this->boleto = $boleto;
    }

    public function getBoleto(){
        return $this->boleto;
    }

    public function setAluno($aluno){
        $this->aluno = $aluno;
    }

    public function getAluno(){
        return $this->aluno;
    }

	public function setValor($valor){
        $this->valor = $valor;
    }

    public function getValor(){
        return $this->valor;
    }
    
    public function setValorPago($valorPago){
        $this->valorPago = $valorPago;
    }

    public function getValorPago(){
        return $this->valorPago;
    }

    public function setDtVendas($dtVendas){
        $this->dtVendas = $dtVendas;
    }

    public function getDtVendas(){
        return $this->dtVendas;
    }	
    
    public function setDtCompra($dtCompra)
    {
    	$this->dtCompra = $dtCompra;
    }
    
    public function getDtCompra()
    {
    	return $this->dtCompra;
    }
}

?>