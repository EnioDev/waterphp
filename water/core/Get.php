<?php namespace core;

final class Get
{
    private static function splitUrl($type = null)
    {
        if (self::url())
        {
            $segments = array();

            $url = explode('/', self::url());

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

    public static function url()
    {
        $url = null;
        if (isset($_GET['url']))
        {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
        }
        return $url;
    }

    public static function controller()
    {
        return self::splitUrl('controller');
    }

    public static function method()
    {
        return self::splitUrl('method');
    }

    public static function params()
    {
        return self::splitUrl('params');
    }
}