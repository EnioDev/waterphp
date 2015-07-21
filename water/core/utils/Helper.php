<?php namespace core\utils;

final class Helper
{
    public static function base()
    {
        return Url::base();
    }

    public static function current()
    {
        return Url::current();
    }

    public static function url($path = null, $params = null)
    {
        return Url::base($path, $params);
    }

    public static function route($routeName, $params = null)
    {
        return Url::route($routeName, $params);
    }

    public static function asset($resource)
    {
        return Url::asset($resource);
    }

    public static function view($view)
    {
        return View::load($view);
    }

    public static function strings()
    {
        return String::values();
    }

    public static function auth()
    {
        return (Auth::user()) ? new Auth() : null;
    }

    public static function token()
    {
        return Session::token();
    }

    public static function old($name)
    {
        return Request::get($name);
    }
}