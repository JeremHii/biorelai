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

    public static function addUser(UserDTO $user, $mdp){
        $db = Db::getDb();
        $req = $db->prepare("
        INSERT INTO utilisateur(mail, mdp, adresse, descriptif, cp, ville, nom, prenom, fonction)
        VALUES (?, md5(?), ?, ?, ?, ?, ?, ?, ?);
        ");

        $req->execute(array(
            $user->getMail(),
            $mdp,
            $user->getAdresse(),
            $user->getDescriptif(),
            $user->getCp(),
            $user->getVille(),
            $user->getNom(),
            $user->getPrenom(),
            $user->getFonction()
        ));
    }

    public static function userExists($mail){
        $db = Db::getDb();
        $req = $db->prepare("
        SELECT count(*) > 0 AS doesExists
        FROM utilisateur
        WHERE mail = ?
        ");
        $req->execute(array($mail));
        
        return $req->fetch(PDO::FETCH_ASSOC)["doesExists"] == 1;
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

    public static function deleteUser(UserDTO $user){
        $db = Db::getDb();
        $req = $db->prepare("DELETE FROM utilisateur WHERE id = ?");
        $req->execute(array(
            $user->getId()
        ));
    }

    public static function changeMdp($idUser, $mdp){
        $db = Db::getDb();
        $req = $db->prepare("
        UPDATE utilisateur 
        SET mdp=:mdp
        WHERE id=:id;
        ");
        $req->bindParam(':id', $idUser);
        $req->bindParam(':mdp', $mdp);
        $req->execute();
    }

    public static function changeModif($idUser, $mail, $nom, $prenom, $adresse, $ville, $cp){
        $db = Db::getDb();
        $req = $db->prepare("
        UPDATE utilisateur 
        SET mail=:mail,
            nom=:nom, 
            prenom=:prenom,
            adresse=:adresse,
            ville=:ville,
            cp=:cp
        WHERE id=:id;
        ");
        $req->bindParam(':id', $idUser);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':ville', $ville);
        $req->bindParam(':cp', $cp);
        $req->execute();
    }

}