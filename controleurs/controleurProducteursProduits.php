<?php

//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

//On créé les objets DTO nécessaires
ProduitDAO::createProduits();

$produitsTableau = new Table(array("N°", "Nom", "Descriptif", "Unite", "", ""));

foreach (ProduitDTO::getProduits() as $produit) {
    if($produit->getId_utilisateur() == $user->getId()){
        $produitsTableau->addRow(array(
            $produit->getId(),
            $produit->getNom(),
            $produit->getDescriptif(),
            $produit->getUnite(),
            new TableLink("Modifier", "?page=ProducteursModifierProduit&produit=" . $produit->getId()),
            new TableLink("Supprimer", "?page=ProducteursSupprimerProduit&produit=" . $produit->getId())
        ));
    }
}

require_once "vue/producteurs/vueProducteursProduits.php";