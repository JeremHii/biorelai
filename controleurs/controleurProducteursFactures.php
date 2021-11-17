<?php

//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

//On créé les objets DTO nécessaires
CommandeDAO::createCommandes();
LigneCommandeDAO::createLignesCommande();
UserDAO::createUsers();
ProduitDAO::createProduits();

$tableaux = array();

/*
On fait une boucle des commandes.
Si la commande bouclée contient un produit du producteur on créer un tableau.
Le tableau créé contient seulement les lignes de commande qui sont liées à un produit du producteur.
*/
foreach (CommandeDTO::getCommandes() as $commande) {
    if($commande->containsProducteur($user)){
        $acheteur = UserDTO::getUser($commande->getIdUtilisateur());
        $commandesTableau = new Table(array("Produit", "Quantite"), "Commande du " . $commande->getDate() . " de " . $acheteur->getNom() . " " . $acheteur->getPrenom());

        foreach($commande->getLignesCommande() as $ligneCommande){
            //Si le produit appartient au producteur
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