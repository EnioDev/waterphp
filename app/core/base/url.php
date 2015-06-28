<?php namespace core\base;

final class Url
{
    private static function splitUrl($type = null)
    {
        if (isset($_GET['url']))
        {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $controller = isset($url[0]) ? $url[0] : null;
            $method = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $params = array_values($url);

            if ($type) {
                return $$type;
            } else {
                return [
                    'controller' => $controller,
                    'method' => $method,
                    'params' => $params
                ];
            }
        }
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