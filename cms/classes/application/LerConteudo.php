<?php
class LerConteudo {	

	public static function getPagina($i) {
				 
		switch($i){			
			case 'home':include("paginas/home/home.php"); break;
			
			case 'cms-home':include("home/index.php"); break;
			
			case 'cms-vendas':include("vendas/index.php"); break;
			case 'cms-vendas-inserir':include("vendas/inserir.php"); break;
			case 'cms-vendas-editar':include("vendas/editar.php"); break;
			
			case 'cms-estabelecimento':include("estabelecimento/index.php"); break;
			case 'cms-estabelecimento-inserir':include("estabelecimento/inserir.php"); break;
			case 'cms-estabelecimento-editar':include("estabelecimento/editar.php"); break;
			case 'cms-estabelecimento-importar':include("estabelecimento/importar.php"); break;
			
			case 'cms-tipo-estudante':include("tipo_estudante/index.php"); break;
			case 'cms-tipo-estudante-inserir':include("tipo_estudante/inserir.php"); break;
			case 'cms-tipo-estudante-editar':include("tipo_estudante/editar.php"); break;
			
			case 'cms-estoque':include("estoque/index.php"); break;
			case 'cms-estoque-inserir':include("estoque/inserir.php"); break;
			case 'cms-estoque-editar':include("estoque/editar.php"); break;
			
			case 'cms-relatorio':include("relatorios/filtro.php"); break;
			
			case 'cms-aluno':include("aluno/index.php"); break;
			case 'cms-aluno-inserir':include("aluno/inserir.php"); break;
			case 'cms-aluno-editar':include("aluno/editar.php"); break;
			case 'cms-aluno-importar':include("aluno/importar.php"); break;
			
			
			case 'cms-valor':include("valor_cartela/index.php"); break;
			case 'cms-valor-inserir':include("valor_cartela/inserir.php"); break;
			case 'cms-valor-editar':include("valor_cartela/editar.php"); break;
			
			
			# USUaRIO #
			# CMS-USUARIO
			case 'cms-user':include("user/index.php"); break;
			case 'cms-user-inserir':include("user/inserir.php"); break;
			case 'cms-user-editar':include("user/editar.php"); break;			
			
			#CMS-LOGOUT
			case 'cms-logout':include("login/logout.php"); break;
			#----------------------------------			
			
			
			default: include("paginas/home/home.php"); break;			
		}		
	}		
	
	public static function getInclude($n){

		switch($n){
			
			case "busca-internas":  include("paginas/busca-internas.php"); break;
			
			
			case "busca-internas":  include("includes/busca-internas.php"); break;
			case "menu-hospital":  include("includes/menu-hospital.php"); break;
			case "menu-servicos":  include("includes/menu-servicos.php"); break;
			case "menu-diagnostico":  include("includes/menu-diagnostico.php"); break;
			case "menu-visita":  include("includes/menu-visita.php"); break;
			case "menu-links":  include("includes/menu-links.php"); break;
			case "menu-fale-conosco":  include("includes/menu-fale-conosco.php"); break;
			case "menu-estrutura":  include("includes/menu-estrutura.php"); break;
			case "menu-qualidade":  include("includes/menu-qualidade.php"); break;
			case "menu-humanizacao":  include("includes/menu-humanizacao.php"); break;
			case "menu-exames":  include("includes/menu-exames.php"); break;
			case "menu-pre-internamento":  include("includes/menu-pre-internamento.php"); break;
			case "menu-sustentabilidade":  include("includes/menu-sustentabilidade.php"); break;
			case "menu-espaco-medico":  include("includes/menu-espaco-medico.php"); break;
			case "menu-noticias":  include("includes/menu-noticias.php"); break;
			case "menu-facilidades":  include("includes/menu-facilidades.php"); break;
			case "menu-care":  include("includes/menu-care.php"); break;
			case "menu-busca":  include("includes/menu-busca.php"); break;
			case "menu-faq":  include("includes/menu-faq.php"); break;
			case "newsletter":  include("includes/newsletter.php"); break;
			case "navegacao-footer":  include("includes/navegacao-footer.php"); break;
			case "navegacao-header":  include("includes/navegacao-header.php"); break;
			case "topo-canais":  include("includes/topo-canais.php"); break;
			case "comentarios-condicionais":  include("includes/comentarios-condicionais.php"); break;
			default:   break;
		}								
	}			
}
?>