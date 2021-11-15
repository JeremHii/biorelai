<?php

ProduitDAO::createProduits();
VenteDAO::createVentes();
SemaineDAO::createSemaines();

$message = "";

if(isset($_POST["confirm"])){
    $produit = $_POST["produit"];
    $quantite = $_POST["quantite"];
    $prix = $_POST["prix"];

    if(ProduitDTO::getProduit($produit) == null || ProduitDTO::getProduit($produit)->getId_utilisateur() != $user->getId()){
        $message = "Vous n'avez pas la permission de modifier ce produit.";
    }
    else if(!is_numeric($quantite) || !is_numeric($prix)){
        $message = "Les valeurs doivent être numérique.";
    }
    /*else if($prix > 0 && $quantite <= 0){
        $message = "La quantité doit être supérieure à 0 afin de pouvoir modifier le prix.";
    }*/
    else{
        $produit = ProduitDTO::getProduit($produit);
        $semaine = SemaineDTO::getSemaineActive();
        $vente = VenteDTO::getVente($produit, $semaine);

        if($quantite <= 0){
            if($vente != null){
                VenteDAO::deleteVente($vente);
                VenteDTO::deleteVente($vente);
            }
        }

        else{
            if($vente == null){
                $vente = new VenteDTO();
                $vente->setProduit($produit->getId());
                $vente->setSemaine($semaine->getNumero());
                $vente->setQuantite($quantite);
                $vente->setPrix($prix);

                VenteDAO::addVente($vente);
            }else{
                $vente->setQuantite($quantite);
                $vente->setPrix($prix);

                VenteDAO::updateVente($vente);
            }
        }
        $message = "Le produit a été modifié !";
    }
}

$ventesTableau = new Table(array("Produit", "Quantité", "Prix", ""));

$ventes = VenteDTO::getVentesProducteurSemaine($user->getId(), SemaineDTO::getSemaineActive());

foreach (ProduitDTO::getProduits() as $produit) {
    if($produit->getId_utilisateur() == $user->getId()){
        $quantite = 0;
        $prix = 0;
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

require_once "vue/producteurs/vueProducteursVentes.php";
