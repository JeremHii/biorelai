<?php

if(isset($_GET["semaine"])){
    SemaineDAO::createSemaines();
    SemaineDAO::deleteSemaine(SemaineDTO::getSemaine($_GET["semaine"]));
    header("Location: ?page=BioRelaiSemaines");
}