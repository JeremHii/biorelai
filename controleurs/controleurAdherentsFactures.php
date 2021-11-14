<?php

function afficherTableauFactures(){
    $composant = "<table border='1'>
    <tr>
    <th>Date</th>
    <th>Factures</th>
    </tr>";

    $liste = UserDAO::getFactures();
    if(!empty($liste)){
        foreach($liste as $row)
        {
            $composant .= "<tr>";
            $composant .= "<td>" . $row['date'] . "</td>";
            $composant .= "<td> <a href ='";
            $composant .=  $row['facturesPDF'] . "' title='Afficher' target='blank_'> Afficher</a>";
            $composant .= "</td>";
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
}
require_once 'vue/adherents/vueAdherentsFactures.php';
