<?php

class CommandeDTO{
    use Hydrate;

    private static $commandes = array();

    private $id;
    private $idUtilisateur;
    private $date;
    private $semaine;
    private $facturesPDF;

    public function __construct()
    {
        array_push(CommandeDTO::$commandes, $this);
    }

    public static function getCommandes() : array{
        return CommandeDTO::$commandes;
    }

    public static function setCommandes(array $commandes){
        CommandeDTO::$commandes = $commandes;
    }

    public static function getCommande($id){
        foreach(CommandeDTO::$commandes as $commande){
            if($commande->id == $id){
                return $commande;
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
     * Get the value of semaine
     */ 
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * Set the value of semaine
     *
     * @return  self
     */ 
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;

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