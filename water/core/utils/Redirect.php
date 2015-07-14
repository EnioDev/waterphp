<?php namespace core\utils;

final class Redirect
{
    public static function to($url)
    {
        if (!headers_sent()) {
            session_write_close();
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$url);
            exit();
        }
    }
}