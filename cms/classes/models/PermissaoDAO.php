<?php 
/**
 * Arquivo de declaração da classe PermissaoDAO
 * @package classes
 * @subpackage controllers
 * @author Rafael Cardoso <rafuszero@gmail.com> 
 * @version 1.0
 * @since Março/2008
 */
Class PermissaoDAO
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
	 * Método para carregar as permissões
	 *
	 * @access public
	 * @return Permissao
	 * @see Permissao
	 */
	public function permissaoUsuario($idUser)
	{
		
		$txtSql	= "SELECT  pr.tel_id
					FROM   cp_usuario u,
						   cp_permissao pr
					WHERE  u.usu_id = pr.usu_id
							AND u.usu_id = :usu_id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindParam(":usu_id", $idUser, PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$resultado	= $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if( count($resultado) > 0 )
		{
			$arrPermissoes = array();
			foreach($resultado as $reg)
			{
			
				$arrPermissoes[] = $reg['tel_id'];
			
			}
			$objPermissao	= new Permissao($arrPermissoes);
			return $objPermissao;
			
		}
		else
		{
			
			throw new Exception("Nenhuma permissão encontrada");
			
		}
		
		
	}

	
	public function permissaoTela($tela_path, $idUser)
	{
		$arrPerm = array();
		
		$txtSql = "SELECT incluir,
						  alterar,
						  excluir,
						  consultar
					FROM  cp_permissao p,
						  cp_tela t
					WHERE  t.tel_id = p.tel_id
					AND t.tel_path = :tela
					AND p.usu_id = :usu_id";
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindParam(":usu_id", $idUser, PDO::PARAM_INT);
			$sql->bindParam(":tela", $tela_path, PDO::PARAM_STR);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$resultado	= $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if( count($resultado) > 0 )
		{
			foreach($resultado as $reg)
			{
			
				$arrPerm['consultar'] = $reg['consultar'];
				$arrPerm['incluir']   = $reg['incluir'];
				$arrPerm['editar']    = $reg['alterar'];
				$arrPerm['excluir']   = $reg['excluir'];
			
			}
		}
		else
		{
			$arrPerm['consultar'] = 0;
			$arrPerm['incluir']   = 0;
			$arrPerm['editar']    = 0;
			$arrPerm['excluir']   = 0;
		}			
		return $arrPerm;
	}
	
	public function permissaoTelaUsuario($idUser)
	{
		if ($idUser != "")
		{
			$txtSql = "SELECT  p.tel_id,
							   tel_descricao,
							   tel_path,
							   incluir,
							   alterar,
							   excluir,
							   consultar
						FROM   cp_permissao p
							   INNER JOIN cp_usuario u
								 ON u.usu_id = p.usu_id
							   INNER JOIN cp_tela t
								 ON t.tel_id = p.tel_id
						WHERE  u.usu_id = :id
						UNION
						SELECT t.tel_id,
							   tel_descricao,
							   tel_path,
							   0 AS incluir,
							   0 AS alterar,
							   0 AS excluir,
							   0 AS consultar
						FROM   cp_tela t
						WHERE  t.tel_id NOT IN (SELECT tel_id
												FROM   cp_permissao
												WHERE  usu_id = :id)
						ORDER BY tel_descricao";
		}
		else
		{
			$txtSql = "SELECT t.tel_id,
							   tel_descricao,
							   tel_path,
							   0 AS incluir,
							   0 AS alterar,
							   0 AS excluir,
							   0 AS consultar
						FROM   cp_tela t
						ORDER BY tel_descricao";
		}				
		
		try
		{
		
			$sql	= $this->conexao->getConexao()->prepare($txtSql);
			$sql->bindParam(":id", $idUser, PDO::PARAM_INT);
			$sql->execute();
				
		}
		catch(PDOException $ex)
		{
			
			throw new BancoExcecao($ex->getMessage(),$txtSql,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
		}
		$resultado	= $sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if( count($resultado) > 0 )
		{
			$arrPermissoes = array();
			foreach($resultado as $reg)
			{
				$arrPermissoes[$reg['tel_id']]['tel_id'] 	= $reg['tel_id'];
				$arrPermissoes[$reg['tel_id']]['path']      = $reg['tel_path'];
				$arrPermissoes[$reg['tel_id']]['descricao'] = $reg['tel_descricao'];
				$arrPermissoes[$reg['tel_id']]['incluir']   = $reg['incluir'];				
				$arrPermissoes[$reg['tel_id']]['alterar']   = $reg['alterar'];
				$arrPermissoes[$reg['tel_id']]['excluir']   = $reg['excluir'];
				$arrPermissoes[$reg['tel_id']]['consultar'] = $reg['consultar'];
			}
			$objPermissao	= new Permissao($arrPermissoes);
			return $objPermissao;
		}
		else
		{
			throw new Exception("Nenhuma permiss�o encontrada");
		}
	}	
}

?>