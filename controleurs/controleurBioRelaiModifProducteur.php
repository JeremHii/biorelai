<?php

if(!isset($_GET["producteur"])) header("Location: ");
UserDAO::createUsers();
$user = UserDTO::getUser($_GET["producteur"]);

if(isset($_POST["mail"]) && isset($_POST["adresse"]) && isset($_POST["descriptif"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["fonction"])){
    ResponsableDAO::updateUser($user->getid(), $_POST["mail"], $_POST["adresse"], $_POST["descriptif"], $_POST["cp"], $_POST["ville"], $_POST["nom"], $_POST["prenom"], $_POST["fonction"]);
    header("Location: ?page=BioRelaiProducteurs");
}

$formulaireInfos = new Formulaire('post', '', 'fPRD', 'fPRD'); //Création d'un nouveau formulaire
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Mail :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('mail', 'mail', $user->getMail(), 1, '', '')); //Affichage du nom de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Adresse :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('adresse', 'adresse', $user->getAdresse(), 1, '', ''));//Affichage du login de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Descriptif :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('descriptif', 'descriptif',  $user->getDescriptif(),1, '', ''));//Affichage du statut de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Code Postal :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('cp', 'cp',  $user->getCp(),1, '', ''));//Affichage de la fonction de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Ville :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('ville', 'ville',  $user->getVille(),1, '', ''));//Affichage de la fonction de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Nom :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('nom', 'nom', $user->getNom(), 1, '', '')); //Affichage du nom de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Prenom :'));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte('prenom', 'prenom', $user->getPrenom(), 1, '', ''));//Affichage du prenom de l'utilisateur
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel('Fonction :'));
FonctionDAO::createFonctions();
$select = new Select("fonction");
foreach (FonctionDTO::getFonctions() as $fonction) {
    $select->addOption(new SelectOption($fonction->getCode(), $fonction->getLibelle(), $user->getFonction() == $fonction->getCode()));
}
$formulaireInfos->ajouterComposantLigne($select);
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputSubmit('Modifier', '1', 'Modifier'));

$formulaireInfos->ajouterComposantTab();

$formulaireInfos->creerFormulaire();

require_once 'vue/producteurs/vueProducteurModifier.php';