<?php namespace core\base;

final class Url
{
    private static function splitUrl($type = null)
    {
        if (self::get())
        {
            $url = explode('/', self::get());
            $get = array();

            $get['controller'] = $controller = isset($url[0]) ? $url[0] : null;
            $get['method'] = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $get['params'] = array_values($url);

            if ($type) {
                return $get[$type];
            } else {
                return $get;
            }
        }
        return null;
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

    public static function debugUrl()
    {
        var_dump(self::splitUrl());
    }
}