<?php namespace core\base;

final class Redirect
{
    public static function to($url)
    {
        header('Location: '. $url);
    }
}