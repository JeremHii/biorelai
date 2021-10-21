<?php

class Db{
    public static function getDb(){
        $dsn = "mysql:host=10.100.0.5;dbname=jdelmas_biorelai";
        $username = "jdelmas";
        $password = "jdelmas";
        $db = new PDO($dsn, $username, $password);
        return $db;
    }
}