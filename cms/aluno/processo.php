<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-aluno"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$codigo		= (int)$_POST['codigo'];
	$ac = Acesso::check("cms-aluno");
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			
			if ($ac->incluir())
			{
				$confere = Aluno::verificaAluno($_POST['codigo']);
				if($confere){
					$direct = "cms-aluno-inserir";
					$retorno= $confere;
				}else{
					if($_POST['estabelecimento'] != ""){
						//Verifica o ID do Estabelecimento.
						$whEstabelecimento = "n.razaosocial = '".$_POST['estabelecimento']."'";
						$objEstabelecimento= Estabelecimento::listar($whEstabelecimento,array());
						if(sizeof($objEstabelecimento) > 0){
							foreach($objEstabelecimento as $est){
								$idEstabelecimento = $est->getId();
							}
						}else{
							//Caso não tenha cadastro, efetua o cadastro.
							$objEst= new Estabelecimento(0,$objUsuario,$_POST['estabelecimento']);
							$objEst->inserir();
							$idEstabelecimento = Estabelecimento::ultimoId();
						}
					}else{
						$direct = "cms-aluno-inserir";
						$retorno= "Você não informou o estabelecimento.";
					}
					
					$objEst= new Estabelecimento($idEstabelecimento);
					$objCat= new TipoEstudante($_POST['tipo']);
					$objNO = new Aluno(	0,
											$objUsuario,
											$objEst,
											$codigo,
											$_POST['nome'],	
											$objCat,
											$_POST['responsavel'],
											Util::dataParaBanco($_POST['dtNasc'])								
										);
											  
					$objLog	= new LogCMS(0, $objUsuario, 'Inserir Aluno',	$_SESSION['sesIP']);
					try 
					{
						$objNO->inserir();			
						$objLog->inserir();				
						$retorno = "Operação Realizada com Sucesso";
					}
					catch (BancoExcecao $ex)	
					{
						$direct = "cms-aluno-inserir"; 
						$retorno = $ex->getMessage();
					}
					catch (Exception $e)
					{
						$direct = "cms-aluno-inserir";
						$retorno = $e->getMessage();
					}	
				}
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{
				$objEst= new Estabelecimento($_POST['estabelecimento']);
				$objCat= new TipoEstudante($_POST['tipo']);
				$objNO = new Aluno(	$_POST['id'],
										$objUsuario,
										$objEst,
										$codigo,
										$_POST['nome'],
										$objCat,
										$_POST['responsavel'],									
										Util::dataParaBanco($_POST['dtNasc'])
									);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Aluno',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-aluno-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-aluno-editar&id=".$_POST['id'];
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
						Aluno::excluir($id);							
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
							$escola= $texto[0];
							$cod   = trim($texto[1]);
							$nome  = @ucwords(Util::retiraAcentoCategoria(trim($texto[2])));
							$dtNasc= Util::dataParaBanco($texto[3]);
							$resp  = @ucwords(Util::retiraAcentoCategoria(trim($texto[4])));
							$tipo  = 1;
							
							if(($nome != "" && strlen($nome) >= 4) || ($cod != "")){
								$where = "nome = '".$nome."' OR codigo = '".$cod."'";
								
								$objEst = Aluno::listar($where,array());
								if(sizeof($objEst) > 0){
									continue;
								}else{
									$objEscola = new Estabelecimento($escola);
									$objTipo   = new TipoEstudante($tipo);
									$objNO 	   = new Aluno(0,$objUsuario,$objEscola,$cod,$nome,$objTipo,$resp,$dtNasc);
									$objNO->inserir();
								}
							}
							
						}
						
						//Fechar arquivo
						fclose($ponteiro);
						
						$objLog	= new LogCMS(0, $objUsuario, 'Importar Aluno',	$_SESSION['sesIP']);
						$objLog->inserir();				
						$retorno = "Importação Realizada com Sucesso";
						$direct  = "cms-aluno";
						
					}else{
						$direct = "cms-aluno-importar";
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