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

    public static function updateVente(VenteDTO $vente){
        $db = Db::getDb();
        $req = $db->prepare("UPDATE vente SET quantite = ?, prix = ? WHERE produit = ? AND semaine = ?");
        $req->execute(array(
            $vente->getQuantite(),
            $vente->getPrix(),
            $vente->getProduit(),
            $vente->getSemaine()
        ));
    }

    public static function addVente(VenteDTO $vente){
        $db = Db::getDb();
        $req = $db->prepare("INSERT INTO vente(produit, semaine, prix, quantite) VALUES (?, ?, ?, ?)");
        $req->execute(array(
            $vente->getProduit(),
            $vente->getSemaine(),
            $vente->getPrix(),
            $vente->getQuantite()
        ));
    }

    public static function deleteVente(VenteDTO $vente){
        $db = Db::getDb();
        $req = $db->prepare("DELETE FROM vente WHERE produit = ? AND semaine = ?");
        $req->execute(array(
            $vente->getProduit(),
            $vente->getSemaine()
        ));
    }

    public static function getVenteSemaine(){
        $db = Db::getDb();
        $req = $db->prepare("
        SELECT produit.id, nom, descriptif, quantite, prix
        FROM produit, vente 
        WHERE produit.id = vente.produit
        ");
        $req->execute();
        return $req->fetchAll();
    }
}