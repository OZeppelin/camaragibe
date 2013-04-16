<?php
$ac = Acesso::check("cms-estoque");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');

$periodo[] = array('' => 'Selecione');
$periodo[] = array('D' => 'Diário');
$periodo[] = array('M' => 'Mensal');
$periodo[] = array('A' => 'Geral');
 

?>
<div id="main">
	<h2>Estoque</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('estoque/processo.php?t=inserir'), array('qtd','periodo','dtIni'), array('name' => 'form', 'id' => 'form') ); 
		echo HtmlHelper::input_text('Quantidade', 'qtd', false, 11, array('style'=>'width:150px','onkeydown'=>'Mascara(this,Integer)','onkeypress'=>'Mascara(this,Integer)','onkeyup'=>'Mascara(this,Integer)'))."<br/><br/><br/><br/><br/>";
		echo HtmlHelper::select('Período','periodo',$periodo);
		echo HtmlHelper::input_text('Data','dtIni', date("d/m/Y"), 10, array('style'=>'width:150px','class'=>'data-picker'))."<br/>";
	?>
	
    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
