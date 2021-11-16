<?php

FactureDAO::createFactures();
UserDAO::createUsers();
//Afficher sous forme de tableau les facture des producteurs et des adhérents
$tableFactures = new Table(array('Utilisateur', 'Date', 'Numéro', 'Facture PDF'));
foreach(FactureDTO::getFactures() as $factures){
    $user = UserDTO::getUser($factures->getIdUtilisateur());
    if($user->getFonction() == "PRD" || $user->getFonction() == "ADH"){
        $tableFactures->addRow(array(
            $user->getNom() . " " . $user->getPrenom(),
            $factures->getDate(),
            $factures->getNumero(),
            new TableLink($factures->getFacturesPDF(), "Afficher"),
        ));
    }
}

require_once 'vue/bioRelai/vueBioRelaiFactures.php';