<?php
//Pour éviter une erreur si le panier est vide avec le formulaire
if(!empty($_SESSION['Panier'])){
    $formulairePanier->afficherFormulaire();
}
