<div id="main">
	<h2>Tipo de Estudante</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-tipo-estudante");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":tipo","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where .= " AND (Descricao like :tipo)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 10, Estoque::contador($where,$param), "cms-tipo-estudante" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-tipo-estudante-inserir" class="add">Adicionar</a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-tipo-estudante";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-tipo-estudante-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/tipo_estudante/processo.php?t=deletar' : false;
	
		
	$objNO = TipoEstudante::listar("", $param, "Descricao", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Tipo' => $obj->getTitulo());		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
