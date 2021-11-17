<?php
if(isset($user) && $user->getFonction() == "ADH"){
    //Je vérifie si l'id a était envoyé
    if(isset($_POST['id'])){
        //Je vérifie si le panier existe
        if(!isset($_SESSION['Panier'])){
            $_SESSION['Panier'] = serialize(array());
        }
        //Je créer un objet produit
        ProduitDAO::createProduits();
        $panier = unserialize($_SESSION['Panier']);


        //J'ajoute l'élément a la variable de session
        $var = ProduitDTO::getProduit($_POST['id']);

        //On regarde si le panier est pas vide pour ensuite le parcourir et vérifier si l'utilisateur ne met pas deux fois le même produits
        if(!empty($panier)){
            foreach($panier as $row){
                if($row['nom'] == $var->getNom()){
                    echo "<SCRIPT>alert('Vous avez déjà ce produits dans votre panier !')</SCRIPT>";
                    echo "<SCRIPT>javascript:window.close()</SCRIPT>";
                }
                else{
                    array_push($panier, array("id"=>$_POST['id'], "nom"=>$var->getNom(), "descriptif"=>$var->getDescriptif(), "quantite"=>$_POST['quantite']));
                }
            }
        }else{
            array_push($panier, array("id"=>$_POST['id'], "nom"=>$var->getNom(), "descriptif"=>$var->getDescriptif(), "quantite"=>$_POST['quantite']));
        }
        
        //Je re serialize le panier
        $_SESSION['Panier'] = serialize($panier);

        //Ici en javascript je ferme la fenêtre
        echo '<SCRIPT>javascript:window.close()</SCRIPT>';
    }
}
else{
    header("Location: .");
}