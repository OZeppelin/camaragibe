<?php 
/**
 * Arquivo de declaração da classe NoticiaDAO (controlador da notícia).
 * @package classes
 * @subpackage controllers
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0
 * @since Jan/2011
 */
Class VendasDAO
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
		$txtSql		= "SELECT count(n.id) as quantidade FROM Vendas n
					   INNER JOIN cp_usuario u ON n.idUser = u.usu_id
					   INNER JOIN aluno a ON n.aluno = a.codigo 
					   WHERE n.excluir = 'N' ".$condicao."";//echo $txtSql."<br/>";
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
	public function inserir(Vendas $objNO)
	{
		
		$txtSql		= "INSERT INTO Vendas
								   (idUser,
								    boleto,
									aluno,
									valor,
									valorPago,
									dtCompra
									)
						VALUES     (:usuario,
									:boleto,
									:aluno,
									:valor,
									:valorPago,
									:dtCompra
									)";
		try
		{
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':boleto' 	 	, $objNO->getBoleto(), PDO::PARAM_STR);
			$sql->bindValue(':aluno' 	 	, $objNO->getAluno(), PDO::PARAM_STR);
			$sql->bindValue(':valor' 	 	, $objNO->getValor(), PDO::PARAM_STR);
			$sql->bindValue(':valorPago' 	, $objNO->getValorPago(), PDO::PARAM_STR);
			$sql->bindValue(':dtCompra' 	, date("Y-m-d"), PDO::PARAM_STR);
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
		
		$txtSql		= "SELECT max(id) as max FROM Vendas";
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
	public function listar($condicao = "", $parametros = array(), $group = "", $order = "", $limit = "", $offset = "")
	{

		$condicao	= Util::verificaCampo($condicao,"AND");
		$group		= Util::verificaCampo($group,"GROUP BY");
		$order		= Util::verificaCampo($order,"ORDER BY");
		$limit		= Util::verificaCampo($limit,"LIMIT");
		$offset		= Util::verificaCampo($offset,"OFFSET");

		$txtSql		= "SELECT  n.id,
							   n.idUser,
							   u.usu_nome,
							   n.boleto,
							   n.aluno,
							   a.nome,
							   n.valor,
							   n.valorPago,
							   n.dtCompra,
							   n.dtVenda
						FROM   Vendas n
						INNER JOIN cp_usuario u ON n.idUser = u.usu_id
						INNER JOIN aluno a ON n.aluno = a.codigo
						WHERE n.excluir = 'N' 
						".$condicao." ".$group." ".$order." ".$limit." ".$offset."";
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
				$objT			= new Aluno("","","",$reg['aluno'],$reg['nome']);
				$arrObjeto[]	= new Vendas( $reg['id'],
												$objUsuario,
												$reg['boleto'],
												$objT,
												$reg['valor'],
												$reg['valorPago'],
												$reg['dtCompra'],
												$reg['dtVenda']
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
		
		$txtSql	= "UPDATE Vendas SET excluir = 'S' WHERE id = :id";
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
						   n.boleto,
						   n.aluno,
						   a.nome,
						   n.valor,
						   n.valorPago,
						   n.dtCompra,
						   n.dtVenda
					FROM   Vendas n
					INNER JOIN cp_usuario u ON n.idUser = u.usu_id
					INNER JOIN aluno a ON n.aluno = a.codigo
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
			$objT			= new Aluno("","","",$resultado['aluno'],$resultado['nome']);
			$objNO			= new Vendas( $resultado['id'],
										$objUsuario,
										$resultado['boleto'],
										$objT,
										$resultado['valor'],
										$resultado['valorPago'],
										$resultado['dtCompra'],
										$resultado['dtVenda']
										);
			
			return $objNO;
		}
		else
		{
			throw new Exception("Nenhum registro encontrado.");			
		}
	}
	
	/**
	 * Método para editar a noticia;
	 *
	 * @access public
	 * @see Noticia
	 */
	public function editar(Vendas $objNO)
	{	
	
		$txtSql		= "UPDATE Vendas SET 
									idUser			= :usuario,
									boleto	 		= :boleto,
									aluno			= :aluno,
									valor			= :valor,
									valorPago		= :valorPago
					   where id  = :id";//echo $txtSql;exit;
					   
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindValue(':usuario' 	 	, $objNO->getUsuario()->getId(), PDO::PARAM_INT);
			$sql->bindValue(':boleto' 	 	, $objNO->getBoleto(), PDO::PARAM_STR);
			$sql->bindValue(':aluno' 	 	, $objNO->getAluno(), PDO::PARAM_STR);
			$sql->bindValue(':valor' 	 	, $objNO->getValor(), PDO::PARAM_STR);
			$sql->bindValue(':valorPago' 	, $objNO->getValorPago(), PDO::PARAM_STR);
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