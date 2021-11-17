<?php

class FonctionDTO{
    use Hydrate;

    private static $fonctions = array();

    private $code;
    private $libelle;

    public function __construct()
    {
        array_push(FonctionDTO::$fonctions, $this);
    }

    public static function getFonctions() : array{
        return FonctionDTO::$fonctions;
    }

    public static function setFonctions(array $fonctions){
        FonctionDTO::$fonctions = $fonctions;
    }

    public static function getFonction($code){
        foreach(FonctionDTO::$fonctions as $fonction){
            if($fonction->code == $code){
                return $fonction;
            }
        }
        return null;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
}