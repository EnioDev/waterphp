<?php namespace core\base;

abstract class Controller
{
    private $model;

    function __construct($model = null)
    {
        $this->setModel($model);
    }

    abstract function index();

    private function setModel($name)
    {
        if (is_string($name))
        {
            $namespace = 'model\\' . str_replace(DS, '\\', $name);
            $this->model = new $namespace;
        }
        if (is_object($name))
        {
            $this->model = $name;
        }
    }

    protected final function loadModel($name)
    {
        if (is_string($name))
        {
            $namespace = 'model\\' . str_replace(DS, '\\', $name);
            $model = new $namespace;
            return $model;
        }
    }

    protected final function model()
    {
        return $this->model;
    }
}
