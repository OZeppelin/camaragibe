<?php
$secao = explode("-",$_GET['i']);
echo "<a href='index.php?i=cms-home'>Painel de Controle</a> / ";
switch (sizeof($secao))
{
	case 2:
		echo "<a href='index.php?i=".$secao[0]."-".$secao[1]."'>".ucfirst($secao[1])."</a> / ";
		echo "<b>Consulta</b>";
		break;
	case 3:
		if ($secao[2] == "inserir" || $secao[2] == "editar" || $secao[2] == "view" )
		{
			echo "<a href='index.php?i=".$secao[0]."-".$secao[1]."'>".ucfirst($secao[1])."</a> / ";
			echo "<b>".ucfirst($secao[2])."</b>";
		}else
		{
			echo "<a href='index.php?i=".$secao[0]."-".$secao[1]."-".$secao[2]."'>".ucfirst($secao[1])." ".ucfirst($secao[1])."</a> / Consulta";
		}	
		break;
	case 4:
		echo "<a href='index.php?i=".$secao[0]."-".$secao[1]."-".$secao[2]."'>".ucfirst($secao[1])." ".$secao[2]."</a> / ";
		echo "<b>".$secao[3]."</b>";
		break;
}
?>