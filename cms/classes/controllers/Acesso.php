<?php
/**
 * Final Class Acesso com todas as permissões de acesso dos arquivos.
 * @package classes
 * @subpackage basicas
 * @author Rafael Cardoso <rafuszero@gmail.com>
 * @final Acesso
 * @version 1.0
 * @since Março/2008
 */
Class Acesso
{

	private $acesso_editar;
	
	private $acesso_consultar;
	
	private $acesso_incluir;
	
	private $acesso_deletar;	
	
	public function __construct($consultar = 0, $deletar = 0, $editar = 0, $incluir = 0)
	{
		$this->acesso_consultar = $consultar;
		$this->acesso_deletar   = $deletar;
		$this->acesso_editar    = $editar;
		$this->acesso_incluir   = $incluir;
	
	}
	
	/**
	* Path principal da Tela
	*
	**/
	public static function check($tela)
	{
		# Verifica se é usuário master (acesso total)
		if ($_SESSION['sesTipo'] == 1)
		{
			return new Acesso(1, 1, 1, 1);
		}
		else
		{
			$arrPerm = Permissao::permissaoTela($tela, $_SESSION['sesCodigo']);
			return new Acesso($arrPerm['consultar'],$arrPerm['excluir'],$arrPerm['editar'],$arrPerm['incluir']);
		}	
	}
	
	public function consultar()
	{
		return $this->acesso_consultar;
	}

	public function incluir()
	{
		return $this->acesso_incluir;
	}

	public function deletar()
	{
		return $this->acesso_deletar;
	}
	
	public function editar()
	{
		return $this->acesso_editar;
	}
	
}
?>
