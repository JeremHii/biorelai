<?php

if(!isset($_GET["semaine"])) header("Location: ");
SemaineDAO::createSemaines();
$semaine = SemaineDTO::getSemaine($_GET["semaine"]);

$message="";

//Vérification si tous les champs existent
if(isset($_POST["dateDebutProducteur"]) && isset($_POST["dateFinProducteur"]) && isset($_POST["dateFinClient"]) && isset($_POST["datevente"])){
    $semaine->setDateDebutProducteur($_POST["dateDebutProducteur"]);
    $semaine->setDateFinProducteur($_POST["dateFinProducteur"]);
    $semaine->setDateFinClient($_POST["dateFinClient"]);
    $semaine->setDatevente($_POST["datevente"]);
    SemaineDAO::updateSemaine($semaine);
    $message = "La modification à bien été effectué";
}

//Création d'un formulaire permettant la modification d'une vente en récupérant toutes les informations de la vente précédemment choisie
$formulaireSemaine = new Formulaire('post', '', 'fSemaine', 'fSemaine'); //Création d'un nouveau formulaire
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Debut Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateDebutProducteur', 'dateDebutProducteur', $semaine->getDateDebutProducteur(), 1,0)); //Affichage de la Date Debut Producteur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Producteur :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinProducteur', 'dateFinProducteur', $semaine->getDateFinProducteur(), 1, 0));//Affichage de la Date Fin Producteur
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date Fin Client :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('dateFinClient', 'dateFinClient',  $semaine->getDateFinClient(),1, 0));//Affichage de la Date Fin Client
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerLabel('Date vente :'));
$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputDate('datevente', 'datevente',  $semaine->getDatevente(),1, 0));//Affichage de la Date vente
$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->ajouterComposantLigne($formulaireSemaine->creerInputSubmit('Modifier', '1', 'Modifier'));

$formulaireSemaine->ajouterComposantTab();

$formulaireSemaine->creerFormulaire();

require_once 'vue/bioRelai/vueBioRelaiModifSemaine.php';