<?php

use App\DataClass;
use App\DataClassExtended;
use App\Model\User;
use App\Model\UserObserver;
use System\Container\Container;
use System\DataTransformer\DataTransformerInterface;
use System\DataTransformer\JsonDataTransformer;

include "vendor/autoload.php";
include "boot.php";
include "routes.php";
include "functions.php";

Container::bind(DataTransformerInterface::class, function() {

    return new JsonDataTransformer;

});

$data = new DataClassExtended([
    'name' => 'Namik Mesic',
    'email' => 'namik.mesic@hotmail.com',
    'password' => 'secret',
    'courses' => [
        'Software Engineering',
        'Computer Architecture and Design'
    ]
]);

User::addObserver(UserObserver::class);

$user = new User;

$user->setValues([
    'name' => 'Namik Mesic',
    'email' => 'namik.mesic@hotmail.com'
]);

$user->save();