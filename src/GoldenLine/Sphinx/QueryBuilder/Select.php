<?php

namespace GoldenLine\Sphinx\QueryBuilder;

use GoldenLine\Sphinx\QueryBuilder\Where;

class Select extends Where
{
    protected $columns      = array();

    protected $tables       = array();

    public function __construct(array $columns = null)
    {
        $this->columns = $columns;

        parent::__construct($this);
    }

    public function select($columns = null)
    {
        $columns = func_get_args();

        $this->columns = array_merge($this->columns, $columns);

        return $this;
    }

    public function from($tables)
    {
        $tables = func_get_args();

        $this->tables = array_merge($this->tables, $tables);

        return $this;
    }

    public function compile()
    {
        $query = 'SELECT ';

        if (empty($this->columns)) {
            $query .= '*';
        } else {
            $query .= implode(', ', array_unique($this->columns));
        }

        if (!empty($this->tables)) {
            $query .= ' FROM ' . implode(', ', array_unique($this->tables));
        }

        if (!empty($this->conditions)) {
            $query .= ' WHERE ' . $this->compileConditions($this->conditions);
        }

        if (!empty($this->orderBy)) {
            $query .= $this->compileOrderBy($this->orderBy);
        }

        $this->sql = $query;
    }

}
