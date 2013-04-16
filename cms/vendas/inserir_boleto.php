<?php
$ac = Acesso::check("cms-vendas");
if( ! $ac->incluir() ) die('<h3 style="color:blue">Acesso negado.</h3>');
$mes = date("Y-m");
?>
<div id="main">
	<h2>Vendas</h2>
	<ul class="nav">
	<li><?php include Util::baseDir()."cms/includes/migalha.php"; ?></li>
	</ul>
	<!-- INCIO CONTEUDO //-->	
	<?php 
		// Mensagem de Retorno
		$msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
		if ( $msg != "" ) echo '<h3 style="color:blue">' . $msg . '</h3>';
		// -------------------
		
		echo HtmlHelper::form_post( HtmlHelper::link('vendas/processo.php?t=inserir')); 
		echo HtmlHelper::input_text('Boleto', 'boleto', false, 255, array('onchange'=>'qntdAlunos();','onkeydown'=>'Mascara(this,Integer)','onkeypress'=>'Mascara(this,Integer)','onkeyup'=>'Mascara(this,Integer)'))."<br/><br/><br/><br/><br/>";
		//echo HtmlHelper::input_text('Aluno', 'aluno', false, 180, array('onchange'=>'verificaAluno();','onkeydown'=>'Mascara(this,Integer)','onkeypress'=>'Mascara(this,Integer)','onkeyup'=>'Mascara(this,Integer)'))."<br/><br/><br/><br/><br/>";
		echo "<div class='alunos'>";
		echo HtmlHelper::input_text('Valor', 'valor', false, 180, array('style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'))."<br/><br/><br/><br/><br/>";
		echo HtmlHelper::input_text('Valor Pago', 'valorPago', false, 180, array('onblur'=>'enviar();','style'=>'width:150px','onkeydown'=>'Mascara(this,Valor)','onkeypress'=>'Mascara(this,Valor)','onkeyup'=>'Mascara(this,Valor)'))."<br/><br/><br/><br/><br/>";
		echo "</div>";
		echo HtmlHelper::input_hidden('mes', $mes);
	?>
    <script>
    	function qntdAlunos(){
        	var boleto = $("#boleto").val();
        	$.post("vendas/ajax.php",{
            	boleto: boleto,
            	par: 'b'
            },function(data){
                if(data != ""){
                    $(".alunos").html(data);
                    //$(".botao").html("<input type='submit' value='' class='bt-salvar' />");
                }
            });
    	}
		
	
		/*function enviar(){
			var pg = $("#valorPago").val();
			if(pg != ""){
				$(".botao").html("<input type='submit' value='' class='bt-salvar' />");
			}
		}*/
	</script>
    <!-- FIM CONTEUDO //-->	
	<div class="clear"></div>
	<div class="botao"></div>
	<?php include (Util::baseDir().'cms/includes/busca.php'); ?>
</div>	
