<?php namespace core\utils;

final class String
{
    public static function values($node = null)
    {
        $file = LANGUAGE_PATH . APP_LANGUAGE . DS . 'strings.xml';
        if (file_exists($file)) {
            $xml = simplexml_load_file($file);
            if ($node) {
                return (isset($xml->{$node})) ? $xml->{$node} : null;
            } else {
                return $xml;
            }
        }
        return null;
    }
}