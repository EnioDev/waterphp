<?php namespace core\base;

final class Helper
{
    public static function view($view) {
        return View::load($view);
    }

    public static function strings() {
        return String::values();
    }

    public static function auth() {
        return (Auth::user()) ? new Auth() : null;
    }

    public static function csrf_token() {
        return Session::token();
    }

    public static function old($name) {
        return Request::old($name);
    }

    public static function base_url($path = null)
    {
        if ($path and is_string($path)) {
            return BASE_URL . $path;
        }
        return BASE_URL;
    }

    public static function route($routeName, $params = null)
    {
        if (is_string($routeName)) {
            if ($params and is_array($params) and count($params) > 0) {
                $params = implode('/', $params);
                return BASE_URL . $routeName . DS . $params;
            }
            return BASE_URL . $routeName;
        }
    }

    public static function asset($resource)
    {
        if ($resource and is_string($resource)) {
            return PUBLIC_URL . $resource;
        }
        return null;
    }
}