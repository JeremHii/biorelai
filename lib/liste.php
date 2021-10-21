<?php
class Liste{
   
    private $style;
    private $titreListe;
    private $liste;
    
    private $composants = array();
   
    public function __construct($unStyle ){
        $this->style = $unStyle;
    }
    
    public function ajouterTitreListe($unTitre){
        $this->titreListe = $unTitre;
    }
    
    public function ajouterComposant($unComposant){
        $this->composants[] = $unComposant;
    }
    
    public function afficherListe(){
       echo  $this->liste;
    }

    
    public function unProducteur(Producteur $unProducteur){
        $item = "<div class = 'item'>";
            $item .= "<div class = 'photo'>";
                $item .="<img src= 'images/producteurs/";
                $item .= $unProducteur->getPhotoProducteur();
                $item .="'/>";
            $item .= "</div>";
            $item .= "<div class = 'texte'>";
                $item .= "<div class = 'titre'>";
                    $item .= "<span>";
                    $item .= $unProducteur->getNomUtilisateur();
                    $item .= "</span><span>";
                    $item .= $unProducteur->getCodePostalProducteur();
                    $item .= "</span><span>";
                    $item .= $unProducteur->getCommuneProducteur();
                    $item .= "</span>";
                $item .= "</div>";
                $item .= "<div class = 'descriptif'>";
                    $item .= $unProducteur->getDescriptifProducteur();
                $item .= "</div>";
                $item .= "<div class = 'produitsProposes'><form><input type = 'button' class='btnProduits' value='Voir les produits proposés par ce producteur' ";
                
                
                $item .= "id = 'btnProduits" .$unProducteur->getIdProducteur()."' ";
                
                $item .= "onclick='afficher(".$unProducteur->getIdProducteur().")'></form></div>";
            
                
                
                $item .= "</div>";
           
        $item .= "</div>";
        return $item ;
    }
    
    
    
    
    public function unProduit(Produit $unProduit){
        $item = "<div class = 'item'>";
            $item .= "<div class = 'photo'>";
                    $item .="<img src= 'images/produits/";
                    $item .= $unProduit->getPhotoProduit();
                    $item .="'/>";
            $item .= "</div>";
            $item .= "<div class = 'texte'>";
                $item .= "<div class = 'titre'>";
                    $item .= $unProduit->getNomProduit();
                $item .= "</div>";
                $item .= "<div class = 'descriptif'>";
                    $item .= $unProduit->getDescriptifProduit();
                $item .= "</div>";
             $item .= "</div>";
        $item .= "</div>";
        return $item ;
    }
    
    public function unProduitAchat(Produit $unProduit){
        $item = "<div class = 'item'>";
            $item .= "<div class = 'photo'>";
                $item .="<img src= 'images/produits/";
                    $item .= $unProduit->getPhotoProduit();
                $item .="'/>";
            $item .= "</div>";
            $item .= "<div class = 'texte'>";
                $item .= "<div class = 'titre'>";
                    $item .= $unProduit->getNomProduit();
                $item .= "</div>";
                $item .= "<div class = 'descriptif'>";
                    $item .= $unProduit->getDescriptifProduit();
                $item .= "</div>";
                $item .= "<div class = 'prix'>";
                    $item .= $unProduit->getPrix() . '&nbsp;&euro;';
                    $item .= $unProduit->getUnite();
                    
                    
                $item .= "</div>";
            $item .= "</div>";
        $item .= "</div>";
        return $item ;
    }
    
    public function creerListe(){
        $liste = "<div class = '" .  $this->style . "'>";
            $liste .= "<div class = 'titreListe'>". $this->titreListe ."</div>";
            foreach($this->composants as $composant){
                $liste .=  $composant;
             }
        $liste .=  "</div>";  
        $this->liste =  $liste;
    }
    
}
    