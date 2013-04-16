<?php
$ac = Acesso::check("cms-user");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');
?>
<div id="main">
	<h2>Usu&aacute;rio</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
	//
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
		echo HtmlHelper::form_post( HtmlHelper::link('user/processo.php?t=inserir'),array(),array("name"=>"form")); 
		echo HtmlHelper::input_text('Nome','nome', false, 255); 
		echo HtmlHelper::input_text('E-mail','email', false, 255); 
	?>	
	<div class="bloqueio box">
			<div>
				<ul class="data">
					<?
					echo HtmlHelper::input_text('Login de acesso','login', false, 100, array(),true); 
					echo HtmlHelper::input_password('Senha','senha',false, 12, array(), true); 
					echo HtmlHelper::input_password('Redigitar senha','confirmacao',false, 12, array(), true); 
					?>
				</ul>
				<? if ($_SESSION['sesTipo'] == 1){ ?>
					<label class="t-box">Tipo:</label><br />
					<input type="radio"  value="0" name="rdbTipo" id="rdbUsuario"><label>Usuário</label>
					<input type="radio"  value="1" name="rdbTipo" id="rdbMaster"><label>Master</label>
					<br /><br />
				<? } ?>
				<p>
					<label class="t-box">Ativo:</label>
					<input type="radio" checked="checked" value="rdbAtivoSim" name="rdbAtivo" id="rdbAtivoSim"><label>Sim</label>
					<input type="radio" value="rdbAtivoNao" name="rdbAtivo" id="rdbAtivoNao"><label>N&atilde;o</label>
				</p>
			</div>
	</div>		
	<?	//echo Permissao::grid(); ?>
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="button" value="" class="bt-salvar" onclick="return validaUser(1);" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
