<?php
class ProduitDAO{

    public static function createProduits(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM produit");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $produitDao) {
            $produit = new ProduitDTO();
            $produit->hydrate($produitDao);
        }
    }

    public static function getProduitNomById($id){
        $db = Db::getDb();
        $req = $db->prepare("
        SELECT nom, descriptif
        FROM produit
        WHERE id=:id
        ");
        $req->bindParam(':id', $id);
        $req->execute();
        
        return $req->fetchAll();
    }

}