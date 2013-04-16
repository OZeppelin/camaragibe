<?php
$ac = Acesso::check("cms-aluno");
if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

if(isset($_GET['id']))
	$objNO = Aluno::buscar($_GET['id']);
	
?>
<div id="main">
	<h2>Aluno</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('aluno/processo.php?t=editar'), array('estabelecimento', 'nome', 'codigo', 'tipo', 'responsavel', 'dtNasc') ); 		
		echo HtmlHelper::select('Estabelecimento', 'estabelecimento', Estabelecimento::arraySelect(), $objNO->getEstabelecimento()->getId());
		echo HtmlHelper::input_text('Nome', 'nome', $objNO->getNome(), 255);
		echo HtmlHelper::select('Tipo de Estudante', 'tipo', TipoEstudante::arraySelect(),$objNO->getTipo()->getId());
		echo HtmlHelper::input_text('Responsável', 'responsavel', $objNO->getResponsavel(), 255); 
		echo HtmlHelper::input_text('Data Nasc.','dtNasc', Util::ajustarData($objNO->getDtNasc()), 10, array('style'=>'width:150px','class'=>'data-picker'))."<br/><br/><br/>";
		echo HtmlHelper::input_text('Código', 'codigo', $objNO->getCodigo(), 255);
		echo HtmlHelper::input_hidden('id', $objNO->getId());
?>	

	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
	</div>	
</div>			
