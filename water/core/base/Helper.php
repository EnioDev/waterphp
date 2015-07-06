<?php namespace core\base;

final class Helper
{
    public static function strings() {
        return String::values();
    }

    public static function old($name) {
        return Request::old($name);
    }

    public static function csrf_token() {
        return Session::token();
    }

    public static function is_auth() {
        return (Auth::user()) ? true : false;
    }

    public static function view($view) {
        return View::load($view);
    }

    public static function base_url($path = null)
    {
        if ($path and is_string($path)) {
            return BASE_URL . $path;
        }
        return BASE_URL;
    }

    public static function route($name, $params = null)
    {
        if (is_string($name)) {
            if ($params and is_array($params) and count($params) > 0) {
                $params = implode('/', $params);
                return BASE_URL . $name . DS . $params;
            }
            return BASE_URL . $name;
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