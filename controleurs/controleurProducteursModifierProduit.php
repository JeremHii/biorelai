<?php

if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

ProduitDAO::createProduits();
if(!isset($_GET["produit"]) || ProduitDTO::getProduit($_GET["produit"]) == null || ProduitDTO::getProduit($_GET["produit"])->getId_utilisateur() != $user->getId()) header("Location: ?page=producteursProduits");

$produit = ProduitDTO::getProduit($_GET["produit"]);
$message = "";

//Formulaire envoyé
if(isset($_POST["confirm"])){
    if(isset($_POST["nom"]) && isset($_POST["description"]) && isset($_POST["unite"])){
        $produit->setNom($_POST["nom"]);
        $produit->setDescriptif($_POST["description"]);
        $produit->setUnite($_POST["unite"]);
        ProduitDAO::updateProduit($produit);
        
        $message = "Le produit a été modifié !";
    }
    else{
        $message = "Les champs ne sont pas complet.";
    }
}


$form = new Formulaire("POST", "", "", "");
$form->ajouterComposantLigne($form->creerLabel("Nom"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('nom', 'nom', $produit->getNom(), 0, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerLabel("Descriptif"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('description', 'description', $produit->getDescriptif(), 0, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerLabel("Unite"));
$form->ajouterComposantTab();
$form->ajouterComposantLigne($form->creerInputTexte('unite', 'unite', $produit->getUnite(), 0, '', ''));
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerEspace());
$form->ajouterComposantTab();

$form->ajouterComposantLigne($form->creerInputSubmit("confirm", "confirm", "Confirmer"));
$form->ajouterComposantTab();

$form->creerFormulaire();

require_once "vue/producteurs/vueProducteursModifierProduit.php";