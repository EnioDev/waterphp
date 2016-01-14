<?php namespace core\traits;

trait ClassMethods
{
    protected static function validateNumArgs($function, $numArgs, $min = 0, $max = 0)
    {
        $namespace = explode('\\', self::getClassName());
        $class = $namespace[(count($namespace) - 1)];

        if ($numArgs >= $min and $numArgs <= $max) {
            return true;
        }
        if ($numArgs > $max) {
            $msg = $class . "::" . $function . "() expects at most " . $max . (($max > 1) ? " parameters, " : " parameter, ") . $numArgs . " given.";
        }
        if ($numArgs < $min) {
            $msg = $class . "::" . $function . "() expects at least " . $min . (($min > 1) ? " parameters, " : " parameter, ") . $numArgs . " given.";
        }
        if ($max == 0 and $numArgs > 0) {
            $msg = $class . "::" . $function . "() doesn't expect any parameter.";
        }

        $_SESSION['debug_backtrace_file'] = debug_backtrace()[1]['file'];
        $_SESSION['debug_backtrace_line'] = debug_backtrace()[1]['line'];

        trigger_error($msg, E_USER_WARNING);
    }

    protected static function getClassName()
    {
        return __CLASS__;
    }

    protected static function validateArgType($function, $arg, $number, $types)
    {
        $namespace = explode('\\', self::getClassName());
        $class = $namespace[(count($namespace) - 1)];

        $expects = implode(' or ', $types);

        $valid = false;

        foreach ($types as $type) {
            switch ($type) {
                case 'null':
                    if (is_null($arg)) {
                        $valid = true;
                    }
                    break;
                case 'array':
                    if (is_array($arg)) {
                        $valid = true;
                    }
                    break;
                case 'object':
                    if (is_object($arg)) {
                        $valid = true;
                    }
                    break;
                case 'bool':
                    if (is_bool($arg)) {
                        $valid = true;
                    }
                    break;
                case 'string':
                    if (is_string($arg)) {
                        $valid = true;
                    }
                    break;
                case 'integer':
                    if (is_integer($arg)) {
                        $valid = true;
                    }
                    break;
                case 'float':
                    if (is_float($arg)) {
                        $valid = true;
                    }
                    break;
            }
        }
        if (!$valid) {

            $_SESSION['debug_backtrace_file'] = debug_backtrace()[1]['file'];
            $_SESSION['debug_backtrace_line'] = debug_backtrace()[1]['line'];

            $msg = $class . "::" . $function . "() expects parameter " . $number . " to be " . $expects . ", " . gettype($arg) . " given.";

            trigger_error($msg, E_USER_WARNING);
        }
    }
}
