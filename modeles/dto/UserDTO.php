<?php


class UserDTO{
    use Hydrate;

    private static $users = array();

    private $id;
    private $mail;
    private $adresse;
    private $descriptif;
    private $cp;
    private $ville;
    private $nom;
    private $prenom;
    private $fonction;

    public function __construct()
    {
        array_push(UserDTO::$users, $this);
    }

    public static function getUsers() : array{
        return UserDTO::$users;
    }

    public static function setUsers(array $users){
        UserDTO::$users = $users;
    }

    public static function getUser($id) : UserDTO{
        foreach(UserDTO::$users as $user){
            if($user->id == $id){
                return $user;
            }
        }
        return null;
    }

    public function getCommandes() : array{
        $commandes = array();
        foreach (CommandeDTO::getCommandes() as $commande) {
            if($commande->getIdUtilisateur() == $this->id){
                array_push($commandes, $commande);
            }
        }
        return $commandes;
    }

    /**
     * Get the value of fonction
     */ 
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set the value of fonction
     *
     * @return  self
     */ 
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

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
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

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
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
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
}