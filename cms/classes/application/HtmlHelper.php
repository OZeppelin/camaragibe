<?php

class HtmlHelper
{
	private $html;	
	
	/**
	 * @desc  GRID: Monta datagrid a partir do resultado do mysql_fetch_array
	 * 
	 * @var $arrObj array
	 */
	static function show_grid($arrObj, $idname = '', $link = false, $editar = true, $delete = false, $objPaginacao = null){
		
		$link_editar = ""; //__URL . __CONTROLLER;
		$title = array_keys($arrObj[0]);
		if ( count($arrObj) > 0 ):
			
			$html = "<form action=\"$delete\" method=\"post\" onsubmit=\"return enviaFormDelete('id');\">";
			$html .= '<table class="tablesorter" id="tb_lista">';
			$html .= "<thead><tr>";
			if ($delete) $html .= "<th class=\"center\"><input type=\"checkbox\" onclick=\"selectAll(this, 'tb_lista', '{$idname}[]')\" /></th>";
			foreach ($title as $key => $value)
			{ 
				if ($key != $idname)
					$html .= "<th><span><em>" . $value . "</em></span></th>";
			}	
			
			if ($editar)
				$html .= "<th class=\"center\"><span><em>Editar</em></span></th>";
			if ($delete)
				$html .= "<th class=\"center\"><span><em>Deletar</em></span></th>";
				
			$html .= "</tr></thead>";
			$html .= '<tbody>';
			foreach ($arrObj as $key => $value) :
				
				$value = (array)$value;
				
				$html .= '<tr class="li_lista">';
				
				if ($delete) $html .= "<td class=\"center\"><input type=\"checkbox\" name=\"{$idname}[]\" value=\"{$value[$idname]}\" /></td>";
				
				foreach ($value as $key => $value2) :
					
					if ($key != $idname) :
						//$value2 = ( strlen($value2) > 100) ? substr($value2,0,100).'...' : $value2;
						
						if (!$link) :
							$html .= "<td>$value2</td>";
						else:
							$html .= "<td><a href=\"$link&id={$value[$idname]}\">".$value2."</a></td>";
						endif;
					endif;
					
				endforeach;
				
					if($editar)
						$html .= "<td><a href=\"$link&id={$value[$idname]}\" class=\"editar\" title=\"editar\">&nbsp;</a></td>";
					if ($delete)
	    				$html .= "<td><a href=\"$delete&id={$value[$idname]}\" class=\"excluir bt-excluir\" title=\"excluir\">&nbsp;</a></td>";
				
				$html .= '</tr>';
				
			endforeach;
			
			$html .= '</tbody>';
			
			$html .= '</table><div class="acoes-table">';
				if ($delete) $html .= '<input type="submit" id="deletar" name="deletar" value="Deletar >>" />';
				if (!is_null($objPaginacao)) $html .= $objPaginacao->links();
			$html .= '</div></form>';
			
		else :
			$html = '';
		endif;
		
		return $html;
	}
	
	/**
	 * @desc  GRID: Monta datagrid a partir do resultado do mysql_fetch_array
	 * 
	 * @var $arrObj array
	 */
	static function show_grid_exibicao($arrObj, $link = false)
	{
		$title = array_keys($arrObj[0]);
		if ( count($arrObj) > 0 ):
			$html  = '<table class="tablegrid" id="tb_lista">';
			$html .= "<thead><tr>";
			foreach ($title as $key => $value)
			{ 
				$html .= "<th><span><em>" . $value . "</em></span></th>";
			}	
			$html .= "</tr></thead>";
			$html .= '<tbody>';
			foreach ($arrObj as $key => $value) :
				$value = (array)$value;
				$html .= '<tr class="li_lista">'; 
				foreach ($value as $key => $value2) :
					if (!$link) :
						$html .= "<td>".$value2."</td>";
					else:
						$html .= "<td><a href=\"$link\">".$value2."</a></td>";
					endif;
				endforeach;
				$html .= '</tr>';
			endforeach;
			$html .= '</tbody>';
			$html .= '</table>';
		else :
			$html = '';
		endif;
		return $html;
	}	
	
	


	static function show_grid_ordem($arrLinhas)
	{
		$ordem = '';
		$html  = "<table class=\"tablesorter\" id=\"tb_list-1\" width=\"100%\">";
		$html .= "<thead><tr>";
		$html .= "<th><span><em>Descrição</em></span></th>";
		$html .= "</tr></thead>";		
		foreach ($arrLinhas as $linha) 
		{
			$ordem .= $linha["id"].' ';
 	 		$html .= "<tr onmouseover=\"color(this)\" 
						onmouseout=\"colorBranco(this)\" 
						style=\"border-bottom:1px #999999 solid;cursor: move;\" 
						id=\"".$linha["id"]."\">";
			$html .= "<td style=\"border-bottom:1px #999999 solid; color:#496678\">";
    		$html .= $linha['nome'];
		    $html .= "<input type=\"hidden\" name=\"cod[]\" value=\"".$linha['id']."\"/>";
    		$html .= "</td></tr>";
   		}
		$html .= "</table>";
		$html .= "<input type=\"hidden\" name=\"ordem\" id=\"ordem\" value=\"".trim($ordem)."\"/>";
		return $html;
	}

	/**
	 * @desc retirna a tag option com validacao jquery
	 * @var
	 * @return tag form formatada
	*/
	static function form_post( $action = '', $validar = array(), $attr = array() ){

		$attr_str = '';
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\" ";
		if ( !empty($validar) ) :
		
			$validar = implode(',', $validar);
			$validar = 'onsubmit="return validarForm(\'' . $validar . '\')"';
		endif;
		
		$html = "<form action=\"$action\" method=\"post\" enctype=\"multipart/form-data\" $attr_str $validar>";
		
		return $html;
	}
	
	
	
	/**
	 * @desc File: exibe um input file
	 * @var 
	 * @return input file formatado
	 *
	 */	
	 static function input_file($label = "", $name = "", $dirImagem=null, $attr = array())
	 {
		$html = "";
		if($dirImagem!=null)
		{
			$html .= '<img src="'.$dirImagem.'" id="img_'.$name.'" />';
			$html .= "<br>";			
		}
		$attr_str = '';
		
		if($label == "Imagem")
			$label = "<img src='public/images/layout/icon-picture.png' style='position:relative; bottom:-6px;'  /> &nbsp;&nbsp;".$label;	
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\" ";
		$html .= '<label>'.$label.'</label>';		
		$html .= '<input type="file" name="'.$name.'" '.$attr_str.'/>';		
		return $html;
	}

	/**
	 * @desc TEXT: exibe um input text formatado
	 * @var 
	 * @return input text formatado
	 *
	 */	
	 static function input_text($label, $name, $value = false, $length = false, $attr = array(),$special_box = false){
		
		$attr_str = '';
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		
		if ($value !== false) $value = "value='$value'";
		
		if ($length !== false) $length = "maxlength=\"$length\"";
		$html = (!$special_box) ? '<label>'.$label.'</label>': '<li><label class="left">'.$label.'</label>';
		$html .= '<span class="box-inp">											
						<span class="tl">&nbsp;</span>
						<span class="bl">&nbsp;</span>		
									
						<input type="text" name="' . $name . '" id="' . $name . '" ' . $value . ' ' . $length . ' ' . $attr_str . '/>
										
						<span class="tr">&nbsp;</span>
						<span class="br">&nbsp;</span>
					</span>';
		$html .= ($special_box) ? "</li>" : "";
		return $html;
	}
	
	static function input_text_for($label, $name,$id, $value = false, $length = false, $attr = array(),$special_box = false){
		
		$attr_str = '';
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		
		if ($value !== false) $value = "value='$value'";
		
		if ($length !== false) $length = "maxlength=\"$length\"";
		$html = (!$special_box) ? '<label>'.$label.'</label>': '<li><label class="left">'.$label.'</label>';
		$html .= '<span class="box-inp">											
						<span class="tl">&nbsp;</span>
						<span class="bl">&nbsp;</span>		
									
						<input type="text" name="' . $name . '" id="' . $id . '" ' . $value . ' ' . $length . ' ' . $attr_str . '/>
										
						<span class="tr">&nbsp;</span>
						<span class="br">&nbsp;</span>
					</span>';
		$html .= ($special_box) ? "</li>" : "";
		return $html;
	}
	
	
	
	/**
	 * @desc TEXTAREA: exibe um textarea formatado
	 * @var 
	 * @return textarea formatado
	 *
	 */	
	static function textarea($label = "",$name = "", $value = false, $attr = array()){
		
		$attr_str = '';
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		$html = '<label>'.$label.'</label>';
		$html .= '<span class="box-inp">	
						<span class="tl">&nbsp;</span>
						<span class="bl">&nbsp;</span>		
									
						<textarea name="' . $name . '"  id="' . $name . '" rows="8" cols="40"' . $attr_str . '>' . $value . '</textarea>
										
						<span class="tr">&nbsp;</span>
						<span class="br">&nbsp;</span>
					</span>';
		
		return $html;
	}
	

	/**
	 * @desc RADIO : exibe um radio button formatado
	 * @var 
	 * @return radio button formatado
	 *
	 */	
	public static function input_radio($name, $value = false, $attr = array()){
		
		$attr_str = '';
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		
		if ($value !== false) $value = "value=\"$value\"";
		
		$html = '<input name="'.$name.'" type="radio" '.$value.' ' . $attr_str . ' />';
		
		return $html;
	}		
	
	/**
	 * @desc PASSWORD: exibe um input password formatado
	 * @var 
	 * @return input password formatado
	 *
	 */
	
	 static function input_password($label, $name, $value = false, $length = false, $attr = array(), $special_box = false){
		
		$attr_str = '';
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		
		if ($value !== false) $value = "value=\"$value\"";
		
		if ($length !== false) $length = "maxlength=\"$length\"";
		$html = (!$special_box) ? '<label>'.$label.'</label>': '<li><label class="left">'.$label.'</label>';
		$html .= '<span class="box-inp">											
						<span class="tl">&nbsp;</span>
						<span class="bl">&nbsp;</span>		
						
							<input type="password" name="' . $name . '" id="' . $name . '" ' . $value . ' ' . $length . ' ' . $attr_str . '/>										
							
						<span class="tr">&nbsp;</span>
						<span class="br">&nbsp;</span>
					</span>';
		$html .= ($special_box) ? "</li>" : "";
		return $html;
	}
	
	
	/**
	 * @desc retorna o action do form
	 * @var $destino a acao de destino
	 * @return caminho do action
	 */
	static function link($destino)
	{
		if ( is_string($destino) and !strpos($destino, '@') ) :
			//return __URL . __CONTROLLER . '/' . $destino;
			return $destino;
		endif;
	}		

	
	/**
	 * Metodo estatico para criacao de SELECT
	 *
	 * @param string $label
	 * @param string $name
	 * @param string[] $dados['value' => desc]	
	 * @param string[] $attr[]
	 * @return string $html
	**/

	static function select($label = "", $name = "", $dados = array(), $selected = "" , $attr = array())
	{
		$attr_str = "";
		$html     = "";
		
		foreach ($attr as $k => $v) $attr_str .= "$k=\"$v\"";
		$html  = '<label>'.$label.'</label>';
		$html .= "<select name=".$name." id=".$name." ".$attr_str.">";
		foreach ($dados as $sel)
		{
			foreach ($sel as $id => $value)
			{
				if ($id == $selected)
					$html .= "<option value='".$id."' selected>".$value."</option>";
				else
					$html .= "<option value='".$id."'>".$value."</option>";
			}
		}
		$html .= "</select>";
		return $html;
	}
	
	
	
	/**
	 * @desc HIDDEN: exibe input tipo hidden
	 * @var
	 * @return input hidden
	 *
	 */	
	static function input_hidden($name, $value = false){
		
		$html = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . $value . '" />';
		
		return $html;
	}
}