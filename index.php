<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //header("Expires: 0");

    include_once 'router/Router.php';
    include_once 'exceptions/RouteNotFoundException.php';

    $router = new Router();

    try {
        echo $router->resolve($_SERVER['REQUEST_URI']);
    } catch (RouteNotFoundException $e) {
        echo $e->getMessage();
    }
?>