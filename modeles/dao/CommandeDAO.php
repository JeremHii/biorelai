<?php
class CommandeDAO{

    public static function createCommandes(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM commande");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $commandeDao) {
            $commande = new CommandeDTO();
            $commande->hydrate($commandeDao);
        }
    }

    //Pour créer une commande
    public static function addCommande(CommandeDTO $commande){
        $db = Db::getDb();
        $req = $db->prepare("INSERT INTO commande(idUtilisateur, date, semaine) VALUES (?, CURRENT_TIMESTAMP, ?)");
        $req->execute(array(
            $commande->getIdUtilisateur(),
            $commande->getSemaine()
        ));
    }
    
    //Pour récupérer la dernière commande
    public static function getLastId(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT DISTINCT max(id) as id FROM commande;");
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)["id"];
    }
}