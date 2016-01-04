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
        if (session_id())
        {
            session_unset();
            session_destroy();
        }
    }

    private static function timeout()
    {
        if (self::get('app_session_time') && (time() > self::get('app_session_time'))) {
            self::stop();
            return true;
        } else {
            self::set('app_session_time', time() + SESSION_LIFETIME, true);
            self::set('app_session_token', Encryption::encode(md5(uniqid(rand(), true))));
            self::set('app_session_encryption_key', ENCRYPTION_KEY);
            self::set('app_session_language', DEFAULT_LANGUAGE);
            return false;
        }
    }

    public static function set($key, $value, $force = false)
    {
        if (is_string($key) and (!isset($_SESSION[$key]) or $force)) {
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
