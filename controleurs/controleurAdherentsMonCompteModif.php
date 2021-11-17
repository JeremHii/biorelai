<?php

if(isset($user) && $user->getFonction() == "ADH"){
    //J'appelle une fonction de la DAO user pour faire la requête de changement d'informations
    $user->setMail($_POST["mail"]);
    $user->setNom($_POST["nom"]);
    $user->setPrenom($_POST["prenom"]);
    $user->setAdresse($_POST["adresse"]);
    $user->setVille($_POST["ville"]);
    $user->setCp($_POST["cp"]);

    UserDAO::updateUser($user);
    $_SESSION["identification"] = serialize($user);
    header("Location: ?page=AdherentsMonCompte");
}
else{
    header("Location: .");
}

