<?php
    function __autoload($className) {
        $file = APP_PATH . str_replace('\\', DS, strtolower($className)) . '.php';
        if (file_exists($file)) {
            require_once($file);
        } else {
            echo 'The class name '. $className .' does not exists.';
            return false;
        }
        return true;
	}