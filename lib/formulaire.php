<?php
class Formulaire{
	private $method;
	private $action;
	private $nom;
	private $style;
	private $formulaireToPrint;
	
	private $ligneComposants = array();
	private $tabComposants = array();
	
	public function __construct($uneMethode, $uneAction , $unNom,$unStyle ){
		$this->method = $uneMethode;
		$this->action =$uneAction;
		$this->nom = $unNom;
		$this->style = $unStyle;
	}
	
	public function concactComposants($unComposant , $autreComposant ){
		$unComposant .=  $autreComposant;
		return $unComposant ;
	}
	
	public function ajouterComposantLigne($unComposant){
		$this->ligneComposants[] = $unComposant;
	}
	
	public function ajouterComposantTab(){
		$this->tabComposants[] = $this->ligneComposants;
		$this->ligneComposants = array();
	}
	
	public function creerLabel($unLabel){
		$composant = "<label>" . $unLabel . "</label>";
		return $composant;
	}

	public function creerEspace()
	{
		$composant = "<br>";
		return $composant;
	}
	
	public function creerMessage($unMessage){
		$composant = "<label class='message'>" . $unMessage . "</label>";
		return $composant;
	}

	public function creerMessageAvecId($unMessage, $nnId){
		$composant = "<label class='message' id=". $nnId .">" . $unMessage . "</label>";
		return $composant;
	}
	
	
	public function creerInputDate($unNom, $unId, $uneValue , $required = 1, $disabled = false){
		$composant = "<input type = 'date' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if ( $required == 1){
			$composant .= "required ";
		}
		if ( $disabled == true){
			$composant .= "disabled ";
		}
		$composant .= "/>";
		return $composant;
	}

	public function creerInputTexte($unNom, $unId, $uneValue , $required , $placeholder , $pattern, $disabled = false){
		$composant = "<input type = 'text' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required == 1){
			$composant .= "required ";
		}
		if ( $disabled == true){
			$composant .= "disabled ";
		}
		if (!empty($pattern)){
			$composant .= "pattern = '" . $pattern . "' ";
		}
		$composant .= "/>";
		return $composant;
	}

	public function creerInputHidden($unNom, $unId, $uneValue){
		$composant = "<input type = 'hidden' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		$composant .= "/>";
		return $composant;
	}
	
	
	public function creerInputMdp($unNom, $unId,  $required , $placeholder , $pattern){
		$composant = "<input type = 'password' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required = 1){
			$composant .= "required ";
		}
		if (!empty($pattern)){
			$composant .= "pattern = '" . $pattern . "' ";
		}
		$composant .= "/>";
		return $composant;
	}
	
	public function creerLabelFor($unFor,  $unLabel){
		$composant = "<label for='" . $unFor . "'>" . $unLabel . "</label>";
		return $composant;
	}
	
	public function creerInputSubmit($unNom, $unId, $uneValue){
		$composant = "<input type = 'submit' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}

	public function creerInputImage($unNom, $unId, $uneSource){
		$composant = "<input type = 'image' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}
	
	
	public function creerFormulaire(){
		$this->formulaireToPrint = "<form method = '" .  $this->method . "' ";
		$this->formulaireToPrint .= "action = '" .  $this->action . "' ";
		$this->formulaireToPrint .= "target = '" .  "_self" . "' ";
		$this->formulaireToPrint .= "name = '" .  $this->nom . "' ";
		$this->formulaireToPrint .= "class = '" .  $this->style . "' >";
		
	
		foreach ($this->tabComposants as $uneLigneComposants){
			$this->formulaireToPrint .= "<div class = 'ligne'>";
			foreach ($uneLigneComposants as $unComposant){
				if($unComposant instanceof Select){
					$this->formulaireToPrint .= "<select name='" . $unComposant->getName() . "'>";
					foreach($unComposant->getOptions() as $option){
						$this->formulaireToPrint .= "<option value='" . $option->getValue() . "' . " . ($option->isSelected() ? "selected" : "") . ">" . $option->getText() . "</option>";
					}
					$this->formulaireToPrint .= "</select>";
				}else{
					$this->formulaireToPrint .= $unComposant ;
				}
				
			}
			$this->formulaireToPrint .= "</div>";
		}
		$this->formulaireToPrint .= "</form>";
		return $this->formulaireToPrint ;
	}
	
	public function afficherFormulaire(){
		echo $this->formulaireToPrint ;
	}	
}

//Créer un select dans un formulaire
class Select{
	private $name;
	private $options;

	public function __construct($name){
		$this->name = $name;
		$this->options = array();
	}

	public function addOption(SelectOption $option){
		array_push($this->options, $option);
	}

	/**
	 * Get the value of name
	 */ 
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the value of options
	 */ 
	public function getOptions()
	{
		return $this->options;
	}
}

//Option d'un select dans un formulaire
class SelectOption{
	private $value;
	private $text;
	//Permet de dire si cette option sera selctionnée par défaut dans un select
	private $selected;

	public function __construct($value, $text, $selected = false){
		$this->value = $value;
		$this->text = $text;
		$this->selected = $selected;
	}

	/**
	 * Get the value of value
	 */ 
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Get the value of text
	 */ 
	public function getText()
	{
		return $this->text;
	}

	/**
	 * Get the value of selected
	 */ 
	public function isSelected()
	{
		return $this->selected;
	}
}