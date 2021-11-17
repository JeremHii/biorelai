<?php

//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

//On créé les objets DTO nécessaires
ProduitDAO::createProduits();
//Si le produit renseigné existe bien et appartient bien au producteur
if(!isset($_GET["produit"]) || ProduitDTO::getProduit($_GET["produit"]) == null || ProduitDTO::getProduit($_GET["produit"])->getId_utilisateur() != $user->getId()) header("Location: ?page=producteursProduits");

$produit = ProduitDTO::getProduit($_GET["produit"]);
$message = "Voulez-vous supprimer le produit " . $produit->getNom() . " ?";

//Formulaire envoyé
if(isset($_POST["confirm"])){
    //On supprime le produit de la bdd
    ProduitDAO::deleteProduit($produit);
    header("Location: ?page=ProducteursProduits");
}


$form = new Formulaire("POST", "", "", "");
$form->ajouterComposantLigne($form->creerInputSubmit("confirm", "confirm", "Confirmer la suppression"));
$form->ajouterComposantTab();

$form->creerFormulaire();

require_once "vue/producteurs/vueProducteursSupprimerProduit.php";