<?php namespace core\database;

use core\base\Error;

class Db
{
    private static $instance;

    public final static function getInstance()
    {
		if (!isset(self::$instance)) {
			try {
				self::$instance = new \PDO(DB_DRIVER . ':host=' . DB_HOST . '; port=' .DB_PORT. '; dbname=' . DB_NAME . '; charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
				self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
			} catch (\PDOException $e) {
                self::showErrorDetail($e);
			}
		}
	}

    public final static function prepare($sql)
    {
        $statement = null;
        self::getInstance();
        try {
            $statement = self::$instance->prepare($sql);
        } catch (\PDOException $e) {
            self::showErrorDetail($e);
        }
		return $statement;
	}

    public final static function paramType($value = null)
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

    public final static function showErrorDetail($error)
    {
        $detail = '<b>Code</b>: ' . $error->getCode() . '<br>';
        $detail.= '<b>Message</b>: ' . $error->getMessage() . '<br>';
        $detail.= '<b>File</b>: ' . $error->getFile() . '<br>';
        $detail.= '<b>Line</b>: ' . $error->getLine() . '<br>';
        //$detail.= '<br><b>Trace</b>: ' . $error->getTraceAsString();

        $error = new Error(1);
        $error->setTitle('PDO Exception');
        $error->setMessage($detail);
        $error->show();
    }
}