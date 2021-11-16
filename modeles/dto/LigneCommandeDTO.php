<?php

class LigneCommandeDTO{
    use Hydrate;

    private static $lignesCommande = array();

    private $produit;
    private $commande;
    private $quantite;

    public function __construct()
    {
        array_push(LigneCommandeDTO::$lignesCommande, $this);
    }

    public static function getLignesCommande() : array{
        return LigneCommandeDTO::$lignesCommande;
    }

    public static function setLignesCommande(array $lignesCommande){
        LigneCommandeDTO::$lignesCommande = $lignesCommande;
    }

    public static function getLigneCommande($id){
        foreach(LigneCommandeDTO::$lignesCommande as $ligneCommande){
            if($ligneCommande->id == $id){
                return $ligneCommande;
            }
        }
        return null;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of produit
     */ 
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set the value of produit
     *
     * @return  self
     */ 
    public function setProduit($produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get the value of commande
     */ 
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set the value of commande
     *
     * @return  self
     */ 
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }
}