<?php 
/**
 * Arquivo de declaração da classe NoticiaDAO (controlador da notícia).
 * @package classes
 * @subpackage controllers
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0
 * @since Jan/2011
 */
Class AlunoDAO
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
     * @see Edicao
	 */
	public function contador($condicao, $parametros)
	{
		
		$condicao	= Util::verificaCampo($condicao,"AND");
		
		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT count(n.id) as quantidade FROM aluno n
					   INNER JOIN cp_usuario u ON n.idUser = u.usu_id
						INNER JOIN estabelecimentos e ON n.estabelecimento = e.id
						INNER JOIN tipoestudante t ON n.tipo = t.id 
						WHERE n.excluir = 'N' ".$condicao."";
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
	 * Método para inserir notícia
	 *
     * @access public
     * @see Noticia
	 */
	public function inserir(Aluno $objNO)
	{
		
		$txtSql		= "INSERT INTO aluno
								   (idUser,
								    estabelecimento,
									codigo,
									nome,
									tipo,
									responsavel,
									dtNasc
									)
						VALUES     (:usuario,
									:estabelecimento,
									:codigo,
									:nome,
									:tipo,
									:responsavel,
									:dtNasc
									)";
		try
		{
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':estabelecimento', $objNO->getEstabelecimento()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':codigo' 	 	, $objNO->getCodigo(), PDO::PARAM_STR);
			$sql->bindValue(':nome' 	 	, $objNO->getNome(), PDO::PARAM_STR);
			$sql->bindValue(':tipo' 	 	, $objNO->getTipo()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':responsavel' 	, $objNO->getResponsavel(), PDO::PARAM_STR);
			$sql->bindValue(':dtNasc' 	 	, $objNO->getDtNasc(), PDO::PARAM_STR);
			$sql->execute();
		}
		catch(PDOException $ex)
		{
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
		}
		$sql->closeCursor();
	}
	
	

	/**
	 * Método para retornar o ultimo id
	 *
     * @access public
     * @see Noticia
	 */
	public function ultimoId()
	{
		
		$txtSql		= "SELECT max(id) as max FROM aluno";
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
	 * Método para listar os objetos Noticia.
	 *
     * @access public
     * @see Noticia
	 */
	public function listar($condicao = "", $parametros = array(), $order = "", $limit = "", $offset = "")
	{

		$condicao	= Util::verificaCampo($condicao,"AND");
		$order		= Util::verificaCampo($order,"ORDER BY");
		$limit		= Util::verificaCampo($limit,"LIMIT");
		$offset		= Util::verificaCampo($offset,"OFFSET");

		$txtSql		= "SELECT  n.id,
							   n.idUser,
							   u.usu_nome,
							   n.estabelecimento,
							   e.razaosocial,
							   n.codigo,
							   n.nome,
							   n.tipo,
							   t.descricao,
							   n.responsavel,
							   n.dtNasc,
							   n.dtCadas
						FROM   aluno n
						INNER JOIN cp_usuario u ON n.idUser = u.usu_id
						INNER JOIN estabelecimentos e ON n.estabelecimento = e.id
						INNER JOIN tipoestudante t ON n.tipo = t.id
						WHERE n.excluir = 'N' 
						".$condicao." ".$order." ".$limit." ".$offset."";
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
		$resultado	= $sql->fetchAll();
		$sql->closeCursor();		
		if( count($resultado) > 0 )
		{
			foreach ($resultado as $reg)
			{
				$objUsuario		= new Usuario($reg['idUser'],$reg['usu_nome']);
				$objEstab		= new Estabelecimento($reg['estabelecimento'],$objUsuario,$reg['razaosocial']);
				$objT			= new TipoEstudante($reg['tipo'],"",$reg['descricao']);
				$arrObjeto[]	= new Aluno( $reg['id'],
												$objUsuario,
												$objEstab,
												$reg['codigo'],
												$reg['nome'],
												$objT,
												$reg['responsavel'],
												$reg['dtNasc'],
												$reg['dtCadas']
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
	 * Método para exclusão das noticias
	 *
     * @access public
     * @see Noticia
	 */	
	public function excluir($codigo)
	{
		
		$txtSql	= "UPDATE aluno SET excluir = 'S' WHERE id = :id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":id", $codigo, PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}	
		$sql->closeCursor();
	}	
	
	/**
	 * Método para buscar o noticia;
	 *
	 * @access public
	 * @see Noticia
	 */
	public function buscar($codigo)
	{
		$txtSql	= "SELECT  n.id,
						   n.idUser,
						   u.usu_nome,
						   n.estabelecimento,
						   e.razaosocial,
						   n.codigo,
						   n.nome,
						   n.tipo,
						   t.descricao,
						   n.responsavel,
						   n.dtNasc,
						   n.dtCadas
					FROM   aluno n
					INNER JOIN cp_usuario u ON n.idUser = u.usu_id
					INNER JOIN estabelecimentos e ON n.estabelecimento = e.id
					INNER JOIN tipoestudante t ON n.tipo = t.id
					WHERE n.id = :id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":id", $codigo, PDO::PARAM_INT);
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
			
			$objUsuario		= new Usuario($resultado['idUser'],$resultado['usu_nome']);
			$objEstab		= new Estabelecimento($resultado['estabelecimento'],$objUsuario,$resultado['razaosocial']);
			$objT			= new TipoEstudante($resultado['tipo'],"",$resultado['descricao']);
			$objNO			= new Aluno( $resultado['id'],
										$objUsuario,
										$objEstab,
										$resultado['codigo'],
										$resultado['nome'],
										$objT,
										$resultado['responsavel'],
										$resultado['dtNasc'],
										$resultado['dtCadas']
										);
			return $objNO;
		}
		else
		{
			throw new Exception("Nenhum registro encontrado.");			
		}
	}
	
	public function verificaAluno($codigo)
	{
		$txtSql	= "SELECT  n.id,
						   n.idUser,
						   u.usu_nome,
						   n.estabelecimento,
						   e.razaosocial,
						   n.codigo,
						   n.nome,
						   n.tipo,
						   t.descricao,
						   n.responsavel,
						   n.dtNasc,
						   n.dtCadas
					FROM   aluno n
					INNER JOIN cp_usuario u ON n.idUser = u.usu_id
					INNER JOIN estabelecimentos e ON n.estabelecimento = e.id
					INNER JOIN tipoestudante t ON n.tipo = t.id
					WHERE n.codigo = :id AND
					n.excluir = 'N'";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(":id", $codigo, PDO::PARAM_INT);
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
			
			/*$objUsuario		= new Usuario($resutado['idUser'],$resutado['usu_nome']);
			$objEstab		= new Estabelecimento($resutado['estabelecimento'],$objUsuario,$resutado['estab']);
			$objT			= new TipoEstudante($resutado['tipo'],"",$resutado['descricao']);
			$objNO			= new Aluno( $resutado['id'],
										$objUsuario,
										$objEstab,
										$resutado['codigo'],
										$resutado['nome'],
										$objT,
										$resutado['responsavel'],
										$resutado['dtNasc'],
										$resutado['dtCadas']
										);*/
			return "Aluno já cadastrado!";
		}
	}
	
	/**
	 * Método para editar a noticia;
	 *
	 * @access public
	 * @see Noticia
	 */
	public function editar(Aluno $objNO)
	{	
	
		$txtSql		= "UPDATE aluno SET 
									idUser			= :usuario,
									estabelecimento	= :estabelecimento,
									codigo			= :codigo,
									nome			= :nome,
									tipo			= :tipo,
									responsavel		= :responsavel,
									dtNasc			= :dtNasc
					   where id  = :id";//echo $txtSql;exit;
					   
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':estabelecimento', $objNO->getEstabelecimento()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':codigo' 	 	, $objNO->getCodigo(), PDO::PARAM_STR);
			$sql->bindValue(':nome' 	 	, $objNO->getNome(), PDO::PARAM_STR);
			$sql->bindValue(':tipo' 	 	, $objNO->getTipo()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':responsavel' 	, $objNO->getResponsavel(), PDO::PARAM_STR);
			$sql->bindValue(':dtNasc' 	 	, $objNO->getDtNasc(), PDO::PARAM_STR);
			$sql->bindValue(":id"	  		, $objNO->getId(), PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
		}
		$sql->closeCursor();
	}
}

?>