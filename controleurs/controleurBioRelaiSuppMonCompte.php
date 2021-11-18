<?php
if(!empty($user) && $user->getFonction() == "RES"){
    UserDAO::SuppUtilisateur($user->getId());
    header('Location: ?page=Deconnexion');
}
else
{
	header('location: .');
}