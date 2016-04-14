<?php

namespace System\Container;
use Closure;

/**
 * Class Container
 * @package System\Container
 */
class Container
{
    /**
     * Array of key method implementation bindings
     *
     * @var
     */
    protected static $bindings;

    /**
     * Set a particular key binding
     *
     * @param $key
     * @param callable $factory
     */
    public static function bind($key, Callable $factory)
    {
        static::$bindings[$key] = $factory;
    }

    /**
     * Set a singleton key binding
     *
     * @param $key
     * @param callable $factory
     */
    public static function singleton($key, Callable $factory)
    {
        static::$bindings[$key] = $factory();
    }

    /**
     * Resolve a particular key binding
     *
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (array_key_exists($key, static::$bindings))
        {
            $binding = static::$bindings[$key];

            if (is_object($binding) && get_class($binding) == Closure::class)
                return $binding();

            else
                return $binding;
        }

        else
            return null;
    }
}