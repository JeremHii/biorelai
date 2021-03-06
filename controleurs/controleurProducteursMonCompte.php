<?php
//Vérifie que l'utilisateur est connecté et qu'il est producteur
if(!isset($user) || $user->getFonction() != "PRD") header("Location: /");

$message = "";

//Formulaire pour modifier les infos générales envoyé
if(isset($_POST["submitModif"])){
    if(isset($_POST["mail"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["ville"]) && isset($_POST["cp"]) && isset($_POST["descriptif"])){
        //On modifie l'objet user, on l'update dans la bdd et on met bien à jour la variable de session
        $user->setMail($_POST["mail"]);
        $user->setNom($_POST["nom"]);
        $user->setPrenom($_POST["prenom"]);
        $user->setAdresse($_POST["adresse"]);
        $user->setVille($_POST["ville"]);
        $user->setCp($_POST["cp"]);
        $user->setDescriptif($_POST["descriptif"]);
        
        UserDAO::updateUser($user);
        $_SESSION["identification"] = serialize($user);

        $message = "Modification confirmée !";
    }else{
        $message = "Les champs ne sont pas complet.";
    }
}

//Formulaire pour modifier le mot de passe envoyé
if(isset($_POST["submitModifMdp"])){
    if(isset($_POST["newPass"]) && isset($_POST["newPassConfirm"])){
        if($_POST["newPass"] == $_POST["newPassConfirm"]){
            //On modifie le mot de passe dans la bdd
            UserDAO::updateUserPass($user, $_POST["newPass"]);
            $message = "Modification confirmée !";
        }
        else{
            $message = "Les mots de passe ne correspondent pas.";
        } 
    }else{
        $message = "Les champs ne sont pas complet.";
    }
}

//Formulaire pour modifié les infos générales
$formulaireModif = new Formulaire('post', '', 'fMonCompte', 'fMonCompte');

$formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre mail :'));
$formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('mail', 'mail', $user->getMail(), 1, '', ''));
$formulaireModif->ajouterComposantTab();

$formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre nom :'));
$formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('nom', 'nom', $user->getNom(), 1,'', ''));
$formulaireModif->ajouterComposantTab();

$formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre prenom :'));
$formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('prenom', 'prenom', $user->getPrenom(), 1,'', ''));
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
$formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('descriptif', 'descriptif', $user->getDescriptif(), 0,'', ''));
$formulaireModif->ajouterComposantTab();

$formulaireModif->ajouterComposantLigne($formulaireModif-> creerInputSubmit('submitModif', 'submitModif', 'Confirmer'));
$formulaireModif->ajouterComposantTab();

$formulaireModif->ajouterComposantLigne($formulaireModif->creerMessage($messageErreurConnexion));
$formulaireModif->ajouterComposantTab();

$formulaireModif->creerFormulaire();

//Formulaire pour modifié le mot de passe
$formulaireModifMdp = new Formulaire('post', '', 'fMonCompte', 'fMonCompte');

$formulaireModifMdp->ajouterComposantLigne($formulaireModifMdp->creerLabel('Nouveau mot de passe :'));
$formulaireModifMdp->ajouterComposantLigne($formulaireModifMdp->creerInputMdp('newPass', 'newPass', 1,'', ''));
$formulaireModifMdp->ajouterComposantTab();

$formulaireModifMdp->ajouterComposantLigne($formulaireModifMdp->creerLabel('Confirmation nouveau mot de passe :'));
$formulaireModifMdp->ajouterComposantLigne($formulaireModifMdp->creerInputMdp('newPassConfirm', 'newPassConfirm', 1,'', ''));
$formulaireModifMdp->ajouterComposantTab();

$formulaireModifMdp->ajouterComposantLigne($formulaireModifMdp-> creerInputSubmit('submitModifMdp', 'submitModifMdp', 'Modifier votre mot de passe'));
$formulaireModifMdp->ajouterComposantTab();

$formulaireModifMdp->creerFormulaire();


require_once 'vue/producteurs/vueProducteursMonCompte.php';