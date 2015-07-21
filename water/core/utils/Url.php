<?php namespace core\utils;

use core\Get;
use core\Route;

final class Url
{
    public static function current()
    {
        $url = self::base() . Get::url();
        return $url;
    }

    public static function base($path = null, $params = null)
    {
        if ($path and is_string($path) and strlen($path) > 0)
        {
            if ($params and is_array($params) and count($params) > 0)
            {
                $params = implode('/', $params);
                return self::base() . $path . DS . $params;
            }
            return self::base() . $path;
        }
        return BASE_URL;
    }

    public static function route($routeName, $params = null)
    {
        if (is_string($routeName) and strlen($routeName) > 0)
        {
            if (array_key_exists($routeName, Route::getRoutes()))
            {
                if ($params and is_array($params) and count($params) > 0)
                {
                    $params = implode('/', $params);
                    return self::base() . $routeName . DS . $params;
                }
                return self::base() . $routeName;
            }
        }
        return null;
    }

    public static function asset($resource)
    {
        if (is_string($resource) and strlen($resource) > 0)
        {
            return PUBLIC_URL . $resource;
        }
        return null;
    }
}