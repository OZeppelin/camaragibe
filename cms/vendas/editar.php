<?php
$ac = Acesso::check("cms-vendas");
if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

if(isset($_GET['id']))
	$objNO = Vendas::buscar($_GET['id']);
	
?>
<div id="main">
	<h2>Vendas</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('vendas/processo.php?t=editar'), array('boleto','aluno','valor','valorPago') ); 		
		echo HtmlHelper::input_text('Boleto', 'boleto', str_replace("\\","",$objNO->getBoleto()));
		echo HtmlHelper::input_text('Aluno', 'aluno', str_replace("\\","",$objNO->getAluno()->getCodigo()));
		echo HtmlHelper::input_text('Valor', 'valo', str_replace("\\","",$objNO->getValor()));
		echo HtmlHelper::input_text('Valor Pago', 'valorPago', str_replace("\\","",$objNO->getValorPago())); 
		echo HtmlHelper::input_hidden('id', $objNO->getId()); 
?>	
        
    <br />
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
	</div>	
</div>			
