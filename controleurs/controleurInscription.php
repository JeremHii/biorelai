<?php

//On vérifie tout un tas de conditions et on inscrit l'utilisateur
if(!isset($user)){
    if(isset($_POST['mail']) || isset($_POST['mdp']) || isset($_POST['Cmdp']) || isset($_POST['adresse']) || isset($_POST['desc']) || isset($_POST['cp']) || isset($_POST['nom']) || isset($_POST['prenom'])){
        if(isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['Cmdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['Cmdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
        {   
            if($_POST['mdp'] == $_POST['Cmdp'])
            {
                if(UserDAO::userExists($_POST['mail']))
                {
                    UserDAO::createUser($_POST['mail'], md5($_POST['mdp']), $_POST['adresse'], $_POST['desc'], $_POST['cp'], $_POST['ville'] ,$_POST['nom'],  $_POST['prenom']);
                }
                else
                {
                    $messageErreurConnexion = "Le mail est déjà utilisé";
                }
            }
            else
            {
                $messageErreurConnexion = "Les mots de passe ne sont pas les mêmes";
            }
        }
        else{
            $messageErreurConnexion = "Veuillez remplir tout les champs ci-dessus";
        }
    }

//Création du formulaire pour l'inscription
$formulaireInscription = new Formulaire('post', '?page=inscription', 'fInscription', 'fInscription');

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mail :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('mail', 'mail', '', 1, 'Entrez votre mail...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mot de Passe :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Confirmez votre mot de Passe :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('Cmdp', 'Cmdp',  1, 'Confirmez votre mot de passe...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Votre adresse :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('adresse', 'adresse', '',  1, 'Entrez votre adresse...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Descriptif :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('desc', 'desc', '',  1, 'Entrez votre description...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Code postal :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('cp', 'cp', '',  1, 'Entrez votre code postal...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Ville :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('ville', 'ville', '',  1, 'Entrez votre ville...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Nom :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('nom', 'nom', '',  1, 'Entrez votre nom...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Prénom :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('prenom', 'prenom', '',  1, 'Entrez votre prénom...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerMessage($messageErreurConnexion));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->creerFormulaire();

require_once 'vue/visiteurs/vueInscription.php';

}
else{
    header("Location: .");
}

