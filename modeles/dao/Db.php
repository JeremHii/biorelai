<?php

class Db{
    public static function getDb(){
        $dsn = "mysql:host=localhost;dbname=biorelai";
        $username = "root";
        $password = "";
        $db = new PDO($dsn, $username, $password);
        return $db;
    }
}