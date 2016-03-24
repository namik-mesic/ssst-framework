<?php

namespace System\Core;

/**
 * Class App
 * @package System\Core
 */
class App
{
    /**
     * System config
     *
     * @var array
     */
    protected static $config = [];

    /**
     * Loads and merges config to existing application configuration
     *
     * @param string $path
     */
    public static function loadConfig($path = 'System/Config/default.php')
    {
        static::$config = array_merge(static::$config, require($path));
    }

    /**
     * Resets the config array to an empty array
     */
    public static function flushConfig()
    {
        static::$config = [];
    }

    /**
     * Sets config to default config values
     */
    public static function bootConfig()
    {
        static::flushConfig();
        static::loadConfig();
    }

    /**
     * Sets config to default config values
     */
    public static function resetConfig()
    {
        static::bootConfig();
    }

    /**
     * Gets a config value
     *
     * @param string $key
     * @return string|null
     */
    public static function config($key)
    {
        if (isset(static::$config[$key]))
            return static::$config[$key];

        else
            return null;
    }

    /**
     * Sets an uncommitted config value
     *
     * @param $key
     * @param $value
     */
    public static function setConfig($key, $value)
    {
        static::$config[$key] = $value;
    }

    /**
     * Returns all config values
     *
     * @return array
     */
    public static function getConfigValues()
    {
        return static::$config;
    }
}