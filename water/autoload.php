<?php
    function loadClass($className)
    {
        $fileName = '';
        $appPath = APP_PATH;
        $libPath = LIB_PATH;

        if (false !== ($lastNsPos = strripos($className, '\\')))
        {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DS, $namespace) . DS;
        }

        $fileName .= str_replace('_', DS, $className) . '.php';
        $fullFileName = $libPath . $fileName;

        if (file_exists($fullFileName)) {
            require_once($fullFileName);
        } else {
            $fullFileName = $appPath . $fileName;
            if (file_exists($fullFileName))
                require_once($fullFileName);
            else {
                throw new \Exception('Class "'.$className.'" does not exist.');
            }
        }
    }
    spl_autoload_register('loadClass');