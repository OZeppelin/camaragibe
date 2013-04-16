<div id="main">
	<h2>Usu&aacute;rio</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<?php
	$ac = Acesso::check("cms-user");
	if( ! $ac->consultar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

	$param = array(); $where = "";
	if(isset($_POST['buscar']))
	{
		$param[] = array("referencia" => ":desc","valor" => "%".$_POST['buscar']."%","tipo" => "STR");
		$where = "usu_nome like :desc";
	}
	
	# Paginacao #
	$objPag = new Paginacao( 20, Usuario::contador($where,$param), "cms-user" );
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
				<a href="<?php echo Util::baseUrl()?>cms/?i=cms-user-inserir" class="add">Adicionar</a> 
			</div>
		</div>
	<?
	}
	
	$editar  = ($ac->editar()) ? Util::baseUrl().'cms/?i=cms-user-editar' : false;
	$deletar = ($ac->deletar()) ? Util::baseUrl().'cms/user/processo.php?t=deletar' : false;

	echo "<!-- grid -->";
	
	$objUsu = Usuario::listar($where, $param, "usu_nome", $objPag->getTamanho_pagina(), $objPag->getOffset());
	if (sizeof($objUsu) > 0)
	{
		foreach($objUsu as $obj)
			$content[] = array('id' => $obj->getId(), 'Nome' => $obj->getNome(), 'E-mail' => $obj->getEmail());		
			
		echo HtmlHelper::show_grid($content, 'id', $editar, $editar, $deletar, $objPag);
	}
	else
		echo "Nenhum registro encontrado";
	
	include (Util::baseDir().'cms/includes/busca.php'); 
	?>
</div>	
