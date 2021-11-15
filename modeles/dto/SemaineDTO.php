<?php

class SemaineDTO{
    use Hydrate;

    private static $semaines = array();

    private $numero;
    private $dateDebutProducteur;
    private $dateFinProducteur;
    private $dateFinClient;
    private $datevente;

    public function __construct()
    {
        array_push(SemaineDTO::$semaines, $this);
    }

    public static function getSemaines() : array{
        return SemaineDTO::$semaines;
    }

    public static function setSemaines(array $semaines){
        SemaineDTO::$semaines = $semaines;
    }

    public static function getSemaine($numero){
        foreach(SemaineDTO::$semaines as $semaine){
            if($semaine->numero == $numero){
                return $semaine;
            }
        }
        return null;
    }

    public static function getSemaineActive(){
        $semaineActive = null;

        foreach(SemaineDTO::$semaines as $semaine){
            if($semaineActive == null || $semaine->numero > $semaineActive->getNumero()){
                $semaineActive = $semaine;
            }
        }
        return $semaineActive;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of dateDebutProducteur
     */ 
    public function getDateDebutProducteur()
    {
        return $this->dateDebutProducteur;
    }

    /**
     * Set the value of dateDebutProducteur
     *
     * @return  self
     */ 
    public function setDateDebutProducteur($dateDebutProducteur)
    {
        $this->dateDebutProducteur = $dateDebutProducteur;

        return $this;
    }

    /**
     * Get the value of dateFinProducteur
     */ 
    public function getDateFinProducteur()
    {
        return $this->dateFinProducteur;
    }

    /**
     * Set the value of dateFinProducteur
     *
     * @return  self
     */ 
    public function setDateFinProducteur($dateFinProducteur)
    {
        $this->dateFinProducteur = $dateFinProducteur;

        return $this;
    }

    /**
     * Get the value of dateFinClient
     */ 
    public function getDateFinClient()
    {
        return $this->dateFinClient;
    }

    /**
     * Set the value of dateFinClient
     *
     * @return  self
     */ 
    public function setDateFinClient($dateFinClient)
    {
        $this->dateFinClient = $dateFinClient;

        return $this;
    }

    /**
     * Get the value of datevente
     */ 
    public function getDatevente()
    {
        return $this->datevente;
    }

    /**
     * Set the value of datevente
     *
     * @return  self
     */ 
    public function setDatevente($datevente)
    {
        $this->datevente = $datevente;

        return $this;
    }
}