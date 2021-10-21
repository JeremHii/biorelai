<?php
class Menu{
	private $style;
	private $menu ;

	private $composants = array();

	public function __construct($unStyle ){
		$this->style = $unStyle;
	}

	public function afficherMenu(){
	    echo $this->menu;
	}
	
	
	public function ajouterComposant($unComposant){
		$this->composants[] = $unComposant;
	}

	
	public function creerItemLien($unLien,$uneValeur){
	    $composant = array();
	    $composant[1] = $unLien ;
	    $composant[0] = $uneValeur ;
	    return $composant;
	}
	
	public function creerItemImage($uneValue,$uneImage,$uneEtiquette){
		$composant = array();
		$composant[0] = $uneValue ;
		$composant[1] = $uneImage ;
		$composant[2] = $uneEtiquette ;
		return $composant;
	}
	
	
	
	public function creerMenu($composantActif,$nomMenu){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
			
			if($composant[0] == $composantActif){
				$menu .= "<li class='actif'>";
				$menu .=  $composant[1] ;
			}
			else{
				$menu .= "<li>";
				$menu .= "<a target='_self' href='index.php?" . $nomMenu ."=" . $composant[0] . "'>";
				$menu .= $composant[1] ;
				$menu .= "</a>";
			}
			$menu .= "</li>";
			
		}
		$menu .= "</ul>";
		$this->menu =  $menu ;
	}
	


	
	public function creerMenuImage($composantActif, $nomMenu){
		$menu = "<ul class='" .  $this->style . "'>";
		foreach($this->composants as $composant){
		    if($composant[0] == $composantActif){
		        $menu .= "<li class='actif'>";
		        $menu .=  "<img src = 'images/" . $composant[1]. ".png'/>";
		    }
		    else{
		        $menu .= "<li>";
		        $menu .= "<a href='index.php?$nomMenu=$composant[0]'>" ;
		        $menu .=  "<img src = 'images/" . lcfirst($composant[1]) . ".png'/>";
		        $menu .= "</a>";
		    }
		    $menu .= "</li>";
		}
		$menu .= "</ul>";
		
		$this->menu =  $menu ;
	}
	
	

}