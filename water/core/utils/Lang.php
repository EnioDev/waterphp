<?php namespace core\utils;

final class Lang
{
    private static $xml = null;
    private static $loaded = 0;

    public static function setSessionLanguage($language)
    {
        Session::set('app_session_language', (is_string($language) ? $language : DEFAULT_LANGUAGE), true);
    }

    public static function load($language = null)
    {
        $reload = 0;

        if (is_string($language)) {
            $language = $language;
            $reload = 1;
        } else {
            $language = Session::get('app_session_language');
        }

        $file = LANGUAGE_PATH . $language . DS . 'strings.xml';

        if ((!self::$loaded and file_exists($file)) or $reload)
        {
            self::$xml = simplexml_load_file($file);
            self::$loaded = 1;
        }
    }

    public static function strings($node = null)
    {
        self::load();

        if ($node) {
            $strings = (isset(self::$xml->{$node})) ? self::$xml->{$node} : null;
        } else {
            $strings = self::$xml;
        }

        return $strings;
    }
}
