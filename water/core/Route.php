<?php namespace core;

use core\utils\Url;

final class Route {

    private static $routes = [];
    private $controller = null;
    private $method = null;

    public function controller($url, $controller)
    {
        if (!$this->isControllerMethod($controller)) {
            if (!isset(self::$routes[$url])) {
                self::$routes[$url] = $controller;
            }
        }
    }

    public function get($url, $controllerMethod)
    {
        if ($this->isControllerMethod($controllerMethod)) {
            if (!isset(self::$routes[$url])) {
                self::$routes[$url] = $controllerMethod;
            }
        }
    }

    private function setControllerMethod($controllerMethod)
    {
        $m = $this->isControllerMethod($controllerMethod);
        if ($m) {
            $this->controller = $m[0];
            $this->method = $m[1];
        } else {
            $this->controller = self::$routes[Url::getController()];
            $this->method = null;
        }
    }

    private function isControllerMethod($controllerMethod)
    {
        $m = explode('@', $controllerMethod);
        if (is_array($m) and count($m) === 2) {
            return $m;
        }
        return false;
    }

    public function getController()
    {
        $urlController = Url::getController();
        $url = Url::get();

        if (isset(self::$routes[$urlController])) {
            $this->setControllerMethod(self::$routes[$urlController]);
        } else if (isset(self::$routes[$url])) {
            $this->setControllerMethod(self::$routes[$url]);
        } else {
            return null;
        }
        return $this->controller;
    }

    public function getMethod()
    {
        if ($this->getController()) {
            return $this->method;
        }
        return null;
    }

    public function getParams()
    {
        if ($this->getMethod())
        {
            $url = array_search($this->controller . '@' . $this->method, self::$routes);
            $url = str_replace($url, '', Url::get());
            if (substr($url, 0, 1) == '/') {
                $url = substr($url, 1, strlen($url)-1);
            }
            $params = explode('/', $url);
            $params = array_values($params);
            return $params;
        }
        return null;
    }
}