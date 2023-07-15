<?php
session_start();
abstract class Connexion {
    public static function connexion_start():PDO{      
        $server = "localhost";
        $database = "gestion_paie";
        $username = "root";
        $password = "";
        $dsn = "mysql:host=$server;dbname=$database;charset=utf8";
        try {
            $pdo = new PDO($dsn,$username,$password);
            return $pdo;
        } 
        catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}










?>