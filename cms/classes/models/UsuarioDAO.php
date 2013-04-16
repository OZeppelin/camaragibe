<?php 
/**
 * Arquivo de declaração da classe UsuarioDAOPGSQL (controlador do usuário).
 * @package classes
 * @subpackage controllers
 * @author Rafael Cardoso Tavares <rafuszero@gmail.com>
 * @version 1.0
 * @since Março/2008
 */
Class UsuarioDAO
{
	
	/**
	 * Atributo que recebe a conexao com o DB.
	 *
	 * @access private
	 * @var resource
	 */
	private $conexao;
	
	/**
	 * Método construtor da classe.
	 * 
	 * Método que usará o padrão singleton para instanciar a conexão.
	 * 
	 * @acess public
	 * @see Conexao
	 */
	public function __construct()
	{
		
		$this->conexao	= Conexao::getInstancia();
		
	}		
	
	/**
	 * Método para retornar a quantidade de usuarios, conforme condição informada.
	 *
     * @access public
     * @see Usuario
	 */
	public function contador($condicao, $parametros)
	{
		
		$condicao	= Util::verificaCampo($condicao,"WHERE");
		
		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT count(usu_id) as quantidade FROM cp_usuario ".$condicao."";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			if (sizeof($parametros) > 0)
			{
				foreach ($parametros as $params)
				{
					switch ($params['tipo']) 
					{
						case "STR": 
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_STR);
							break;
						case "INT":
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_INT);
							break;
					}	
				}
				
			}			
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$result	= $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();		
		return $result['quantidade'];
		
	}
	
	/**
	 * Método para inserir os Usuários
	 *
     * @access public
     * @see Usuario
	 */
	public function inserir(Usuario $objUsuario)
	{
		
		$txtSql		= "INSERT INTO cp_usuario
								   (usu_nome,
									usu_login,
									usu_email,
									usu_senha,
									usu_tipo,
									usu_ativo)
						VALUES     (:nome,
									:login,
									:email,
									:senha,
									:tipo,
									:ativo)";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			
			$sql->bindValue(':nome'	 , $objUsuario->getNome(), PDO::PARAM_STR);
			$sql->bindValue(':login' , $objUsuario->getLogin(), PDO::PARAM_STR);
			$sql->bindValue(':email' , $objUsuario->getEmail(), PDO::PARAM_STR);
			$sql->bindValue(':senha' , $objUsuario->getSenha(), PDO::PARAM_STR);			
			$sql->bindValue(':tipo', $objUsuario->getTipo(), PDO::PARAM_INT);			
			$sql->bindValue(':ativo' , $objUsuario->getAtivo(), PDO::PARAM_INT);			
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$sql->closeCursor();
	}

	/**
	 * Método para retornar o ultimo id os usuários
	 *
     * @access public
     * @see Usuario
	 */
	public function ultimoId()
	{
		
		$txtSql		= "SELECT max(usu_id) as max FROM cp_usuario";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$result	= $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		return $result['max'];
		
	}
	
	/**
	 * Método para listar os objetos Usuarios.
	 *
     * @access public
     * @see Usuario
	 */
	public function listar($condicao = "", $parametros = array(), $order = "", $limit = "", $offset = "")
	{

		$condicao	= Util::verificaCampo($condicao,"AND");
		$order		= Util::verificaCampo($order,"ORDER BY");
		$limit		= Util::verificaCampo($limit,"LIMIT");
		$offset		= Util::verificaCampo($offset,"OFFSET");

		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT  usu_id, 
							   usu_nome, 
						       usu_login, 
						       usu_email,
							   usu_tipo,
							   usu_ativo
						FROM   cp_usuario WHERE usu_excluido = 'N' ".$condicao." ".$order." ".$limit." ".$offset."";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			
			if (sizeof($parametros) > 0){
				
				foreach ($parametros as $params)
				{
					switch ($params['tipo']) 
					{
						case "STR": 
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_STR);
							break;
						case "INT":
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_INT);
							break;
					}	
				}
				
			}
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		
		/**
		 * Variavel que vai receber a matriz com o recordset equivalente ao mysql_fetch_array
		 * 
		 * @var recordset
		 */
		$resultado	= $sql->fetchAll();
		$sql->closeCursor();		
		if( count($resultado) > 0 )
		{
			foreach ($resultado as $reg)
			{
				
				$arrObjeto[]	= new Usuario(  $reg['usu_id'],
												$reg['usu_nome'],
												$reg['usu_email'],
												$reg['usu_login'],
												"",
												$reg['usu_tipo'],
												$reg['usu_ativo']
											);
			}	
			return $arrObjeto;
		}
		else
		{
			return null;
		}
		
	}
	
	/**
	 * Método para listar os objetos Usuarios.
	 *
     * @access public
     * @see array
	 */
	public function listarAcoes($condicao = "", $parametros = array(), $order = "", $limit = "", $offset = "")
	{

		$condicao	= Util::verificaCampo($condicao,"AND");
		$order		= Util::verificaCampo($order,"ORDER BY");
		$limit		= Util::verificaCampo($limit,"LIMIT");
		$offset		= Util::verificaCampo($offset,"OFFSET");

		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT  u.usu_id, 
							   usu_nome,
							   log_acao,
							   log_datacriacao	
						FROM   cp_usuario u 
						INNER JOIN cp_log l ON u.usu_id = l.usu_id 
						WHERE usu_excluido = 'N' ".$condicao." ".$order." ".$limit." ".$offset."";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			
			if (sizeof($parametros) > 0){
				
				foreach ($parametros as $params)
				{
					switch ($params['tipo']) 
					{
						case "STR": 
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_STR);
							break;
						case "INT":
							$sql->bindValue($params['referencia'], $params['valor'], PDO::PARAM_INT);
							break;
					}	
				}
				
			}
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		
		/**
		 * Variavel que vai receber a matriz com o recordset equivalente ao mysql_fetch_array
		 * 
		 * @var recordset
		 */
		$resultado	= $sql->fetchAll();
		$sql->closeCursor();		
		if( count($resultado) > 0 )
		{
			foreach ($resultado as $reg)
			{
				
				$arrObjeto[]	= array( "id" => $reg['usu_id'],
										 "nome" => $reg['usu_nome'],
										 "acao" => $reg['log_acao'],
										 "datacriacao" => $reg['log_datacriacao']
										);
			}	
			return $arrObjeto;
		}
		else
		{
			return null;
		}
		
	}	
	
	
	/**
	 * Método que valida o login do usuário
	 *
	 * @param string $login
	 * @param string $senha
	 * @return Usuario
	 */
	public function login($login,$senha)
	{

		$retorno = array();
		$txtSql	= "SELECT u.usu_id,
						  u.usu_login,
						  u.usu_email,
						  u.usu_nome,
						  u.usu_tipo,
						  u.usu_ativo,
						  u.usu_datacriacao
					FROM  cp_usuario u      
					WHERE usu_ativo = 1 
					AND	usu_excluido = 'N'				
					AND usu_login = :login 
					AND usu_senha = :senha";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":login", $login, PDO::PARAM_STR);
			$sql->bindValue(":senha",$senha, PDO::PARAM_STR);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$resultado	= $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if($resultado)
		{
			foreach ($resultado as $reg)
			{
				$objUsuario = new Usuario(  $reg['usu_id'],
											$reg['usu_nome'],
											$reg['usu_email'],
											$reg['usu_login'],
											"",
											$reg['usu_tipo'],
											$reg['usu_ativo'],
											$reg['usu_datacriacao']);
				return $objUsuario;
			}	
		}
		else
		{
			throw new Exception("Login incorreto");
		}
		return $retorno;
		
	}
	
	/**
	 * Método para exclusão dos usuários
	 *
     * @access public
     * @see Usuario
	 */	
	public function excluir($codigo)
	{
		
		 # $txtSql	= "DELETE FROM cp_usuario WHERE usu_id = :usu_id";
	    $txtSql	= "UPDATE cp_usuario set usu_excluido = 'S' WHERE usu_id = :usu_id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":usu_id", $codigo, PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}	
		$sql->closeCursor();
	}	
	
	/**
	 * Método para buscar o usuário;
	 *
	 * @access public
	 * @see Usuario
	 */
	public function buscar($idUser)
	{
		$txtSql	= "SELECT  usu_id,
						   usu_nome,
						   usu_login,
						   usu_email,
						   usu_tipo,
						   usu_ativo,
						   usu_datacriacao
				   FROM   cp_usuario
					WHERE  usu_id = :usu_id
					AND usu_excluido = 'N'";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":usu_id", $idUser, PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$resultado	= $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if($resultado)
		{
			$objUsuario	= new Usuario(  $resultado['usu_id'],
										$resultado['usu_nome'],
										$resultado['usu_email'],
										$resultado['usu_login'],
										"",
										$resultado['usu_tipo'],
										$resultado['usu_ativo'],
										$resultado['usu_datacriacao']);
			return $objUsuario;
		}
		else
		{
			throw new Exception("Nenhum usuário encontrado");			
		}
	}
	
	public function editar(Usuario $objUsuario)
	{
		$txtSqlSenha = "";
		if($objUsuario->getSenha() != "")
			$txtSqlSenha = ",usu_senha = :senha";

		$txtSql		= "UPDATE cp_usuario SET 
					   usu_nome 	 		 = :nome,
					   usu_email 	 		 = :email,
					   usu_tipo			     = :tipo,
					   usu_ativo 			 = :ativo
					   ".$txtSqlSenha."
					   where usu_id  	 	 = :id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":nome",  $objUsuario->getNome(), PDO::PARAM_STR);
			$sql->bindValue(":email", $objUsuario->getEmail(), PDO::PARAM_STR);
			if($txtSqlSenha != "")
				$sql->bindValue(":senha", $objUsuario->getSenha(), PDO::PARAM_STR);
			$sql->bindValue(":tipo", $objUsuario->getTipo(), PDO::PARAM_INT);
			$sql->bindValue(":ativo", $objUsuario->getAtivo(), PDO::PARAM_INT);
			$sql->bindValue(":id", $objUsuario->getId(), PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$sql->closeCursor();
	}
	
	
	/**
	* Metodo para alterar permissão de usuario
	*
	* @param int $idUer
	* @param int $idTela
	* @param string $operacao
	* @return int $status
	**/
	public function mudaPermissao($idUser,$idTela,$operacao)
	{
		$txtSql = "SELECT consultar,
						   incluir,
						   alterar,
						   excluir
					FROM   cp_permissao
					WHERE  usu_id = :user
						   AND tel_id = :tela";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":user",$idUser, PDO::PARAM_INT);
			$sql->bindValue(":tela", $idTela, PDO::PARAM_INT);
			$sql->execute();
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}	
		$resultado	= $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		$perm   = ""; $status = "";
		switch($operacao)
		{
			case "consultar":
			case "incluir":
			case "alterar":
			case "excluir":
				$perm = $operacao;
			break;
			default: $perm = false;
		}
		if ($perm)
		{
			if ($resultado)
			{
				$status = ($resultado[$perm] == 1) ? 0: 1;
				$txtSql = "UPDATE cp_permissao set ".$perm." = :ope where usu_id = :usu_id AND tel_id = :tel_id";
				try
				{
			
					$sql	= $this->conexao->getConexao()->prepare($txtSql);
					$sql->bindValue(":usu_id", $idUser, PDO::PARAM_INT);
					$sql->bindValue(":tel_id", $idTela, PDO::PARAM_INT);
					$sql->bindValue(":ope", $status, PDO::PARAM_INT);
					$sql->execute();
				}
				catch(PDOException $ex)
				{
					throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
				}				
				
			}
			else
			{
				$status = 1;
				$txtSql = "INSERT INTO cp_permissao
										(usu_id,
										 tel_id,
										 ".$perm.")
							VALUES      (:usu_id,
										 :tel_id,
										 :ope)  ";	
				try
				{
			
					$sql	= $this->conexao->getConexao()->prepare($txtSql);
					$sql->bindValue(":usu_id", $idUser, PDO::PARAM_INT);
					$sql->bindValue(":tel_id", $idTela, PDO::PARAM_INT);
					$sql->bindValue(":ope", $status, PDO::PARAM_INT);
					$sql->execute();
				}
				catch(PDOException $ex)
				{
					throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
				}	
			}
			return $status;
		}	
	}
}
?>