<?php
class FonctionDAO{

    public static function createFonctions(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM fonction");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $fonctionDao) {
            $fonction = new FonctionDTO();
            $fonction->hydrate($fonctionDao);
        }
    }
}