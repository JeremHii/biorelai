<?php
if(isset($user) && $user->getFonction() == "RES"){
    
    $messagePrevention = "Après avoir changé vos informations vous devez vous reconnecter";

    $formulaireModif = new Formulaire('post', '?page=BioRelaiMonCompteModif', 'fMonCompte', 'fMonCompte');

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerMessageAvecId($messagePrevention, "prevention"));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputHidden('id', 'id', $user->getId(), 0, '', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Mail :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('mail', 'mail', $user->getMail(), 0, '', ''));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre Nom :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('nom', 'nom', $user->getNom(), 0,'', ''));
    $formulaireModif->ajouterComposantTab();
    
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerLabel('Changez votre prenom :'));
    $formulaireModif->ajouterComposantLigne($formulaireModif->creerInputTexte('prenom', 'prenom', $user->getPrenom(), 0,'', ''));
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

    $formulaireModif->ajouterComposantLigne($formulaireModif-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->ajouterComposantLigne($formulaireModif->creerMessage($messageErreurConnexion));
    $formulaireModif->ajouterComposantTab();

    $formulaireModif->creerFormulaire();

    $formulaireModifCompteMdp = new Formulaire('post', '?page=BioRelaiMonCompteMDP', 'fMonCompte', 'fMonCompte');

    $formulaireModifCompteMdp->ajouterComposantLigne($formulaireModifCompteMdp-> creerInputSubmit('submitModifmdp', 'submitModifmdp', 'Modifier votre mot de passe'));
    $formulaireModifCompteMdp->ajouterComposantTab();

    $formulaireModifCompteMdp->creerFormulaire();

    $messagePreventionSupp = "Attention la suppression du compte est définitive, impossible de revenir en arrière";

    $formulaireSupp = new Formulaire('post', '?page=BioRelaiSuppMonCompte', 'fMonCompte', 'fMonCompte');

    $formulaireSupp->ajouterComposantLigne($formulaireSupp->creerMessageAvecId($messagePreventionSupp, "prevention"));
    $formulaireSupp->ajouterComposantTab();

    $formulaireSupp->ajouterComposantLigne($formulaireSupp-> creerInputSubmit('submitSupp', 'submitSupp', 'Supprimer votre compte'));
    $formulaireSupp->ajouterComposantTab();

    $formulaireSupp->creerFormulaire();


    require_once 'vue/bioRelai/vueBioRelaiMonCompte.php';
}else{
    header("Location: .");
}