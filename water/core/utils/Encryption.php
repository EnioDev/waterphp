<?php namespace core\utils;

use core\contracts\ICrypt;

final class Encryption implements ICrypt
{
    use \core\traits\ClassMethods;

    public static function encode($decrypted)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $decrypted, 1, ['string']);

        if (ENCRYPTION_KEY and SECRET_WORD and is_string($decrypted)) {
            $iv = substr(hash('sha256', SECRET_WORD), 0, 16);
            $encrypted = openssl_encrypt($decrypted, 'AES-256-CBC', ENCRYPTION_KEY, 0, $iv);
            $encrypted = base64_encode($encrypted);
            return trim($encrypted);
        }
        return '';
    }

    public static function decode($encrypted)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $encrypted, 1, ['string']);

        $iv = substr(hash('sha256', ENCRYPTION_KEY), 0, 16);

        if (ENCRYPTION_KEY and SECRET_WORD and is_string($encrypted)) {
            $iv = substr(hash('sha256', SECRET_WORD), 0, 16);
            $encrypted = base64_decode($encrypted);
            $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', ENCRYPTION_KEY, 0, $iv);
            return trim($decrypted);
        }
        return '';
    }
}