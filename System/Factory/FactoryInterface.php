<?php

namespace System\Factory;

/**
 * The interface which every factory implements
 *
 * Interface FactoryInterface
 * @package System\Factory
 */
interface FactoryInterface
{
    /**
     * Creates a default instance for some class
     *
     * @param $args
     * @return mixed
     */
    public static function create(...$args);
}