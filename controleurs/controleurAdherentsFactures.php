<?php
if(isset($user) && $user->getFonction() == "ADH"){
        //Le titre de la page
        $titre = "<h1>Voici la liste de vos factures</h1>";
        echo $titre;
        //Je créer un tableau pour afficher mon panier
        $composant = "<table border='1'>
        <tr>
        <th>Date</th>
        <th>Factures</th>
        </tr>";
        CommandeDAO::createCommandes();

        $liste = $user->getCommandes();
        if(!empty($liste)){
            foreach($liste as $row)
            {
                $composant .= "<tr>";
                $composant .= "<td>" . $row->getDate() . "</td>";
                $composant .= "<td> <a href ='";
                $composant .=  $row->getFacturesPDF() . "' title='Afficher' target='blank_'> Afficher</a>";
                $composant .= "</td>";
                $composant .= "</tr>";
            }
            $composant .= "</table>";
        
            echo $composant;
        }
        //Si l'utilisateur n'a pas de facture
        else{
            echo "<h1 style='text-align: center; color: red;'>";
            echo "Vous n'avez pas encore de facture";
            echo "</h1>";
        }

    require_once 'vue/adherents/vueAdherentsFactures.php';
}
else{
    header("Location: .");
}

