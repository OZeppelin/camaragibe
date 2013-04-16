<div id="main">
	<h2>Estoque</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-estoque");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "n.periodo='D'";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":qtd","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where .= " AND (qtd like :qtd)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 10, Estoque::contador($where,$param), "cms-estoque" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-estoque-inserir" class="add">Adicionar</a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-estoque";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-estoque-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/estoque/processo.php?t=deletar' : false;
	
		
	$objNO = Estoque::listar("n.periodo='A'", $param, "data desc", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
?>
	<label>GERAL</label>
<?php	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Quantidade' => $obj->getQtd(), 'Data' => Util::ajustarData($obj->getDataCriacao()));		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar);
	}
	else
		echo "Nenhum registro encontrado";

?>
	<label>MENSAL</label>
<?php
	$objMensal = Estoque::listar("n.periodo='M'",$param,"data desc");
	if(sizeof($objMensal) > 0){
		foreach($objMensal as $mes)
		
			$contentM[] = array('id' => $mes->getId(), 'Quantidade' => $mes->getQtd(), 'Data' => Util::ajustarData($mes->getDataCriacao()));
			
		echo HtmlHelper::show_grid($contentM, 'id',  $editar, $editar, $deletar);
	}	
	else
		echo "Nenhum registro encontrado";
?>
	<label>Dia</label>
<?php
	$objDia = Estoque::listar("n.periodo='D'",$param,"data desc");
	if(sizeof($objDia) > 0){
		foreach($objDia as $dia)
		
			$contentD[] = array('id' => $dia->getId(), 'Quantidade' => $dia->getQtd(), 'Data' => Util::ajustarData($dia->getDataCriacao()));
			
		echo HtmlHelper::show_grid($contentD, 'id',  $editar, $editar, $deletar,$objPag);
	}
	else
		echo "Nenhum registro encontrado";
		
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
