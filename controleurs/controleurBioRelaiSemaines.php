<?php

SemaineDAO::createSemaines();
//Affichage des ventes sous forme de tableau
$tableSemaines = new Table(array("N°", 'Date Debut Producteur', 'Date Fin Producteur', 'Date Fin Client', 'Date vente'));
foreach(SemaineDTO::getSemaines() as $semaines){
    $tableSemaines->addRow(array(
        $semaines->getNumero(),
        $semaines->getDateDebutProducteur(),
        $semaines->getDateFinProducteur(),
        $semaines->getDateFinClient(),
        $semaines->getDatevente(),
        new TableLink("Modifier", "?page=BioRelaiModifSemaine&semaine=" . $semaines->getNumero()), //Ajout d'un bouton modifier à chaque ligne d'enregistrement
        new TableLink("Supprimer", "?page=BioRelaiSuppSemaine&semaine=" . $semaines->getNumero()) //Ajout d'un bouton supprimer à chaque ligne d'enregistrement
    ));
}

require_once 'vue/bioRelai/vueBioRelaiSemaines.php';