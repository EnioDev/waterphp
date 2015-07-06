<?php namespace core\base;

final class Helper
{
    public static function values() {
        return String::values();
    }

    public static function old($name) {
        return Request::old($name);
    }

    public static function token() {
        return Session::token();
    }

    public static function isAuth() {
        return (Auth::user()) ? true : false;
    }

    public static function template($view) {
        return View::load($view);
    }

    public static function getPublic($filePath) {
        return PUBLIC_URL . $filePath;
    }

    public static function baseUrl() {
        return BASE_URL;
    }

    public static function url($route) {
        return BASE_URL . $route;
    }
}