<?php namespace core\base;

final class Route {

    private static $routes = [];

    public function controller($index, $controllerMethod)
    {
        self::$routes[$index] = $controllerMethod;
    }

    public function getController($index)
    {
        if (isset(self::$routes[$index])) {
            return self::$routes[$index];
        }
        return null;
    }
}