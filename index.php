<?php

use App\Model\User;

include "vendor/autoload.php";

$user = new User;

$user->name = "Namik";
$user->email = "namik.mesic@hotmail.com";
$user->password = "superSecretPassword";

$user->save();