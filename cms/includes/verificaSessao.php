<?php
if ( !isset($_SESSION['sesStatusLogin']) ) 
{
	header('Location: login.php');
	exit();	
}
?>