<?php
include_once("../includes/inicio.php");
include_once("../includes/verificaSessao.php");
$retorno = "";
$direct = "cms-vendas"; 
if(isset($_GET['t']))
{
	$objUsuario = new Usuario($_SESSION['sesCodigo']);
	$ac = Acesso::check("cms-vendas");
	$mes= date("Y-m");
	
	switch ($_GET['t']) 
	{
		case 'inserir':
			if ($ac->incluir())
			{
					$param = array();
				
					$qtdAluno = count($_POST['aluno']);
					if($qtdAluno > 0){
						for($i=0;$i<$qtdAluno;$i++){
							$wh    = "codigo = '".(int)$_POST['aluno'][$i]."'";	
							$objAluno = Aluno::listar($wh,$param,"","1");
							if(sizeof($objAluno) > 0){
								$where = "aluno = '".(int)$_POST['aluno'][$i]."' AND dtVenda like '%".$mes."%'";
								$objVendas = Vendas::listar($where,$param,"","1");
								if(sizeof($objVendas) > 0){ 
									foreach($objVendas as $v){
										echo utf8_decode("<script>alert('Aluno ".$v->getAluno()->getCodigo()." já efetuou a compra para este mês!')</script>");
									}
									$direct = "cms-vendas-inserir";//die();
									//$retorno= "Esta venda já foi efetuada!";
									$retorno = "Aluno(a) já efetuou a compra para este mês!";
									
									echo "<script language= 'JavaScript'>
										location.href='../?i=".$direct."&msg=".$retorno."';
									</script>";
									
									die();
									
								}else{
									if(!$_POST['aluno'][$i]){
										continue;
									}
									$objNO = new Vendas(	0,
															$objUsuario,
															$_POST['boleto'],
															(int)$_POST['aluno'][$i],
															$_POST['valor'],
															$_POST['valorPago']
														);
															  
									//$objNO->inserir();
									$objLog	= new LogCMS(0, $objUsuario, 'Inserir Vendas',	$_SESSION['sesIP']);
									try 
									{
										$objNO->inserir();			
										$objLog->inserir();				
										$retorno = "Operação Realizada com Sucesso";
									}
									catch (BancoExcecao $ex)	
									{
										$direct = "cms-vendas-inserir"; 
										$retorno = $ex->getMessage();
									}
									catch (Exception $e)
									{
										$direct = "cms-vendas-inserir";
										$retorno = $e->getMessage();
									}
							    }
							}else{
								echo utf8_decode("<script>alert('Aluno não cadastrado!')</script>");
								$direct = "cms-vendas-inserir";
							}
					}//For
				}
				
				
			}else
				$retorno = "Acesso negado.";
		break;
		
		case 'editar':
			if ($ac->editar())
			{
				
				$objNO = new Vendas(	$_POST['id'],
										$objUsuario,
										$_POST['boleto'],
										(int)$_POST['aluno'],
										$_POST['valor'],
										$_POST['valorPago']
									);//print_r($objNO);
										  
				$objLog	= new LogCMS(0, $objUsuario, 'Editar Vendas',	$_SESSION['sesIP']);
				try 
				{
					$objNO->editar();
					$objLog->inserir();				
					$retorno = "Operação Realizada com Sucesso";
				}
				catch (BancoExcecao $ex)	
				{
					$direct = "cms-vendas-editar&id=".$_POST['id'];
					$retorno = $ex->getMessage();
				}
				catch (Exception $e)
				{
					$direct = "cms-vendas-editar&id=".$_POST['id'];
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
						Vendas::excluir($id);							
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