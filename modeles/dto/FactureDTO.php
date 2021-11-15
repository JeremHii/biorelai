<?php

class FactureDTO{
    use Hydrate;

    private static $factures = array();

    private $id;
    private $idUtilisateur;
    private $date;
    private $numero;
    private $facturesPDF;

    public function __construct()
    {
        array_push(FactureDTO::$factures, $this);
    }

    public static function getFactures() : array{
        return FactureDTO::$factures;
    }

    public static function setFactures(array $factures){
        FactureDTO::$factures = $factures;
    }

    public static function getFacture($id){
        foreach(FactureDTO::$factures as $facture){
            if($facture->id == $id){
                return $facture;
            }
        }
        return null;
    }

    /**
     * Get the value of code
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
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
     * Get the value of facturesPDF
     */ 
    public function getFacturesPDF()
    {
        return $this->facturesPDF;
    }

    /**
     * Set the value of facturesPDF
     *
     * @return  self
     */ 
    public function setFacturesPDF($facturesPDF)
    {
        $this->facturesPDF = $facturesPDF;

        return $this;
    }
}