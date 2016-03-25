<?php

use System\Routes\Router;

Router::register('user/create', 'UserController@create');
Router::register('user/edit', 'UserController@edit');
Router::register('user/show', 'UserController@show');
