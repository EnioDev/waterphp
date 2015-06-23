<?php namespace core\base;

use core\utils\Url;
use core\utils\Strings;

abstract class Controller {

    private $model = null;
    private $token = null;

    use Url;
    use Strings;

    function __construct($model = null)
    {
        $this->setModel($model);
        $this->setToken(Session::token());

        $token = Request::get('_token');

        if ($token) {
            if (!Session::isToken($token)) {
                $error = new Error();
                $error->setTitle('Invalid Token');
                $error->setMessage('The given token is not a valid token! The session time might been expired.');
                $error->show();
            }
        }
    }

    abstract function index();

    private function setModel($model) {
        $this->model = $model;
    }

    protected final function model() {
        return $this->model;
    }

    private function setToken($token) {
        $this->token = $token;
    }

    protected final function token() {
        return $this->token;
    }

    protected function old($key)
    {
        $input = Request::all();
        if ($input) {
            if (isset($input[$key])) {
                return $input[$key];
            }
        }
        return null;
    }

    protected function view($name, $data = null)
    {
        if ($data) {
            foreach ($data as $var => $value) {
                $$var = $value;
            }
        }

        if ($this->model()) {
            $table = $this->model()->getTable();
            $$table = $this->model()->all();
        }

        require APP . $this->viewPath('template/header');
        require APP . $this->viewPath($name);
        require APP . $this->viewPath('template/footer');
    }

    private function viewPath($name)
    {
        $subs = explode('/', $name);
        $last = count($subs)-1;
        $name = 'view' . DS;
        for($i = 0; $i < $last; $i++) {
            $name .= $subs[$i] . DS;
        }
        $name .= $subs[$last] . '.php';
        return $name;
    }
}