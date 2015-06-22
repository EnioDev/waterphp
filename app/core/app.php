<?php namespace core;

use core\base\Session;
use core\base\Error;
use core\utils\Url;

final class App {

    use Url;

    public function __construct()
    {
        $this->splitUrl();

        // Starts the session before executing controller/action.
        if (!Session::start()) {
            header('Location: ' . BASE_URL);
        } else {
            $this->load();
        }
    }
    
    private function load() 
    {
        // Check for controller: no controller given? Then load default controller.
        if (!$this->url_controller) 
        {
            $this->loadDefaultController();
        } 
        else if ($this->checkController($this->url_controller))
        {
            $controller = 'controller\\' . $this->url_controller;
            $controller = new $controller();

            // Check for method: does this method exist in the controller?
            if (method_exists($controller, $this->url_method)) {

                if (!empty($this->url_params)) {
                    // Call the method and pass arguments to it.
                    call_user_func_array(array($controller, $this->url_method), $this->url_params);
                } else {
                    // If no parameters are given, just call the method without parameters.
                    $controller->{$this->url_method}();
                }

            } else {
                if (strlen($this->url_method) == 0) {
                    // No action defined: call the default index() method of a selected controller.
                    $controller->index();
                } else {
                    $error = new Error();
                    $error->setTemplate('error/404');
                    $error->show();
                }
            }
        } else {
            $error = new Error();
            $error->setTemplate('error/404');
            $error->show();
        }
    }
    
    private function loadDefaultController()
    {
        $controller = 'controller\\' . strtolower(DEFAULT_CONTROLLER);
        $controller = new $controller();
        $controller->index();
    }
    
    private function checkController($controller) 
    {
        return file_exists(APP_DIR . 'controller' . DS . $controller . '.php');
    }
}