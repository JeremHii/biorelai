<?php

ProduitDAO::createProduits();
VenteDAO::createVentes();
SemaineDAO::createSemaines();

if(isset($_POST["confirm"])){
    echo "Produit: " . $_POST["produit"] . "<br>";
    echo "Quantité: " . $_POST["quantite"] . "<br>";
    echo "Prix: " . $_POST["prix"] . "<br>";
}
else{
    $ventesTableau = new Table(array("Produit", "Quantité", "Prix", ""));

    $ventes = VenteDTO::getVentesProducteurSemaine($user->getId(), SemaineDTO::getSemaineActive());
    
    foreach (ProduitDTO::getProduits() as $produit) {
        if($produit->getId_utilisateur() == $user->getId()){
            $ventesTableau->addRow(new RowForm($produit->getId(), array(
                new RowFormHidden("produit", $produit->getId()),
                new RowFormLabel($produit->getNom()),
                new RowFormInput("quantite", 1, '', 1),
                new RowFormInput("prix", 1, '', 1)
            ), new FormSubmit("confirm", "Confirmer")));
        }
    }
    
    require_once "vue/producteurs/vueProducteursVentes.php";
}
