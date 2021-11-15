<?php

class VenteDTO{
    use Hydrate;

    private static $ventes = array();

    private $produit;
    private $semaine;
    private $quantite;
    private $prix;

    public function __construct()
    {
        array_push(VenteDTO::$ventes, $this);
    }

    public static function getVentes() : array{
        return VenteDTO::$ventes;
    }

    public static function setVentes(array $ventes){
        VenteDTO::$ventes = $ventes;
    }

    public static function getVente($produit, $semaine){
        foreach(VenteDTO::$ventes as $vente){
            if($vente->produit == $produit && $vente->semaine == $semaine){
                return $vente;
            }
        }
        return null;
    }

    public static function getVentesProducteurSemaine($producteur, $semaine){
        $ventes = array();
        foreach(VenteDTO::$ventes as $vente){
            if(ProduitDTO::getProduit($vente->produit)->getId_utilisateur() == $producteur && $vente->semaine == $semaine){
                array_push($ventes, $vente);
            }
        }
        return $ventes;
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
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }
}