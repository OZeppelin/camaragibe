<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-relatorio"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$ac = Acesso::check("cms-relatorio");
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{			
				$objNO = new Relatorio(	0,
										$objUsuario,
										$_POST['titulo'],
										$_POST['objetivo'],
										$_POST['texto']
									);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Inserir Relatório',	$_SESSION['sesIP']);
				try 
				{
					$objNO->inserir();			
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-relatorio-inserir"; 
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-relatorio-inserir";
					$retorno = $e->getMessage();
				}				
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{			
				$objNO = new Relatorio($_POST['id'],
										$objUsuario,
										$_POST['titulo'],
										$_POST['objetivo'],
										$_POST['texto']
									);//print_r($objNO);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Relatório',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-relatorio-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-relatorio-editar&id=".$_POST['id'];
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
						Relatorio::excluir($id);							
					}
				}
			}else
				$retorno = 'Acesso negado.';	
		break;
		
	}
	//Util::geraVideo();
}
//echo $retorno;
//header("Location: ../?i=cms-noticia");
?>

<script language= "JavaScript">
	location.href="../?i=<?php echo $direct;?>&msg=<?php echo $retorno; ?>";
</script>