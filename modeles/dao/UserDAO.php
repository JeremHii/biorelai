<?php
class UserDAO{

    public static function createUsers(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT id, mail, adresse, descriptif, cp, ville, nom, prenom, fonction FROM utilisateur");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $utilisateurDao) {
            $utilisateur = new UserDTO();
            $utilisateur->hydrate($utilisateurDao);
        }
    }

    public static function getUserByCredentials($mail, $password){
        $db = Db::getDb();
        $req = $db->prepare("
        SELECT id, mail, adresse, descriptif, cp, ville, nom, prenom, fonction
        FROM utilisateur
        WHERE mail = ?
        AND mdp = ?
        ");
        $req->execute(array($mail, md5($password)));
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function createUser($mail, $mdp, $adresse, $descriptif, $cp, $ville, $nom, $prenom, $fonction="ADH"){
        $db = Db::getDb();
        $req = $db->prepare("
        INSERT INTO utilisateur(mail, mdp, adresse, descriptif, cp, ville, nom, prenom, fonction)
        VALUES (:mail, :mdp, :adresse, :descriptif, :cp, :ville, :nom, :prenom, :fonction);
        ");
        $req->bindParam(':mail', $mail);
        $req->bindParam(':mdp', $mdp);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':descriptif', $descriptif);
        $req->bindParam(':cp', $cp);
        $req->bindParam(':ville', $ville);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':fonction', $fonction);

        $req->execute();
    }

    public static function userExists($mail){
        $db = Db::getDb();
        $req = $db->prepare("
        SELECT count(mail)
        FROM utilisateur
        WHERE mail = ?
        ");
        $req->execute(array($mail));
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUser(UserDTO $user){
        $db = Db::getDb();
        $req = $db->prepare("UPDATE utilisateur SET mail = ?, adresse = ?, descriptif = ?, cp = ?, ville = ?, nom = ?, prenom = ?, fonction = ? WHERE id = ?");
        $req->execute(array(
            $user->getMail(),
            $user->getAdresse(),
            $user->getDescriptif(),
            $user->getCp(),
            $user->getVille(),
            $user->getNom(),
            $user->getPrenom(),
            $user->getFonction(),
            $user->getId()
        ));
    }

    public static function updateUserPass(UserDTO $user, $pass){
        $db = Db::getDb();
        $req = $db->prepare("UPDATE utilisateur SET mdp = md5(?) WHERE id = ?");
        $req->execute(array(
            $pass,
            $user->getId()
        ));
    }
}