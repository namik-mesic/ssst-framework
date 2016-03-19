<?php

namespace System\Database\Connection;

use System\Database\BadResourceException;

/**
 * Interface ConnectionInterface
 * @package System\Connection
 */
interface ConnectionInterface
{
    /**
     * Closes the currently open connection
     *
     * @return bool
     * @throws ConnectionNotOpenException
     */
    public function close();

    /**
     * Gets the current connection driver
     *
     * @return $driver
     */
    public function getDriver();

    /**
     * Set the current connection driver
     *
     * @param $driver
     * @throws BadResourceException
     */
    public function setDriver($driver);

    /**
     * Perform a query on the currently open connection
     *
     * @param $query
     * @throws ConnectionNotOpenException
     * @return bool|Object[]
     */
    public function query($query);

    /**
     * Creates a default connection driver
     *
     * @return mixed
     */
    public function createDefaultDriver();
}