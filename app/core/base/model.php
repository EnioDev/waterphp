<?php namespace core\base;

use core\database\Crud;

class Model extends Crud
{
    // You must override this attribute in a child class
    // and set the table name.
    protected $table = '';

    // If you don't override this attribute in a child class,
    // it will be called 'id' for default.
    protected $pk = 'id';

    public final function getTable() {
        return $this->table;
    }
}