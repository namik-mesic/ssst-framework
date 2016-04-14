<?php

namespace App;
use System\Singleton\SingletonInterface;

/**
 * Class Kernel
 * @package App
 */
class Kernel implements SingletonInterface
{
    /**
     * @var Kernel
     */
    protected static $instance;

    /**
     * @return string
     */
    public function boot()
    {
        return "Booting...";
    }

    /**
     * Hidden Kernel constructor
     */
    protected function __construct() {}

    /**
     * Returns the singleton Kernel instance
     *
     * @return Kernel
     */
    public static function getInstance()
    {
        if (!static::$instance)
            static::$instance = new Kernel;

        return static::$instance;
    }    
}