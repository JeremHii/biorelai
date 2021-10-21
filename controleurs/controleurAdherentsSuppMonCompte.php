<?php
if(!empty($user) && $user->getFonction() == "RES"){
    UserDAO::SuppIntervenants($user->getId());
    header('Location: ?page=BioRelaiProducteurs');
}
else
{
	header('location: .');
}