<?php
if(!empty($user) && $user->getFonction() == "RES"){
    UserDAO::deleteUser($user);
    header('Location: ?page=Deconnexion');
}
else
{
	header('location: .');
}