<?php

namespace System\Singleton;

/**
 * Interface SingletonInterface
 * @package System\Singleton
 */
interface SingletonInterface
{
    /**
     * Returns the singleton instance
     *
     * @return mixed
     */
    public static function getInstance();
}