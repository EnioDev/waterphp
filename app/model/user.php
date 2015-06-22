<?php namespace model;

use core\base\Model;

class User extends Model {

    // @Override
    protected $table = 'users';

    // @Override
    protected $pk = 'id';

    // You should define the table column names as constants if
    // you want to use them in your controller.
    // It is a good practice! =)
    const COLUMN_NAME   = 'name';
    const COLUMN_EMAIL  = 'email';
    const COLUMN_PASSWD = 'password';

}