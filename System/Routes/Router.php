<?php

namespace System\Routes;

/**
 * Class Router
 * @package System\Routes
 */
class Router
{
    /**
     * Array of available system routes
     *
     * @var array
     */
    protected static $routes = [];

    /**
     * Register a route that can be hit
     *
     * @param $routeName
     * @param $action
     */
    public static function register($routeName, $action)
    {
        static::$routes[$routeName] = $action;
    }

    /**
     * Get all routes that have been registered so far
     *
     * @return array
     */
    public static function getRoutes()
    {
        return static::$routes;
    }

    public static function process($route)
    {
        if (!isset(static::$routes[$route]))
            throw new RouteNotFoundException;

        $action = explode('@', static::$routes[$route]);

        $className = 'App\\Controllers\\' . $action[0];

        $controller = new $className;
        $method = $action[1];

        return $controller->$method();
    }
}