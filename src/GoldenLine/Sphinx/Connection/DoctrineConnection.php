<?php

namespace GoldenLine\Sphinx\Connection;

use GoldenLine\Sphinx\Connection as ConnectionInterface;
use Doctrine\DBAL\Connection;

class DoctrineConnection implements ConnectionInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function execute($sql)
    {
        return $this->connection->fetchAssoc($sql);
    }
}
