<?php namespace core\base;

use core\database\Crud;

class Model extends Crud
{
    // Você DEVE sobreescrever este atributo na classe filha
    // e definir o nome da tabela que será usado no modelo.
    protected $table = null;

    // Você DEVE redefinir este atributo na classe filha SE
    // o nome do campo chave primária na tabela for diferente.
    protected $primary_key = 'id';

    public final function getTable()
    {
        return $this->table;
    }
}