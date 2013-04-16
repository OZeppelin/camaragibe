<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-tipo-estudante"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$ac = Acesso::check("cms-tipo-estudante");
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{
				
				$objNO = new TipoEstudante(	0,
										$objUsuario,
										$_POST['titulo']
									);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Inserir Tipo de Estudante',	$_SESSION['sesIP']);
				try 
				{
					$objNO->inserir();			
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-tipo-estudante-inserir"; 
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-tipo-estudante-inserir";
					$retorno = $e->getMessage();
				}				
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{
				
				$objNO = new TipoEstudante(	$_POST['id'],
										$objUsuario,
										$_POST['titulo']
									);//print_r($objNO);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Tipo de Estudante',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-tipo-estudante-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-tipo-estudante-editar&id=".$_POST['id'];
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
						TipoEstudante::excluir($id);							
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