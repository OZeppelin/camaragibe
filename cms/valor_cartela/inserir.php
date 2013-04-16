<?php
$ac = Acesso::check("cms-valor");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');
$mes = date("Y-m");
?>
<div id="main">
	<h2>Paramêtros</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
		
		echo HtmlHelper::form_post( HtmlHelper::link('valor_cartela/processo.php?t=inserir')); 
		echo HtmlHelper::input_text('Valor', 'valor', false, 180, array('style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'));
	?>

    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
