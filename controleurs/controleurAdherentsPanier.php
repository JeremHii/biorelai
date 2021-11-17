<?php
if(isset($user) && $user->getFonction() == "ADH"){
    //Je vérifie si le panier n'est pas vide
    if(!empty($_SESSION['Panier'])){
        //J'affiche un titre
        $titre = "<h1>Votre panier</h1>";
        echo $titre;
        //J'unserialize le panier
        $panier = unserialize($_SESSION['Panier']);

        if(isset($_POST['id'])){
            $newPanier = array();
            foreach($panier as $produit){
                if($produit["id"] != $_POST['id']){
                    array_push($newPanier, $produit);
                }
            }
            $panier = $newPanier;
            $_SESSION['Panier'] = serialize($panier);
        }

        //je créer un tableau pour afficher le panier
        $composant = "<table border='1'>
        <tr>
        <th>Nom</th>
        <th>Descriptif</th>
        <th>Quantité</th>
        <th>Supprimer</th>
        </tr>";
        foreach($panier as $row)
        {
            $composant .= "<form method='post' action='index.php?page=AdherentsPanier'>";
            $composant .= "<tr>";
            $composant .= "<td style='display: none;'>" . "<input type='hidden' name='id' value='" . $row['id'] . "'/>" . "</td>";
            $composant .= "<td>" . $row['nom'] . "</td>";
            $composant .= "<td>" . $row['descriptif'] . "</td>";
            $composant .= "<td>". $row['quantite']. "</td>";
            $composant .= "<td>" . "<input type='submit' id='suppPanier' value='Supprimer'>" . "</td>";
            $composant .= "</form>";
            $composant .= "</tr>";
        }
        $composant .= "</table>";

        echo $composant;
        
        //Je créer un bouton pour créer la commande
        $formulairePanier = new Formulaire('post', 'index.php?page=AdherentsCommandeCreer', 'Valider', 'Valider');

        $formulairePanier->ajouterComposantLigne($formulairePanier-> creerInputSubmit('submitValider', 'submitValider', 'Valider ma commande'));
        $formulairePanier->ajouterComposantTab();
    
        $formulairePanier->creerFormulaire();

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