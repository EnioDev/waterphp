<?php namespace core;

use core\base\Session;
use core\base\Redirect;
use core\base\View;
use core\base\Url;

final class App {

    public function __construct()
    {
        if (!Session::start()) {
            Redirect::to(BASE_URL);
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

            $namespace = 'controller\\';
            $continue = file_exists(CONTROLLER_PATH . $controller . '.php');

            if ($controller === 'debug') {
                $namespace = 'core\\error\\';
                $controller = ucfirst($controller);
                $continue = file_exists(LIB_PATH . 'core' . DS . 'error' . DS . $controller . '.php');
            }

            if ($continue)
            {
                $controller = $namespace . $controller;
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
                        View::load(ERR404_VIEW);
                    }
                }
            } else {
                View::load(ERR404_VIEW);
            }
        }
    }
}