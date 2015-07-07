<?php namespace core\base;

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
            // Remove todas as variáveis definidas na sessão.
            session_unset();

            // Destroi a sessão do usuário.
            session_destroy();
        }
    }

    private static function timeout()
    {
        if (self::get('app_session_time')) {
            if (SESSION_TIMEOUT > 0) {
                if (self::get('app_session_time') < (time() - SESSION_TIMEOUT)) {
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

    public static function token()
    {
        if (self::get('app_session_token')) {
            return Encryption::decode(self::get('app_session_token'));
        }
        return null;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }
}