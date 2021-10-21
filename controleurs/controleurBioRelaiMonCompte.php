<?php
if(isset($user) && $user->getFonction() == "RES"){

    $messageErreurConnexion = "";
    if(isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['cmdp']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['desc'])){
        if($_POST['mail'] != $user->getMail() && !empty($_POST['mail'])){
            UserDAO::changeMail($user->getId(), $_POST['mail']);

            $userDTO = new UserDTO();
            $userDTO->hydrate($userDAO);
            $_SESSION['identification'] = serialize($userDTO);
            $user = unserialize($_SESSION['identification']);
        }
        elseif(isset($_POST['mdp']) && isset($_POST['cmdp'])){
    
        }
    }
    else{
        $messageErreurConnexion = "test";
    }


    $formulaireModif = new Formulaire('post', '?page=AdherentsMonCompte', 'fMonCompte', 'fMonCompte');

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Mail :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('mail', 'mail', $user->getMail(), 0, '', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre mot de passe :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputMdp('mdp', 'mdp',  0, '*************', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Confirmez votre mot de passe :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputMdp('cmdp', 'cmdp',  0, '*************', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre Nom :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('nom', 'nom', $user->getNom(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();
    
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre prenom :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('nom', 'nom', $user->getPrenom(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre adresse :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('adresse', 'adresse', $user->getAdresse(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre ville :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('ville', 'ville', $user->getVille(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre code postal :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('cp', 'cp', $user->getCp(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre descriptif :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('desc', 'desc', $user->getDescriptif(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerMessage($messageErreurConnexion));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->creerFormulaire();

    $formulaireSupp = new Formulaire('post', '?page=AdherentsSuppMonCompte', 'fMonCompte', 'fMonCompte');

    $formulaireSupp->ajouterComposantLigne($formulaireSupp-> creerInputSubmit('submitSupp', 'submitSupp', 'Supprimer votre compte'));
    $formulaireSupp->ajouterComposantTab();

    $formulaireSupp->creerFormulaire();


    require_once 'vue/bioRelai/vueBioRelaiMonCompte.php';
}else{
    header("Location: .");
}