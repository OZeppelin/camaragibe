<?php setlocale(LC_TIME, 'pt_BR'); ?>
<div id="main">
	<h2>Painel de Controle</h2>
	<ul class="nav">
		<li><?php echo strftime('%a,  %d de %B de %G &agrave;s %R');?></li>
	</ul>
	<?php if ( isset($msg) ) echo '<h3 style="color:blue">' . $msg . '</h3>'; ?>
	
	<div class="basic" style="float:left;"  id="painel">
		<a>Últimas ações</a>
		<div>
			<?php echo Usuario::gridUltimasAcoes(7); ?>
		</div>
	</div>

</div>	
<script>
	$('#painel').accordion(); 
</script>