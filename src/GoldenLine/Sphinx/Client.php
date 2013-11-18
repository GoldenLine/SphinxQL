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

    /**
     * @return int
     */
    public function getTotalCount()
    {
        $count = 0;
        $sql   = 'SHOW META';
        $meta  = $this->execute($sql);

        foreach ($meta as $item) {
            if ($item['Variable_name'] == 'total_found') {
                $count = (int) $item['Value'];
                break;
            }
        }

        return $count;
    }
}
