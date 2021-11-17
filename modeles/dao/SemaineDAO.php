<?php

class SemaineDAO{
    public static function createSemaines(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM semaine");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $semaineDao) {
            $semaine = new SemaineDTO();
            $semaine->hydrate($semaineDao);
        }
    }
}