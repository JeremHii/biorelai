<?php

CategorieDAO::createCategories();
//Affichage des categories sous forme de tableau
$tableCategories = new Table(array("Code", 'Libelle'));
foreach(CategorieDTO::getCategories() as $categorie){
    $tableCategories->addRow(array(
        $categorie->getCode(),
        $categorie->getLibelle(),
    ));
}

require_once 'vue/bioRelai/vueBioRelaiCategories.php';