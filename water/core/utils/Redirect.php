<?php namespace core\utils;

final class Redirect
{
    public static function to($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        }
    }
}