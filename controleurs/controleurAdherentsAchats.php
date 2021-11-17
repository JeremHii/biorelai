<?php
if(isset($user) && $user->getFonction() == "ADH"){
    //Je vérifie si l'adhérent peut acheter 
    SemaineDAO::createSemaines();
    VenteDAO::createVentes();
    ProduitDAO::createProduits();
    if(SemaineDTO::getSemaineActive()->canAdherentBuy()){

        //Le titre de la page
        $titre = "<h1>Voici la liste des produits en vente</h1>";
        echo $titre;

        //Je créer un tableau pour proposer toute les ventes
        $composant = "<table border='1'>
        <tr>
        <th>Nom</th>
        <th>Descriptif</th>
        <th>Prix</th>
        <th>Quantité disponible</th>
        <th>Quantité souhaitée</th>
        <th>Ajouter</th>
        </tr>";
        //Je créer une liste avec toute les ventes de la semaine
        //$liste = VenteDAO::getVenteSemaine();
        $liste = VenteDTO::getVentes();
        if(!empty($liste)){
            //J'affiche cette liste
            foreach($liste as $row)
            {
                $produit = ProduitDTO::getProduit($row->getProduit());
                $composant .= "<form method='post' action='index.php?page=AdherentsAjoutPanier'>";
                $composant .= "<tr>";
                $composant .= "<td style='display: none;'>" . "<input type='hidden' name='id' value='" . $produit->getId() . "'/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='nom' class='AchatTab' value='" . $produit->getNom() . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='desc' class='AchatTab' value='" . $produit->getDescriptif() . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='prix' class='AchatTab' value='" . $row->getPrix() . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='quantiteM' class='AchatTab' value='" . $row->getQuantite() . "'disabled/>" . "</td>";
                //Faire en sorte que l'utilisateur peut saisir que la quantité max disponible
                $composant .= "<td>" ."<select name='quantite'>";
                for($i = 1; $i <= $row->getQuantite(); $i++){
                    $composant .= "<option value='" . $i . "'>" . $i . "</option>";
                }
                $composant .= "</select>". "</td>";
                $composant .= "<td>" . "<input type='submit' id='ajout' value='Ajouter'>" . "</td>";
                $composant .= "</form>";
                $composant .= "</tr>";
            }
            $composant .= "</table>";
            //J'affiche le tableau
            echo $composant;
        }
        //Si les ventes ne sont pas ouverte on affiche un message
        else{
            echo "<h1 style='text-align: center; color: red;'>";
            echo "Il n'y a pas de produit en vente";
            echo "</h1>";
        }
        require_once 'vue/adherents/vueAdherentsAchats.php';
    }
    else{
        require_once 'vue/adherents/vueAdherentsAchatsFermes.php';
    }
}
else{
    header("Location: .");
}
