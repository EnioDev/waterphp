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
        $cookieLifetime = ini_get('cookie_lifetime');

        if (self::get('app_session_time')) {
            if ($cookieLifetime > 0) {
                if (self::get('app_session_time') < (time() - $cookieLifetime)) {
                    self::stop();
                    return true;
                }
            }
        } else {
            $_SESSION['app_session_time']  = time();
            $_SESSION['app_session_token'] = Encryption::encode(md5(uniqid(rand(), true)));
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
        $appKeys = [
            'app_session_token',
            'app_session_time',
            'app_session_user'
        ];
        if (is_string($key)) {
            if (!in_array($key, $appKeys)) {
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
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