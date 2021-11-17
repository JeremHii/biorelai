<?php
//On créer le menu navigant
$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Achats", "AdherentsAchats"));
$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Panier", "AdherentsPanier"));
$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Factures", "AdherentsFactures"));
$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Mon compte", "AdherentsMonCompte"));