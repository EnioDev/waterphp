<?php
    function loadClass($className)
    {
        $fileName = '';
        $namespace = '';
        $includePath = APP_PATH;

        if (false !== ($lastNsPos = strripos($className, '\\'))) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DS, $namespace) . DS;
        }
        $fileName .= str_replace('_', DS, $className) . '.php';
        $fullFileName = $includePath . $fileName;

        if (file_exists($fullFileName)) {
            require $fullFileName;
        } else {
            echo 'Class "'.$className.'" does not exist.';
        }
    }
    spl_autoload_register('loadClass');