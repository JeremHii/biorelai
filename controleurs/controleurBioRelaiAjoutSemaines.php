<?php

SemaineDAO::createSemaines();
$message="";

if(isset($_POST["dateDebutProducteur"]) && isset($_POST["dateFinProducteur"]) && isset($_POST["dateFinClient"]) && isset($_POST["datevente"])){
    $semaine = new SemaineDTO();
    $semaine->setDateDebutProducteur($_POST["dateDebutProducteur"]);
    $semaine->setDateFinProducteur($_POST["dateFinProducteur"]);
    $semaine->setDateFinClient($_POST["dateFinClient"]);
    $semaine->setDatevente($_POST["datevente"]);
    SemaineDAO::addSemaine($semaine);
    header("Location: ?page=BioRelaiSemaines");
}

$formulaireSemaine = new Formulaire('post', '', 'fSemaine', 'fSemaine'); //Création d'un nouveau formulaire
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Debut Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateDebutProducteur', 'dateDebutProducteur', date("Y-m-d"))); //Affichage de la Date Debut Producteur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinProducteur', 'dateFinProducteur', date("Y-m-d")));//Affichage de la Date Fin Producteur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Client :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinClient', 'dateFinClient', date("Y-m-d")));//Affichage de la Date Fin Client
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date vente :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('datevente', 'datevente', date("Y-m-d")));//Affichage de la Date vente
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputSubmit('Ajouter', '1', 'Ajouter'));

$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->creerFormulaire();

require_once 'vue/bioRelai/vueBioRelaiAjoutSemaine.php';