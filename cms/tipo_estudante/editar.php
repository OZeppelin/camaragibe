<?php
$ac = Acesso::check("cms-tipo-estudante");
if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

if(isset($_GET['id']))
	$objNO = TipoEstudante::buscar($_GET['id']);
	
?>
<div id="main">
	<h2>Tipo de Estudante</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('tipo_estudante/processo.php?t=editar'), array('titulo') ); 		
		echo HtmlHelper::input_text('Tipo', 'titulo', str_replace("\\","",$objNO->getTitulo())); 
		echo HtmlHelper::input_hidden('id', $objNO->getId()); 
?>	
        
    <br />
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
	</div>	
</div>			
