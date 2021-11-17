<?php

class CategorieDTO{
    use Hydrate;

    private static $categories = array();

    private $code;
    private $libelle;

    public function __construct()
    {
        array_push(CategorieDTO::$categories, $this);
    }

    public static function getCategories() : array{
        return CategorieDTO::$categories;
    }

    public static function setCategories(array $categories){
        CategorieDTO::$categories = $categories;
    }

    public static function getCategorie($code){
        foreach(CategorieDTO::$categories as $categorie){
            if($categorie->code == $code){
                return $categorie;
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