<?php 
/**
 * Arquivo de declaração da classe notícia
 * @package classes
 * @subpackage models
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version  1.0
 * @since Jan/2011
 */
Class Aluno
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
	 
	private $estabelecimento;
	
	private $codigo;
	
	private $nome;
	
	private $tipo;
	
	private $responsavel;
	
	private $dtNasc;
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
	public function __construct($id = "", $usuario = "",$estabelecimento = "",$codigo = "", $nome = "", $tipo = "",$responsavel = "", $dtNasc = "", $dataCriacao = "")
	{
		$this->setId($id);
		$this->setUsuario($usuario);
		$this->setEstabelecimento($estabelecimento);
		$this->setCodigo($codigo);
		$this->setNome($nome);
		$this->setTipo($tipo);
		$this->setResponsavel($responsavel);
		$this->setDtNasc($dtNasc);
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
		FabricaDAO::getAlunoDAO()->inserir($this);
		
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
		
		return FabricaDAO::getAlunoDAO()->ultimoId();
		
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
		
		return FabricaDAO::getAlunoDAO()->contador($condicao, $parametros);
		
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
		
		return FabricaDAO::getAlunoDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}
	
	/**
	 * Método para excluir
	 *
	 * @access public
	 * @param int
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getAlunoDAO()->excluir($codigo);
		
	}
	
	/**
	 * Método para editar
	 *
	 * @access public
	 */
	public function editar()
	{
		FabricaDAO::getAlunoDAO()->editar($this);
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
			return FabricaDAO::getAlunoDAO()->buscar($idInst);
		
	}

	public static function verificaAluno($codigo)
	{
		if($codigo == "" || !is_numeric($codigo))
			return false;
		else
			return FabricaDAO::getAlunoDAO()->verificaAluno($codigo);
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
				$select[] = array($obj->getId() => $obj->getNome());	
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
	
	public function setEstabelecimento($estalecimento)
	{
		$this->estabelecimento = $estalecimento;
	}
	
	public function getEstabelecimento()
	{
		return $this->estabelecimento;
	}
	
	
	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}
	
	public function getCodigo()
	{
		return $this->codigo;
	}
	
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function setTipo($tipo)
	{
		$this->tipo = $tipo;
	}
	
	public function getTipo()
	{
		return $this->tipo;
	}
	
	public function setResponsavel($responsavel)
	{
		$this->responsavel = $responsavel;
	}
	
	public function getResponsavel()
	{
		return $this->responsavel;
	}
	
	public function setDtNasc($dtNasc)
	{
		$this->dtNasc = $dtNasc;
	}
	
	public function getDtNasc()
	{
		return $this->dtNasc;
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