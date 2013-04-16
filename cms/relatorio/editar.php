<?php
$ac = Acesso::check("cms-relatorio");
if( ! $ac->editar() ) die('<h3 style="color:blue">Acesso negado.</h3>');

if(isset($_GET['id']))
	$objNO = Relatorio::buscar($_GET['id']);
	
?>
<div id="main">
	<h2>Relat&oacute;rio</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
	
		echo HtmlHelper::form_post( HtmlHelper::link('relatorio/processo.php?t=editar'), array('titulo','objetivo', 'texto') ); 
		echo HtmlHelper::input_text('Título', 'titulo', str_replace("\\","",$objNO->getTitulo())); 
		echo HtmlHelper::input_hidden('id', $objNO->getId()); 
?>	
        
        <label>Objetivo</label>
<?php
        
		include("fckeditor/fckeditor.php") ;	
		
		$editor  = new FCKeditor('objetivo');
		$editor->BasePath=Util::baseUrl().'cms/fckeditor/';   
		//$editor->BasePath='/adm/fckeditor/';   ///   ONLINE
		$editor->Config['SkinPath']=Util::baseUrl().'cms/fckeditor/editor/skins/office2003/';    
		//$editor->Config['SkinPath']='/adm/fckeditor/editor/skins/office2003/';   // ONLINE						 
		$editor->Width =620;
		$editor->Height = 400;
		$editor->ToolbarSet = "Default";
		
		$editor->Value = str_replace("\\","",$objNO->getObjetivo());   // ENT_QUOTES.... reconhesse aspas simples e duplas!
		$editor->Create();

	?>
    <br />
        
        
        <label>Texto</label>
<?php
        
		include("fckeditor/fckeditor.php") ;	
		
		$editor  = new FCKeditor('texto');
		$editor->BasePath=Util::baseUrl().'cms/fckeditor/';   
		//$editor->BasePath='/adm/fckeditor/';   ///   ONLINE
		$editor->Config['SkinPath']=Util::baseUrl().'cms/fckeditor/editor/skins/office2003/';    
		//$editor->Config['SkinPath']='/adm/fckeditor/editor/skins/office2003/';   // ONLINE						 
		$editor->Width =620;
		$editor->Height = 400;
		$editor->ToolbarSet = "Default";
		
		$editor->Value = str_replace("\\","",$objNO->getTexto());   // ENT_QUOTES.... reconhesse aspas simples e duplas!
		$editor->Create();

	?>
    <br />
	<!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<input type="submit" value="" class="bt-salvar" />
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
	</div>	
</div>			
