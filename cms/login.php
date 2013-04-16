<?php
	$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="none" />
	<title>.:: GRANDE RECIFE ::.</title>
	
	<!-- CSS -->
	<link href="public/css/main.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="public/js/jquery.js"></script>
	<script type="text/javascript" src="public/js/functions.js"></script>
	<!-- CC -->
	<!--[if IE 6]>	
			<script type="text/javascript" src="js/dd_belatedpng.js"></script>    
	        <script type="text/javascript">
				  DD_belatedPNG.fix('#hd h1, #hd .busca .cl, #hd .busca .cr, #hd .sombra, #sidebar ul li, #hd .busca #ok, #main #salvar, .master-media .media div .mai, #hd .log ul li a, #sidebar ul li, table.tablesorter tr td a.editar, table.tablesorter tr td a.excluir, .acoes-table dl.paginacao dd a.avancar, .acoes-table dl.paginacao dd a.retroceder');
			</script> 
	<![endif]-->	
	
	<script type="text/javascript">

	function validacao(){
		
		var formulario = document.getElementById('formulario');
		
		if(formulario.usuario.value == '' || formulario.usuario.value == false){
			formulario.btsubmit.disabled = true;
			return false;
			
		}else if(formulario.senha.value == '' || formulario.senha.value == false){
			formulario.btsubmit.disabled = true;
			return false;
			
		}else{
			formulario.btsubmit.disabled = false;
		}
	
	}
	
	window.onload = function(){
		
		var formulario = document.getElementById('formulario');
		
		formulario.usuario.setAttribute("autocomplete","off");
		formulario.senha.setAttribute("autocomplete","off");
		
		formulario.usuario.focus();
		
	};
	
	</script>
</head>

<body>
	<div id="all">
		<div id="hd">
			<h1>Graça Albuquerque</h1>					

			<div class="sombra">&nbsp;</div>
		</div>
		
		<div id="md">
		
			<div id="main">
				
				<div class="int-destaques">
					
				
					<form action="login/login.php" method="post" id="formulario" class="frm-login">
					<input type="hidden" name="tipo" id="tipo" value="login">
						<label>Login:</label>
                        <span class="box-inp">
                            <span class="tl"> </span>
                            <span class="bl"> </span>
                            	<input id="usuario" type="text" name="usuario" class="ipt_login" maxlength="100" onKeyUp="validacao();" value="<?php if ( !empty($_COOKIE['lembrar']) ) echo $_COOKIE['lembrar'];?>"/>
                            <span class="tr"> </span>
                            <span class="br"> </span>
                        </span>	
                        
                        <label>Senha:</label>
                        <span class="box-inp">
                            <span class="tl"> </span>
                            <span class="bl"> </span>
                            	<input id="senha" type="password" name="senha" class="ipt_login" maxlength="20" onKeyUp="validacao();" //>
                            <span class="tr"> </span>
                            <span class="br"> </span>
                        </span>
                        
                        <br />
                        <span style="color:#FF0000" id="spRetorno"><?php echo $msg; ?></span>
                        
                        <br />
                        <input type="checkbox" name="lembrar" id="lembrar" value="1"<?php if ( !empty($_COOKIE['lembrar']) ) echo ' checked="checked"';?> />
                        <label for="lembrar" style="display:inline">Lembrar nome de usu&aacute;rio.</label>

						<br />
						<input type="submit" id="btsubmit" disabled="disabled" value="" class="ipt-login" name="salvar"/>
						
                        <br /><br />
                        <a href="nova_senha.php" style="font-size:10px; color:#999">Esqueci minha senha.</a>
					</form>											
				</div>	
			</div>
		</div>				
	</div><!-- #all -->
<?php include('includes/rodape.php'); ?>