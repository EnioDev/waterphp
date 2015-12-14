<?php namespace core\utils;

final class Session
{
    public static function start()
    {
        session_start();
        return !self::timeout();
    }

    public static function stop()
    {
        if (self::get('app_session_time'))
        {
            session_unset();
            session_destroy();
        }
    }

    private static function timeout()
    {
        if (is_null(self::get('app_session_time')))
        {
            $_SESSION['app_session_time']  = time();
            $_SESSION['app_session_token'] = Encryption::encode(md5(uniqid(rand(), true)));
            $_SESSION['app_session_language'] = DEFAULT_LANGUAGE;
            return true;
        }
        return false;
    }

    public static function set($key, $value)
    {
        if (is_string($key) and !isset($_SESSION[$key])) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key)
    {
        if (is_string($key) and isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function forget($key)
    {
        if (is_string($key) and substr($key, 0, 12) !== 'app_session_') {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }

    public static function token()
    {
        if (self::get('app_session_token')) {
            return Encryption::decode(self::get('app_session_token'));
        }
        return null;
    }
}
