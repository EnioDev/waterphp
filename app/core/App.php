<?php namespace core;

use core\base\Route;
use core\base\Session;
use core\base\View;
use core\base\Url;

final class App {

    public function __construct()
    {
        if (!Session::start()) {
            header('Location: ' . BASE_URL);
        } else {
            $this->load();
        }
    }
    
    private function load()
    {
        if (!Url::getController())
        {
            $controller = 'controller\\' . CONTROLLER_INDEX;
            $controller = new $controller();
            $controller->index();

        } else {

            $route = new Route();

            $controller = $route->getController();
            $method = $route->getMethod();
            $params = $route->getParams();

            $controller = ($controller) ? $controller : Url::getController();
            $method = ($method) ? $method : Url::getMethod();
            $params = ($params) ? $params : Url::getParams();

            if (file_exists(CONTROLLER_PATH . $controller . '.php'))
            {
                $controller = 'controller\\' . $controller;
                $controller = new $controller();

                if (method_exists($controller, $method))
                {
                    if (is_array($params) and count($params) > 0) {
                        call_user_func_array(array($controller, $method), $params);
                    } else {
                        $controller->{$method}();
                    }
                } else {
                    if (strlen($method) == 0) {
                        $controller->index();
                    } else {
                        View::load('template/404');
                    }
                }
            } else {
                View::load('template/404');
            }
        }
    }
}