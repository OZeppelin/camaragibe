<script type="text/javascript">
	<?php $permitir_busca = ( file_exists(HtmlHelper::link('search') . '.php') ) ? 1 : 0 ; ?>
	if (<?php echo $permitir_busca ?> == 1) {
		$('#form_busca').attr('action', '<?php echo HtmlHelper::link('search') ?>');
	}else{
		$('#form_busca').submit( function(){ return false } );
	}
</script>