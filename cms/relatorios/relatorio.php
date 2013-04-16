<?php 
	
	require $_SERVER['DOCUMENT_ROOT']."/camaragibe/cms/includes/inicio.php";
	
	$dtIni = isset($_POST['dtIni']) ? $_POST['dtIni'] : "";
	$dtFim = isset($_POST['dtFim']) ? $_POST['dtFim'] : "";
	
	if(($dtIni != "") && ($dtFim != "")){
		$dtInii = Util::dataParaBanco($dtIni);
		$dtFimm = Util::dataParaBanco($dtFim);
		$qDt = " n.dtCompra BETWEEN '".$dtInii."' AND '".$dtFimm."'";
	}else{
		$qDt = " ";
	}
	
	$objVendas = Vendas::listar($qDt,array(),"n.dtCompra","n.dtVenda");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.:: GRANDE RECIFE ::.</title>
<style type="text/css">
.total{
	text-align: right;
}
.titulo {
	font-family: Verdana, Geneva, sans-serif;
}
.titulo {
	font-family: Georgia, "Times New Roman", Times, serif;
}
.campos {
	font-size: medium;
	font-weight: bold;
	font-family: "Times New Roman";
}

.resultado{
	font-size: medium;
	font-family: "Times New Roman";
}

.totais {
	color: #F00;
	font-size: medium;
	font-weight: bold;
	font-family: "Times New Roman";
	text-align: center;
}

</style>
<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/jquery.js"></script>
</head>

<body>
<table width="50%" height="146" border="0" align="center" cellpadding="0" cellspacing="0">
<script>
	function imprimir(){
		//alert('tea');
		$("#imp").hide();
		window.print();
		$("#imp").show();
	}
</script>
	<tr>
    	<td width="187" height="94"><img width="187px" align="top" src="<?php echo Util::baseUrl()?>cms/public/images/sistema/logo_granderecife.gif" /></td>
    	<td width="342" align="center" class="labels2"><p class="titulo"><span class="titulo">DIRETORIA DE GEST&Atilde;O ORGANIZACIONAL</span></p>
   	    <p class="titulo"><span class="titulo">GER&Ecirc;NCIA COMERCIAL - GCOM</span></p>
      <p class="titulo"><span class="titulo">DIVIS&Atilde;O RESGATE DE CR&Eacute;DITOS-DREC</span></p></td>
    	<td width="260">&nbsp;</td>
    </tr>
<tr>
	  <td colspan="3" align="center" class="labels2"><p class="titulo">DEMONSTRATIVO DE RESGATE DE CAMARAGIBE</p>
      <p class="titulo">TRANSPORTE COMPLEMENTAR</p>
      <p>&nbsp;</p>
    <p class="titulo">PER&Iacute;ODO - <span class="totais"><?php echo $dtIni;?></span> à <span class="totais"><?php echo $dtFim;?></span></p></td>
  </tr>
	<tr>
	  <td colspan="3"><table width="662" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
	    <tr align="center" class="campos">
	      <td>Data da Compra:</td>
	      <td>Estoque do Dia:</td>
	      <td>Qtd. Cartelas:</td>
	      <td>Estoque do Dia: (Saldo)</td>
	      <td>Qtd. Bilhetes:</td>
	      <td>Valor Total R$:</td>
        </tr>
        <?php
        	if(sizeof($objVendas) > 0){
        		$total = 0;
        		$totalCartelas = 0;
        		$totalBilhetes = 0;
        		$totalValor = "";
        		$totalMes	= 0;
        		$totalSaldoDia = 0;
        		foreach($objVendas as $vendas){
        			
        			$data = Util::ajustarData($vendas->getDtCompra());//Util::dataHoraParaHtml($vendas->getDtVendas());
        			
        			$qtdDia = Estoque::quantidade("n.periodo='D' AND n.data='".$vendas->getDtCompra()."'");
        			if($qtdDia == ""){
        				$qtdDia = 0;
        			}
        			
        			$totalMes += $qtdDia;
        			
        			$whCartelas = "n.dtCompra = '".$vendas->getDtCompra()."'";
        			$qtdCartelas = Vendas::contador($whCartelas);
        			
        			//Saldo do Estoque
        			$saldoDia = $qtdDia - $qtdCartelas;
        			
        			$totalSaldoDia += $saldoDia;
        			
        			$valor = ($vendas->getValor() * $qtdCartelas);
        			$bilhetes = ($qtdCartelas * 60);
        			
        			//TOTAIS
        			$totalCartelas += $qtdCartelas;
        			$totalBilhetes += $bilhetes;
        			$total 		   += $valor;
        			$totalValor    .= $total;
        ?>
	    <tr align="center" class="resultado">
	      <td><?php echo $data;?></td>
	      <td><?php echo number_format($qtdDia,0,'','.');?></td>
	      <td align="center"><?php echo number_format($qtdCartelas,0,'','.');?></td>
	      <td><?php echo number_format($saldoDia,0,'','.');?></td>
	      <td><?php echo number_format($bilhetes,0,'','.');?></td>
	      <td><?php echo number_format($valor,2,',','.');?></td>
        </tr>
        <?php
        		 }
        ?>
	    <tr align="center">
	      <td class="campos">TOTAL:</td>
	      <td class="totais"><?php echo number_format($totalMes,0,'','.');?></td>
	      <td class="totais"><?php echo number_format($totalCartelas,0,'','.');?></td>
	      <td class="totais"><?php echo number_format($totalSaldoDia,0,'','.');?></td>
	      <td class="totais"><?php echo number_format($totalBilhetes,0,'','.');?></td>
	      <td class="totais"><?php echo number_format($total,2,',','.');?></td>
        </tr>
        <?php }//if?>
      </table></td>
  </tr>
	<tr>
	  <td colspan="3"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>
      	</p>
      <p>&nbsp;</p>
      <p><div id="imp" align="right"><a onclick="imprimir();"><img width="46px" height="43px" align="top" src="<?php echo Util::baseUrl()?>cms/public/images/layout/print.gif" /></a></div></p></td>
  </tr>
</table>
</body>
</html>