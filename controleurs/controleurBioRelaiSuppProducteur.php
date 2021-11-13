<?php

if(isset($_GET["producteur"])){
    ResponsableDAO::deleteUser($_GET["producteur"]);
    header("Location: ?page=BioRelaiProducteurs");
}