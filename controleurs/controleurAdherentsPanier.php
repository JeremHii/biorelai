<?php
if(isset($user) && $user->getFonction() == "ADH"){
    if(!empty($_SESSION['Panier'])){
        $panier = unserialize($_SESSION['Panier']);
        $composant = "<table border='1'>
        <tr>
        <th>Nom</th>
        <th>Descriptif</th>
        <th>Quantité</th>
        </tr>";
        foreach($panier as $row)
        {
            $composant .= "<tr>";
            $composant .= "<td>" . $row['nom'] . "</td>";
            $composant .= "<td>" . $row['descriptif'] . "</td>";
            $composant .= "<td>". $row['quantite']. "</td>";
            $composant .= "</tr>";
        }
        $composant .= "</table>";
    
        echo $composant;
    }
    else{
        echo "<h1 style='text-align: center; color: red;'>";
        echo "Votre panier est vide";
        echo "</h1>";
    }

    require_once 'vue/adherents/vueAdherentsPanier.php';
}
else{
    header("Location: .");
}