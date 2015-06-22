<?php namespace core\base;

// TODO: Tentar colocar a classe no namespace global.
final class Auth
{
    public static function make($user) {
        $_SESSION['authenticated_user'] = Encryption::make(serialize($user));
    }

    public static function user() {
        if (isset($_SESSION['authenticated_user'])) {
            return unserialize(Encryption::undo($_SESSION['authenticated_user']));
        }
        return null;
    }
}