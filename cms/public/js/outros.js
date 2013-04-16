// JavaScript Document

// limitar texto da obs (keypress)
function limitText(obj, tam){
	
	var nome = obj.name;
	tam = tam-1;
	
	if (tam){
		
		if( $(obj).val().length >= tam ) {
			
			// alert('Você digitou '+$(obj).val().length+' caracteres, apenas são permitidos 255 caracters.');
						
			var str = $(obj).val().substr(0, tam);
			$(obj).val(str);
		
		}else{
			
			var qtd = tam - $(obj).val().length;
			
			if ( $('span[id=txt_limit_' + nome + ']').attr('id') ){
			
				$('span[id=txt_limit_' + nome + ']').html(qtd);
				
			}else{
				$(obj).after('<span id="txt_limit_' + nome + '" class="txt-limit">' + qtd + '</span>');
			}
		}
	}
	
}

$(function() {
		   
	// confirmar exclusao
	$('a.bt-excluir').click( function(){
		
		var confirma = confirm('Deseja excluir permanentemete?');
		if (!confirma) return false;
	});
	
});


// marcar todos
function selectAll(obj, tb, name){

	var check = obj.checked;

	$('#' + tb).find('input[name=' + name +']').each( function(){
		$(this).attr('checked', check);
	});
}

//so envia o form se tiver algum marcado
function enviaFormDelete(name){
	
	var marcou = validaSelecao(name);
	
	if (marcou == false){
	
		alert('Selecione um registro!');
		return false;
	
	}else{
		
		var confirma = confirm('Deseja excluir permanentemete?');
		if (!confirma) return false;
	}
}

function validaSelecao(name){
	var ok = false;
	todos = document.getElementsByName(name+'[]');
	for(x = 0; x < todos.length; x++) {
        if (todos[x].checked == true){
			ok = true;
			break;
		}
	}
	return ok;
}


//formata data
function formataData(){
 
	 //se for passado o obj
	 if (arguments[0].value){
		var obj = arguments[0];
	 }else{
		var obj = this; 
	 }
	
	 var cont = obj.value.length; 
	 
	 if (cont == 2) {
	 
	  var valor = obj.value;
	  obj.value = valor + "/";
	  
	 }else if (cont == 5) {
	  
	  valor = obj.value;
	  obj.value = valor + "/";
	 
	 }  
}


// formata cpf
function formataCpf(){
 
 if (arguments[0].value){
 	var obj = arguments[0];
 }else{
 	var obj = this;
 }
 
 var cont = obj.value.length;
 
 if (cont == 3) {
	 
	  var valor = obj.value;
	  obj.value = valor + ".";
	  
  }else if (cont == 7) {
	  
	  valor = obj.value;
	  obj.value = valor + ".";
	  
  }else if (cont == 11) {
	  
	  valor = obj.value;
	  obj.value = valor + "-";
	  
  }
  
}

// formata cep
function formataCep(){
 var cont = this.value.length;
 if (cont == 5) {
  var valor = this.value;
  this.value = valor + "-";
  }
}


// Apenas numeros
function numero(e){

	//IE
	try{
		var element = event.keyCode;
	}catch(er){};
	
	//OUTROS
	try{
		var element = e.which;
	}catch(er){};
	
	//VERIFICA
	if ( (element < 48 || element > 57) && element != 0 && element != 8 && element != 9 ){
		return false;
	}
	
}


/*
function buscarCep(cep, nome){
	
	//recebe o valor do cep
	var cep = cep.replace('-','');
	
	// inicia o metodo .ajax
	$.ajax({

			type: "POST",

			url: "inc/cliente/cliente/busca_cep.php",

			dataType: "json",
			
			data: "cep="+cep,
			
			success: function(msg){
						
						var novoCep = new Array( msg.uf,
											msg.cidade,
											msg.bairro,
											msg.tipo_logradouro+' '+msg.logradouro);
						return novoCep;
					 },

			beforeSend: function(){
				$("input[name="+nome+"]").after("&nbsp;&nbsp;carregando...");
			}
		});
	
}*/
