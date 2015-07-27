<?php namespace core\base;

abstract class Controller
{
    private $model;

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