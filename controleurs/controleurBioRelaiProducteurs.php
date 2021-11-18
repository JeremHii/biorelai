<?php


if(isset($user) && $user->getFonction() == "RES"){
    if(isset($_POST['mail']) || isset($_POST['mdp']) || isset($_POST['Cmdp']) || isset($_POST['adresse']) || isset($_POST['desc']) || isset($_POST['cp']) || isset($_POST['nom']) || isset($_POST['prenom'])){
        if(isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['Cmdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['Cmdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
        {   
            if($_POST['mdp'] == $_POST['Cmdp'])
            {
                if(!UserDAO::userExists($_POST['mail']))
                {

                    $newUser = new UserDTO();
                    $newUser->setMail($_POST['mail']);
                    $newUser->setAdresse($_POST['adresse']);
                    $newUser->setDescriptif($_POST['desc']);
                    $newUser->setCp($_POST['cp']);
                    $newUser->setVille($_POST['ville']);
                    $newUser->setNom($_POST['nom']);
                    $newUser->setPrenom($_POST['prenom']);
                    $newUser->setFonction("PRD");
                    UserDAO::addUser($newUser, $_POST['mdp']);

                    //header("Location: ?page=BioRelaiProducteurs");
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

//Création du formulaire pour l'inscription d'un producteur
$formulaireInscription = new Formulaire('post', '?page=BioRelaiProducteurs', 'fInscription', 'fInscription');

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mail :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('mail', 'mail', '', 1, 'Entrez le mail...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mot de Passe :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('mdp', 'mdp',  1, 'Entrez le mot de passe...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Confirmez le mot de Passe :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('Cmdp', 'Cmdp',  1, 'Confirmez le mot de passe...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel("L'adresse :"));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('adresse', 'adresse', '',  1, 'Entrez son adresse...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Descriptif :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('desc', 'desc', '',  1, 'Entrez sa description...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Code postal :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('cp', 'cp', '',  1, 'Entrez son code postal...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Ville :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('ville', 'ville', '',  1, 'Entrez sa ville...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Nom :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('nom', 'nom', '',  1, 'Entrez son nom...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Prénom :'));
$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('prenom', 'prenom', '',  1, 'Entrez son prénom...', ''));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerMessage($messageErreurConnexion));
$formulaireInscription->ajouterComposantTab();

$formulaireInscription->creerFormulaire();

UserDAO::createUsers();

$tableauProducteurs = new Table(array("Nom", "Prenom"));
foreach (ResponsableDAO::getUsers() as $user) {
    $tableauProducteurs->addRow(array(
        $user["nom"],
        $user["prenom"],
        new TableLink("Modifier", "?page=BioRelaiModifProducteur&producteur=" . $user["id"]),
        new TableLink("Supprimer", "?page=BioRelaiSuppProducteur&producteur=" . $user["id"])
    ));
}

require_once 'vue/bioRelai/vueBioRelaiProducteurs.php';

}
else{
    header("Location: .");
}

