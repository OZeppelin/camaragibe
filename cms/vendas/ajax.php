<?php
	
	require $_SERVER['DOCUMENT_ROOT']."/camaragibe/cms/includes/inicio.php";
	
	$aluno = (isset($_POST['aluno'])) ? $_POST['aluno'] : "";
	$mes   = (isset($_POST['mes'])) ? $_POST['mes'] : "";
	$par   = (isset($_POST['par'])) ? $_POST['par'] : "";
	$boleto= (isset($_POST['boleto'])) ? $_POST['boleto'] : "";
	
	if($par == ""){
		$wh    = "codigo = '".(int)$aluno."'";
		$param = array();
		$retorno = "";
		
		$objAluno = Aluno::listar($wh,$param,"","1");
		if(sizeof($objAluno) > 0){
			
			foreach($objAluno as $alu){ 
				echo "Código: ".$alu->getCodigo()."<br/>
							Nome: ".$alu->getNome()."<br/>
							Dt. Nasc: ".Util::ajustarData($alu->getDtNasc())."<br/>
							Responsável: ".$alu->getResponsavel()."<br/>";
			}
			
			//Verifico se já realizou uma compra para o mês.
			$where = "aluno = '".(int)$aluno."' AND dtVenda like '%".$mes."%'";
			$objVendas = Vendas::listar($where,$param);
			if(sizeof($objVendas) > 0){
				foreach($objVendas as $vendas){
					$retorno = "<font color='#FF0000' id='erroAluno'>Aluno já efetuou a compra para este mês!</font><br/>Última Compra:<font color='#FF0000' id='erroAluno'>".Util::ajustarDataHora($vendas->getDtVendas())."</font>";
				}
			}
			
		}else{
			$retorno = "<font color='#FF0000' id='erroAluno'>Aluno não cadastrado!</font>";
		}
	
		echo $retorno;
	}
	
	if($par != "" && $boleto != ""){
		
		$valorBoleto = (int)substr($boleto, 4,11);
		$inteiro  = substr($valorBoleto, 0,-2);
		$decimal  = substr($valorBoleto, -2);
		$valorB	  = $inteiro.".".$decimal;
		
		$objValor = Valor::listar("",array(),"dtCadas desc","1");
		foreach($objValor as $objV){
			$valor = $objV->getValor();
		}
		
		$qtdAlunos = round($valorB / $valor);
		echo HtmlHelper::input_hidden('qtdAlunos', $qtdAlunos);
		
		for($i=0;$i<$qtdAlunos;$i++){
			echo HtmlHelper::input_text_for('Carteira / CPF', 'aluno[]','aluno'.$i.'', false, 180, array('onchange'=>'verificaAluno'.$i.'();','onkeydown'=>'Mascara(this,Integer)','onkeypress'=>'Mascara(this,Integer)','onkeyup'=>'Mascara(this,Integer)'))."<br/><br/><br/><br/><br/>";
			echo HtmlHelper::input_hidden('i'.$i, $i+1);
			echo "<div class='erroAluno".$i."'></div>";
?>		
			<script>
			function verificaAluno<?php echo $i;?>(){
				var mes 	 = $("#mes").val();
				var aluno 	 = $("#aluno<?php echo $i;?>").val();
				var qtdAluno = $("#qtdAlunos").val();
				var i		 = $("#i<?php echo $i?>").val();
				$.post("vendas/ajax.php",{
					mes: mes,
					aluno: aluno
				},function(data){
					if(data != ""){
						$(".erroAluno<?php echo $i;?>").html(data);
					}
					if(i == qtdAluno){
						$(".botao").html("<input type='submit' value='' class='bt-salvar' />");
					}
				});
			}
			</script>	
<?php 		
		}//for
		echo HtmlHelper::input_text('Valor', 'valor', $valor, 180, array('readonly'=>'readonly','style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'))."<br/><br/><br/><br/><br/>";
		echo HtmlHelper::input_text('Valor Pago', 'valorPago', $valorB, 180, array('readonly'=>'readonly','style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'))."<br/><br/><br/><br/><br/>";
		
	}


?>

