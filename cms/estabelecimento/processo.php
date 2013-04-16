<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-estabelecimento"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$ac = Acesso::check("cms-estabelecimento");
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{
				
				$objNO = new Estabelecimento(	0,
										$objUsuario,
										$_POST['titulo']
									);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Inserir Estabelecimento',	$_SESSION['sesIP']);
				try 
				{
					$objNO->inserir();			
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-estabelecimento-inserir"; 
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-estabelecimento-inserir";
					$retorno = $e->getMessage();
				}				
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{
				
				$objNO = new Estabelecimento(	$_POST['id'],
										$objUsuario,
										$_POST['titulo']
									);//print_r($objNO);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Estabelecimento',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-estabelecimento-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-estabelecimento-editar&id=".$_POST['id'];
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
						Estabelecimento::excluir($id);							
					}
				}
			}else
				$retorno = 'Acesso negado.';	
		break;
		
		case 'import':
			
				if( $_FILES['arquivo']['name'] != "" )
				{
					$filename = str_replace(" ","_",substr($_FILES['arquivo']['name'], 0, -4));
					$ext      = substr($_FILES['arquivo']['name'], -4);
					$size	  = $_FILES['arquivo']['size'];
					if($ext == ".txt"){
						$arquivo = $filename.$ext;
						
						//Abrir arquivo
						$ponteiro= fopen($_FILES['arquivo']['tmp_name'], "r");
						
						while(!feof($ponteiro)){
							$linha = fgets($ponteiro,$size);
							$texto = explode(";", $linha);
							$id	   = $texto[0];
							$nome  = @ucwords(Util::retiraAcentoCategoria(trim($texto[2])));
							
							if($nome != ""){
							
								$where = "id = '".$id."'";
								
								$objEst = Estabelecimento::listar($where,array());
								if(sizeof($objEst) > 0){
									continue;
								}else{
									$objNO = new Estabelecimento($id,$objUsuario,$nome);
									$objNO->importar();
								}
							}
							
						}
						
						//Fechar arquivo
						fclose($ponteiro);
						
						$objLog	= new LogCMS(0, $objUsuario, 'Importar Estabelecimento',	$_SESSION['sesIP']);
						$objLog->inserir();				
						$retorno = "Importação Realizada com Sucesso";
						$direct  = "cms-estabelecimento-importar";
						
					}else{
						$direct = "cms-estabelecimento-importar";
						$retorno = "Arquivo incompatível com a importação.";
					}
				}
		break;
		
	}
}
?>

<script language= "JavaScript">
	location.href="../?i=<?php echo $direct;?>&msg=<?php echo $retorno; ?>";
</script>