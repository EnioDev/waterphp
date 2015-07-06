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

    public static function base_url($url = null)
    {
        if ($url and is_string($url)) {
            return BASE_URL . $url;
        }
        return BASE_URL;
    }

    public static function route($name, $params = null)
    {
        if (is_string($name)) {
            if ($params and is_array($params) and count($params) > 0) {
                $params = implode('/', $params);
                return BASE_URL . $name . $params;
            }
            return BASE_URL . $name;
        }
    }

    public static function asset($file)
    {
        if ($file and is_string($file)) {
            return PUBLIC_URL . $file;
        }
        return null;
    }
}