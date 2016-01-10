<?php namespace core\base;

final class View
{
    public static function load($view, $data = null)
    {
        if ($data and is_array($data)) {
            foreach ($data as $index => $value) {
                $$index = $value;
            }
        }
        require_once(self::getFilename($view));
    }

    private static function getFilename($view)
    {
        $parts = explode('/', $view);
        $total = count($parts);
        $final = $total-1;
        $filename = VIEW_PATH;
        for ($i = 0; $i < ($final); $i++) {
            $filename .= $parts[$i] . DS;
        }
        $filename .= $parts[$final].'.php';
        return $filename;
    }
}