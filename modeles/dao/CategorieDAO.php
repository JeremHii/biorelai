<?php
class CategorieDAO{

    public static function createCategories(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM categorie");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $categorieDao) {
            $categorie = new CategorieDTO();
            $categorie->hydrate($categorieDao);
        }
    }

    //Requête permettant l'ajout d'une catégorie
    public static function addCategorie(CategorieDTO $categorie){
        $requetePrepa = DB::getDb()->prepare("INSERT INTO categorie(libelle) VALUES (?)");
        $requetePrepa->execute(array(
            $categorie->getLibelle()
        ));
    }
}