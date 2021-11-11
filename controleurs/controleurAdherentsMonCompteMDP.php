<?php
if(isset($user) && $user->getFonction() == "ADH"){
    $messagePrevention = "Après avoir changé votre mot de passe vous devez vous reconnecter";
    if(isset($_POST['mdp']) || isset($_POST['cmdp'])){
        if(isset($_POST['mdp']) && isset($_POST['cmdp']) && !empty($_POST['mdp']) && !empty($_POST['cmdp']))
        {   
            if($_POST['mdp'] == $_POST['cmdp'])
            {
                UserDAO::changeMdp($user->getId(), md5($_POST['mdp']));
                header("Location: ?page=Deconnexion");
            }
            else{
                $messageErreurConnexion = "Les deux mots de passe ne correspondent pas";
            }
        }
        else{
            $messageErreurConnexion = "Veuillez remplir tout les champs ci-dessus";
        }
    }

    $formulaireModifMDP = new Formulaire('post', '?page=AdherentsMonCompteMDP', 'fMonMDP', 'fMonMDP');

    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerMessageAvecId($messagePrevention, "prevention"));
    $formulaireModifMDP->ajouterComposantTab();

    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerLabel('Changez votre mot de passe :'));
    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerInputMdp('mdp', 'mdp', 1, '*************', ''));
    $formulaireModifMDP->ajouterComposantTab();

    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerLabel('Confirmez votre mot de passe :'));
    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerInputMdp('cmdp', 'cmdp', 1, '*************', ''));
    $formulaireModifMDP->ajouterComposantTab();

    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerInputSubmit('submitMdp', 'submitMdp', 'Valider'));
    $formulaireModifMDP->ajouterComposantTab();
    
    $formulaireModifMDP->ajouterComposantLigne($formulaireModifMDP->creerMessage($messageErreurConnexion));
    $formulaireModifMDP->ajouterComposantTab();

    $formulaireModifMDP->creerFormulaire();

    require_once 'vue/adherents/vueAdherentsModifMdp.php';
}else{
    header("Location: .");
}