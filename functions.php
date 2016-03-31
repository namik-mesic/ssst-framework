<?php

function view($viewName, array $vars = [])
{
    ob_start();

    extract($vars);

    include 'Views/' . str_replace('.', '/', $viewName) . '.php';

    return ob_get_clean();
};

function url($uri)
{
    return BASE_URI . "/{$uri}";
}

function redirect($uri)
{
    $url = url($uri);

    header("location: {$url}");
}