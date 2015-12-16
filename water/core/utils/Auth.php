<?php namespace core\utils;

final class Auth
{
    public static function make($user)
    {
        if (!Session::get('app_session_user')) {
            Session::set('app_session_user', Encryption::encode(serialize($user)));
        }
    }

    public static function user()
    {
        if (Session::get('app_session_user')) {
            return unserialize(Encryption::decode(Session::get('app_session_user')));
        }
        return null;
    }
}
