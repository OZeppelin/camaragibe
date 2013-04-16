// JavaScript Document
$(document).ready(function(){
	
	// --------------- JS LAYOUT ---------------
	// $(".data-picker").datepicker({dateFormat: 'dd/mm/yy', showOn: 'button', buttonImage: '../public/images/layout/calendar.png', buttonImageOnly: true});

	$('.box-tags').css({'display' : 'none'});			
	
	/*$("#ver-tags").click(function () {
		  $(".box-tags").slideToggle("slow");
	});*/

	
	$("#ver-tags").click(function () {
		$(".box-tags").slideToggle("normal");
	});
	
	$(".submenu").hide();
	
	$('#sidebar a.abrir').click (function () {
		$('#sidebar ul li.fix').toggleClass("active");
		$(this).next().slideToggle();
		return false;
	}); 
	
	
	
	// --------------- DEMAIS ---------------	
	//cor no focus e blur dos input text e textarea
	$('input:text:not([id=buscar], [name=seu_email], [name=seu_login])').focus(corFocus);
	$('input:text:not([id=buscar], [name=seu_email], [name=seu_login])').blur(corBlur);
	$('textarea').focus(corFocus);
	$('textarea').blur(corBlur);
	$('select').focus(corFocus);
	$('select').blur(corBlur);
	$('input:password:not([name=seu_senha])').focus(corFocus);
	$('input:password:not([name=seu_senha])').blur(corBlur);
	$('tr.li_lista').mouseover( function(){ $(this).find("td").css('background','#F4FAFF');	} );
	$('tr.li_lista').mouseout( function(){ $(this).find("td").css('background','#FFFFFF');} );
	$(".data-picker").keypress(numero);
	$(".data-picker").keyup(formataData);
	
	//adiciona a classe input aos input text e textarea
	/*$('input:text').addClass('input');
	$('select').addClass('select');
	$('textarea').addClass('input');
	$('input:password').addClass('input');*/
	
	//tirar autocomplete do campo
	$('form').attr('autocomplete','off');
	
	
	//'limpar'campo de pesquisa
	$('#buscar').focus( function(){
		if(this.value == 'Fazer Pesquisa')	this.value = '';
	});
	
	$('#buscar').blur( function(){
		if(this.value == '')	this.value = 'Fazer Pesquisa';
	});
	
	
	//cor no  focus e blur do input
	function corFocus(){
		this.style.background = '#F4FAFF';
	}
	
	function corBlur(){
		this.style.background = '#FFFFFF';
	}
	
	
	
	/*function apenasNumero(){
		this.value = this.value.replace(/([a-z,\/,.,-])/i,'');//replace(/([a-z])/i,'')
	}*/	
	
	
	/*
	//editar configuracao
	$('#editar_configuracoes, #cancelar_configuracao').click( function(){

		if ( $('#div_configuracao').css('display') != 'block' ){
			
			$('#div_configuracao').fadeIn();
			$('#div_configuracao').css('display','block');
			
		}else{
			
			$('#div_configuracao').fadeOut();
		}
	
	});
	
	$('#salvar_configuracao').click( function(){
		
		var dados = $("#form_configuracao").serialize();
		
		$.ajax({
			   
			   type: 'POST',
			   url: 'inc/salvar_configuracao.php', 
			   data: dados, 
			   
			   success: function(msn){
				   
				   $('#salvar_configuracao').val('Salvar');
				   $('#div_configuracao').fadeOut();
				}, 
				
				beforeSend: function(){
					
					$('#salvar_configuracao').val('carregando...');
				}
			   
			   
		});
	
	});
	*/
	
});