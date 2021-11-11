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

    public static function changeMail($idUser , $mail){
        $db = Db::getDb();
        $req = $db->prepare("
        UPDATE utilisateur
        SET mail=:mail
        WHERE id=:idUser
        ");
        $req->bindParam(':mail', $mail);
        $req->bindParam(':idUser', $idUser);
    }

    //Récupère tout les intervenants si ils ont le statut de bénévole ou salarié
    public static function getUsers(){
        $requetePrepa = Db::getDb()->prepare("select id, nom, prenom from utilisateur where fonction = 'PRD'");
        $requetePrepa->execute();
        $requeteUser = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        return $requeteUser;
    }

    //Récupère les informations de l'utilisateur sélectionné
    public static function getUserById($id){
        $requetePrepa = DB::getDb()->prepare("select id, mail, adresse, descriptif, cp, ville, nom, prenom, fonction from utilisateur where id = ?");
        $requetePrepa->execute(array($id));
        $requeteUser = $requetePrepa->fetch(PDO::FETCH_ASSOC);

        return $requeteUser;
    }

    public static function SuppIntervenants($idUser){
        $db = Db::getDb();
        $req = $db->prepare("
        DELETE FROM utilisateur
        WHERE id=:id
        ");
        $req->bindParam(':id', $idUser);
        $req->execute();
    }

    public static function SuppProducteur($idUser){
        $db = Db::getDb();
        $req = $db->prepare("
        DELETE FROM utilisateur
        WHERE id=:id
        ");
        $req->bindParam(':id', $idUser);
        $req->execute();
    }
}