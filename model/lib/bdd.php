<?php

namespace App\Model\Lib;

use PDO;

class BDD
{
    /**
     * Fournit une connexion à la BDD.
     * 
     * @return PDO Connexion à la BDD.
     */
    public static function connect(): PDO
    {
        $db = [];
        $db = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/cfg/db.ini'); 

        // Établit la connexion à la BDD
        $dsn = 'mysql:host=' . $db['host'] . ';port=' . $db['port'] . ';dbname=' . $db['name'];
        $pdo = new PDO($dsn, $db['user'], $db['password']);

        return $pdo;
    }
}