<?php

CommandeDAO::createCommandes();
UserDAO::createUsers();
//Afficher sous forme de tableau les facture des producteurs et des adhérents
$tableCommandes = new Table(array('Utilisateur', 'Date', 'Numéro', 'Facture PDF'));
foreach(CommandeDTO::getCommandes() as $commande){
    $user = UserDTO::getUser($commande->getIdUtilisateur());
    if($user->getFonction() == "PRD" || $user->getFonction() == "ADH"){
        $tableCommandes->addRow(array(
            $user->getNom() . " " . $user->getPrenom(),
            $commande->getDate(),
            $commande->getSemaine(),
            new TableLink("Afficher",$commande->getFacturesPDF()),
        ));
    }
}

require_once 'vue/bioRelai/vueBioRelaiFactures.php';