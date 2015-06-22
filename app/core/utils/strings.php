<?php namespace core\utils;

trait Strings
{
    public final function strings($name = null)
    {
        $file = VALUES_DIR . APP_LANGUAGE . DS . 'strings.xml';
        if (file_exists($file)) {
            $strings = simplexml_load_file($file);
            if ($name) {
                return (isset($strings->$name)) ? $strings->$name : null;
            } else {
                return $strings;
            }
        }
        return null;
    }
}