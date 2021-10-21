<?php
//Commentaire
$messageErreurConnexion = '';

$page=(isset($_GET["page"])) ? $_GET["page"] : "visiteurs";

$bioRelaiMP = new Menu("menuBioRelai");

$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Accueil", "Visiteurs"));

//unset($_SESSION['identification']);

if(isset($_SESSION['identification'])){
    $user = unserialize($_SESSION['identification']);
    echo("Connecté en tant que " . $user->getPrenom() . " " . $user->getNom()[0] . ".");
}else{
    echo("non Connecté");
}

//Faire le spit selon status
if(isset($user))
{
    if($user->getFonction() == "ADH"){
        require_once "controleurAdherents.php";
    }

    if($user->getFonction() == "PRD"){
        require_once "controleurProducteurs.php";
    }
    
    if($user->getFonction() == "RES"){
        require_once "controleurBioRelai.php";
    }

    $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Déconnexion", "Deconnexion"));
}
else
{
    $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien('Inscription','Inscription'));
    $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("Connexion", "Connexion"));
}

$bioRelaiMP->creerMenu($page,'page');

ob_start();

include_once dispatcher::dispatch($page);

$content = ob_get_clean();

include_once "vue/template.php";