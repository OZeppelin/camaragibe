<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = ""; $result = ""; $master = ""; $ativo = "";
$direct = "cms-user"; 
if(isset($_GET['t']))
{
	$ac = Acesso::check("cms-user");

	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{
				$tipo    = $_POST['rdbtipo'];
				$ativo   = ($_POST['rdbAtivo'] == "rdbAtivoSim") ? 1 : 0;
				$objUser = new Usuario(0, $_POST['nome'],$_POST['email'],$_POST['login'],md5($_POST['senha']), $tipo, $ativo);
				$objLog	= new LogCMS(0, $objUsuario, 'Inserir usuario', $_SESSION['sesIP']);
				try 
				{
					$objUser->inserir();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-user-inserir"; 
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-user-inserir";
					$retorno = $e->getMessage();
				}
			}
			else			
				$retorno = "Acesso Negado.";
		break;
		
		case 'editar':
			$tipo = $_POST['rdbTipo'];
			$ativo  = ($_POST['rdbAtivo'] == "rdbAtivoSim") ? 1 : 0;
			$senha  = ($_POST['senha'] != "") ? md5($_POST['senha']) : "";
			$objUser = new Usuario($_POST['id'], $_POST['nome'],$_POST['email'],"", $senha, $tipo, $ativo);
			$objLog	= new LogCMS(0, $objUsuario, 'Editar usuario',	$_SESSION['sesIP']);
			try 
			{
				$objUser->editar();
				$objLog->inserir();				
				$retorno = "Operação Realizada com Sucesso";
			}
			catch (BancoExcecao $ex)	
			{
				$direct = "cms-user-editar&id=".$_POST['id'];
				$retorno = $ex->getMessage();
			}
			catch (Exception $e)
			{
				$direct = "cms-user-editar&id=".$_POST['id'];
				$retorno = $e->getMessage();
			}
		break;
		
		case 'deletar':
			if ($ac->deletar())
			{
				$arrIds = (isset($_POST['id'])) ? $_POST['id']: array($_GET['id']);
				if(sizeof($arrIds) > 0)
				{
					foreach($arrIds as $id)
					{
						Usuario::excluir($id);	
						$objLog	= new LogCMS(0, $objUsuario, 'Excluir usuario',	$_SESSION['sesIP']);
						$objLog->inserir();
					}
				}
			}
			else
				$retorno = "Acesso Negado.";
		break;
		
		case 'permissao':
		
			$objLog	= new LogCMS(0, $objUsuario, 'Alterou permissão do usuario '.$_POST['user'], $_SESSION['sesIP']);
			$objLog->inserir();
			$return = Usuario::mudaPermissao($_POST['user'],$_POST['tela'],$_POST['ope']);
			
			if ($return == 1)		
				$retorno[] = array("id"=> 0,"mensagem" => iconv('ISO-8859-1', 'UTF-8',"publicar"));			
			else
				$retorno[] = array("id"=> 0,"mensagem" => iconv('ISO-8859-1', 'UTF-8',"despublicar"));
				
				
			$json = new Services_JSON();
			$result = $json->encode($retorno);	
			echo $result;
			
		break;
		
		case 'valida-login':
		
			$objUser = Usuario::listar("usu_login = :login",array(array("referencia" => ":login","valor" => $_POST['login'],"tipo" => "STR")));

			if (sizeof($objUser) > 0)		
				$retorno[] = array("id"=> 1,"mensagem" => iconv('ISO-8859-1', 'UTF-8',"- Escolha outro login, este já esta em uso."));			
			else
				$retorno[] = array("id"=> 0,"mensagem" => iconv('ISO-8859-1', 'UTF-8',""));
				
				
			$json = new Services_JSON();
			$result = $json->encode($retorno);	
			echo $result;
			
		break;
		
	}
}
//echo $retorno;
if($result == "") {
	//header("Location: ../?i=cms-user");
?>
	<script language= "JavaScript">
		location.href="../?i=<?php echo $direct;?>&msg=<?php echo $retorno; ?>";
	</script>
<?php
}
?>

