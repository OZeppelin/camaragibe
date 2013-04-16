<div id="main">
	<h2>Estabelecimento</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	
	$ac = Acesso::check("cms-estabelecimento");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":titulo","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where .= " (razaosocial like :titulo)";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 25, Estabelecimento::contador($where,$param), "cms-estabelecimento" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-estabelecimento-inserir" class="add">Adicionar</a> 
			</div>
			<div>
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-estabelecimento-importar"><img src="<?php echo Util::baseUrl();?>cms/public/images/layout/bt_importar.jpg" height="36px" width="148px"></a> 
			</div>
		</div>
	<?php
	}
	echo "<!-- grid -->";
	$pag = Util::baseUrl()."cms/?i=cms-estabelecimento";
?>	
    
<?php	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-estabelecimento-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/estabelecimento/processo.php?t=deletar' : false;
	
		
	$objNO = Estabelecimento::listar($where, $param, "RazaoSocial", $objPag->getTamanho_pagina(), $objPag->getOffset());
	
	
	if (sizeof($objNO) > 0)
	{
		foreach($objNO as $obj)
		
			$content[] = array('id' => $obj->getId(), 'Raz&atilde;o Social' => $obj->getTitulo());		
			
		echo HtmlHelper::show_grid($content, 'id',  $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
