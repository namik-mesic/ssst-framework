<?php

namespace App\Model;

use System\Model\Model;

/**
 * Class user
 * @package App\Model
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string identifier
 */
class User extends Model
{
    /**
     * The name of the associated table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The array of fields in the database (excluding id)
     *
     * @var array
     */
    protected $fields = [
        'name',
        'email',
        'password',
        'identifier'
    ];
}