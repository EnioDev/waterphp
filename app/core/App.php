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
        // Se nenhum controlador foi informado executa o controlador padrão.
        if (!Url::getController()) {
            $controller = 'controller\\' . CONTROLLER_INDEX;
            $controller = new $controller();
            $controller->index();
        } else {

            $route = new Route();

            $controller = Url::getController();
            $method = Url::getMethod();
            $params = Url::getParams();

            if ($route->getController()) {
                $controller = $route->getController();
            }

            if ($route->getMethod()) {
                $method = $route->getMethod();
                $params = [];
            }

            if (file_exists(CONTROLLER_PATH . $controller . '.php'))
            {
                $controller = 'controller\\' . $controller;
                $controller = new $controller();

                // Verifica se o método existe no controlador informado.
                if (method_exists($controller, $method)) {
                    // Verifica se algum parâmetro foi informado antes de executar o método.
                    if (count($params) > 0) {
                        call_user_func_array(array($controller, $method), $params);
                        // Senão executa o método sem nenhum parâmetro.
                    } else {
                        $controller->{$method}();
                    }
                } else {
                    // Se nenhum método foi informado, então executa o método "index" do controlador.
                    if (strlen($method) == 0) {
                        $controller->index();
                        // Se o método informado não existe, então exibe a página de erro 404.
                    } else {
                        View::load('template/404');
                    }
                }
            // Se o controlador informado não existe, então exibe a página de erro 404.
            } else {
                View::load('template/404');
            }
        }
    }
}