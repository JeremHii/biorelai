<?php
if(isset($user) && $user->getFonction() == "ADH"){
    if(!empty($_SESSION['Panier'])){
        $panier = unserialize($_SESSION['Panier']);
        if(is_array($panier) && sizeof($panier) > 0){

            SemaineDAO::createSemaines();

            $commande = new CommandeDTO();
            $commande->setIdUtilisateur($user->getId())
            ->setSemaine(SemaineDTO::getSemaineActive()->getNumero());

            CommandeDAO::addCommande($commande);
            $commandeId = CommandeDAO::getLastId();

            foreach($panier as $row)
            {
                $ligneCommande = new LigneCommandeDTO();
                $ligneCommande->setProduit($row["id"])
                ->setCommande($commandeId)
                ->setQuantite($row["quantite"]);

                LigneCommandeDAO::addLigneCommande($ligneCommande);
            }
            $_SESSION['Panier'] = serialize(array());
            header("Location: ?page=AdherentsFactures");
        }
            
    }
    else{
        echo "<h1 style='text-align: center; color: red;'>";
        echo "Votre panier est vide";
        echo "</h1>";
    }
}
else{
    header("Location: .");
}