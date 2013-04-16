<?php
if(isset($_GET['id']))
{
	$ac = Acesso::check("cms-user");
	if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');
	$objUser = Usuario::buscar($_GET['id']);
}	
else
	$objUser = Usuario::buscar($_SESSION['sesCodigo']);	

$tipo['usuario'] = ""; $tipo['master'] = "";
switch ($objUser->getTipo())
{
	case 0:
		$tipo['usuario'] = "checked=\"checked\"";
		break;
	case 1:
		$tipo['master'] = "checked=\"checked\"";
		break;
}
if ($objUser->getAtivo() != 1){
	$ativo['sim'] = ""; $ativo['nao'] = "checked=\"checked\"";
}else{
	$ativo['nao'] = ""; $ativo['sim'] = "checked=\"checked\"";
}
?>
<div id="main">
	<h2>Usu&aacute;rio</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('user/processo.php?t=editar'), "",array("onsubmit" => "javascript: return validaUser(0);") ); 
		echo HtmlHelper::input_text('Nome','nome', $objUser->getNome(), 255); 
		echo HtmlHelper::input_text('E-mail','email', $objUser->getEmail(), 255); 
	?>	
	<div class="bloqueio box">
			<div>
				<ul class="data">
					<?
					echo HtmlHelper::input_text('Login de acesso','login', $objUser->getLogin(), 100, array("disabled"=>"disabled"),true); 
					echo HtmlHelper::input_password('Senha','senha',false, 12, array(), true); 
					echo HtmlHelper::input_password('Redigitar senha','confirmacao',false, 12, array(), true); 
					?>
				</ul>

				<? if ($_SESSION['sesTipo'] == 1){ ?>
					<label class="t-box">Tipo:</label><br />
					<input type="radio" <?php echo $tipo['usuario'];?>  value="0" name="rdbTipo" id="rdbUsuario"><label>Usuário</label>
					<input type="radio" <?php echo $tipo['master'];?> value="1" name="rdbTipo" id="rdbMaster"><label>Master</label>
					<br /><br />
				<? } ?>
				<p>
					<label class="t-box">Ativo:</label><br />
					<input type="radio" <?php echo $ativo['sim'];?> value="rdbAtivoSim" name="rdbAtivo" id="rdbAtivoSim"><label>Sim</label>
					<input type="radio" <?php echo $ativo['nao'];?> value="rdbAtivoNao" name="rdbAtivo" id="rdbAtivoNao"><label>N&atilde;o</label>
				</p>
			</div>
	</div>		
	<?
	echo HtmlHelper::input_hidden('id', $objUser->getId()); 		
	if (isset($_GET['id']))
		echo Permissao::grid($_GET['id']);
	
	?>
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar"/>
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	

