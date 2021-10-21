<?php
if(isset($user) && $user->getFonction() == "ADH"){

    $formulaireModif = new Formulaire('post', '?page=AdherentsMonCompteModif', 'fMonCompte', 'fMonCompte');

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputHidden('id', 'id', $user->getId(), 0, '', ''));
    $formulaireModif->ajouterComposantTab();

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


    require_once 'vue/adherents/vueAdherentsMonCompte.php';
}else{
    header("Location: .");
}