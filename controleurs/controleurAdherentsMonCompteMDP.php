<?php
if(isset($user) && $user->getFonction() == "ADH"){
    //J'écris un message pour prévenir l'utilisateur
    $messagePrevention = "Après avoir changé votre mot de passe vous devez vous reconnecter";
    //Vérifie si tous les champs ont été remplis
    if(isset($_POST['mdp']) || isset($_POST['cmdp'])){
        //Je vérifie que les deux champs sont pas vide
        if(isset($_POST['mdp']) && isset($_POST['cmdp']) && !empty($_POST['mdp']) && !empty($_POST['cmdp']))
        {   
            //Je vérifie que les deux mot de passe correspondent
            if($_POST['mdp'] == $_POST['cmdp'])
            {  
                //J'appelle la fonction de la DAO pour changer le mot de passe
                UserDAO::updateUserPass($user, $_POST["mdp"]);
                header("Location: ?page=Deconnexion");
            }
            else{
                //J'affiche un message pour avertir l'utilisateur d'un problème
                $messageErreurConnexion = "Les deux mots de passe ne correspondent pas";
            }
        }
        else{
            //J'affiche un message pour avertir l'utilisateur d'un problème
            $messageErreurConnexion = "Veuillez remplir tout les champs ci-dessus";
        }
    }

    //Je créer le formulaire de changement de mot de passe
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