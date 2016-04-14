<?php

namespace App\Factories;

use App\Model\User;
use System\Factory\FactoryInterface;

/**
 * Class UserFactory
 * @package App\Factories
 */
class UserFactory implements FactoryInterface
{
    /**
     * Creates a default instance for the User class
     *
     * @param $args
     * @return User
     */
    public static function create(...$args)
    {
        return new User($args);
    }
}