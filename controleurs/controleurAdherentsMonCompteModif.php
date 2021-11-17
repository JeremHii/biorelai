<?php

if(isset($user) && $user->getFonction() == "ADH"){
    //J'appelle une fonction de la DAO user pour faire la requête de changement d'informations
    UserDAO::changeModif($user->getId(), $_POST['mail'], $_POST['nom'], $_POST['prenom'], $_POST['adresse'] ,$_POST['ville'] ,$_POST['cp']);
    header("Location: ?page=Deconnexion");
}
else{
    header("Location: .");
}

