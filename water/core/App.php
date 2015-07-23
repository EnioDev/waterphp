<?php namespace core;

use core\utils\Redirect;
use core\utils\Request;
use core\utils\Session;
use core\utils\Url;
use core\utils\View;

final class App {

    public function __construct()
    {
        if (!Session::start()) {
            Redirect::to(Url::base());
        } else {
            $this->verifyCSRFToken();
            $this->load();
        }
    }
    
    private function load()
    {
        if (!Get::controller())
        {
            $controller = 'controller\\' . CONTROLLER_INDEX;
            $controller = new $controller();
            $controller->index();

        } else {

            $route = new Route();

            $controller = $route->getController();
            $method = $route->getMethod();
            $params = $route->getParams();

            $controller = ($controller) ? $controller : Get::controller();
            $method = ($method) ? $method : Get::method();
            $params = ($params) ? $params : Get::params();

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
                        View::load(ERROR_404_VIEW);
                    }
                }
            } else {
                View::load(ERROR_404_VIEW);
            }
        }
    }

    public function verifyCSRFToken()
    {
        $token = Request::get('_token');
        if ($token) {
            if (Session::token() != trim($token)) {
                trigger_error('The given token is not a valid token!', E_USER_ERROR);
            }
        }
    }
}