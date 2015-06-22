<?php namespace core\base;

final class Session {

    public static function start()
    {
        session_start();
        return !self::timeout();
    }

    public static function stop()
    {
        // Removes all session variables.
        session_unset();

        // Destroys the session.
        session_destroy();
    }

    private static function timeout()
    {
        if (isset($_SESSION['app_session_time'])) {
            if (SESSION_TIMEOUT > 0) {
                if ($_SESSION['app_session_time'] < (time() - SESSION_TIMEOUT)) {
                    self::stop();
                    return true;
                }
            }
        } else {
            $_SESSION['app_session_time']  = time();
            $_SESSION['app_session_token'] = Encryption::make(md5(uniqid(rand(), true)));
        }
        return false;
    }

    public static function token()
    {
        if (isset($_SESSION['app_session_token'])) {
            return Encryption::undo($_SESSION['app_session_token']);
        }
        return null;
    }

    public static function isToken($token)
    {
        if (self::token() === $token) {
            return true;
        }
        return false;
    }
}