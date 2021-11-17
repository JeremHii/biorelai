<?php

//Si il n'est pas connecté on vérifie que le mot de passe et le login est bon
if(!isset($user)){
    if(isset($_POST['mail']) || isset($_POST['mdp'])){
        if(isset($_POST['mail']) && isset($_POST['mdp']) && !empty($_POST['mail']) && !empty($_POST['mdp']))
        {   
            $userDAO = UserDAO::getUserByCredentials($_POST['mail'], $_POST['mdp']);
                if(!empty($userDAO)){
                    $userDTO = new UserDTO();
                    $userDTO->hydrate($userDAO);
                    $_SESSION['identification'] = serialize($userDTO);
                    header("Location: .");
                }
                else{
                    $messageErreurConnexion = "Le mot de passe ou le login est incorrect";
                }
        }
        else{
            $messageErreurConnexion = "Veuillez remplir tout les champs ci-dessus";
        }
    }

    $formulaireConnexion = new Formulaire('post', '?page=connexion', 'fConnexion', 'fConnexion');

    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mail :'));
    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('mail', 'mail', '', 1, 'Entrez votre mail...', ''));
    $formulaireConnexion->ajouterComposantTab();

    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe...', ''));
    $formulaireConnexion->ajouterComposantTab();

    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
    $formulaireConnexion->ajouterComposantTab();

    $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerMessage($messageErreurConnexion));
    $formulaireConnexion->ajouterComposantTab();

    $formulaireConnexion->creerFormulaire();

    require_once 'vue/visiteurs/vueConnexion.php';

}else{
    header("Location: .");
}


