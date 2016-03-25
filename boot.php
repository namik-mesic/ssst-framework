<?php

use System\Core\App;

App::bootConfig();
App::loadConfig('App/Config/custom.php');

define('BASE_URI', '/ssst-framework');
define('REQUEST_URI', trim(str_replace(BASE_URI, '', $_SERVER['REQUEST_URI'], $count = 1), '/'));
