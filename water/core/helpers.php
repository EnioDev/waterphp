<?php

/*
 * ========================================
 * URL HELPERS
 * ========================================
 */

if (!function_exists('current'))
{
    function current()
    {
        return Url::current();
    }
}

if (!function_exists('base'))
{
    function base()
    {
        return core\utils\Url::base();
    }
}

if (!function_exists('url'))
{
    function url($path = null, $params = null)
    {
        return core\utils\Url::base($path, $params);
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
    function view($view)
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

if (!function_exists('auth_user'))
{
    /*
     * This is a new option to the auth function.
     */
    function auth_user()
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
    /*
     * This is a new option to the token function.
     */
    function session_token()
    {
        return core\utils\Session::token();
    }
}

if (!function_exists('old'))
{
    function old($name)
    {
        return core\utils\Request::get($name);
    }
}