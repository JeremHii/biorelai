<?php

//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

CategorieDAO::createCategories();

$message = "";

//Formulaire envoyé
if(isset($_POST["confirm"])){
    if(isset($_POST["nom"]) && isset($_POST["description"]) && isset($_POST["unite"]) && isset($_POST["categorie"])){
        //Créer un produit et l'ajoute à la BDD
        $produit = new ProduitDTO();
        $produit->setNom($_POST["nom"]);
        $produit->setDescriptif($_POST["description"]);
        $produit->setUnite($_POST["unite"]);
        $produit->setId_utilisateur($user->getId());
        $produit->setCategorie($_POST["categorie"]);
        ProduitDAO::addProduit($produit);
        
        header("Location: ?page=ProducteursProduits");
    }
    else{
        $message = "Les champs ne sont pas complet.";
    }
}


$form = new Formulaire("POST", "", "", "");
$form->ajouterComposantLigne($form->creerLabel("Nom"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('nom', 'nom', "", 1, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerLabel("Descriptif"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('description', 'description', "", 1, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerLabel("Unite"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('unite', 'unite', "", 1, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerLabel("Catégorie"));
$form->ajouterComposantTab();

$selectCategories = new Select("categorie");
foreach (CategorieDTO::getCategories() as $categorie) {
    $selectCategories->addOption(new SelectOption($categorie->getcode(), $categorie->getLibelle()));
}

$form->ajouterComposantLigne($selectCategories);
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerInputSubmit("confirm", "confirm", "Confirmer"));
$form->ajouterComposantTab();

$form->creerFormulaire();

require_once "vue/producteurs/vueProducteursAjouterProduit.php";