<?php
/**
 * Final Class Util com todas as funções que auxiliam no desenvolvimento.
 * @package classes
 * @subpackage application
 * @author Anderson Jesus <andersonajfs@gmail.com>
 * @final Util
 * @version 1.0
 * @since Janeiro/2011
 */
Final Class Util
{

	/**
	 * Atributo com o titulo do sistema, utilizando tanto no HTML, como em alguns envios de emails.
	 *
	 * @var string
	 */
   private static $tituloSistema = ".:: GRANDE RECIFE ::.";
   
	
	/**
	* Método para retornar a baseDir do sistema. 
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @return string $baseDir
	*/
	public static function baseDir()
	{
		$DIR_PORTAL = "";
		$DIR_PORTAL = $_SERVER['DOCUMENT_ROOT']."/camaragibe/";

		return $DIR_PORTAL;
	}
	
	/**
	* Método para retornar a baseUrl do sistema. 
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @return string $baseDir
	*/
	public static function baseUrl()
	{
		$baseUrl = "";
		$baseUrl = "http://localhost:8888/camaragibe/";

		return $baseUrl;
	}
	

	/**
	 * Método para retornar o titulo do sisetma
	 * @author Anderson Jesus <andersonajfs@gmail.com>
	 * @access public
	 * @return unknown
	 */
	public static function tituloSistema()
	{
		return self::$tituloSistema;
	}

	
	
	/**
	* Método para montagem dos parametros da consulta
	*
	* @param string $referencia
	* @param var $var
	* @param string $tipo
	* @return string[] $retorno
	**/
	public static function montaParametros($referencia, $var, $tipo= "STR")
	{
		$retorno = array("referencia" => $referencia,"valor" => $var, "tipo" => $tipo);
		return $retorno;
	}
	
	/**
	 *  Método para montar o embed do Youtube apartir da url do video
	 *
	 * @param string $url
	 * @param int $width
	 * @param int $height
	 * @return string
	 *
	**/
	public static function embedYoutube($url = "", $width = 520, $height = 344)
	{
		$retorno = "";
		if ($url != "" && strpos($url,"youtube") !== false)
		{
			$video = explode("?", $url);
			$tam = (strpos($video[1],"&") !== false) ? strpos($video[1],"&")-2 : strlen($video[1])-2;
			$video = substr($video[1],2,$tam);		
			$video = "http://www.youtube.com/v/".$video;	
			$retorno =  "<object width=\"$width\" height=\"$height\">
							<param name=\"movie\" value=\"".$video."\"></param>
							<param name=\"allowFullScreen\" value=\"true\"></param>
							<param name=\"allowscriptaccess\" value=\"always\"></param>
							<embed src=\"".$video."\" type=\"application/x-shockwave-flash\" 
							allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"$width\" height=\"$height\"></embed>
							</object>";
		}else
			$retorno = false;
			
		return $retorno;				
	}
	
	/**
	 * Método para buscar a imagem do video no youtube
	 *
	 * @param string $url
	 * @return string $retorno
	 *
	**/
	public static function getImageYoutube($url = "")
	{
		if ($url != "" && strpos($url,"youtube") !== false)
		{
			$video = explode("?", $url);
			$tam = (strpos($video[1],"&") !== false) ? strpos($video[1],"&")-2 : strlen($video[1])-2;
			$video = substr($video[1],2,$tam);		
			$result = @file_get_contents("http://img.youtube.com/vi/$video/default.jpg");
			if ( $result ) 
				$retorno = "<img src=\"http://img.youtube.com/vi/$video/default.jpg\" alt=\"\" width=\"120\" height=\"80\" />";
			else 
				$retorno = "<img src=\"".Util::baseUrl()."images/dummy-video.gif\" />";		
		}else
			$retorno = "<img src=\"".Util::baseUrl()."images/dummy-video.gif\" />";		
		
		return $retorno;	
	}
	
	
	// Recebe a data em americano e retorna o ano
	public static function pegaAnoData($data) {
	
		$string  = explode("-",$data);
		
		return $string[0];
	
	}
	
	
	public static function videoEmbed($video,$w,$h){
		
		$a = "<object width='$w' height='$h'>
			  <param name='movie' value='$video'></param>
			  <param name='allowFullScreen' value='true'></param>
			  <param name='allowscriptaccess' value='always'></param>
			  <embed src='$video' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='$w' height='$h'>
			  </embed>
			  </object>";
		return $a;
		
	}
	
	
   /**
	* Método para ajustar a data e hora.
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @static ajustarDataHora($dataHora)
	* @param string $dataHora no formato americano: YYYY-mm-dd hh:ii:ss
	* @return string $retorno no formato: dd/mm/YYYY hh:ii:ss 
	*/
	public static function ajustarDataHora($dataHora)
	{
	
		$separador	= explode(" ",$dataHora);
		$dataHora	= $separador[0];
		$ano		= substr($dataHora,0,4);
		$mes		= substr($dataHora,5,2);
		$dia		= substr($dataHora,8,2);
		$hora		= $separador[1];
		$hora		= substr($hora,0,strlen($hora)-3);
		$retorno	= $dia."/".$mes."/".$ano." - ".$hora;
		return $retorno;
		
	}	
	
   /**
	* Método para ajustar a data
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @static ajustarData($data)
	* @param string $data no formato americano: YYYY-mm-dd
	* @return string $retorno no formato: dd/mm/YYYY
	*/
	public static function ajustarData($data)
	{
	
		$separador	= explode(" ",$data);
		$data		= $separador[0];
		$ano		= substr($data,0,4);
		$mes		= substr($data,5,2);
		$dia		= substr($data,8,2);
		$data		= $dia."/".$mes."/".$ano;
		return $data;
	
	}
	
	
	// retorna o mes por extenso
	public static function mesExtenso($mes) {
	
		$arrayMes = array('Janeiro' , 'Fevereiro', 'Março'   , 'Abril', 
						  'Maio'    , 'Junho'    , 'Julho'   , 'Agosto', 
						  'Setembro', 'Outubro'  , 'Novembro', 'Dezembro');
		
		$mes = $mes - 1;
		return $arrayMes[$mes]; 
	}
	
	// restona data no formato: 'Dia'(Número) 'de' 'Mes'(Extenso)
	// Recebe a data do banco
	public static function dataExtenso($dataBanco) {
			
		$string = explode("-",$dataBanco);
		
		$mes = Util::mesExtenso($string[1]);
		
		return substr($string[2], 0, 2)." de ".$mes;	
			
	}
		
		
		
  /**
	* Método para ajustar a data e a hora para o formato do MySQL
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @static mysqlDataHora($datahora)
	* @param string $retorno no formato: dd/mm/YYYY hh:mm:00
	* @return string $data no formato americano: YYYY-mm-dd hh:mm:00
	*/
	public static function mysqlDataHora($datahora)
	{
	
		$ano		= substr($datahora,6,4);
		$mes		= substr($datahora,3,2);
		$dia		= substr($datahora,0,2);
		$hora		= substr($datahora,11,2);
		$minuto		= substr($datahora,14,2);
		$data		= $ano."-".$mes."-".$dia." ".$hora.":".$minuto.":00";
		return $data;
	
	}

	/**
	* Método para retirar acentos gráficos de uma string
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @static retiraAcento($palavra)
	* @param string $palavra 
	* @return string $retorno
	*/
	public static function retiraAcento($str)
	{
		$acento		= array(utf8_encode("á"),utf8_encode("é"),utf8_encode("í"),utf8_encode("ó"),utf8_encode("ú"),utf8_encode("â"),utf8_encode("ê"),utf8_encode("î"),utf8_encode("ô"),utf8_encode("û"),utf8_encode("ã"),utf8_encode("õ"),utf8_encode("ä"),utf8_encode("ë"),utf8_encode("ï"),utf8_encode("ö"),utf8_encode("ü"),utf8_encode("à"),utf8_encode("è"),utf8_encode("ì"),utf8_encode("ò"),utf8_encode("ù"),utf8_encode("ç"),utf8_encode("Á"),utf8_encode("É"),utf8_encode("Í"),utf8_encode("Ó"),utf8_encode("Ú"),utf8_encode("Â"),utf8_encode("Ê"),utf8_encode("Î"),utf8_encode("Ô"),utf8_encode("Û"),utf8_encode("Ã"),utf8_encode("Õ"),utf8_encode("Ä"),utf8_encode("Ë"),utf8_encode("Ï"),utf8_encode("Ö"),utf8_encode("Ü"),utf8_encode("À"),utf8_encode("È"),utf8_encode("Ì"),utf8_encode("Ò"),utf8_encode("Ù"),utf8_encode("Ç"));
		$semacento	= array("a","e","i","o","u","a","e","i","o","u","a","o","a","e","i","o","u","a","e","i","o","u","c","a","e","i","o","u","a","e","i","o","u","a","o","a","e","i","o","u","a","e","i","o","u","c");
		for($i=0;$i<sizeof($acento);$i++)
		{
		
			$str	= str_replace($acento[$i],$semacento[$i],$str);
			
		}
		return $str;
	}
	
	
	/**
	* Método para gerar um select ( combobox ).
	* Exemplo:
	* 
	* Chamada:
	*  Util::geraSelect("cmbStatus",array("0" => "Inativo","1" => "Ativo"),$objTipoImagem[0]->getStatus())?>
	* 
	* Combo Gerado:
	* <code>
    *
	* <select name="cmbStatus" id="cmbStatus">
	* 	<option value="0">Inativo</option>
	*   <option value="1" selected="selected">Ativo</option>
	* </select>
	* 
	* </code>
	* 
	* @author Anderson Jesus <andersonajfs@gmail.com>
	* @access public
	* @static geraSelect($nome,$itens,$selecionado)
	* @param string $nome  Nome e Id do combo
	* @param array  $itens Exemplo: <var> array("0" => "Inativo","1" => "Ativo") </var>
	* @param string $selecionado Valor do option que vai ficar selecionado
	* @param string $funcao Se o select precizar de uam função ela deve ser passada nesse campo. Exemplo: onchange=retornaAcoes();
	* @return string $select
	*/
	public static function geraSelect($nome,$itens,$selecionado,$funcao)
	{
		$select  = "<select name=\"$nome\" id=\"$nome\" $funcao>";
		
		foreach ( $itens as $value => $option ) 
		{
			$select .= "<option value=\"$value\""; 
			if($selecionado === $value) 
			$select .= " selected";
			$select .= " >$option</option>";
		}
		
		$select .= "</select>";

		return $select;
	}
	
	
	public static function Estados(){
		
		$estado[] = array("" => "SELECIONE");
		$estado[] = array("AC" => "Acre");
		$estado[] = array("AL" => "Alagoas");
		$estado[] = array("AP" => "Amap&aacute;");
		$estado[] = array("AM" => "Amazonas");
		$estado[] = array("BA" => "Bahia");
		$estado[] = array("CE" => "Cear&aacute;");
		$estado[] = array("DF" => "Distrito Federal");
		$estado[] = array("ES" => "Esp&iacute;rito Santo");
		$estado[] = array("GO" => "Goi&aacute;s");
		$estado[] = array("MA" => "Maranh&atilde;o");
		$estado[] = array("MT" => "Mato Grosso");
		$estado[] = array("MTS" => "Mato Grosso do Sul");
		$estado[] = array("MG" => "Minas Gerais");
		$estado[] = array("PA" => "Par&aacute;");
		$estado[] = array("PB" => "Para&iacute;ba");
		$estado[] = array("PR" => "Paran&aacute;");
		$estado[] = array("PE" => "Pernambuco");
		$estado[] = array("PI" => "Piau&iacute;");
		$estado[] = array("RJ" => "Rio de Janeiro");
		$estado[] = array("RN" => "Rio Grande do Norte");
		$estado[] = array("RS" => "Rio Grande do Sul");
		$estado[] = array("RO" => "Rond&ocirc;nia");
		$estado[] = array("RR" => "Roraima");
		$estado[] = array("SP" => "S&atilde;o Paulo");
		$estado[] = array("SC" => "Santa Catarina");
		$estado[] = array("SE" => "Sergipe");
		$estado[] = array("TO" => "Tocantins");
		
		return $estado;
		
	}
	
	public static function SelectsEstadoMunicipio($uf){
	  
	  $selectsestado = "<select name='uf' class='textonegrito'>
	                      <option value=''>SELECIONE</option>
                              <option value='AC' $submit >Acre</option>
                              <option value='AL' $submit>Alagoas</option>
                              <option value='AP' $submit>Amap&aacute;</option>
                              <option value='AM' $submit>Amazonas</option>
                              <option value='BA' $submit>Bahia</option>
                              <option value='CE' $submit>Cear&aacute;</option>
                              <option value='DF' $submit>Distrito Federal</option>
                              <option value='ES' $submit>Esp&iacute;rito Santo</option>
                              <option value='GO' $submit>Goi&aacute;s</option>
                              <option value='MA' $submit>Maranh&atilde;o</option>
                              <option value='MT' $submit>Mato Grosso</option>
                              <option value='MS' $submit>Mato Grosso do Sul</option>
                              <option value='MG' $submit>Minas Gerais</option>
                              <option value='PA' $submit>Par&aacute;</option>
                              <option value='PB' $submit>Para&iacute;ba</option>
                              <option value='PR' $submit>Paran&aacute;</option>
                              <option value='PE' $submit>Pernambuco</option>
                              <option value='PI' $submit>Piau&iacute;</option>
                              <option value='RJ' $submit>Rio de Janeiro</option>
                              <option value='RN' $submit>Rio Grande do Norte</option>
                              <option value='RS' $submit>Rio Grande do Sul</option>
                              <option value='RO' $submit>Rond&ocirc;nia</option>
                              <option value='RR' $submit>Roraima</option>
                              <option value='SP' $submit>S&atilde;o Paulo</option>
                              <option value='SC' $submit>Santa Catarina</option>
                              <option value='SE' $submit>Sergipe</option>
                              <option value='TO' $submit>Tocantins</option>
	                </select>";
	      return $selectsestado;
      }
	
	/**
	 * Classe para tratamento de erro na camada de dados. Um e-mail será enviado para o analista responsável
	 * e uma mensagem mais amigavel será exibida para o usuário final.
	 *
	 * @author Anderson Jesus <andersonajfs@gmail.com>
	 * @param string $sistema <Nome do sistema>
	 * @param string $msgErro <Erro gerado pelo banco>
	 * @param string $txtSql  <Instrução SQL que o sistema tentou executar>
	 * @param string $arquivo <nome do arquivo>
	 * @param string $classe  <nome da classe>
	 * @param string $metodo  <nome do método>
	 * @param int $linha <número da linha>
	 * @return string
	 */
	public static function trataErroDB($msgErro,$txtSql,$arquivo,$classe,$metodo,$linha)
	{
		$texto = "<html><head><title>".Util::tituloSistema()."</title></head><body>
		<table><tr><td>
		Caro Sr. Analista,<br /><br />
		O sistema <b>- ".Util::tituloSistema()." -</b> emitiu a seguinte mensagem de erro: <br /><br />
		<b>Data    :</b> ".@date('d/m/Y H:i:s')."<br />
		<b>Mensagem:</b> ".$msgErro."<br />
		<b>Txt SQL :</b> ".$txtSql."<br />
		<b>Arquivo :</b> ".$arquivo."<br />		
		<b>Classe  :</b> ".$classe."<br />
		<b>Método  :</b> ".$metodo."<br />		
		<b>Linha   :</b> ".$linha."<br /><br />				
		Atenciosamente,<br />
		Classe Util - Método trataErroDB <br />
		</td></tr></table>
		<div class=\"footer\" align=\"center\">
		        <div align=\"center\">
		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr><td colspan=\"3\" align=\"right\">&nbsp;&nbsp;&nbsp;</td></tr>
		        <tr align=\"center\">
		          <td width=\"20%\"></td>
		          <td width=\"45%\"></td>
		          <td width=\"25%\"><div></div></td>
		        </tr>
		      </table>
		        </div>
		</div>
		</body></html>";
		$headers	 = "MIME-Version: 1.0\n"; 
		$headers	.= "Content-Type: text/html; cahrset=\"ISO-8859-1\"\n";
		$headers	.= "From: andersonajfs@gmail.com\r\n";
   
		
		#mail("anderson@in.teracao.com","ERRO DB - ".Util::tituloSistema(),$texto,$headers);		
		
		
		#$msgUsuario = "Um erro foi detectado durante a sua operacao. Um e-mail já foi enviado para o analista responsavel que em breve estará resolvendo o ocorrido <br />".$texto;
		$msgUsuario = $texto;
		
		return $msgUsuario;
	}
	
	/**
	 * Método estático para verificar os campos vazios nos métodos das listagens.
	 * Como usar: <code>verficaCampo($condicao,"WHERE")</code>
	 * @param string $campo
	 * @param string $string
	 * @return string $campo
	 */
	public static function verificaCampo($campo,$string)
	{
		
		if($campo !== "")
		{
			
			$campo	= $string." ".$campo;
			
		}
		return $campo;
		
	}
	
	/**
	 * Método que irá tirar todos os caracteres especiais da string;
	 *
	 * @access public
	 * @static 
	 * @param string $string
	 * @return $string
	 */
	public static function trataCaracteres($string)
	{
	
		
		$string	= str_replace("INSERT","",$string);
		$string	= str_replace("insert","",$string);
		$string	= str_replace("DELETE","",$string);
		$string	= str_replace("delete","",$string);		
		$string	= str_replace("ALTER","",$string);
		$string	= str_replace("alter","",$string);		
		$string	= str_replace("DROP","",$string);
		$string	= str_replace("drop","",$string);		
		$string	= str_replace("TRUNCATE","",$string);
		$string	= str_replace("truncate","",$string);		
		$string	= str_replace("SELECT","",$string);
		$string	= str_replace("select","",$string);	
		$string	= strip_tags($string);
		return $string; 
		
	}	
	
	/**
	 * Método estático que formatará a data para o formato de banco de dados.
	 *
	 * @access public
	 * @static 
	 * @param timestamp $dataHora
	 * @return timestamp
	 */
	public static function dataHoraParaBanco($dataHora)
	{
		
		$data			= explode(" ",$dataHora);
		$ano			= substr($data[0],6,4);
		$mes			= substr($data[0],3,2);
		$dia			= substr($data[0],0,2);
		$hora			= substr($data[1],0,2);
		$minuto			= substr($data[1],3,2);
		$segundo		= substr($data[1],6,2);
		$array['data']	= $ano."-".$mes."-".$dia;
		$array['hora']	= $hora.":".$minuto.":".$segundo;
		return $array;
		
		
	}
	
	/**
	 * Método estático que formatará a data para o formato de banco de dados.
	 *
	 * @access public
	 * @static 
	 * @param date $data
	 * @return date
	 */
	public static function dataParaBanco($data)
	{
		
		$ano			= substr($data,6,4);
		$mes			= substr($data,3,2);
		$dia			= substr($data,0,2);
		$dataFormatada	= $ano."-".$mes."-".$dia;
		return $dataFormatada;
		
	}
		
	/**
	 * Método estático que formatará a data para o formato de exibição (HTML).
	 *
	 * @access public
	 * @static 
	 * @param timestamp $dataHora
	 * @return timestamp
	 */
	public static function dataHoraParaHtml($dataHora)
	{
		
		$data			= explode(" ",$dataHora);
		$ano			= substr($data[0],0,4);
		$mes			= substr($data[0],5,2);
		$dia			= substr($data[0],8,2);
		$hora			= substr($data[1],0,2);
		$minuto			= substr($data[1],3,2);
		$segundo		= substr($data[1],6,2);
		$array['data']	= $dia."/".$mes."/".$ano;
		$array['hora']	= $hora.":".$minuto."h";
		return $array;
		
	}
	
	/**
	 * Método estático que formatará a data para o formato americano.
	 *
	 * @access public
	 * @static
	 * @param timestamp $dataHora
	 * @return timestamp
	 */
	public static function dataHoraAmericana($dataHora)
	{

		$data			 = explode(" ",$dataHora);
		$ano			 = substr($data[0],0,4);
		$mes			 = substr($data[0],5,2);
		if($mes<10) $mes = substr($data[0],6,1);
		$dia			 = substr($data[0],8,2);
		$hora			 = substr($data[1],0,2);
		$minuto			 = substr($data[1],3,2);
		$segundo		 = substr($data[1],6,2);
        $nome_do_mes = array("-","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
        $array = "".$nome_do_mes[$mes]." ".$dia.", ".$ano." at ".$hora.":".$minuto."";
		return $array;

	}
	
/**
	 * Método estático que formatará a data para o formato de exibição (HTML).
	 *
	 * @access public
	 * @static 
	 * @param timestamp $dataHora
	 * @return timestamp
	 */
	public static function dataHoraParaHtml2($dataHora)
	{
		
		$data			= explode(" ",$dataHora);
		$ano			= substr($data[0],0,4);
		$mes			= substr($data[0],5,2);
		$dia			= substr($data[0],8,2);
		$hora			= substr($data[1],0,2);
		$minuto			= substr($data[1],3,2);
		$segundo		= substr($data[1],5,2);
		$mesExt = "";
		switch($mes)
		{
			
			case "01":
				
				$mesExt = "Janeiro";	
				
			break;
			case "02":
				
				$mesExt = "Fevereiro";
				
			break;
			case "03":
				
				$mesExt = "Março";
				
			break;
			case "04":
				
				$mesExt = "Abril";
								
			break;
			case "05":
				
				$mesExt = "Maio";
				
			break;
			case "06":
				
				$mesExt = "Junho";
				
			break;
			case "07":
				
				$mesExt = "Julho";
				
			break;
			case "08":
				
				$mesExt = "Agosto";
				
			break;
			case "09":
				
				$mesExt = "Setembro";
								
			break;
			case "10":
				
				$mesExt = "Outubro";				
				
			break;
			case "11":
				
				$mesExt = "Novembro";
				
			break;
			case "12":
				
				$mesExt = "Dezembro";
				
			break;
			
		}
		$array['dia']		= $dia;
		$array['mesExt']	= $mesExt;
		$array['mes']		= $mes;
		$array['ano']		= $ano;
		$array['hora']		= $hora;
		$array['minuto']	= $minuto;
		$array['segundo']	= $segundo;
		return $array;
		
	}

	public static function aplica_ereg($palavra) {
        $temp = "";
        for($i=0;$i<strlen($palavra);$i++) {
        $temp.=$palavra[$i]."(".$palavra[$i].")*";
        }
		return "^(".$temp.")$";
		
	}
	public static function elimina_pontuacao($palavra){
	        $temp = "";
	        for($i=0;$i<strlen($palavra);$i++) {
	        if((ord($palavra[$i])>47) && (ord($palavra[$i])!=63) && (ord($palavra[$i])!=58) && (ord($palavra[$i])!=59) && !((ord($palavra[$i])>=123) && (ord($palavra[$i])<=191))) {
	        $temp.= $palavra[$i];
	                }
	        }
		return $temp;
	}
	
	/**
	 * Método para verificar o cpf digitado é valido. Está sendo usado no cadastro de Usuários.
	 *
	 * @author Anderson Jesus <andersonajfs@gmail.com>
	 * @param int $cpf
	 * @return boolean
	 */
	public static function validaCPF($cpf)
  	{
  		$cpf_limpo = "";
		$tam_cpf = strlen($cpf);
		for ($i=0; $i<$tam_cpf; $i++)
		{
			$carac = substr($cpf, $i, 1);
			// verifica se o codigo asc refere-se a 0-9
			if (ord($carac)>=48 && ord($carac)<=57) $cpf_limpo .= $carac;
		}

		if (strlen($cpf_limpo)!=11) return false;

		// achar o primeiro digito verificador
		$soma = 0;
		for ($i=0; $i<9; $i++)
			$soma += (int)substr($cpf_limpo, $i, 1) * (10-$i);
		
		if ($soma == 0)	return false;
		
		$primeiro_digito = 11 - $soma % 11;
		
		if ($primeiro_digito > 9) $primeiro_digito = 0;
		
		if (substr($cpf_limpo, 9, 1) != $primeiro_digito) return false;
		
		// acha o segundo digito verificador
		$soma = 0;
		for ($i=0; $i<10; $i++)
			$soma += (int)substr($cpf_limpo, $i, 1) * (11-$i);
		
		$segundo_digito = 11 - $soma % 11;
		
		if ($segundo_digito > 9) $segundo_digito = 0;
		
		if (substr($cpf_limpo, 10, 1) != $segundo_digito) return false;
		
		return true;
		
	}
	
	public static function retiraAcentoCategoria($str)
	{

		$acento		= array("º","ª","á","é","í","ó","ú","â","ê","î","ô","û","ã","ñ","õ","ä","ë","ï","ö","ü","à","è","ì","ò","ù",".",",",":",";","...","ç","%","?","/","\\","”","“","'","!","@","#","$","&","*","(",")","+","=","{","}","[","]","|","<",">");
		$semacento	= array("","","a","e","i","o","u","a","e","i","o","u","a","n","o","a","e","i","o","u","a","e","i","o","u","","","","","","c","_porcento","","","","\"","\"","","","","","","","","","","","","","","","","","","","","","");
		$str		= strtolower($str);
		for($i=0;$i<sizeof($acento);$i++)
		{
		
			$str	= str_replace($acento[$i],$semacento[$i],$str);
			
		}
		return $str;
		
	}

	public static function html_scape($strIn) {
	    $arr_procura = array ('&ldquo;','&rdquo;','&amp;','&ordf;','&Agrave;','&Aacute;','&Eacute;','&Otilde;','&Oacute;','&Uacute;','&Iacute;','&Atilde;','&Ccedil;','&aacute;','&agrave;','&atilde;', '&acirc;', '&auml;', '&otilde;','&oacute;', '&ograve;','&ocirc;','&egrave;','&eacute;', '&ecirc;','&euml;','&igrave;', '&iacute;','&iuml;','&uuml;','&uacute;','&ccedil;','&ndash;','&quot;','&ordm;','&nbsp;','&#63;','&ntilde;','&Ntilde;');
	    $arr_troca   = array ('"','"','e','º','À','Á','É','Õ','Ó','Ú','Í','Ã','Ç','á','à','ã','â','ä','õ','ó','ò','ô','è','é','ê','ë','ì','í','ï','ü','ú','ç','-','"','º',' ','?','ñ','Ñ');
	    return str_replace($arr_procura, $arr_troca, $strIn);
	}

	/**
	* Função para retirar os caracteres especiais
	*
	* @param	$Str				[string]	conteudo de qualquer variavel
	* @return	$Str				[string]	conteudo sem caracteres especiais
	*/
	public static function retiraCaracteres($Str="") {
		$ComAcento = array
			("á","à","ã","â","é","è","ê","ë","í","ì","î","ï","ó","ò","õ","ô","ú","ù","û","ü","ç",
				"Á","À","Ã","Â","É","È","Ê","Í","Ì","Î","Ó","Ò","Ô","Õ","Ú","Ù","Û","Ç","~","^",
				"´","`","[","]","º","ª",",","(",")","\"","'","\\","--",1,2,3,4,5,6,7,8,9,0,"."," ","?","¬");
		$SemAcento = array
			("a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","c",
				"A","A","A","A","E","E","E","I","I","I","O","O","O","O","U","U","U","C"," "," ",
				" "," ","-","-",".",".","","-","-","”"," ","\\","-"," ","","","","","",
					"","","","","","-","-","");
		$Str = str_replace ($ComAcento, $SemAcento, $Str);
		
		return $Str;
	}
	
	public static function SoNumeros($Numero) 
	{ 
		return (eregi('^[0-9]+$',trim($Numero))); 
	}

	public static function selectAnos($start = "", $qtd = 5)
	{
		if ($start == "") $start = date('Y');
		$selectAno = array();
		$ano = $start; //date("Y") + 1;
		for($i = 0; $i < $qtd; $i++) 
			$selectAno[] = array($ano-$i => $ano-$i);
			
		return $selectAno;
	}
	
	
	public static function quebraLinha($parQuebra){
		$parQuebra = wordwrap($parQuebra, 90, "<br/>\n", true);
		return $parQuebra;
	}
	
	
	//Funcao para redimensionar imagem -  a imagem vai ser menor que o x_max e y_max
	public static function reduz_imagem($img, $x_max, $y_max, $nome_foto, $tipo="image/jpeg") {

		list($width, $height) = getimagesize($img);
		
		$x_orig = $width;
		$y_orig = $height;
		
		$x_perc = (100 * $x_max) / $x_orig;
		$y_perc = (100 * $y_max) / $y_orig;
		
		if ($x_perc < $y_perc){
		
			$porc = $x_perc;
		}else{
			$porc = $y_perc;
		}
		
		$x_novo = $x_orig * ($porc / 100);
		$y_novo = $y_orig * ($porc / 100);
		
		$imagem_pt = imagecreatetruecolor($x_novo, $y_novo);
		
		//$imagem   = imagecreatefromjpeg($img);
		
		switch($tipo){
		   case 'image/jpeg':
		   $imagem = imagecreatefromjpeg($img);
		   break;
		   case 'image/gif';
		   $imagem = imagecreatefromgif($img);
		   break;
		   case 'image/png':
		   $imagem = imagecreatefrompng($img);
		   break;
		   case 'image/pjpeg':
		   $imagem = imagecreatefromjpeg($img);
		   break;
		   case 'image/x-png':
		   $imagem = imagecreatefrompng($img);
		   break;
		   default:
			return false;   
		   break;   
		} 

		imagecopyresampled($imagem_pt, $imagem, 0, 0, 0, 0, $x_novo, $y_novo, $width, $height);
		
		imagejpeg($imagem_pt, $nome_foto, 100);

	}

}
?>