<?php
class LigneCommandeDAO{

    public static function createLignesCommande(){
        $db = Db::getDb();
        $req = $db->prepare("SELECT * FROM ligne_commande");
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $ligneCommandeDao) {
            $ligneCommande = new LigneCommandeDTO();
            $ligneCommande->hydrate($ligneCommandeDao);
        }
    }

    public static function addLigneCommande(LigneCommandeDTO $ligneCommande){
        $db = Db::getDb();
        $req = $db->prepare("INSERT INTO ligne_commande(produit, commande, quantite) VALUES (?, ?, ?)");
        $req->execute(array(
            $ligneCommande->getProduit(),
            $ligneCommande->getCommande(),
            $ligneCommande->getQuantite()
        ));
    }
}