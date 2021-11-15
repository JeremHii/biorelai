<?php
class FactureDAO{

    public static function createFactures(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM commande");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $factureDao) {
            $facture = new FactureDTO();
            $facture->hydrate($factureDao);
        }
    }
}