<?php
//VERIFICA PERMISSÃO
$ac = Acesso::check("cms-relatorio");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');

?>
<div id="main">
	<h2>Relatório</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('relatorios/relatorio.php'), array('dtIni','dtFim','onSubmit' => 'return verificaTexto();'),array('target'=>'_blank')/*, array('name' => 'form', 'id' => 'form', 'onSubmit' => 'return verificaTexto();')*/ );
		/*echo HtmlHelper::select('Operador','operador',Resgate::arraySelect("OPERADOR"),false,array('onchange'=>'carregaDadosCAP(this)'));
		echo "<div class='cap'>".HtmlHelper::select('CAP','cap',Resgate::arraySelect("CAP"),false,array('onchange'=>'carregaDados(this)'))."</div>";
		echo "<div class='dados'>".HtmlHelper::input_text('Nome', 'nome', false, 255, array('readonly'=>'readonly'))."</div>"; 
		echo HtmlHelper::select('Tipo de Bilhete','tipo',Resgate::arraySelect("BILHETE"),false,array('onchange'=>'carregaDadosANEL(this)'));
		echo "<div class='anel'></div>";*/
		echo HtmlHelper::input_text('Data Inicial','dtIni', false, 10, array('style'=>'width:150px','class'=>'data-picker'))."<br/><br/><br/>";
		echo HtmlHelper::input_text('Data Final','dtFim', false, 10, array('style'=>'width:150px','class'=>'data-picker'));
		
	?>
    <br />
    
    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="Filtrar"  />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
