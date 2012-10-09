<?php

namespace GoldenLine\Sphinx;

use GoldenLine\Sphinx\Connection;

class Client
{
    private $connection;

    /**
     * Constructor
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Query Client using SphinxQL
     *
     * @param string $sphinxQL
     *
     * @return array
     */
    public function execute($sphinxQL)
    {
        return $this->connection->execute($sphinxQL);
    }

}
