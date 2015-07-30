<?php namespace core;

use core\base\View;
use core\utils\Url;
use core\utils\String;
use core\utils\Auth;
use core\utils\Session;
use core\utils\Request;

final class Helpers
{
    public static function current()
    {
        return Url::current();
    }

    public static function base()
    {
        return Url::base();
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
        View::load($view);
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