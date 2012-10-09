<?php

namespace GoldenLine\Sphinx\QueryBuilder;

class QueryBuilder
{
    protected $sql;

    protected $statement;

    const SELECT    = 1;
    const UPDATE    = 2;
    const REPLACE   = 3;
    const DELETE    = 4;

    public function __construct($statement = null)
    {
        $this->statement = $statement;
    }

    public function select($columns = null)
    {
        $this->statement = new Select(func_get_args());

        return $this->statement;
    }

    public function delete()
    {

    }

    public function update()
    {

    }

    public function replace()
    {

    }

    protected function compileConditions(array $conditions)
    {
        $lastCondition  = null;
        $sql            = '';

        foreach ($conditions as $conditionGroup) {
            foreach ($conditionGroup as $logic => $condition) {
                if ($condition === '(') {
                    if (!empty($sql) && $lastCondition !== '(') {
                        $sql .= ' ' . $logic . ' ';
                    }
                    $sql .= '(';
                } else if ($condition === ')') {
                    $sql .= ')';
                } else {
                    if (!empty($sql) && $lastCondition !== '(') {
                        $sql .= ' ' . $logic . ' ';
                    }

                    list ($column, $op, $value) = $condition;

                    if ($value === null) {
                        if ($op === '=') {
                            $op = 'IS';
                        } else if ($op === '!=') {
                            $op = 'IS NOT';
                        }
                    }

                    $op = strtoupper($op);

                    if ($op === 'BETWEEN' && is_array($value)) {
                        list($min, $max) = $value;

                        $value = $min . ' AND ' . $max;
                    }

                    $sql .= trim($column . ' ' . $op . ' ' . $value);
                }

                $lastCondition = $condition;
            }

        }

        return $sql;

    }

    protected function compileOrderBy(array $columns)
    {
        $sort = array();

        foreach ($columns as $group) {
            list ($column, $direction) = $group;

            $sort[] = $column . ' ' . strtoupper($direction);
        }

        return 'ORDER BY ' . implode(', ', $sort);
    }

    public function end()
    {
        $this->statement->compile();

        return $this->sql;
    }

}
