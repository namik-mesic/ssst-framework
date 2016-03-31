<?php

namespace App\Controllers;

use App\Model\User;
use System\Database\MySQL\Builder;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Sets local variables
     */
    public function __construct()
    {
        $this->builder = new Builder;
    }

    /**
     * Displays all users
     *
     * @return string
     */
    public function index()
    {
        // $users = User::all();

        $users = $this->builder
            ->from('users')
            ->get();

        return view('user.index', compact(
            'users'
        ));
    }

    /**
     * Shows a form for creating a user
     *
     * @return string
     */
    public function create()
    {
        $text = 'Hello world';

       return view('user.create', compact(
           'text'
       ));
    }

    /**
     * Creates a user based on a POST request
     *
     * Redirects
     */
    public function post()
    {
        User::create($_POST);

        redirect('user/index');
    }

    public function edit()
    {
        
    }

    public function show()
    {
        
    }
}