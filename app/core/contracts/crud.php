<?php namespace core\contracts;

interface Crud
{
    function insert($data);

    function update($key, $data);

    function delete($key);

    function find($key);

    function where($args);

    function all();
}