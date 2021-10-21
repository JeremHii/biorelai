<?php
    $messageErreurConnexion = "";

if(!empty($_POST['id']) && isset($_POST['id'])){
    if($_POST['mail'] != $user->getMail() && !empty($_POST['mail'])){
        UserDAO::changeMail($user->getId(), $_POST['mail']);

        $userDTO = new UserDTO();
        $userDTO->hydrate($userDAO);
        $_SESSION['identification'] = serialize($userDTO);
        $user = unserialize($_SESSION['identification']);
    }
    elseif(isset($_POST['mdp']) && isset($_POST['cmdp'])){
        
    }
    else{
        $messageErreurConnexion = "test";
    }
}
else{
    $messageErreurConnexion = "test";
}