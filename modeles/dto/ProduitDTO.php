<?php
class ProduitDTO{
    use Hydrate;

    private static $produits = array();

    private $id;
    private $nom;
    private $descriptif;
    private $unite;
    private $id_utilisateur;

    public function __construct()
    {
        array_push(ProduitDTO::$produits, $this);
    }

    public static function getProduits() : array{
        return ProduitDTO::$produits;
    }

    public static function setProduits(array $produits){
        ProduitDTO::$produits = $produits;
    }

    public static function getProduit($id) : ProduitDTO{
        foreach(ProduitDTO::$produits as $produit){
            if($produit->id == $id){
                return $produit;
            }
        }
        return null;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of descriptif
     */ 
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set the value of descriptif
     *
     * @return  self
     */ 
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get the value of unite
     */ 
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set the value of unite
     *
     * @return  self
     */ 
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}