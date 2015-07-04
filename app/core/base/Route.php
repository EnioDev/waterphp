<?php namespace core\base;

final class Route {

    private static $routes = [];
    private $controller = null;
    private $method = null;

    public function controller($url, $controller)
    {
        $m = explode('@', $controller);
        if (!(is_array($m) and count($m) === 2)) {
            if (!isset(self::$routes[$url])) {
                self::$routes[$url] = $controller;
            } else {
                trigger_error('The route name has already been defined.', E_USER_WARNING);
            }
        }
    }

    public function get($url, $controllerMethod)
    {
        $m = explode('@', $controllerMethod);
        if (is_array($m) and count($m) === 2) {
            if (!isset(self::$routes[$url])) {
                self::$routes[$url] = $controllerMethod;
            } else {
                trigger_error('The route name has already been defined.', E_USER_WARNING);
            }
        }
    }

    private function setControllerMethod($controllerMethod)
    {
        $m = explode('@', $controllerMethod);
        if (is_array($m) and count($m) === 2) {
            $this->controller = $m[0];
            $this->method = $m[1];
        } else {
            $this->controller = self::$routes[Url::getController()];
            $this->method = null;
        }
    }

    public function getController()
    {
        if (isset(self::$routes[Url::getController()])) {
            $this->setControllerMethod(self::$routes[Url::getController()]);
            return $this->controller;
        } else if (isset(self::$routes[Url::get()])) {
            $this->setControllerMethod(self::$routes[Url::get()]);
            return $this->controller;
        }
        return null;
    }

    public function getMethod()
    {
        if ($this->getController()) {
            return $this->method;
        }
        return null;
    }
}