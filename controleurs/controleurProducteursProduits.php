<?php

ProduitDAO::createProduits();

$produitsTableau = new Table(array("N°", "Nom", "Descriptif", "Unite", ""));

foreach (ProduitDTO::getProduits() as $produit) {
    if($produit->getId_utilisateur() == $user->getId()){
        $produitsTableau->addRow(array(
            $produit->getId(),
            $produit->getNom(),
            $produit->getDescriptif(),
            $produit->getUnite(),
            new TableLink("Modifier", "https://www.google.fr")
        ));
    }
}

require_once "vue/producteurs/vueProducteursProduits.php";