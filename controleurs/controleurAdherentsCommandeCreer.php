<?php
if(isset($user) && $user->getFonction() == "ADH"){
    //Je vérifie si le panier est pas vide
    if(!empty($_SESSION['Panier'])){
        $panier = unserialize($_SESSION['Panier']);
        //Je vérifie ici si le panier est un tableau qu'il est pas vide encore une fois
        if(is_array($panier) && sizeof($panier) > 0){

            SemaineDAO::createSemaines();

            //J'initialise l'objet commande avec des accesseurs
            $commande = new CommandeDTO();
            $commande->setIdUtilisateur($user->getId())
            ->setSemaine(SemaineDTO::getSemaineActive()->getNumero());

            //Je créer la commande avec le DAO a partir de l'objet que je viens de créer
            CommandeDAO::addCommande($commande);
            $commandeId = CommandeDAO::getLastId();

            //Je créer la ligne commande a partir de la commande et du panier
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
    //J'affiche un message si le panier est vide
    else{
        echo "<h1 style='text-align: center; color: red;'>";
        echo "Votre panier est vide";
        echo "</h1>";
    }
}
else{
    header("Location: .");
}