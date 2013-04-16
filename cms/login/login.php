<?php
include_once("../includes/inicio.php");
$msg = "";
if( isset( $_POST['tipo'] ) )
{
	try
	{
	
		$objUsuario	= Usuario::login($_POST['usuario'],$_POST['senha']);
		
	}
	catch(Exception $ex)
	{
	
		$msg = $ex->getMessage();
	
	}
	catch (BancoExcecao $ex2)
	{
		$msg = Util::mensagemRetorno("erro","ERRO ! <br /><br />")." ".$ex->getMessage();			
	}
	
	if($msg == "")
	{
		try
		{
			$objPermissao = Permissao::permissaoUsuario($objUsuario->getId());

			foreach ($objPermissao->getPermissao() as $permissoes) 
			{
			
				$_SESSION['sesAcesso'][]	= $permissoes;
					
			}
			
			$_SESSION['sesLogin']			= $objUsuario->getLogin();
			$_SESSION['sesNome']			= $objUsuario->getNome();
			$_SESSION['sesCodigo']			= $objUsuario->getId();
			$_SESSION['sesTipo']			= $objUsuario->getTipo();
			$_SESSION['sesIP']				= $_SERVER['REMOTE_ADDR'];
			$_SESSION['sesStatusLogin']		= 'logado';
			
			$objLog	= new LogCMS(0, $objUsuario, 'Efetuou login', $_SESSION['sesIP']);
			$objLog->inserir();
		
			// cookie - lembrar nome de usuario
			if ( isset($_POST['lembrar']) ){
				
				setcookie('lembrar', $objUsuario->getEmail() ,time() + 3600 * 24 * 5);//quatro dias

			}else{
				setcookie('lembrar', '', time() -3600);//expira
			}
			
			header("Location: ../index.php");
			exit;
			
		}
		catch(Exception $ex)
		{
			$msg = "Usuário sem permissões de acesso";
		}	
		
	}
	header("Location: ../login.php?msg=".$msg);
}
else 
{
	echo "Dados Inválidos!";
}
?>
