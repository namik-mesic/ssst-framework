<?php

use App\Model\User;

include "vendor/autoload.php";
include "boot.php";

$user = User::create([
    'name' => 'Namik',
    'email' => 'namik.mesic@hotmail.com',
    'password' => 'password'
]);

dump($user->getBuilder()->getConnection()->getDriver());