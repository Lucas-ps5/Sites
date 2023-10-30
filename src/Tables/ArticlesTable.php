<?php
namespace App\Tables;
use PDO;

class ArticlesTable {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    

}