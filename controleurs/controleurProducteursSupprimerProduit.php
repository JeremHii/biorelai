<?php

if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

ProduitDAO::createProduits();
if(!isset($_GET["produit"]) || ProduitDTO::getProduit($_GET["produit"]) == null || ProduitDTO::getProduit($_GET["produit"])->getId_utilisateur() != $user->getId()) header("Location: ?page=producteursProduits");

$produit = ProduitDTO::getProduit($_GET["produit"]);
$message = "Voulez-vous supprimer le produit " . $produit->getNom() . " ?";

//Formulaire envoyé
if(isset($_POST["confirm"])){
    ProduitDAO::deleteProduit($produit);
    header("Location: ?page=ProducteursProduits");
}


$form = new Formulaire("POST", "", "", "");
$form->ajouterComposantLigne($form->creerInputSubmit("confirm", "confirm", "Confirmer la suppression"));
$form->ajouterComposantTab();

$form->creerFormulaire();

require_once "vue/producteurs/vueProducteursSupprimerProduit.php";