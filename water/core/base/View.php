<?php namespace core\base;

final class View
{
    private static function getFilename($view)
    {
        $parts = explode('/', $view);
        $total = count($parts);
        $final = $total - 1;
        $filename = VIEW_PATH;
        for ($i = 0; $i < ($final); $i++) {
            $filename .= $parts[$i] . DS;
        }
        $filename .= $parts[$final] . '.php';
        return $filename;
    }

    public static function load($view, $data = null)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 2);
        self::validateArgType(__FUNCTION__, $view, 1, ['string']);
        self::validateArgType(__FUNCTION__, $data, 2, ['array', 'null']);

        if (is_string($view)) {
            if ($data and is_array($data)) {
                foreach ($data as $index => $value) {
                    $$index = $value;
                }
            }
            require_once(self::getFilename($view));
        }
    }
}