<?php

use System\Routes\Router;

include "vendor/autoload.php";
include "boot.php";
include "routes.php";

echo Router::process(REQUEST_URI);