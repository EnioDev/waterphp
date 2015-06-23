<?php namespace core;

use core\base\Session;
use core\base\Error;
use core\utils\Url;

final class App {

    use Url;

    public function __construct()
    {
        $this->splitUrl();

        // Reinicializa a sessão do usuário sempre que chamar um controlador / método.
        if (!Session::start()) {
            header('Location: ' . BASE_URL);
        } else {
            $this->load();
        }
    }
    
    private function load() 
    {
        // Verifica o controlador: caso nenhum tenha sido informado, executa o controlador padrão.
        if (!$this->url_controller) 
        {
            $this->defaultController();
        }
        else if ($this->controllerExists($this->url_controller))
        {
            $controller = 'controller\\' . $this->url_controller;
            $controller = new $controller();

            // Verifica o método: se ele existe no controlador informado.
            if (method_exists($controller, $this->url_method))
            {
                // Verifica os argumentos: se algum parâmetro foi informado na url,
                // chama o método e passa os argumentos.
                if (!empty($this->url_params)) {
                    call_user_func_array(array($controller, $this->url_method), $this->url_params);
                // Senão executa o método sem nenhum argumento.
                } else {
                    $controller->{$this->url_method}();
                }
            } else {
                // Se nenhum método foi informado, então executa o método "index" do controlador.
                if (strlen($this->url_method) == 0) {
                    $controller->index();
                // Se o método informado não existe, então exibe a página de erro.
                } else {
                    $error = new Error();
                    $error->setTemplate('error/404');
                    $error->show();
                }
            }
        // Se o controlador informado não existe, então exibe a página de erro.
        } else {
            $error = new Error();
            $error->setTemplate('error/404');
            $error->show();
        }
    }
    
    private function defaultController()
    {
        $controller = 'controller\\' . strtolower(DEFAULT_CONTROLLER);
        $controller = new $controller();
        $controller->index();
    }
    
    private function controllerExists($controller) 
    {
        return file_exists(APP . 'controller' . DS . $controller . '.php');
    }
}