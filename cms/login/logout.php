<?php
include_once("../includes/inicio.php");
$msg = "Logout efetuado com sucesso.";
$objUsuario = new Usuario($_SESSION['sesCodigo']);
$objLog	= new LogCMS(0, $objUsuario, 'Efetuou logout', $_SESSION['sesIP']);
$objLog->inserir();
if (isset($_SESSION['sesLogin']))
	unset($_SESSION['sesLogin'],$_SESSION['sesNome'],$_SESSION['sesCodigo'],$_SESSION['sesIP'],$_SESSION['sesStatusLogin'], $_SESSION['sesTipo']);
	
header("Location: ../login.php?msg=".$msg);
?>
