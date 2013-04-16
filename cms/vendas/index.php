<div id="main">
	<h2>Vendas</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-vendas");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":boleto","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$param[] = array("referencia" => ":aluno","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where .= " (n.boleto like :boleto OR n.aluno like :aluno)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 10, Vendas::contador($where,$param), "cms-vendas" );
	$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 0;
	$objPag->paginar($pagina);

	// Mensagem de Retorno
	$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
	if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
	// -------------------

	if ($ac->incluir())
	{
	?>	
		<div class="destaque box">
			<div>
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-vendas-inserir" class="add">Adicionar</a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-vendas";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-vendas-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/vendas/processo.php?t=deletar' : false;
	
	$estoqueANO = Estoque::quantidade("n.periodo='A' AND n.data LIKE '%".date("Y")."%'");
	$estoqueMES = Estoque::quantidade("n.periodo='M' AND n.data LIKE '%".date("Y-m")."%'");
	$estoqueDIA = Estoque::quantidade("n.periodo='D' AND n.data = '".date("Y-m-d")."'");
	
	$whDia = "n.dtVenda LIKE '%".date("Y-m-d")."%'";
	//$whDia   = "n.dtVenda LIKE '%2013-01-23%'";
	$whMes = "n.dtVenda LIKE '%".date("Y-m")."%'";
	//$whMes	 = "n.dtVenda LIKE '%2013-01%'";
	
	$qtdVendasDia = Vendas::contador($whDia,array());
	$qtdVendasMes = Vendas::contador($whMes,array());
	$qtdVendasAno = Vendas::contador("n.dtVenda LIKE '%".date("Y")."%'");
	
	$qtdEstoqueMes = $estoqueMES - $qtdVendasMes;
	$qtdEstoqueDia = $estoqueDIA - $qtdVendasDia;
	$qtdEstoqueAno = $estoqueANO - $qtdVendasAno;
	
	echo "Estoque Geral: ".number_format($qtdEstoqueAno,0,'','.');
	echo "<br/>Estoque Mensal: ".number_format($qtdEstoqueMes,0,'','.');
	echo "<br/>Estoque Diário: ".number_format($qtdEstoqueDia,0,'','.');
	echo "<br/><br/>Vendas realizadas no dia   : ".number_format($qtdVendasDia,0,'','.');
	echo "<br/>Vendas realizadas no mês: ".number_format($qtdVendasMes,0,'','.');
	echo "<br/>Vendas realizadas no ano: ".number_format($qtdVendasAno,0,'','.')."<br/><br/>";
		
	$objNO = Vendas::listar($where, $param,"", "n.dtVenda desc", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Aluno' => $obj->getAluno()->getCodigo(), 'Data' => Util::ajustarDataHora($obj->getDtVendas()));		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
