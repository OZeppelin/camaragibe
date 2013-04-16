<?php
$ac = Acesso::check("cms-estabelecimento");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');
?>
<div id="main">
	<h2>Estabelecimento</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('estabelecimento/processo.php?t=import'), array('arquivo'), array('name' => 'form', 'id' => 'form') ); 
		echo HtmlHelper::input_file('Arquivo (Formato txt)','arquivo');
	?>
    
    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
