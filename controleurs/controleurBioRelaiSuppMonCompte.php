<?php
if(!empty($user) && $user->getFonction() == "ADH"){
    UserDAO::SuppUtilisateur($user->getId());
    header('Location: ?page=Deconnexion');
}
else
{
	header('location: .');
}