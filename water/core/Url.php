<?php namespace core;

final class Url
{
    private static function splitUrl($type = null)
    {
        if (self::get())
        {
            $url = explode('/', self::get());
            $segments = array();

            $segments['controller'] = $controller = isset($url[0]) ? $url[0] : null;
            $segments['method'] = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $segments['params'] = array_values($url);

            if ($type) {
                return $segments[$type];
            } else {
                return $segments;
            }
        }
        return null;
    }

    public static function base()
    {
        return BASE_URL;
    }

    public static function current()
    {
        $url = self::base() . self::get();
        return $url;
    }

    public static function get()
    {
        $url = null;
        if (isset($_GET['url']))
        {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
        }
        return $url;
    }

    public static function getController()
    {
        return self::splitUrl('controller');
    }

    public static function getMethod()
    {
        return self::splitUrl('method');
    }

    public static function getParams()
    {
        return self::splitUrl('params');
    }
}