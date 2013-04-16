<?php
class Paginacao{

	public $inicio;
	
	public $tamanho_pagina;
	
	public $total_paginas;
	
	public $num_total_registros;
	
	public $pagina;
	
	public $links;
	
	public function __construct($tamanho = 20, $total_registros = 0, $links = "")
	{
		$this->tamanho_pagina = $tamanho;	
		$this->num_total_registros = $total_registros;
		$this->links = $links;
	}
	
	public function setTamanhoPagina($tamanho)
	{
		$this->tamanho_pagina = $tamanho;	
	}
	
	public function paginar($pagina)
	{
		# examino a página a mostrar e o inicio do registro a mostrar 
		$this->pagina = $pagina; 
		if (!$this->pagina) 
		{ 
			$this->inicio = 0; 
			$this->pagina=1; 
		} 
		else 
		{ 
			$this->inicio = ($this->pagina - 1) * $this->tamanho_pagina; 
		} 
		
		
		#calculo o total de páginas 
		$this->total_paginas = ceil($this->num_total_registros / $this->tamanho_pagina); 
		# ponho o número de registros total, o tamanho de página e a página que se mostra
	}
	
	public function links()
	{	
		$add = 0; $sub = 0; $retorno = ""; $reg = 0;
		# mostro os diferentes índices das páginas, se que há várias páginas
		if ($this->total_paginas> 1)
		{ 
			$retorno = "<dl class='paginacao'>";
			/* Primeira Página */
			// if($this->pagina>2)
				// $retorno .= "<dd><a  href=\"index.php?i=".$this->links."&pagina=1\" title=\"Primeira\">&lt;&lt;</a></dd>";
				
			if($this->pagina>1)
				$retorno .= '<dd class="fix"><a href="index.php?i='.$this->links.'&pagina='.($this->pagina-1).'" class="retroceder" title="Página anterior">Retroceder</a></dd>';
			
			/* Numero das páginas*/
			for ($i=1;$i<=$this->total_paginas;$i++)
			{ 
			   # utilizado para manter sempre 10 elementos caso exista
			   $sub=0;
			   if($i>=$this->total_paginas - 10)   # PÁGINAS A ESQUERDA
				 $sub = $i   ;
			   # -----------------------------------------------------							 
				   if ($this->pagina == $i)
				   {
					  # se mostro o índice da página atual, não coloco link
					  $retorno .= "<dd> <a class='active'>". $this->pagina . "</a> </dd>";
  				      # utilizado para manter sempre 10 elementos caso exista
					  $add=0;
					  if($i<=5)      # PáGINAS A DIREITA
						$add = 5 - $i;							
					  # -----------------------------------------------------	

				   }
				   else if($i >= $this->pagina -5-$sub && $i < $this->pagina +6+$add)
				   {
					  # se o ándice não corresponde com a p�gina mostrada atualmente, coloco o link para ir a essa página
					  $retorno .= "<dd><a href='index.php?i=".$this->links."&pagina=" . $i  . "' >" . $i . "</a> </dd>";
				   }
			}			
			
			if($this->pagina < $this->total_paginas)
				$retorno .= "<dd class='fix'><a href=\"index.php?i=".$this->links."&pagina=".($this->pagina+1)."\" class='avancar' title='Próxima página'>Avancar</a></dd>";
			
			/* Ultima pagina */
			 // if($this->pagina < $this->total_paginas-1)
				 // $retorno .= "<dd class=\"ultima\"> <a  href=\"index.php?i=".$this->links."&pagina=".($this->total_paginas)."\" title=\"&Uacute;ltima\">&gt;&gt;</a></dd>";			
			
			$retorno .= "</dl>";	
			
			$retorno .= "<p class='select'>";
			$reg = ($this->pagina > 1) ? $this->pagina+$this->tamanho_pagina-1: 1; 
			$total_reg = ($this->num_total_registros < ($this->pagina*$this->tamanho_pagina)) ? $this->num_total_registros : ($this->pagina*$this->tamanho_pagina);
			$retorno .= "<strong>".$reg." - ".$total_reg." de ".$this->num_total_registros."</strong>";
			$retorno .= "</p>";
			
			
		} //fim primeiro if
		return $retorno;
	}
	
	public function links_portal()
	{	
		$retorno = "";
		if(	$this->tamanho_pagina <	$this->num_total_registros)
		{
			$add = 0; $sub = 0; $retorno = ""; $reg = 0;
			# mostro os diferentes índices das páginas, se que há várias páginas
			if ($this->total_paginas > 1)
			{ 
				$retorno = "<ul>";
				/*
				# Primeira Página 
				if($this->pagina>2)
					$retorno .= "<li><a  href=\"index.php?i=".$this->links."&pagina=1\" title=\"Primeira\">&lt;&lt;</a></li>";
				*/	
				if($this->pagina>1)
					$retorno .= '<li><a href="index.php?i='.$this->links.'&pagina='.($this->pagina-1).'" title="Página anterior">&lt;&lt;</a></li>';
				
				# Numero das páginas
				for ($i=1;$i<=$this->total_paginas;$i++)
				{ 
					# utilizado para manter sempre 10 elementos caso exista
					$sub=0;

					# PÁGINAS A ESQUERDA
					if($i>=$this->total_paginas - 10)   
						$sub = $i;

					if ($this->pagina == $i)
					{
						# se mostro o índice da página atual, não coloco link
						$retorno .= "<li><a class='active'>". $this->pagina . "</a></li>";
						
						# utilizado para manter sempre 10 elementos caso exista
						$add=0;
						
						# PáGINAS A DIREITA
						if( $i <= 5 )     
							$add = 5 - $i;							
					}
					else if($i >= $this->pagina -5-$sub && $i < $this->pagina +6+$add)
					{
						# se o ándice não corresponde com a p�gina mostrada atualmente, coloco o link para ir a essa página
						$retorno .= "<li><a href='index.php?i=".$this->links."&pagina=" . $i  . "' >" . $i . "</a> </li>";
					}
				}			
				
				if($this->pagina < $this->total_paginas)
					$retorno .= "<li><a href=\"index.php?i=".$this->links."&pagina=".($this->pagina+1)."\" title='Próxima página'>Avancar</a></li>";
				
				/*
				# Ultima pagina 
				if($this->pagina < $this->total_paginas-1)
					$retorno .= "<li> <a  href=\"index.php?i=".$this->links."&pagina=".($this->total_paginas)."\" title=\"&Uacute;ltima\">&gt;&gt;</a></dd>";			
				*/
				$retorno .= "</ul>";	
			} //fim primeiro if
		}	
		return $retorno;
	}
	
	public function getTamanho_pagina()
	{
		return $this->tamanho_pagina;
	}

	public function setTamanho_pagina( $tamanho_pagina )
	{
		$this->tamanho_pagina = $tamanho_pagina;
	}
	
	public function getOffset()
	{
		$offset = ($this->pagina != 0) ? ($this->pagina*$this->tamanho_pagina)-$this->tamanho_pagina+$this->pagina-2 : 0;
		
		if ($offset < 0) $offset = 0;
		
		return $offset;
	}

	
}

?>