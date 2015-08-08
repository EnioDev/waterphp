<?php namespace core\database;

class Db
{
    private static $instance;

    protected final static function getInstance()
    {
		if (!isset(self::$instance) or is_null(self::$instance))
        {
            self::$instance = new \PDO(DB_DRIVER . ':host=' . DB_HOST . '; port=' .DB_PORT. '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
		}
	}

    protected final static function prepare($sql)
    {
        $statement = null;
        self::getInstance();
		return self::$instance->prepare($sql);
	}

    protected final static function paramType($value = null)
    {
        switch (true) {
            case is_bool($value):
                $numberType = \PDO::PARAM_BOOL;
                break;
            case is_int($value):
                $numberType = \PDO::PARAM_INT;
                break;
            case is_string($value):
                $numberType = \PDO::PARAM_STR;
                break;
            default:
                $numberType = \PDO::PARAM_NULL;
                break;
        }
        return $numberType;
    }
}