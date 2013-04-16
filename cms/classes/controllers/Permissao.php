<?php
/**
 * Classe de Permissões de usuários do sistema.
 * @package classes
 * @subpackage models
 * @author Rafael Cardoso <rafuszero@gmail.com>
 * @version 1.0
 * @since Março/2008
 */
Class Permissao
{
	/**
	 * Permissões do perfil
	 * 
	 * @access private
	 * @var int
	 */
	private $permissao;
	
	
	/**
	 * Construtor da classe permissao.
	 * 
	 * @access public
	 * @param Permissao $permissao
	 */
	public function __construct($permissao = '')
	{
		
		$this->setPermissao($permissao);
		
	}

	/**
	 * Método para carregar permissoes.
	 *
	 * Passará pela classe Fabrica que instanciará a classe PermissaoDAO e chamará o método de carregar as permissões.
	 * @access
	 * @param string $idUser
	 * @return Permissao
	 * @see FabricaDAO
	 * @throws Exception
	 */
	public static function permissaoUsuario($idUser)
	{
		
		return FabricaDAO::getPermissaoDAO()->permissaoUsuario($idUser);
		
	}
	
	/**
	 * Método para carregar permissoes.
	 *
	 * Passará pela classe Fabrica que instanciará a classe PermissaoDAO e chamará o método de carregar as permissões.
	 * @access
	 * @param int $idUser
	 * @return Permissao
	 * @see FabricaDAO
	 * @throws Exception
	 */
	public static function permissaoTelaUsuario($idUser)
	{
		
		return FabricaDAO::getPermissaoDAO()->permissaoTelaUsuario($idUser);
		
	}	
	
	
	/**
	 * Método para carregar permissoes de uma tela especifica.
	 *
	 * Passará pela classe Fabrica que instanciará a classe PermissaoDAO e chamará o método de carregar as permissões.
	 * @access
 	 * @param string $tela_path
	 * @param int $idUser
	 * @return Permissao
	 * @see FabricaDAO
	 * @throws Exception
	 */
	public static function permissaoTela($tela_path, $idUser)
	{
		return FabricaDAO::getPermissaoDAO()->permissaoTela($tela_path, $idUser);
	}
	
	/**
	* Monta a grid das permissões do usuario
	*
	* @param int $idUser
	* @return string $html
	**/
	public static function grid($idUser = "")
	{
		$html = "<label>Permiss&otilde;es</label>";
		$html .= "<table class=\"tablesorter\">
			        <thead>
						<tr>
							<th width=\"420\">
								<span><em>Descri&ccedil;&atilde;o</em></span>
									</th>
									<th class=\"center\">
										<span><em>Consultar</em></span>
									</th>
									<th class=\"center\">
										<span><em>Alterar</em></span>
									</th>
									<th class=\"center\">
										<span><em>Incluir</em></span>
									</th>
									<th class=\"center\">
										<span><em>Excluir</em></span>
									</th>
								</tr>
							</thead>
							<tbody>";
							
		$arrPerm = self::permissaoTelaUsuario($idUser);	
		foreach($arrPerm->getPermissao() as $perm)
		{
			$consultar = ($perm['consultar']) ? "publicar" : "despublicar";
			$alterar   = ($perm['alterar']) ? "publicar" : "despublicar";
			$incluir   = ($perm['incluir']) ? "publicar" : "despublicar";
			$excluir   = ($perm['excluir']) ? "publicar" : "despublicar";
			
			$html .= "<tr>
							<td>
								".$perm['descricao']."
							</td>
							<td>
								<a href=\"javascript:alteraPermissao('consultar',".$perm['tel_id'].",".$idUser.");\" class=\"".$consultar."\" id=\"consultar".$perm['tel_id']."\">&nbsp;</a>
							</td>
							<td>
								<a href=\"javascript:alteraPermissao('alterar',".$perm['tel_id'].",".$idUser.");\" class=\"".$alterar."\" id=\"alterar".$perm['tel_id']."\">&nbsp;</a>
							</td>
							<td>
								<a href=\"javascript:alteraPermissao('incluir',".$perm['tel_id'].",".$idUser.");\" class=\"".$incluir."\" id=\"incluir".$perm['tel_id']."\">&nbsp;</a>
							</td>
							<td>
								<a href=\"javascript:alteraPermissao('excluir',".$perm['tel_id'].",".$idUser.");\" class=\"".$excluir."\" id=\"excluir".$perm['tel_id']."\">&nbsp;</a>
							</td>
						</tr>";							
		}
		
		$html .= "</table>";
		return $html;
	}
	
	################################################
	#											   #	
	#             GETTERS AND SETTERS			   #	
	#											   #	
	################################################
	/**
	 * Setando o Permissao.
	 *
	 * @access public
	 * @param int $permissao
	 */
	public function setPermissao($permissao)
	{
	
		$this->permissao	= $permissao;
	
	}
	
	/**
	 * Recuperando o valor das permissoes
	 *
	 * @access public
	 * @return int
	 */
	public function getPermissao()
	{
	
		return $this->permissao;
	
	}


}
?>