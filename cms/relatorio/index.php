<div id="main">
	<h2>Relat&oacute;rio</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-relatorio");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "excluido = 'N'";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":titulo","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$param[] = array("referencia" => ":datacriacao","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where .= " AND (titulo like :titulo OR datacriacao like :datacriacao)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 10, Relatorio::contador($where,$param), "cms-relatorio" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-relatorio-inserir" class="add">Adicionar</a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-relatorio";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-relatorio-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/relatorio/processo.php?t=deletar' : false;
	
		
	$objNO = Relatorio::listar("", $param, "datacriacao desc", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Título' => $obj->getTitulo(), 'Data' => Util::ajustarDataHora($obj->getDataCriacao()));		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
