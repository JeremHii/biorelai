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
}