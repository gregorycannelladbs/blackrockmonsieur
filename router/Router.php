<?php
include_once 'controller/Controller.php';

class Router{
    private array $routes = [
        '/' => '/views/index.php',
        '/recipe' => '/recipe.php',
        '/shoppingList' => '/shoppingList.php'
    ];

    public function register(string $path, callable $action): void{
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri): mixed{
        $path = explode('?', $uri)[0];

        if ($path == '/') return Controller::indexController();
        
        if ($path == '/recipe') return Controller::recipeController();

        if ($path == '/shoppingList') return Controller::shoppingListController();
        
        if ($path == '/savedShoppingList') return Controller::savedShoppingListController();

        return Controller::indexController();
    }
}