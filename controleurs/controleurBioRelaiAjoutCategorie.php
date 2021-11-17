<?php

CategorieDAO::createCategories();
$message="";

if(isset($_POST["libelle"])){
    $categorie = new CategorieDTO();
    $categorie->setLibelle($_POST["libelle"]);
    CategorieDAO::addCategorie($categorie);
header("Location: ?page=BioRelaiCategorie");
}

$formulaireCategorie = new Formulaire('post', '', 'fCategorie', 'fCategorie'); //Création d'un nouveau formulaire
$formulaireCategorie->ajouterComposantLigne($formulaireCategorie->creerLabel('Libelle :'));
$formulaireCategorie->ajouterComposantLigne($formulaireCategorie->creerInputTexte('libelle', 'libelle', '', 1, 'Entrez le libelle', ''));
$formulaireCategorie->ajouterComposantTab();

$formulaireCategorie->ajouterComposantLigne($formulaireCategorie->creerInputSubmit('Ajouter', '1', 'Ajouter'));

$formulaireCategorie->ajouterComposantTab();

$formulaireCategorie->creerFormulaire();

require_once 'vue/bioRelai/vueBioRelaiAjoutCategories.php';