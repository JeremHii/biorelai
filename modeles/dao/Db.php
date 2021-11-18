<?php

class Db{
    public static function getDb(){

        $dsn = "mysql:host=" . settings::$DB_HOST . ";dbname=" . settings::$DB_NAME . ";charset=utf8";
        $db = new PDO($dsn, settings::$DB_USERNAME, settings::$DB_PASSWORD);
        return $db;
    }
}