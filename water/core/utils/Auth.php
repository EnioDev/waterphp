<?php namespace core\utils;

final class Auth
{
    use \core\traits\ClassMethods;

    public static function make($user)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $user, 1, ['object']);

        if (!Session::get('app_session_user') and is_object($user)) {
            Session::set('app_session_user', Encryption::encode(serialize($user)));
        }
    }

    public static function user()
    {
        self::validateNumArgs(__FUNCTION__, func_num_args());

        if (Session::get('app_session_user')) {
            return unserialize(Encryption::decode(Session::get('app_session_user')));
        }
        return null;
    }
}
