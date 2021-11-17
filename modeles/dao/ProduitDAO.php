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
  
    public static function updateProduit(ProduitDTO $produit){
        $db = Db::getDb();
        $req = $db->prepare("UPDATE produit SET nom = ?, descriptif = ?, unite = ? WHERE id = ?");
        $req->execute(array(
            $produit->getNom(),
            $produit->getDescriptif(),
            $produit->getUnite(),
            $produit->getId()
        ));
    }

    public static function addProduit(ProduitDTO $produit){
        $db = Db::getDb();
        $req = $db->prepare("INSERT INTO produit(nom, descriptif, unite, id_utilisateur) VALUES (?, ?, ?, ?)");
        $req->execute(array(
            $produit->getNom(),
            $produit->getDescriptif(),
            $produit->getUnite(),
            $produit->getId_utilisateur()
        ));
    }

    public static function deleteProduit(ProduitDTO $produit){
        $db = Db::getDb();
        $req = $db->prepare("DELETE FROM produit WHERE id = ?");
        $req->execute(array(
            $produit->getId()
        ));
    }
}