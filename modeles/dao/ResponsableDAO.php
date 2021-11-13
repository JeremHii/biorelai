<?php
class ResponsableDAO{

    //Récupère tout les intervenants si ils ont le mdp de bénévole ou salarié
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

    //Permet de modifier les informations de l'utilisateur précédemment choisi
    public static function updateUser($id, $mail, $adresse, $descriptif, $cp, $ville, $nom, $prenom, $fonction){
        $requetePrepa = DB::getDb()->prepare("update utilisateur set mail=:mail, adresse=:adresse, descriptif=:descriptif, cp=:cp, ville=:ville, nom=:nom, prenom=:prenom, fonction=:fonction where id=:id");
        $requetePrepa->bindParam(":mail",$mail);
        $requetePrepa->bindParam(":adresse",$adresse);
        $requetePrepa->bindParam(":descriptif",$descriptif);
        $requetePrepa->bindParam(":cp",$cp);
        $requetePrepa->bindParam(":ville",$ville);
        $requetePrepa->bindParam(":nom",$nom);
        $requetePrepa->bindParam(":prenom",$prenom);
        $requetePrepa->bindParam(":fonction",$fonction);
        $requetePrepa->bindParam(":id",$id);
        $requetePrepa->execute();
    }

    //Permet de supprimer l'utilisateur choisi
    public static function deleteUser($id){
        $requetePrepa = DB::getDb()->prepare("delete from utilisateur where id = ?");
        $requetePrepa->execute(array($id));
    }
}