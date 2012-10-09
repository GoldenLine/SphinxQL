<?php

namespace GoldenLine\Sphinx\Connection;

use GoldenLine\Sphinx\Connection;

class PDOConnection implements Connection
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute($sql)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
