<?php

class VenteDAO{
    public static function createVentes(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM vente");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $venteDao) {
            $vente = new VenteDTO();
            $vente->hydrate($venteDao);
        }
    }
}