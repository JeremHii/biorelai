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
    //Requête permettant la modification d'une vente
    public static function updateSemaine(SemaineDTO $semaine){
        $db = Db::getDb();
        $req = $db->prepare("UPDATE semaine SET dateDebutProducteur = ?, dateFinProducteur = ?, dateFinClient = ?, datevente = ? WHERE numero = ?");
        $req->execute(array(
            $semaine->getDateDebutProducteur(),
            $semaine->getDateFinProducteur(),
            $semaine->getDateFinClient(),
            $semaine->getDatevente(),
            $semaine->getNumero()
        ));
    }

    //Permet de supprimer la vente choisi
    public static function deleteSemaine(SemaineDTO $semaine){
        $requetePrepa = DB::getDb()->prepare("delete from semaine where numero = ?");
        $requetePrepa->execute(array($semaine->getNumero()));
    }

    //Requête permettant l'ajout d'une vente
    public static function addSemaine(SemaineDTO $semaine){
        $requetePrepa = DB::getDb()->prepare("INSERT INTO semaine(dateDebutProducteur, dateFinProducteur, dateFinClient, datevente) VALUES (?, ?, ?, ?)");
        $requetePrepa->execute(array(
            $semaine->getDateDebutProducteur(),
            $semaine->getDateFinProducteur(),
            $semaine->getDateFinClient(),
            $semaine->getDatevente()
        ));
    }
}