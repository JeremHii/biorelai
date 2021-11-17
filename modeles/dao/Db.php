<?php

class Db{
    public static function getDb(){

        $dsn = "mysql:host=10.100.0.5;dbname=jdelmas_biorelai;charset=utf8";
        $username = "jdelmas";
        $password = "jdelmas";
        $db = new PDO($dsn, $username, $password);
        return $db;
    }
}