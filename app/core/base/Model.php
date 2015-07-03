<?php namespace core\base;

use core\database\Crud;

class Model extends Crud
{
    // Você DEVE sobreescrever este atributo na classe filha
    // e definir o nome da tabela que será usado no modelo.
    protected $table = null;

    // Você pode redefinir este atributo na classe filha caso
    // o nome do campo chave primária na tabela seja diferente.
    protected $primary_key = 'id';

    public final function getTable()
    {
        return $this->table;
    }
}