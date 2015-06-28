<?php namespace core;

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
        if (!Url::getController()) 
        {
            $controller = 'controller\\' . strtolower(CONTROLLER_INDEX);
            $controller = new $controller();
            $controller->index();
        }
        else if (file_exists(CONTROLLER_PATH . Url::getController() . '.php'))
        {
            // TODO: Tentar fazer a chamada do controlador mesmo que o nome do arquivo use CamelCase.
            $controller = 'controller\\' . Url::getController();
            $controller = new $controller();

            // Verifica se o método existe no controlador informado.
            if (method_exists($controller, Url::getMethod()))
            {
                // Verifica se algum parâmetro foi informado antes de executar o método.
                if (count(Url::getParams()) > 0) {
                    call_user_func_array(array($controller, Url::getMethod()), Url::getParams());
                // Senão executa o método sem nenhum parâmetro.
                } else {
                    $controller->{Url::getMethod()}();
                }
            } else {
                // Se nenhum método foi informado, então executa o método "index" do controlador.
                if (strlen(Url::getMethod()) == 0) {
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