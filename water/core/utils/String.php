<?php namespace core\utils;

/**
 * @deprecated Deprecated since version 1.2.0. See the documentation for more details.
 */
final class String
{
    /**
     * @deprecated Deprecated since version 1.2.0. See the documentation for more details.
     */
    public static function values($node = null)
    {
        $file = LANGUAGE_PATH . APP_LANGUAGE . DS . 'strings.xml';
        if (file_exists($file)) {
            $xml = simplexml_load_file($file);
            if ($node) {
                return (isset($xml->{$node})) ? $xml->{$node} : null;
            } else {
                return $xml;
            }
        }
        return null;
    }
}
