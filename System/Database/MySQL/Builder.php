<?php

namespace System\Database\MySQL;

use System\Database\Builder\BuilderInterface;

/**
 * Class Builder
 * @package System\Database\MySQL
 */
class Builder implements BuilderInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Set local values
     * @param Connection|null $connection
     */
    public function __construct(Connection $connection = null)
    {
        $this->setConnection($connection ?: $this->createDefaultConnection());
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param Connection $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Creates the default conneciton
     *
     * @return Connection
     */
    protected function createDefaultConnection()
    {
        return new Connection;
    }
    
    /**
     * The fields that should be selected
     *
     * @var array
     */
    protected $fields = [
        '*'
    ];

    /**
     * The table the query is working with
     *
     * @var string
     */
    protected $from;

    /**
     * The array of conditions
     *
     * @var array
     */
    protected $where = [];

    /**
     * Fields that should be selected, all by default
     *
     * @param ...$fields
     * @return $this
     */
    public function select(...$fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Specifies the table on which the query builder should select from
     *
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->from = $table;

        return $this;
    }

    /**
     * Add a condition for the query
     *
     * @param $expression
     * @param $operator
     * @param $value
     * @return $this
     */
    public function where($expression, $operator, $value)
    {
        $this->where[] =  "{$expression} {$operator} {$value}";

        return $this;
    }

    /**
     * Returns an array of objects for the built query
     *
     * @return Object[]
     */
    public function get()
    {
        $result = $this->connection->query($this->getQuery());

        $this->refresh();

        return $result;
    }

    /**
     * Refreshes the builder state
     *
     * @return $this
     */
    public function refresh()
    {
        $this->fields = [
            '*'
        ];

        $this->from = null;
        $this->where = [];

        return $this;
    }

    /**
     * Builds the query with set parameters
     *
     * @return string
     */
    public function getQuery()
    {
        $sql = "SELECT " .
            implode(',', $this->fields) .
            " FROM {$this->from} ";

        if (count($this->where))
            $sql .= " WHERE " . implode(' AND ', $this->where);

        return $sql;
    }

    /**
     * Insert a given array of values into the specified table
     *
     * @param $table
     * @param array $values
     * @return bool
     */
    public function insert($table, array $values)
    {
        $keyString = implode(', ', array_keys($values));

        $valueString = $this->createValueString($values);

        $sql = "INSERT INTO {$table} ({$keyString}) VALUES ({$valueString})";

        return $this->connection->query($sql);
    }

    /**
     * Processes an array of values to create the string needed for an insert query
     *
     * @param array $values
     * @return string
     */
    protected function createValueString(array $values)
    {
        $string = '';

        foreach ($values as $value)
        {
            if (is_numeric($value))
                $string .= "{$value}, ";

            else if (is_null($value))
                $string .= "null, ";

            else
                $string .= "'{$value}', ";
        }

        return rtrim($string, ', ');
    }
}