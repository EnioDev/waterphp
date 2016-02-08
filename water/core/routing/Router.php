<?php namespace core\routing;

final class Router {

    private static $routes = [];
    private $controller = null;
    private $method = null;

    private static function checkRouteName($routeName)
    {
        $pattern = '/^([a-z]+[0-9]*[_|-]*)+([a-z0-9]*[_|-]*)*$/';
        $result = preg_match($pattern, $routeName);
        if ($result) {
            return true;
        } else {
            trigger_error('The route name "<b>'.$routeName.'</b>" is not a valid name. You can use letters, numbers, "_" and "-" to make a route.', E_USER_ERROR);
        }
    }

    private function isControllerMethod($controllerMethod)
    {
        $segments = explode('@', $controllerMethod);
        if (is_array($segments) and count($segments) === 2) {
            return $segments;
        }
        return false;
    }

    private function setControllerMethod($controllerMethod)
    {
        $segments = $this->isControllerMethod($controllerMethod);
        if ($segments) {
            $this->controller = $this->getOSPath($segments[0]);
            $this->method = $segments[1];
        } else {
            $this->controller = $this->getOSPath(self::$routes[Get::urlController()]);
            $this->method = null;
        }
    }

    private function getOSPath($controller)
    {
        $controller = str_replace('/', DS, $controller);
        return $controller;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public function getController()
    {
        $routeName = Get::urlController();
        if (isset(self::$routes[$routeName])) {
            $this->setControllerMethod(self::$routes[$routeName]);
        } else {
            $routeName = Get::urlSegments();
            if (isset(self::$routes[$routeName])) {
                $this->setControllerMethod(self::$routes[$routeName]);
            } else {
                return null;
            }
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
            $routeName = array_search($this->controller . '@' . $this->method, self::$routes);
            $segments = str_replace($routeName, '', Get::urlSegments());
            if (substr($segments, 0, 1) == '/') {
                $segments = substr($segments, 1, strlen($segments)-1);
            }
            $params = explode('/', $segments);
            $params = array_values($params);
            return $params;
        }
        return null;
    }

    public function controller($routeName, $controller)
    {
        if ($this->checkRouteName($routeName))
        {
            if (!$this->isControllerMethod($controller))
            {
                if (!isset(self::$routes[$routeName]))
                {
                    self::$routes[$routeName] = $controller;
                }
            }
        }
    }

    public function controllerMethod($routeName, $controllerMethod)
    {
        if ($this->checkRouteName($routeName))
        {
            if ($this->isControllerMethod($controllerMethod))
            {
                if (!isset(self::$routes[$routeName]))
                {
                    self::$routes[$routeName] = $controllerMethod;
                }
            }
        }
    }
}
