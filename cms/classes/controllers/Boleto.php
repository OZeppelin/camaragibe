<?php 
/**
 * Arquivo de declaração da classe notícia
 * @package classes
 * @subpackage models
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version  1.0
 * @since Jan/2011
 */
Class Boleto
{
	
	/**
	 * Identificador
	 * 
	 * @access private
	 * @var int
	 */
	private $id;
	
	/**
	 * Título
	 *
	 * @access private
	 * @var string
	 */
	 
	private $boleto;
	
	private $valor;
	
	private $dtPagamento;
	
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
	public function __construct($id = "", $boleto = "",$valor = "",$dtPagamento = "", $dataCriacao = "")
	{
		$this->setId($id);
		$this->setBoleto($boleto);
		$this->setValor($valor);
		$this->setDtPagamento($dtPagamento);
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
		FabricaDAO::getBoletoDAO()->inserir($this);
		
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
		
		return FabricaDAO::getBoletoDAO()->ultimoId();
		
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
		
		return FabricaDAO::getBoletoDAO()->contador($condicao, $parametros);
		
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
		
		return FabricaDAO::getBoletoDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getBoletoDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getBoletoDAO()->editar($this);
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
			return FabricaDAO::getBoletoDAO()->buscar($idInst);
		
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
				$select[] = array($obj->getId() => $obj->getBoleto());	
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
	
	
	public function setBoleto($boleto){
        $this->boleto = $boleto;
    }

    public function getBoleto(){
        return $this->boleto;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setDtPagamento($dtPagamento){
        $this->dtPagamento = $dtPagamento;
    }

    public function getDtPagamento(){
        return $this->dtPagamento;
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