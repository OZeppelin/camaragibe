// JavaScript Document


function getInfo(id,tipo)
{
	$.post('internauta/processo.php?t='+tipo, 
	{
		id:id
	}, function(data){
		$("#dvInteratividade").html('<div class="clear"></div>'+data[0].mensagem+'<div class="clear"></div>');
		$("#dvInteratividade").show();
	}, "json");	
}

function validaPesquisa() {

 if($("#buscar").val() == "Fazer Pesquisa")
	$("#buscar").val("");

 document.form_busca.submit();
}

function verificaTexto() {
	
	texto = document.getElementById('texto');
	
	if(texto.value != "")
		return true;

	alert("Preencher campo de Texto");
	return false;
}

function editarComment(id){
	location.href = 'index.php?i=cms-comentario'; 
}

function editarTopico(id){
	location.href = 'index.php?i=cms-topico-view&id='+id; 
}

function alteraStatusComentario(id)
{
	$.post('comentario/processo.php?t=status', 
	{
		id:id
	}, function(data){
		if (data[0].id == 0)
		{
			$("#com"+id).attr("class",data[0].mensagem);
		}
	}, "json");	
}

function mask(objeto, evt, mask){
	var LetrasU = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	var LetrasL = 'abcdefghijklmnopqrstuvwxyz';
	var Letras  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ?abcdefghijklmnopqrstuvwxyz';
	var Numeros = '0123456789';
	var Fixos  = '().-:/ ';
	var Charset = " !\"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_/`abcdefghijklmnopqrstuvwxyz{|}~";
	
	evt = (evt) ? evt : (window.event) ? window.event : "";
	var value = objeto.value;
	if (evt) {
	 var ntecla = (evt.which) ? evt.which : evt.keyCode;
	 tecla = Charset.substr(ntecla - 32, 1);
	 if (ntecla < 32) return true;
	
	 var tamanho = value.length;
	 if (tamanho >= mask.length) return false;
	
	 var pos = mask.substr(tamanho,1);
	 while (Fixos.indexOf(pos) != -1) {
	  value += pos;
	  tamanho = value.length;
	  if (tamanho >= mask.length) return false;
	  pos = mask.substr(tamanho,1);
	 }
	
	 switch (pos) {
	   case '#' : if (Numeros.indexOf(tecla) == -1) return false; break;
	   case 'A' : if (LetrasU.indexOf(tecla) == -1) return false; break;
	   case 'a' : if (LetrasL.indexOf(tecla) == -1) return false; break;
	   case 'Z' : if (Letras.indexOf(tecla) == -1) return false; break;
	   case '*' : objeto.value = value; return true; break;
	   default : return false; break;
	 }
	}
	objeto.value = value;
	return true;
}


function alteraPermissao(ope,tel,user)
{
	$.post('user/processo.php?t=permissao', 
	{
		ope:ope,
		tela:tel,
		user:user
	}, function(data){
		if (data[0].id == 0)
		{
			$("#"+ope+tel).attr("class",data[0].mensagem);
		}
	}, "json");	
}

function validaUser(newuser)
{
	var erros = "";
	if($("#nome").val() == "")
	{
		erros += "- Preencha o nome.\n\r";
	}
	if($("#email").val() == "")
	{
		erros += "- Preencha o email.\n\r";
	}
	if($("#senha").val() != "")
	{
		if ( $("#senha").val() != $("#confirmacao").val())
		{
			erros += "- Senha e confirmação não conferem.\n\r";
		}
	}
	if (newuser == 1)
	{
		if( $("#login").val() == "")
		{
			erros += "- Preencha o login.\n\r";
		}else{
			$.post('user/processo.php?t=valida-login', 
			{
				login: $("#login").val()
			}, function(data){
				if (data[0].id == 1)
				{
					erros += data[0].mensagem;
					alert(erros);
					return false;
				}
				else
				{
					document.form.submit();
				}	
			}, "json");	
		}
	}
	else
	{
		if (erros != "")
		{
			alert(erros);
			return false;
		}
		document.form.submit();
	}	
}

function validaInternauta(newuser)
{
	var erros = "";
	if($("#nome").val() == "")
	{
		erros += "- Preencha o nome.\n\r";
	}
	
	if($("#senha").val() != "")
	{
		if ( $("#senha").val() != $("#confirmacao").val())
		{
			erros += "- Senha e confirmação não conferem.\n\r";
		}
	}
	if( $("#apelido").val() == "")
	{
		erros += "- Preencha o apelido.\n\r";
	}
	
	if($("#email").val() == "")
	{
		erros += "- Preencha o email.\n\r";
	}
	else if($("#email").val() != $("#emailOld").val())
	{
		if ( emailCheck($("#email").val()) )
		{
			if ( $("#email").val() != $("#confirmacao-email").val())
			{
				erros += "- E-mail e confirmação não conferem.\n\r";
			}
			else
			{
				var newuser = 1;		
			}
		}
		else
		{
			erros += "- E-mail invalido.\n\r";
		}
		
	}
	
	if (erros != "")
	{
		alert(erros);
		return false;
	}else{
		if (newuser == 1)
		{
			$.post('internauta/processo.php?t=valida-login', 
			{
				email: $("#email").val()
			}, function(data){
				if (data[0].id == 1)
				{
					erros += data[0].mensagem;
					alert(erros);
					return false;
				}
				else
				{
					document.form.submit();
				}	
			}, "json");	
		}
		else
		{
			if (erros != "")
			{
				alert(erros);
				return false;
			}
			document.form.submit();
		}	
	}	
}

function emailCheck (emailStr) {
	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom=validChars + '+'
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
	var msgerro = "E-mail com formato incorreto"
	var matchArray=emailStr.match(emailPat)
	if (matchArray==null) {
		return false
	}
	var user=matchArray[1]
	var domain=matchArray[2]
	
	if (user.match(userPat)==null) {
		return false
	}
	var IPArray=domain.match(ipDomainPat)
	if (IPArray!=null) {
		  for (var i=1;i<=4;i++) {
			if (IPArray[i]>255) {
			return false
			}
		}
		return true
	}
	var domainArray=domain.match(domainPat)
	if (domainArray==null) {
		return false
	}
	var atomPat=new RegExp(atom,"g")
	var domArr=domain.match(atomPat)
	var len=domArr.length
	if (domArr[domArr.length-1].length<2 || 
		domArr[domArr.length-1].length>3) {
	   return false
	}
	if (len<2) {
	   return false
	}
	return true;
}
