<?php namespace core\base;

use core\utils\Request;
use core\utils\Session;

abstract class Controller
{
    private $model = null;

    function __construct($model = null)
    {
        $this->setModel($model);
    }

    abstract function index();

    private function setModel($model) {
        $this->model = $model;
    }

    protected final function model() {
        return $this->model;
    }
}