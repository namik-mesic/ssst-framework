<?php

namespace System\Database\MySQL;

use System\Core\App;
use System\Database\BadResourceException;
use mysqli;
use System\Database\Connection\ConnectionInterface;
use System\Database\Connection\ConnectionNotOpenException;

/**
 * Class Connection
 * @package System\Database\MySQL
 */
class Connection implements ConnectionInterface
{
    /**
     * Native php mysqli driver
     *
     * @var mysqli
     */
    protected $driver;

    /**
     * Turns mysqli_result to Object[]
     *
     * @var ObjectAdapter
     */
    protected $adapter;

    /**
     * Sets local values
     *
     * @param mysqli $driver
     * @throws BadResourceException
     */
    public function __construct(mysqli $driver = null)
    {
        $this->adapter = new ObjectAdapter;

        $this->setDriver($driver ?: $this->createDefaultDriver());
    }

    /**
     * Closes the currently open connection
     *
     * @return bool
     * @throws ConnectionNotOpenException
     */
    public function close()
    {
       if (!$this->driver)
           throw new ConnectionNotOpenException;

        else
            $this->driver->close();
    }

    /**
     * Gets the current connection driver
     *
     * @return mysqli|null
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set the current connection driver
     *
     * @param mysqli $driver
     * @throws BadResourceException
     */
    public function setDriver($driver)
    {
        if (!$driver instanceof mysqli)
            throw new BadResourceException;

        else
             $this->driver = $driver;
    }

    /**
     * Perform a query on the currently open connection
     *
     * @param $query
     * @throws ConnectionNotOpenException
     * @return bool|Object[]
     */
    public function query($query)
    {
        if (!$this->driver)
            throw new ConnectionNotOpenException;

        $result = $this->driver->query($query);

        if (is_bool($result))
            return $result;

        else
            return $this->adapter->adapt($result);
    }

    /**
     * Creates a default connection driver based on config settings
     *
     * @return mysqli
     */
    public function createDefaultDriver()
    {
        return new mysqli(
            App::config('database_host'),
            App::config('database_user'),
            App::config('database_password'),
            App::config('database_name')
        );
    }

    /**
     * Returns the last insert id
     *
     * @return int
     */
    public function getInsertId()
    {
        return $this->driver->insert_id;
    }
}