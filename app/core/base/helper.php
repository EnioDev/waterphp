<?php namespace core\base;

final class Helper
{
    public static function values() {
        return String::values();
    }

    public static function old($key) {
        return Request::old($key);
    }

    public static function token() {
        return Session::token();
    }

    public static function isAuth() {
        return (Auth::user()) ? true : false;
    }

    public static function template($view) {
        return View::load($view, null);
    }
}