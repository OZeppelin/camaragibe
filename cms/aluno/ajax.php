<?php
	require $_SERVER['DOCUMENT_ROOT']."/camaragibe/cms/includes/inicio.php";
	
	$valor = (isset($_GET['q'])) ? $_GET['q'] : "";
	
	
	if(!empty($valor)){
		
		$wh = "n.razaosocial LIKE '".$valor."%'";
		$objEstabelecimento = Estabelecimento::listar($wh,array(),"n.razaosocial",50);
		if(sizeof($objEstabelecimento) > 0){
			foreach($objEstabelecimento as $obj){
				echo $obj->getTitulo()."\n";
			}
		}
	
	}