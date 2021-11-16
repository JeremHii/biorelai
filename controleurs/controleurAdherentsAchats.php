<?php
if(isset($user) && $user->getFonction() == "ADH"){
    SemaineDAO::createSemaines();
    if(SemaineDTO::getSemaineActive()->canAdherentBuy()){
        $titre = "<h1>Voici la liste des produits en vente</h1>";
        echo $titre;
        $composant = "<table border='1'>
        <tr>
        <th>Nom</th>
        <th>Descriptif</th>
        <th>Prix</th>
        <th>Quantité disponible</th>
        <th>Quantité souhaitée</th>
        <th>Ajouter</th>
        </tr>";
        $liste = VenteDAO::getVenteSemaine();
        if(!empty($liste)){
            foreach($liste as $row)
            {
                $composant .= "<form method='post' action='index.php?page=AdherentsAjoutPanier'>";
                $composant .= "<tr>";
                $composant .= "<td style='display: none;'>" . "<input type='hidden' name='id' value='" . $row['id'] . "'/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='nom' class='AchatTab' value='" . $row['nom'] . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='desc' class='AchatTab' value='" . $row['descriptif'] . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='prix' class='AchatTab' value='" . $row['prix'] . "'disabled/>" . "</td>";
                $composant .= "<td>" . "<input type='text' name='quantiteM' class='AchatTab' value='" . $row['quantite'] . "'disabled/>" . "</td>";
                //Faire en sorte que l'utilisateur peut saisir que la quantité max disponible
                $composant .= "<td>" ."<select name='quantite'>";
                for($i = 1; $i <= $row['quantite']; $i++){
                    $composant .= "<option value='" . $i . "'>" . $i . "</option>";
                }
                $composant .= "</select>". "</td>";
                $composant .= "<td>" . "<input type='submit' id='ajout' value='Ajouter'>" . "</td>";
                $composant .= "</form>";
                $composant .= "</tr>";
            }
            $composant .= "</table>";
        
            echo $composant;
        }
        else{
            echo "<h1 style='text-align: center; color: red;'>";
            echo "Vous n'avez pas encore de facture";
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
