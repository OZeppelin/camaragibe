<div id="main">
	<h2>Aluno</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-aluno");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":nome","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$param[] = array("referencia" => ":codigo","valor" => "%".(int)$_POST['buscar']."%","tipo" => "STR");
		$where .= " (nome like :nome OR codigo like :codigo)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 100, Aluno::contador($where,$param), "cms-aluno" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-aluno-inserir" class="add">Adicionar</a> 
			</div>
			<div>
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-aluno-importar"><img src="<?php echo Util::baseUrl();?>cms/public/images/layout/bt_importar.jpg" height="36px" width="148px"></a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-aluno";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-aluno-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/aluno/processo.php?t=deletar' : false;
	
		
	$objNO = Aluno::listar($where, $param, "nome", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Nome' => $obj->getNome(), 'Código' => $obj->getCodigo(), 'Tipo' => $obj->getTipo()->getTitulo());		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
