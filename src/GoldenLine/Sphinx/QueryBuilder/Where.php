<?php

namespace GoldenLine\Sphinx\QueryBuilder;

class Where extends QueryBuilder
{
    protected $conditions   = array();

    protected $orderBy      = array();

    protected $limit        = null;

    public function __construct($statement)
    {
        parent::__construct($statement);
    }

    public function where($column, $op, $value)
    {
        return $this->andWhere($column, $op, $value);
    }

    public function andWhere($column, $op, $value)
    {
        $this->conditions[] = array('AND' => array($column, $op, $value));

        return $this;
    }

    public function orWhere($column, $op, $value)
    {
        $this->conditions[] = array('OR' => array($column, $op, $value));

        return $this;
    }

    public function whereOpen()
    {
        return $this->andWhereOpen();
    }

    public function andWhereOpen()
    {
        $this->conditions[] = array('AND' => '(');

        return $this;
    }

    public function orWhereOpen()
    {
        $this->conditions[] = array('OR' => '(');

        return $this;
    }

    public function whereClose()
    {
        $this->andWhereClose();
    }

    public function andWhereClose()
    {
        $this->conditions[] = array('AND' => ')');

        return $this;
    }

    public function orWhereClose()
    {
        $this->conditions[] = array('OR' => ')');

        return $this;
    }

    public function orderBy($column, $direction = null)
    {
        $this->orderBy[] = array($column, $direction);

        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
