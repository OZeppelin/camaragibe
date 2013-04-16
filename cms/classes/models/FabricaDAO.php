<?php
/**
 * Arquivo de declaração da classe FabricaDAO.
 * 
 * Classe responsável pela instancia das classes controladoras do sistema usando o método singleton.
 * @package classes
 * @subpackage dados
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @version 1.0	
 * @since Janeiro/2011
 */
Class FabricaDAO 
{

	/**
	 * Mapa de classes instanciadas.
	 *
	 * @static
	 * @access private
	 * @var array
	 */
	private static $mapa = array();
	
	/**
	 * Tipo de implementação da classe controladora.
	 *
	 * @access public
	 * @static
	 * @var string
	 */
	private static $implementacao = "";
	
	
	/**
	 * Método fabrica a classe CategoriaDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	 
	public static function getEstabelecimentoDAO()
	{
		
		return self::fabricar("EstabelecimentoDAO");
		
	} 
	 
	public static function getEstoqueDAO()
	{
		
		return self::fabricar("EstoqueDAO");
		
	}
	
	
	public static function getNewsletterDAO()
	{
		
		return self::fabricar("NewsletterDAO");
		
	}
	
	
	public static function getTipoEstudanteDAO()
	{
		
		return self::fabricar("TipoEstudanteDAO");
		
	}
	
	
	public static function getAlunoDAO()
	{
		
		return self::fabricar("AlunoDAO");
		
	}
	
	
	public static function getBoletoDAO()
	{
		
		return self::fabricar("BoletoDAO");
		
	}
	
	public static function getVendasDAO()
	{
		
		return self::fabricar("VendasDAO");
		
	}
	
	
	public static function getValorDAO()
	{
		
		return self::fabricar("ValorDAO");
		
	}
	
	
	public static function getPropostaDAO()
	{
		
		return self::fabricar("PropostaDAO");
		
	}
	
	
	public static function getInformativoDAO()
	{
		
		return self::fabricar("InformativoDAO");
		
	}
	
	
	public static function getTipoacaoDAO()
	{
		
		return self::fabricar("TipoacaoDAO");
		
	}
	
	public static function getAcaoDAO()
	{
		
		return self::fabricar("AcaoDAO");
		
	}
	
	
	public static function getRadioDAO()
	{
		
		return self::fabricar("RadioDAO");
		
	}
	
	public static function getRelatorioDAO()
	{
		
		return self::fabricar("RelatorioDAO");
		
	}
	
	
	public static function getIndicacaoDAO()
	{
		
		return self::fabricar("IndicacaoDAO");
		
	}	
	
	
	public static function getVideoDAO()
	{
		
		return self::fabricar("VideoDAO");
		
	}	

	/**
	 * Método fabrica a classe LogCMSDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getLogCMSDAO()
	{
		
		return self::fabricar("LogCMSDAO");
		
	}
	
	/**
	 * Método fabrica a classe DepoimentoDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getDepoimentoDAO()
	{
		return self::fabricar("DepoimentoDAO");
	} 
	
	 
	public static function getAlbumDAO()
	{
		return self::fabricar("AlbumDAO");
	}
	
	
	public static function getFotoDAO()
	{
		return self::fabricar("FotoDAO");
	}
	
	
	public static function getComentarioDAO()
	{
		return self::fabricar("ComentarioDAO");
	}	
	
	/**
	 * Método fabrica a classe DesafioDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getPainelDAO()
	{
		return self::fabricar("PainelDAO");
	}		
	
	/**
	 * Método fabrica a classe UsuarioDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getUsuarioDAO()
	{
		return self::fabricar("UsuarioDAO");
	}	
	
	
	public static function getPacienteDAO()
	{
		return self::fabricar("PacienteDAO");
	}

	/**
	 * Método fabrica a classe PermissaoDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getPermissaoDAO()
	{
		return self::fabricar("PermissaoDAO");
	}		
	
    /**
	 * Método fabrica a classe NoticiaDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getNoticiaDAO()
	{
		return self::fabricar("NoticiaDAO");
	}
	
	/**
	 * Método fabrica a classe DestaqueDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getDestaqueDAO()
	{
		return self::fabricar("DestaqueDAO");
	}
	
	
	/**
	 * Método fabrica a classe ComentarioDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getTemplateDAO()
	{
		return self::fabricar("TemplateDAO");
	}
	
	
	/**
	 * Método fabrica a classe MensagemDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static 
	 */
	public static function getMensagemDAO()
	{
		return self::fabricar("MensagemDAO");
	}

    /**
	 * Método fabrica a classe InstituicaoDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getInstituicaoDAO()
	{

		return self::fabricar("InstituicaoDAO");

	}	
	
 	
    /**
	 * Método fabrica a classe CursoDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getCursoDAO()
	{

		return self::fabricar("CursoDAO");

	}		
	
    /**
	 * Método fabrica a classe AreaDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getAreaDAO()
	{
		return self::fabricar("AreaDAO");
	}		
	
    /**
	 * Método fabrica a classe InternautaDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getInternautaDAO()
	{
		return self::fabricar("InternautaDAO");
	}			
	
    /**
	 * Método fabrica a classe VeiculosDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 */
	public static function getVeiculosDAO()
	{
		return self::fabricar("VeiculosDAO");
	}		
	
    /**
	 * Método fabrica a classe FatorDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 */
	public static function getFatorDAO()
	{
		return self::fabricar("FatorDAO");
	}	
	
	
    /**
	 * Método fabrica a classe ConviteDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 */
	public static function getConviteDAO()
	{
		return self::fabricar("ConviteDAO");
	}		
	
	/**
	 * Método estático que irá instanciar as classes controladoras utilizando o método singleton.
	 *
	 * @static
	 * @param string $posicao
	 * @return $mapa[$posicao] Classe controladora
	 */
	private static function fabricar($posicao) 
	{
		if (!array_key_exists($posicao, self::$mapa)) 
		{
			$classe					= $posicao . self::$implementacao;
			self::$mapa[$posicao]	= new $classe();
		}
		return self::$mapa[$posicao];
	}
	
	/**
	 * Método fabrica a classe TopicoDAO.
	 * verifica se a classe já foi instanciada.
	 *
	 * @access public
	 * @static
	 */
	public static function getTopicoDAO()
	{
		return self::fabricar("TopicoDAO");
	}	
}
?>
