<?php

if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

CommandeDAO::createCommandes();
LigneCommandeDAO::createLignesCommande();
UserDAO::createUsers();
ProduitDAO::createProduits();

$tableaux = array();

foreach (CommandeDTO::getCommandes() as $commande) {
    if($commande->containsProducteur($user)){
        $acheteur = UserDTO::getUser($commande->getIdUtilisateur());
        $commandesTableau = new Table(array("Produit", "Quantite"), "Commande du " . $commande->getDate() . " de " . $acheteur->getNom() . " " . $acheteur->getPrenom());

        foreach($commande->getLignesCommande() as $ligneCommande){
            if(ProduitDTO::getProduit($ligneCommande->getProduit())->getId_utilisateur() == $user->getId()){
                $commandesTableau->addRow(array(
                    ProduitDTO::getProduit($ligneCommande->getProduit())->getNom(),
                    $ligneCommande->getQuantite()
                ));
            }
        }

        array_push($tableaux, $commandesTableau);
    }
}

require_once "vue/producteurs/vueProducteursFactures.php";