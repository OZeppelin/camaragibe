<?php
$ac = Acesso::check("cms-valor");
if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

if(isset($_GET['id']))
	$objNO = Valor::buscar($_GET['id']);
	
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
	
		echo HtmlHelper::form_post( HtmlHelper::link('valor_cartela/processo.php?t=editar'), array('valor') ); 		
		echo HtmlHelper::input_text('Valor', 'valor', str_replace("\\","",$objNO->getValor()),"",array('style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'));
		echo HtmlHelper::input_hidden('id', $objNO->getId()); 
?>	
        
    <br />
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
	</div>	
</div>			
