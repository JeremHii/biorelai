<?php
if(!empty($user) && $user->getFonction() == "ADH"){
    //J'appelle le DAO de user pour supprimer un utilisateur
    UserDAO::deleteUser($user);
    header('Location: ?page=Deconnexion');
}
else
{
	header('location: .');
}