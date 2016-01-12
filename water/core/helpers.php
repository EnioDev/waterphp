<?php

/*
 * ========================================
 * URL HELPERS
 * ========================================
 */

if (!function_exists('current'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function current()
    {
        return Url::current();
    }
}

if (!function_exists('current_url'))
{
    function current_url()
    {
        return Url::current();
    }
}

if (!function_exists('base'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function base()
    {
        return core\utils\Url::base();
    }
}

if (!function_exists('base_url'))
{
    function base_url()
    {
        return core\utils\Url::base();
    }
}

if (!function_exists('url'))
{
    function url($str, $params = null)
    {
        return core\utils\Url::base($str, $params);
    }
}

if (!function_exists('controller'))
{
    function controller($controllerName, $params = null)
    {
        return core\utils\Url::controller($controllerName, $params);
    }
}

if (!function_exists('route'))
{
    function route($routeName, $params = null)
    {
        return core\utils\Url::route($routeName, $params);
    }
}

if (!function_exists('asset'))
{
    function asset($resource)
    {
        return core\utils\Url::asset($resource);
    }
}

/*
 * ========================================
 * PATH HELPERS
 * ========================================
 */

if (!function_exists('public_path'))
{
    function public_path()
    {
        return PUBLIC_PATH;
    }
}

if (!function_exists('image_path'))
{
    function image_path()
    {
        return IMAGE_PATH;
    }
}

/*
 * ========================================
 * LANGUAGE HELPERS
 * ========================================
 */

if (!function_exists('default_language'))
{
    function default_language()
    {
        return DEFAULT_LANGUAGE;
    }
}

if (!function_exists('session_language'))
{
    function session_language()
    {
        return core\utils\Session::get('app_session_language');
    }
}

/*
 * ========================================
 * MISCELLANEOUS
 * ========================================
 */

if (!function_exists('view'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function view($view)
    {
        core\base\View::load($view);
    }
}

if (!function_exists('load'))
{
    function load($view)
    {
        core\base\View::load($view);
    }
}

if (!function_exists('strings'))
{
    function strings()
    {
        return core\utils\Lang::strings();
    }
}

if (!function_exists('auth'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function auth()
    {
        return (core\utils\Auth::user()) ? new core\utils\Auth() : null;
    }
}

if (!function_exists('token'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function token()
    {
        return core\utils\Session::token();
    }
}

if (!function_exists('session_token'))
{
    function session_token()
    {
        return core\utils\Session::token();
    }
}

if (!function_exists('old'))
{
    /*
     * @deprecated deprecated since version 1.3.0
     */
    function old($name)
    {
        return core\utils\Request::get($name);
    }
}

if (!function_exists('previous'))
{
    function previous($name)
    {
        return core\utils\Request::get($name);
    }
}
