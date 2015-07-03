<?php namespace model;

use core\base\Model;

class User extends Model {

    // @Override
    protected $table = 'users';

    // @Override
    protected $primary_key = 'id';

    // Você pode mapear o nome dos campos na tabela usando
    // constantes e acessá-los posteriormente no controlador.
    // Isto é uma boa prática! =)
    const COLUMN_NAME   = 'name';
    const COLUMN_EMAIL  = 'email';
    const COLUMN_PASSWD = 'password';

}