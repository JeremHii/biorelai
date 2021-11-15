<?php

if(!isset($_GET["semaine"])) header("Location: ");
SemaineDAO::createSemaines();
$semaine = SemaineDTO::getSemaine($_GET["semaine"]);

$message="";

if(isset($_POST["dateDebutProducteur"]) && isset($_POST["dateFinProducteur"]) && isset($_POST["dateFinClient"]) && isset($_POST["datevente"])){
    $semaine->setDateDebutProducteur($_POST["dateDebutProducteur"]);
    $semaine->setDateFinProducteur($_POST["dateFinProducteur"]);
    $semaine->setDateFinClient($_POST["dateFinClient"]);
    $semaine->setDatevente($_POST["datevente"]);
    SemaineDAO::updateSemaine($semaine);
    $message = "La modification à bien été effectué";
}

$formulaireSemaine = new Formulaire('post', '', 'fSemaine', 'fSemaine'); //Création d'un nouveau formulaire
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Debut Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateDebutProducteur', 'dateDebutProducteur', $semaine->getDateDebutProducteur(), 1,0)); //Affichage du nom de l'utilisateur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinProducteur', 'dateFinProducteur', $semaine->getDateFinProducteur(), 1, 0));//Affichage du login de l'utilisateur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Client :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinClient', 'dateFinClient',  $semaine->getDateFinClient(),1, 0));//Affichage du statut de l'utilisateur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date vente :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('datevente', 'datevente',  $semaine->getDatevente(),1, 0));//Affichage de la fonction de l'utilisateur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputSubmit('Modifier', '1', 'Modifier'));

$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->creerFormulaire();

require_once 'vue/bioRelai/vueBioRelaiModifSemaine.php';