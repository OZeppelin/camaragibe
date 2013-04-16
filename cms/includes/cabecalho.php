<?php 
	require $_SERVER['DOCUMENT_ROOT']."/camaragibe/cms/includes/inicio.php";

require(Util::baseDir().'cms/includes/verificaSessao.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="none" />
    
	<title>.:: GRANDE RECIFE ::.</title>
	<!-- <link rel="shortcut icon" href="<?php echo Util::baseUrl();?>cms/public/img/favicon.png" type="image/x-icon" /> -->
	
	<!-- CSS -->
    <style type="text/css">
	table.listagem{font: 12px Arial, Verdana; color:#000}
	table.listagem{
		width:100%;
		border:1px #ccc solid;
	}
	table.listagem td{
		border-bottom:1px #ccc solid;
	}
	#content{
		border:1px solid #333;
		padding:5px;
	}
	#content table.listagem{width:100%; border-collapse:collapse}
	#content table.listagem tr, #content table.listagem td{border-bottom:1px #666 solid;}
	#content table.listagem th{background:#ccc; color:#fff;}
	
	</style>
	<link href="<?php echo Util::baseUrl() ?>cms/public/css/main.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo Util::baseUrl() ?>cms/public/css/ui.all.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo Util::baseUrl() ?>cms/public/css/autocomplete.css" rel="stylesheet" type="text/css" media="all" />
	<!-- CC -->
	<!--[if IE 6]>
		<style type="text/css">
			
		</style>
		
		<script type="text/javascript" src="<?php echo Util::baseUrl();?>js/dd_belatedpng.js"></script>    
        <script type="text/javascript">
			  DD_belatedPNG.fix('#hd h1, #hd .busca .cl, #hd .busca .cr, #hd .sombra, #sidebar ul li, #hd .busca #ok, #main #salvar, .master-media .media div .mai, #hd .log ul li a, #sidebar ul li, table.tablesorter tr td a.editar, table.tablesorter tr td a.excluir, .acoes-table dl.paginacao dd a.avancar, .acoes-table dl.paginacao dd a.retroceder');
		</script> 
	<![endif]-->	
	
	
	<!-- JS -->
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/jquery.accordion.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/jquery.tablednd.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/actb.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/init.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/outros.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/validacao.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/ui.core.js"></script>
	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/ui.datepicker.js"></script>
   	<script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/functions.js"></script>
    <script type="text/javascript" src="<?php echo Util::baseUrl() ?>cms/public/js/mascara.js"></script>
    <script type="text/javascript">
	$( function(){
		$(".data-picker").datepicker({dateFormat: 'dd/mm/yy', showOn: 'button', buttonImage: '<?php echo Util::baseUrl() ?>cms/public/images/layout/calendar.png', buttonImageOnly: true});
	});

	</script>

	
</head>

<body>
	<div id="all">
		<div id="hd">
			<h1>Cappen CMS</h1>					
			<div class="log">
				<p>Voc&ecirc; est&aacute; logado como <a href="<?php echo Util::baseUrl()?>cms/?i=cms-user-editar" class="user"><?= $_SESSION['sesNome'] ?></a> </p>
				<ul>	
					<li class="i1"><a href="<?php echo Util::baseUrl()?>cms/?i=cms-user-editar">Editar Perfil</a></li>
					<li class="i2"><a href="<?php echo Util::baseUrl()?>cms/?i=cms-user">Visualizar Usuários</a></li>
					<li class="i3"><a href="<?php echo Util::baseUrl()?>cms/login/logout.php">Log out</a></li>
				</ul>	 
			</div>
			<div class="busca">
				<form action="" id="form_busca" name="form_busca" method="post">					
					<div class="cl">
						<div class="cr">
							<div class="ct">
								<fieldset>
									<legend>Pesquisa:</legend>
									<span><span><input type="text" name="buscar" id="buscar" value="<?php echo ( !empty($_POST['buscar']) ) ? $_POST['buscar'] : 'Fazer Pesquisa' ?>" /></span></span>
									<input type="button" name="ok" id="ok" value="" onclick="javascript: validaPesquisa();"/>
								</fieldset>						
							</div>					
						</div>
					</div>					
				</form>
			</div>
			
			<div class="sombra">&nbsp;</div>
		</div>