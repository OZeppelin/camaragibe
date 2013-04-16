<?php

$i   = (isset($_GET['i'])) ? $_GET['i'] : "cms-home";
include ('includes/cabecalho.php');
?>		
	<div id="md">
			<?php include ('includes/menu.php'); ?>
			<div id="main">
			<!-- INCIO CONTEUDO //-->	
			
			<?php LerConteudo::getPagina($i); ?>
			
			<!-- FIM CONTEUDO //-->	
			<?php include ('includes/busca.php'); ?>
    		</div>	
		</div>			
	</div>
<?php include('includes/rodape.php'); ?>