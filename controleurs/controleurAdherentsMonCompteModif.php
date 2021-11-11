<?php

if(isset($user) && $user->getFonction() == "ADH"){
    UserDAO::changeModif($user->getId(), $_POST['mail'], $_POST['nom'], $_POST['prenom'], $_POST['adresse'] ,$_POST['ville'] ,$_POST['cp'] ,$_POST['desc']);
    header("Location: ?page=Deconnexion");
}
else{
    header("Location: .");
}