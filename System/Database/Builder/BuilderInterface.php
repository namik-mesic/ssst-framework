<?php

namespace System\Database\Builder;

/**
 * Interface BuilderInterface
 * @package System\Database\Builder
 */
interface BuilderInterface
{
    /**
     * Fields that should be selected, all by default
     *
     * @param ...$fields
     * @return $this
     */
    public function select(...$fields);

    /**
     * Specifies the table on which the query builder should select from
     *
     * @param $table
     * @return $this
     */
    public function from($table);

    /**
     * Add a condition for the query
     *
     * @param $expression
     * @param $operator
     * @param $value
     * @return $this
     */
    public function where($expression, $operator, $value);

    /**
     * Returns an array of objects for the built query
     *
     * @return Object[]
     */
    public function get();

    /**
     * Refreshes the builder state
     *
     * @return $this
     */
    public function refresh();

    /**
     * Builds the query with set parameters
     *
     * @return string
     */
    public function getQuery();

    /**
     * Insert a given array of values into the specified table
     *
     * @param $table
     * @param array $values
     * @return bool
     */
    public function insert($table, array $values);
}