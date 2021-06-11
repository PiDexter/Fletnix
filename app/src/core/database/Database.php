<?php


namespace app\src\core\database;


use PDO;
use PDOException;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {

        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        // Creëer een nieuwe database connectie via een nieuwe PDO instantie
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

    }


}