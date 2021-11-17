<?php

//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

//On créé les objets DTO nécessaires
ProduitDAO::createProduits();
VenteDAO::createVentes();
SemaineDAO::createSemaines();

$message = "";

//Formulaire envoyé
if(isset($_POST["confirm"])){
    // Si les ventes ne sont pas activées
    if(!SemaineDTO::getSemaineActive()->canProducteurSell()){
        $message = "Les ventes ne sont pas encore ouverte.";
    }
    else{
        $produit = $_POST["produit"];
        $quantite = $_POST["quantite"];
        $prix = $_POST["prix"];
    
        //Si le produit modifié ne lui appartient pas
        if(ProduitDTO::getProduit($produit) == null || ProduitDTO::getProduit($produit)->getId_utilisateur() != $user->getId()){
            $message = "Vous n'avez pas la permission de modifier ce produit.";
        }
        //Si la quantité et le prix ne sont pas des valeurs numériques
        else if(!is_numeric($quantite) || !is_numeric($prix)){
            $message = "Les valeurs doivent être numérique.";
        }
        else{
            $produit = ProduitDTO::getProduit($produit);
            $semaine = SemaineDTO::getSemaineActive();
            $vente = VenteDTO::getVente($produit, $semaine);
    
            //Si la quantité est inférieure à 0 on la supprime de la bdd et des objets DTO
            if($quantite <= 0){
                if($vente != null){
                    VenteDAO::deleteVente($vente);
                    VenteDTO::deleteVente($vente);
                }
            }
    
            else{
                //Si l'objet vente n'existe pas on le créer et on l'ajoute à la bdd
                if($vente == null){
                    $vente = new VenteDTO();
                    $vente->setProduit($produit->getId());
                    $vente->setSemaine($semaine->getNumero());
                    $vente->setQuantite($quantite);
                    $vente->setPrix($prix);
    
                    VenteDAO::addVente($vente);
                //Sinon on modifie juste ses attributs et on l'update dans la bdd
                }else{
                    $vente->setQuantite($quantite);
                    $vente->setPrix($prix);
    
                    VenteDAO::updateVente($vente);
                }
            }
            $message = "Le produit a été modifié !";
        }
        if($prix > 0 && $quantite <= 0){
            $message = "La quantité doit être supérieure à 0 afin de pouvoir modifier le prix.";
        }
    }
    
}

//Si le producteur peut vendre (car c'est la période)
if(SemaineDTO::getSemaineActive()->canProducteurSell()){

    $ventesTableau = new Table(array("Produit", "Quantité", "Prix", ""));

    foreach (ProduitDTO::getProduits() as $produit) {
        //Si le produit appartient au producteur
        if($produit->getId_utilisateur() == $user->getId()){
            $quantite = 0;
            $prix = 0;
            //Si le produit est déjà en vente on récupère la quantité et le prix de vente
            if(VenteDTO::getVente($produit, SemaineDTO::getSemaineActive()) != null){
                $vente = VenteDTO::getVente($produit, SemaineDTO::getSemaineActive());
                $quantite = $vente->getQuantite();
                $prix = $vente->getPrix();
            }
            $ventesTableau->addRow(new RowForm($produit->getId(), array(
                new RowFormHidden("produit", $produit->getId()),
                new RowFormLabel($produit->getNom()),
                new RowFormInput("quantite", $quantite, '', 1),
                new RowFormInput("prix", $prix, '', 1)
            ), new FormSubmit("confirm", "Confirmer")));
        }
    }

    require_once "vue/producteurs/vueProducteursVentesOuvertes.php";
}else{
    require_once "vue/producteurs/vueProducteursVentesFermees.php";
}

