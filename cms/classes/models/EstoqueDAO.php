<?php 
/**
 * Arquivo de declara��o da classe EstoqueDAO (controlador da estoque).
 * @package classes
 * @subpackage controllers
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0
 * @since Fev/2013
 */
Class estoqueDAO
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
		
		$condicao	= Util::verificaCampo($condicao,"WHERE");
		
		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT count(id) as quantidade FROM estoque n ".$condicao."";
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
	
	
	public function quantidade($condicao, $parametros)
	{
		
		$condicao	= Util::verificaCampo($condicao,"WHERE");
		
		/**
		 * Variavel que vai receber a instrução SQL
		 * 
		 * @var string $txtSql
		 */
		$txtSql		= "SELECT qtd as quantidades FROM estoque n ".$condicao."";//echo $txtSql."<br/>";
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
		$resulta	= $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();		
		return $resulta['quantidades'];
		
	}
	
	/**
	 * Método para inserir notícia
	 *
     * @access public
     * @see Noticia
	 */
	public function inserir(estoque $objNO)
	{
		
		$txtSql		= "INSERT INTO estoque
								   (idUser,
								    qtd,
								    periodo,
									data
									)
						VALUES     (:usuario,
									:qtd,
									:periodo,
									:data
									)";
		try
		{
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':qtd'	 	 	, $objNO->getQtd(), PDO::PARAM_INT);
			$sql->bindValue(':periodo'	 	, $objNO->getPeriodo(), PDO::PARAM_STR);
			$sql->bindValue(':data' 	 	, $objNO->getDataCriacao(), PDO::PARAM_STR);
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
		
		$txtSql		= "SELECT max(id) as max FROM estoque";
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

		$condicao	= Util::verificaCampo($condicao,"WHERE");
		$order		= Util::verificaCampo($order,"ORDER BY");
		$limit		= Util::verificaCampo($limit,"LIMIT");
		$offset		= Util::verificaCampo($offset,"OFFSET");

		$txtSql		= "SELECT  n.id,
							   n.idUser,
							   u.usu_nome,
							   n.qtd,
							   n.periodo,
							   n.data
						FROM   estoque n
						INNER JOIN cp_usuario u ON n.idUser = u.usu_id
						".$condicao." ".$order." ".$limit." ".$offset."";//echo $txtSql;
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
				$arrObjeto[]	= new Estoque( $reg['id'],
												$objUsuario,
												$reg['qtd'],
												$reg['periodo'],
												$reg['data']
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
		
		$txtSql	= "DELETE FROM estoque WHERE id = :id";
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
						   n.qtd,
						   n.periodo,
						   n.data
					FROM   estoque n
					INNER JOIN cp_usuario u ON n.idUser = u.usu_id
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
			$objUsu = new Usuario($resultado['idUser'],$resultado['usu_nome']);
			$objNO	= new Estoque( 	$resultado['id'],						  	
									$objUsu,
									$resultado['qtd'],
									$resultado['periodo'],
									$resultado['data']
							    );
			return $objNO;
		}
		else
		{
			throw new Exception("Nenhum registro encontrado");			
		}
	}
	
	/**
	 * Método para editar a noticia;
	 *
	 * @access public
	 * @see Noticia
	 */
	public function editar(estoque $objNO)
	{	
	
		$txtSql		= "UPDATE estoque SET 
									idUser			= :usuario,
									qtd		 		= :tipo,
									periodo			= :periodo,
									data			= :titulo
					   where id  = :id";//echo $txtSql;exit;
					   
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':tipo' 	 	, $objNO->getQtd(), PDO::PARAM_INT);
			$sql->bindValue(':periodo' 	 	, $objNO->getPeriodo(), PDO::PARAM_STR);
			$sql->bindValue(':titulo' 	 	, $objNO->getDataCriacao(), PDO::PARAM_STR);
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