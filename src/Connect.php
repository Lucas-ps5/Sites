<?php
namespace App;

use PDO;

class Connect {

    public static function getPDO() : PDO
    {
        return new PDO('mysql:dbname=test;host=127.0.0.1', 'Lucas', 'logaboluc1', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}