<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-estoque"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$ac = Acesso::check("cms-estoque");
	$dtIni = Util::dataParaBanco($_POST['dtIni']);
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{
				
				$objNO = new Estoque(	0,
										$objUsuario,
										$_POST['qtd'],
										$_POST['periodo'],
										$dtIni
									);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Inserir Estoque',	$_SESSION['sesIP']);
				try 
				{
					$objNO->inserir();			
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-estoque-inserir"; 
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-estoque-inserir";
					$retorno = $e->getMessage();
				}				
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{
				
				$objNO = new Estoque(	$_POST['id'],
										$objUsuario,
										$_POST['qtd'],
										$_POST['periodo'],
										$dtIni
									);//print_r($objNO);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Estoque',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-estoque-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-estoque-editar&id=".$_POST['id'];
					$retorno = $e->getMessage();
				}
			}else	
				$retorno = "Acesso negado.";
		break;
		
		case 'deletar':
			if ($ac->deletar())
			{
				$arrIds = (isset($_POST['id'])) ? $_POST['id']: array($_GET['id']);
				if(sizeof($arrIds) > 0)
				{
					foreach($arrIds as $id)
					{
						Estoque::excluir($id);							
					}
				}
			}else
				$retorno = 'Acesso negado.';	
		break;
		
	}
}
?>

<script language= "JavaScript">
	location.href="../?i=<?php echo $direct;?>&msg=<?php echo $retorno; ?>";
</script>