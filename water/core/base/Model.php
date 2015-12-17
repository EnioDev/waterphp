<?php namespace core\base;

use core\database\Crud;

class Model extends Crud
{
    protected $table = null;
    protected $primary_key = 'id';
}
