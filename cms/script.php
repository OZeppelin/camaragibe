<?php
	
	require $_SERVER['DOCUMENT_ROOT']."/camaragibe/cms/includes/inicio.php";
	
	$objVendas = Vendas::listar("",array(),"n.id asc");
	foreach($objVendas as $vendas){
		$id = $vendas->getId();
		$dt = $vendas->getDtVendas();
		$data = substr($dt, 0,10);
		
		$objVender = new Vendas($id,"","","","","",$data);
		$objVender->editar();
		
	}
	