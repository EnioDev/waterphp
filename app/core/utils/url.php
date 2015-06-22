<?php namespace core\utils;

trait Url
{
    private $url_controller = null;
    private $url_method = null;
    private $url_params = [];

    private function splitUrl()
    {
        if (isset($_GET['url']))
        {
            // Split URL.
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties.
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_method = isset($url[1]) ? $url[1] : null;

            // Remove controller and action from the split URL.
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params.
            $this->url_params = array_values($url);
        }
    }

    public final function getControllerName() {
        $this->splitUrl();
        return $this->url_controller;
    }

    public final function getMethodName() {
        $this->splitUrl();
        return $this->url_method;
    }

    public final function getParamsArray() {
        $this->splitUrl();
        return $this->url_params;
    }

    public final function debugUrl() {
        $this->splitUrl();
        echo 'Controller: ' . $this->url_controller . '<br>';
        echo 'Method: ' . $this->url_method . '<br>';
        echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
    }
}