<?php

SemaineDAO::createSemaines();

$tableSemaines = new Table(array("N°", 'Date Debut Producteur', 'Date Fin Producteur', 'Date Fin Client', 'Date vente'));
foreach(SemaineDTO::getSemaines() as $semaines){
    $tableSemaines->addRow(array(
        $semaines->getNumero(),
        $semaines->getDateDebutProducteur(),
        $semaines->getDateFinProducteur(),
        $semaines->getDateFinClient(),
        $semaines->getDatevente(),
        new TableLink("Modifier", "?page=BioRelaiModifSemaine&semaine=" . $semaines->getNumero()),
        new TableLink("Supprimer", "?page=BioRelaiSuppSemaine&semaine=" . $semaines->getNumero())
    ));
}

require_once 'vue/bioRelai/vueBioRelaiSemaines.php';