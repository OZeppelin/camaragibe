<?php
$ac = Acesso::check("cms-aluno");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');
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
	
		echo HtmlHelper::form_post( HtmlHelper::link('aluno/processo.php?t=inserir'), array('estabelecimento','nome','codigo','tipo','responsavel','dtNasc'), array('name' => 'form', 'id' => 'form') ); 
		//echo HtmlHelper::select('Estabelecimento', 'estabelecimento', Estabelecimento::arraySelect());
		echo HtmlHelper::input_text('Estabelecimento', 'estabelecimento', false, 255,array('autocomplete'=>'off','class'=>'ac_input'));
		echo HtmlHelper::input_text('Nome', 'nome', false, 255);
		echo HtmlHelper::select('Tipo de Estudante', 'tipo', TipoEstudante::arraySelect());
		echo HtmlHelper::input_text('Responsável', 'responsavel', false, 255); 
		echo HtmlHelper::input_text('Data Nasc.','dtNasc', false, 10, array('style'=>'width:150px','class'=>'data-picker'))."<br/><br/><br/>";
		echo HtmlHelper::input_text('Código', 'codigo', false, 255);
	?>
	<script>
		$().ready(function(){

			$('#estabelecimento').autocomplete("aluno/ajax.php",
			{
				width: 440,
				scrollHeight: 220,
				selectFirst: false
			});
			
		})
	</script>
    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
