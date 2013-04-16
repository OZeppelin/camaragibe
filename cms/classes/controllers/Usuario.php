<?php 
/**
 * Arquivo de declaração da classe Usuario.
 * @package classes
 * @subpackage models
 * @author Rafael Cardoso <rafuszero@gmail.com>
 * @version 1.0
 * @since Julho/2010
 */
Class Usuario
{
	
	/**
	 * Identificador do usuário
	 * 
	 * @access private
	 * @var int
	 */
	private $id;
   	
	/**
	 * Nome do usuário
	 * 
	 * @access private
	 * @var string
	 */
	private $nome;
	
	/**
	 * Email do usuário
	 * 
	 * @access private
	 * @var string
	 */
	private $email;
	
	/**
	 * Login do usuário
	 * 
	 * @access private
	 * @var string
	 */
	private $login;
	
	/**
	 * Senha do usuário
	 * 
	 * @access private
	 * @var Senha
	 */
	private $senha;
	
	/**
	 * tipo de usuario 
	 * 0 = Usuario 
	 * 1 = Master
	 * 2 = Professor
	 * 3 = Corretor
	 * 4 = Diagramador
	 *
	 * @access private
	 * @var int
	 */
	private $tipo;

	/**
	 * usuario ativo
	 *
	 * @access private
	 * @var int
	 */
	private $ativo;
	
	/**
	 * Data de cadastro do usuário
	 *
	 * @access private
	 * @var string
	 */
	private $dataCadastro;
	

	/**
	 * Método construtor da classe.
	 *
	 */
	public function __construct($id = "", $nome = "", $email = "", $login = "", $senha = null, $tipo = 0, $ativo = 1, $dataCadastro = "")
	{
		
		$this->setId($id);
		$this->setNome(str_replace("\\","",$nome));
		$this->setEmail($email);
		$this->setLogin($login);
		$this->setSenha($senha);
		$this->setTipo($tipo);		
		$this->setAtivo($ativo);
		$this->setDataCadastro($dataCadastro);		

	}
	
	/**
	 * Método que listará todos os usuários.
	 *
	 * Passará pela classe FabricaDAO que instanciará a classe UsuarioDAO e chamará o método de listagem.
	 *
	 * @access public
	 * @static
	 * @param string $campos Campos da consulta.
	 * @param string $condicao Condição da consulta
	 * @param string $order Ordenação da consulta
	 * @param int $limit Limit da consulta
	 * @param int $offset Offset da consulta
	 * @return array Retornará um array de objeto Usuario.
	 * @throws Excpetion
	 */
	public static function listar($condicao = "", $parametros = false, $order = "", $limit = "", $offset = "")
	{
		
		return FabricaDAO::getUsuarioDAO()->listar($condicao, $parametros, $order, $limit, $offset);
		
	}

	/**
	 * Método que irá retornar a quantidade de usuários.
	 * 
	 * Passa pela classe FabricaDAO que instancia a classe UsuarioDAO.
	 *
	 * @access public
	 * @static
	 * @return int
	 * @param string $condicao  Condição da instrução SQL
	 */
	public static function contador($condicao = "", $parametros = null)
	{
		
		return FabricaDAO::getUsuarioDAO()->contador($condicao, $parametros);
		
	}
	
	/**
	 * Método para inserir um objeto usuário no SGBD
	 *
	 * Passará pela classe FabricaDAO que instancia a classe UsuarioDAO.
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function inserir()
	{
		
		
		FabricaDAO::getUsuarioDAO()->inserir($this);


	}
	
	/**
	 * Método que irá editar um objeto usuário no SGBD
	 *
	 * Passará pela classe FabricaDAO que instanciará a classe UsuarioDAO e chamará o método de edição.
	 * 
	 * @see FabricaDAO
	 * @access public
	 */
	public function editar()
	{
	
		FabricaDAO::getUsuarioDAO()->editar($this);

	}
	
	/**
	 * Método que irá retornar o último id dos usuários.
	 * 
	 * Passará pela classe FabricaDAO que instanciará a classe UsuarioDAO e chamará o método do último Id.
	 * 
	 * @static 
	 * @access public
	 * @see FabricaDAO
	 * @return ultimoId
	 */
	public static function ultimoId()
	{
		
		return FabricaDAO::getUsuarioDAO()->ultimoId();
		
	}
	
	/**
	 * Método para rejeitar o usuário
	 *
	 * @access public
	 * @param int 
	 */
	public static function excluir($codigo)
	{
		
		FabricaDAO::getUsuarioDAO()->excluir($codigo);
		
	}	

	
	/**
	 * Método para buscar usuário
	 *
	 * @access public
	 * @param int 
	 * @return Usuario
	 */
	public static function buscar($idUser)
	{
		
		return FabricaDAO::getUsuarioDAO()->buscar($idUser);
		
	}
	
	
	/**
	 * Método para realizar o login o usuário 
	 *
	 * @access public
	 * @param int
	 * @param string 
	 * @return Usuario
	 */
	public static function login($login,$senha)
	{
		$senhaEncrypt = md5($senha);
		return FabricaDAO::getUsuarioDAO()->login( $login, $senhaEncrypt);
		
	}
	
	/**
	* Metodo para alterar permissão de usuario
	*
	* @param int $idUer
	* @param int $idTela
	* @param string $operacao
	* @return strng
	**/
	public static function mudaPermissao($idUser,$idTela,$operacao)
	{
		return FabricaDAO::getUsuarioDAO()->mudaPermissao($idUser,$idTela,$operacao);
	}
	
	
	/**
	 * Grid utilizada no Painel de Controle do CMS
	 * 
	 * @param int $qtd [Quantidade de registros]
	 * @return string
	**/
	public static function gridUltimasAcoes($qtd = 5)
	{
		$objUsu = FabricaDAO::getUsuarioDAO()->listarAcoes("", null, "log_datacriacao DESC", $qtd, 0);
		$retorno = "";
		if (sizeof($objUsu) > 0)
		{
			foreach($objUsu as $obj) 
			{
				$content[] = array('Nome' => $obj['nome'], 
								   'Ação' => $obj['acao'],
								   'Data' => Util::ajustarDataHora($obj['datacriacao']) 
								   );		
			}
			$retorno = HtmlHelper::show_grid_exibicao($content);
		}	
		return $retorno;
	}

	/**
	 * Define o valor de <var>$this->id</var>.
	 *
	 * @acess public
	 * @param string $id
	 */
	public function setId($id)
	{
	
		$this->id	= $id;
	
	}
		
	/**
	 * Retorna o valor de <var>$this->id</var>
	 * 
	 * @acess public
	 * @return $id
	 */
	public function getId()
	{
	
		return $this->id;
	
	}

	/**
	 * Define o valor de <var>$this->nome</var>.
	 *
	 * @acess public
	 * @param string $nome
	 */
	public function setNome($nome)
	{
	
		$this->nome	= $nome;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->nome</var>
	 * 
	 * @acess public
	 * @return $nome
	 */
	public function getNome()
	{
	
		return $this->nome;
	
	}

	/**
	 * Define o valor de <var>$this->email</var>.
	 *
	 * @acess public
	 * @param string $email
	 */
	public function setEmail($email)
	{
	
		$this->email	= $email;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->email</var>
	 * 
	 * @acess public
	 * @return $email
	 */
	public function getEmail()
	{
	
		return $this->email;
	
	}
		
	/**
	 * Define o valor de <var>$this->login</var>.
	 *
	 * @acess public
	 * @param string $login
	 */
	public function setLogin($login)
	{
	
		$this->login	= $login;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->login</var>
	 * 
	 * @acess public
	 * @return $login
	 */
	public function getLogin()
	{
	
		return $this->login;
	
	}
		
	/**
	 * Define o valor de <var>$this->senha</var>.
	 *
	 * @acess public
	 * @param string $senha
	 */
	public function setSenha($senha)
	{
	
		$this->senha	= $senha;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->senha</var>
	 * 
	 * @acess public
	 * @return $senha
	 */
	public function getSenha()
	{
	
		return $this->senha;
	
	}
		
	/**
	 * Define o valor de <var>$this->tipo</var>.
	 *
	 * @acess public
	 * @param int $tipo
	 */
	public function setTipo($tipo)
	{
	
		$this->tipo = $tipo;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->tipo</var>
	 * 
	 * @acess public
	 * @return $tipo
	 */
	public function getTipo()
	{
	
		return $this->tipo;
	
	}

	/**
	 * Define o valor de <var>$this->ativo</var>.
	 *
	 * @acess public
	 * @param int $ativo
	 */
	public function setAtivo($ativo)
	{
	
		$this->ativo = $ativo;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->ativo</var>
	 * 
	 * @acess public
	 * @return $ativo
	 */
	public function getAtivo()
	{
	
		return $this->ativo;
	
	}	
		
	/**
	 * Define o valor de <var>$this->dataCadastro</var>.
	 *
	 * @acess public
	 * @param string 
	 */
	public function setDataCadastro($dataCadastro)
	{
	
		$this->dataCadastro	= $dataCadastro;
	
	}
	
	/**
	 * Retorna o valor de <var>$this->dataCadastro</var>
	 * 
	 * @acess public
	 * @return $dataCadastro
	 */
	public function getDataCadastro()
	{
	
		return $this->dataCadastro;
	
	}
	
}
?>